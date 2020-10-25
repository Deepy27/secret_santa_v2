<?php

use App\User;
use App\Http\Controllers\RoomController;

$user = new User();
$roomController = new RoomController();

?>
@include('layout.header')
<div class="container form">
    <div>
        <div>
            <h1>Seznam uporabnikov</h1>
        </div>
        <ul class="border border-white rounded-bottom rounded-top roomList" id="userList"></ul>
        <div>
            <a href="/" class="btn btn-outline-success mt-2">Generiraj</a>
        </div>
    </div>
</div>
@include('layout.footer')
<script src="/script/refreshUsers.js"></script>
