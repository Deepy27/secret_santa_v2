@include('layout.header')
<div class="fullScreenLayout">
    <div>
        <h1>Izberi sobo</h1>
        <div>
            <a href="/roomJoin" class="btn btn-outline-info btn-lg btn-block">
                Pridruži se sobi <i class="fas fa-sign-in-alt room"></i>
            </a>
        </div>
        <div class="pt-2">
            <a href="/roomCreate" class="btn btn-outline-info btn-lg btn-block">
                Naredi sobo <i class="fas fa-sign-in-alt room"></i>
            </a>
        </div>
    </div>
</div>
@include('layout.footer')
