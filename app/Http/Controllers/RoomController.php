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
    //
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
        }
    }

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
                if (Auth::check()) {
                    return DB::table('users')->where('user_id', '=', Auth::id())->first();
                }
                else if ($response->room_password) {
                    if (Hash::check($password, $response->room_password)) {
                        $roomUser->joinRoom($response->room_id);
                    }
                }
            }
            else {
                $roomUser->joinRoom($response->room_id);
            }
        }
    }
}
