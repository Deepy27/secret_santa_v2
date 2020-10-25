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
    <div class="col-4">
        <h1>Vpiši se</h1>
        <form method="post" action="login">
        @csrf <!-- {{ csrf_field() }} -->
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Uporabniško Ime" name="username">
            </div>
            <div class="form-group">
                <input class="form-control" type="password" placeholder="Geslo" name="password">
            </div>
            <div class="form-group">
                <input class="btn btn-outline-success btn-block" type="submit" value="Vpis">
            </div>
            <a href="/register" class="btn btn-outline-danger btn-block">Nisi registriran?</a>
        </form>
    </div>
</div>
@extends('layout.footer')
