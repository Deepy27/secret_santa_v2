@extends('layout.header')
<div class="container form">
        <div class="col-4">
            <h1>Generiraj sobo</h1>
            <form method="post" action="room">
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="Ime sobe" name="roomName">
                </div>
                <div class="form-group">
                    <input class="form-control" type="password" placeholder="Geslo" name="roomPassword">
                </div>
                <div class="form-group">
                    <a href="/room" class="btn btn-info button">Generiraj sobo</a>
                    <a href="/roomOption" class="btn btn-info button float-right">Nazaj</a>
                </div>
            </form>
        </div>
</div>
