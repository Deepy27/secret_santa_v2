@include('layout.header')
<div class="container form">
        <div class="col-md-12 col-lg-4">
            <h1>Generiraj sobo</h1>
            <form method="post" action="roomCreate">
                @csrf <!-- {{ csrf_field() }} -->
                <div class="form-group">
                    <input class="form-control small" type="text" placeholder="Ime sobe" name="roomName">
                </div>
                <div class="form-group">
                    <input class="form-control small" type="password" placeholder="Geslo" name="roomPassword">
                </div>
                <div class="form-group">
                    <input class="btn btn-outline-success btn-lg small" type="submit" value="Generiraj sobo">
                    <a href="/roomOption" class="btn btn-outline-danger button btn-lg small">Nazaj</a>
                </div>
            </form>
        </div>
</div>
@include('layout.footer')
