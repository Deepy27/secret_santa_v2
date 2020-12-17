@include('layout.header')
<div class="fullScreenLayout">
    <div class="col-md-4">
        <h1>Vpiši se <i class='fas fa-user-shield'></i></h1>
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
            <div class="text-white text-center">
                Če ste pozabili geslo nas kontaktirajte na <a href="mailto:andraz.bajec27@gmail.com">andraz.bajec27@gmail.com</a>
            </div>
        </form>
    </div>
</div>
@include('layout.footer')
