@include('layout.header')
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
@include('layout.footer')
