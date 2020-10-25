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
<div class="form">
    <div>
        <h1>Izberi sobo</h1>
        <div>
            <a href="/roomJoin" class="btn btn-outline-info btn-lg btn-block">
                Pridruži se sobi
            </a>
        </div>
        <div class="pt-2">
            <a href="/roomCreate" class="btn btn-outline-info btn-lg btn-block">
                Naredi sobo
            </a>
        </div>
    </div>
</div>
@extends('layout.footer')
