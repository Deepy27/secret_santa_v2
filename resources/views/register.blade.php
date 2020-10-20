@extends('layout.header')
<div class="container form">
        <div class="col-4">
            <h1>Registriraj se</h1>
            <form method="post" action="register">
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="Ime" name="name">
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="Uporabniško Ime" name="username">
                </div>
                <div class="form-group">
                    <input class="form-control" type="password" placeholder="Geslo" name="password">
                </div>
                <div class="form-group">
                    <a href="/room" class="btn btn-info btn-block">Registracija</a>
                </div>
            </form>
        </div>
</div>
