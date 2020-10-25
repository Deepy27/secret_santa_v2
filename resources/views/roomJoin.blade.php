@include('layout.header')
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
                    <input class="btn btn-outline-success btn-lg" type="submit" value="Pridruži se sobi">
                    <a href="/roomOption" class="btn btn-outline-danger button btn-lg float-right">Nazaj</a>
                </div>
            </form>
        </div>
</div>
@include('layout.footer')
