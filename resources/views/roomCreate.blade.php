@include'layout.header')
<div class="container form">
        <div class="col-4">
            <h1>Generiraj sobo</h1>
            <form method="post" action="roomCreate">
                @csrf <!-- {{ csrf_field() }} -->
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="Ime sobe" name="roomName">
                </div>
                <div class="form-group">
                    <input class="form-control" type="password" placeholder="Geslo" name="roomPassword">
                </div>
                <div class="form-group">
                    <input class="btn btn-outline-success btn-lg" type="submit" value="Generiraj sobo">
                    <a href="/roomOption" class="btn btn-outline-danger button btn-lg float-right">Nazaj</a>
                </div>
            </form>
        </div>
</div>
@include('layout.footer')
