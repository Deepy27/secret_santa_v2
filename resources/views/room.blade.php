<?php

use App\User;
use App\Room;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Auth;

$user = new User();
$room = new Room();
$roomController = new RoomController();
$roomTitle = $roomController->getRoomTitle($roomUrl)->title ?? '';

?>
@include('layout.header')
<div class="container form">
    <div>
        <div>
            <h1><u><?=$roomTitle?></u></h1>
            <h1>Seznam uporabnikov <i class="far fa-user user"></i></h1>
        </div>
        <ul class="border border-white rounded-bottom rounded-top roomList" id="userList"></ul>
        <?php
        if ($room->isAdmin($roomUrl)) {
            echo sprintf(
                '<div>
                    <a href="/generate/%s" class="btn btn-outline-success mt-2" id="generateButton">Generiraj</a>
                </div>', $roomUrl);
        }
        ?>
        <p id="recievedName"></p>
    </div>
</div>
@include('layout.footer')
<script src="/script/refreshUsers.js"></script>
