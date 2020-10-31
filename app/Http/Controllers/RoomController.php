<?php

namespace App\Http\Controllers;

use App\Room;
use App\RoomUser;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RoomController extends Controller
{
    /**
     * @return string
     * @throws \Exception
     */
    public function createRoom()
    {
        // Get the data from the request or set to null, if data was not passed //
        $title = $_REQUEST['roomName'] ?? null;
        $roomUrl = rand(10000, 99999);
        $password = $_REQUEST['roomPassword'] ?? null;
        $adminUserId = Auth::id();
        $status = true;

        // Check if all data was passed //
        if ($title) {
            // Generate new user //
            $room = new Room();
            $roomUser = new RoomUser();

            // Set data to new user //
            $room->createRoom($title, $roomUrl, Hash::make($password), $adminUserId, $status);
            $roomUser->joinRoom($room->room_id);
            return $room->room_url;
        } else {
            throw new \Exception('No title was passed!');
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
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
    public function getRoomUsers(int $roomURL = null, bool $selectUsername = false)
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
    public function getRooms()
    {
        $sql = sprintf('
            select title, room_url, table_status from rooms, room_users
            where rooms.room_id = room_users.room_id
            and room_users.user_id = "%s"
        ', Auth::id());
        return DB::select(DB::raw($sql));
    }

    /**
     * @param int $roomUrl
     * @return bool
     */
    public function roomIsActive(int $roomUrl)
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
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
     */
    public function getRoomTitle(int $roomUrl)
    {
        return DB::table('rooms')
            ->select('title')
            ->where('room_url', '=', $roomUrl)
            ->first();
    }
}
