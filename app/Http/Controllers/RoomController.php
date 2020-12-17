<?php

namespace App\Http\Controllers;

use App\Room;
use App\RoomUser;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RoomController extends Controller
{
    /**
     * @return string
     * @throws Exception
     */
    public function createRoom(): string
    {
        // Get the data from the request or set to null, if data was not passed //
        $title = $_REQUEST['roomName'] ?? null;
        $roomUrl = rand(10000, 99999);
        $password = $_REQUEST['roomPassword'] ?? null;
        $joinRoom = $_REQUEST['joinRoom'] ?? null;
        $adminUserId = Auth::id();
        $status = true;

        // Check if all data was passed //
        if ($title) {
            // Generate new user //
            $room = new Room();
            $roomUser = new RoomUser();

            // Set data to new user //
            $room->createRoom($title, $roomUrl, Hash::make($password), $adminUserId, $status);
            if ($joinRoom) {
                $roomUser->joinRoom($room->room_id);
            }
            return $room->room_url;
        } else {
            throw new \Exception('No title was passed!');
        }
    }

    /**
     * @return Application|RedirectResponse|Redirector
     * @throws Exception
     */
    public function joinRoom()
    {
        // Get the data from the request or set to null, if data was not passed //
        $roomUrl = $_REQUEST['roomUrl'] ?? null;
        $password = $_REQUEST['roomPassword'] ?? null;
        // Check if all data was passed //
        if ($roomUrl) {
            // Generate new user //
            $room = new Room();
            $roomUser = new RoomUser();
            $response = $room->getRoom($roomUrl);
            if ($response->room_url) {
                $roomUsers = DB::table('room_users')
                    ->where('user_id', '=', Auth::id())
                    ->where('room_id', '=', $response->room_id)
                    ->first();
                if (isset($roomUsers->user_id)) {
                    throw new \Exception('This user already joined this room!');
                }

                if ($response->room_password) {
                    if (!Hash::check($password, $response->room_password)) {
                        throw new \Exception('Wrong room password!');
                    }
                }
                $roomUser->joinRoom($response->room_id);
                return redirect(sprintf('room/%s', $roomUrl));
            } else {
                throw new \Exception('Room doesn\'t exist!');
            }
        } else {
            throw new \Exception('No room URL was passed!');
        }
    }

    /**
     * @param int|null $roomURL
     * @param bool $selectUsername
     * @return array
     * @throws Exception
     */
    public function getRoomUsers(int $roomURL = null, bool $selectUsername = false): array
    {
        $roomURL = $_REQUEST['roomURL'] ?? $roomURL;
        if (!$roomURL) {
            throw new \Exception('Room URL was not passed!');
        }
        $sql = sprintf('
            select %s from users, rooms, room_users
            where users.user_id = room_users.user_id
            and rooms.room_id = room_users.room_id
            and rooms.room_url = %s;',
            $selectUsername ? 'username' : 'name',
            $roomURL
        );
        $users = DB::select(DB::raw($sql));
        $sql = sprintf('
            select u.name
            from room_users ru, rooms r, users u
            where r.room_id = ru.room_id
            and r.room_url = %s
            and ru.user_id = %s
            and u.user_id = ru.picked_user_id
        ', $roomURL, Auth::id());
        $pickedName = DB::select(DB::raw($sql));
        return ['users' => $users, 'pickedName' => $pickedName];

    }

    /**
     * @return array
     */
    public function getRooms(): array
    {
        $sql = sprintf('
            select title, room_url, table_status
            from rooms
            where room_url
            in (
                select room_url
                from rooms
                inner join room_users
                on rooms.room_id = room_users.room_id
                and room_users.user_id = "%1$s"
            )
            or (room_url
            not in (
                select room_url
                from rooms
                inner join room_users
                on rooms.room_id = room_users.room_id
                and room_users.user_id = "%1$s"
            )
            and rooms.admin_user_id = "%1$s"
);
        ', Auth::id());
        return DB::select(DB::raw($sql));
    }

    /**
     * @param int $roomUrl
     * @return bool
     */
    public function roomIsActive(int $roomUrl): bool
    {
        return DB::select(DB::raw(
                sprintf('select table_status from rooms where room_url = %s', $roomUrl)))[0]->table_status ?? true;
    }

    /**
     * @param int $roomUrl
     * @throws Exception
     */
    public function generateUsers(int $roomUrl): void
    {
        if (!$this->roomIsActive($roomUrl)) {
            throw new Exception('This room has already been generated!');
        }
        $users = $this->getRoomUsers($roomUrl, true)['users'] ?? [];
        if (count($users) < 3) {
            throw new Exception('Not enough users!');
        }

        $names = [];
        foreach ($users as $user) {
            array_push($names, $user->username);
        }

        $generatedUsers = $this->generate($names);

        foreach ($generatedUsers as $key => $generatedUser) {
            $sql = sprintf('
                update room_users ru, users u, rooms r
                set ru.picked_user_id = (select user_id from users where username = \'%s\')
                where ru.user_id = u.user_id
                and r.room_id = ru.room_id
                and r.room_url = \'%s\'
                and u.username = \'%s\';',
                $generatedUser, $roomUrl, $key
            );
            DB::statement($sql);
        }
        DB::statement(sprintf('
            update rooms
            set table_status = false
            where room_url = %s
        ', $roomUrl));
    }


    /**
     * @param array $names
     * @return array
     * @throws Exception
     */
    function generate(array $names): array
    {
        $generatedNames = [];
        $usedNames = [];

        for ($i = 0; $i < count($names); $i++) {
            $pickedName = 0;
            $counter = 0;

            do {
                $pickedName = rand(0, count($names) - 1);
                $counter++;
                if ($counter > 200) {
                    throw new Exception('There was a problem generating the names!');
                }
            } while ($pickedName == $i ||
            ($pickedName != $i + 1 && !in_array($i + 1, $usedNames) && $i == count($names) - 2) ||
            in_array($pickedName, $usedNames));

            $generatedNames[$names[$i]] = $names[$pickedName];
            array_push($usedNames, $pickedName);
        }

        return $generatedNames;
    }

    /**
     * @param int $roomUrl
     * @return Model|Builder|object|null
     */
    public function getRoomTitle(int $roomUrl)
    {
        return DB::table('rooms')
            ->select('title')
            ->where('room_url', '=', $roomUrl)
            ->first();
    }

    /**
     * @param string $roomUrl
     * @return array
     */
    public function getUserList(string $roomUrl): array
    {
        return DB::select(DB::raw(sprintf('
            select u1.name user, u2.name pickedUser
            from rooms, users u1, users u2, room_users
            where rooms.room_id = room_users.room_id
            and rooms.room_url = "%s"
            and u1.user_id = room_users.user_id
            and u2.user_id = room_users.picked_user_id;
        ', $roomUrl)));
    }
}
