<?php
use App\User;
$user = new User();
?>
@extends('layout.header')
<nav class="navbar navbar-expand-lg navbar-dark">
    <span class="navbar-text navbar-brand">
    Dobrodešel/-la <?= $user->getUserName() ?>
    </span>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/">Home</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="/room">Sobe</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="/roomOption">Izbira sobe</a>
            </li>
        </ul>
        <a href="/login">Vpis</a>
        <a href="/register" class="mx-2">Registracija</a>
        <a href="/logout">Izpis</a>
    </div>
</nav>
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
