@include('layout.header')
<div class="container form">
    <div class="col-md-12 col-lg-4">
        <h1>Vpiši se <i class="fas fa-sign-in-alt vpis"></i></h1>
        <form method="post" action="login" >
        @csrf <!-- {{ csrf_field() }} -->
            <div class="form-group">
                <input class="form-control small" type="text" placeholder="Uporabniško Ime" name="username">
            </div>
            <div class="form-group">
                <input class="form-control small" type="password" placeholder="Geslo" name="password">
            </div>
            <div class="form-group">
                <input class="btn btn-outline-success btn-block small" type="submit" value="Vpis">
            </div>
            <a href="/register" class="btn btn-outline-danger btn-block small">Nisi registriran?</a>
        </form>
    </div>
</div>
@include('layout.footer')
