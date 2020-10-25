@extends('layout.header')
<div class="container form">
        <div class="col-4">
            <h1>Registriraj se</h1>
            <form method="post" action="register">
                @csrf <!-- {{ csrf_field() }} -->
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="Ime" name="name" required>
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="Uporabniško Ime" name="username" required>
                </div>
                <div class="form-group">
                    <input class="form-control" type="password" placeholder="Geslo" name="password" required>
                </div>
                <div class="form-group">
                    <input class="btn btn-info btn-block" type="submit" value="Registracija">
                </div>
            </form>
        </div>
</div>
@extends('layout.footer')
