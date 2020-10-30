<?php

namespace App\Http\Controllers;

use App\Room;
use App\RoomUser;
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
     * @return array
     * @throws \Exception
     */
    public function getRoomUsers()
    {
        $roomURL = $_REQUEST['roomURL'];
        if ($roomURL) {
            $sql = sprintf('
                        select name from users, rooms, room_users
                        where users.user_id = room_users.user_id
                        and rooms.room_id = room_users.room_id
                        and rooms.room_url = %s;',
                $roomURL
            );
            return DB::select(DB::raw($sql));
        } else {
            throw new \Exception('Room URL was not passed!');
        }
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
}
