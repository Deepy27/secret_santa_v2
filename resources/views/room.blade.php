<?php
use App\User;
$user = new User();
?>
@extends('layout.header')

<div class="container form">
    <div>
        <h1>Seznam uporabnikov</h1>
    </div>

    <div class="border border-white rounded-bottom rounded-top">
        <ul>
            <li>
                <?= $user->getUserName() ?>
            </li>
        </ul>
    </div>

    <div>
        <a href="/user" class="btn btn-outline-success mt-2">Generiraj</a>
    </div>
</div>
@extends('layout.footer')
