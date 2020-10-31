@include('layout.header')
<div class="container form">
    <div class="col-md-12 col-lg-4">
        <h1>Registriraj se <i class="fas fa-sign-in-alt vpis"></i></h1>
        <form method="post" action="register">
        @csrf <!-- {{ csrf_field() }} -->
            <div class="form-group">
                <input class="form-control small" type="text" placeholder="Ime" name="name" required>
            </div>
            <div class="form-group">
                <input class="form-control small" type="text" placeholder="Uporabniško Ime" name="username" required>
            </div>
            <div class="form-group">
                <input class="form-control small" type="password" placeholder="Geslo" name="password" required>
            </div>
            <div class="form-group">
                <input class="btn btn-outline-success btn-block small" type="submit" value="Registracija">
            </div>
            <a href="/login" class="btn btn-outline-danger btn-block small">Že registriran?</a>
        </form>
    </div>
</div>
@include('layout.footer')
