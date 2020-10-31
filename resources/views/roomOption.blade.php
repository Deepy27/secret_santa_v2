@include('layout.header')
<div class="form">
    <div class="col-md-10 col-lg-2">
        <div>
            <h1>Izberi sobo</h1>
            <div>
                <a href="/roomJoin" class="btn btn-outline-info btn-lg small p-3">
                    Pridruži se sobi <i class="fas fa-sign-in-alt room"></i>
                </a>
            </div>
            <div class="pt-3">
                <a href="/roomCreate" class="btn btn-outline-info btn-lg small p-3">
                    Naredi sobo <i class="fas fa-sign-in-alt room"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@include('layout.footer')
