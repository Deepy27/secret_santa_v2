@extends('layout.header')
<div class="container form">
        <div class="col-4">
            <h1>Pridruži se sobi</h1>
            <form method="post" action="roomJoin">
                @csrf <!-- {{ csrf_field() }} -->
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="Šifra sobe" name="roomUrl">
                </div>
                <div class="form-group">
                    <input class="form-control" type="password" placeholder="Geslo" name="roomPassword">
                </div>
                <div class="form-group">
                    <input class="btn btn-info btn-lg" type="submit" value="Pridruži se sobi">
                    <a href="/roomOption" class="btn btn-info button btn-lg float-right">Nazaj</a>
                </div>
            </form>
        </div>
</div>
@extends('layout.footer')
