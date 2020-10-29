<?php

use App\User;
use App\Room;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Auth;

$user = new User();
$room = new Room();
$roomController = new RoomController();

?>
@include('layout.header')
<div class="container form">
    <div>
        <div>
            <h1>Seznam uporabnikov</h1>
        </div>
        <ul class="border border-white rounded-bottom rounded-top roomList" id="userList"></ul>
        <?php
        if ($room->isAdmin()) {
                echo
                '<div>
                    <a href="/generate" class="btn btn-outline-success mt-2">Generiraj</a>
                </div>';
            }
        ?>
    </div>
</div>
@include('layout.footer')
<script src="/script/refreshUsers.js"></script>
