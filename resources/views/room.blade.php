<?php

use App\User;
use App\Room;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Auth;

$user = new User();
$room = new Room();
$roomController = new RoomController();
$roomTitle = $roomController->getRoomTitle($roomUrl)->title ?? '';
$generated = $roomController->roomIsActive($roomUrl);
?>
@include('layout.header')
<div class="fullScreenLayout">
    <div>
        <div>
            <h3>Soba: <?=$roomTitle?></h3>
            <h5><i>Koda sobe: <?= $roomUrl ?></i></h5>
            <hr>
            <h5>Seznam uporabnikov <i class="far fa-user user"></i></h5>
        </div>
        <ol class="border border-white rounded-bottom rounded-top roomList" id="userList"></ol>
        <?php
        if ($room->isAdmin($roomUrl)) {
            if ($generated) {
                echo sprintf(
                    '<div>
                    <a href="/generate/%s" class="btn btn-outline-success mt-2" id="generateButton">Generiraj</a>
                </div>', $roomUrl);
            } else {
                echo sprintf('
                  <div>
                    <h3>Soba je generirana!<h3>
                    <a href="/seznam/%s">Preveri seznam</a>
                  </div>
                ', $roomUrl);
            }
        }
        ?>
        <p id="recievedName"></p>
    </div>
</div>
@include('layout.footer')
<script src="/script/refreshUsers.js"></script>
