@include('layout.header')
<div class="container form">
    <div class="col-4">
        <h1>Registriraj se <i class="fas fa-sign-in-alt vpis"></i></h1>
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
                <input class="btn btn-outline-success btn-block" type="submit" value="Registracija">
            </div>
            <a href="/login" class="btn btn-outline-danger btn-block">Že registriran?</a>
        </form>
    </div>
</div>
@include('layout.footer')
