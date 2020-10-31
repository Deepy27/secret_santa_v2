<?php
use App\User;
$user = new User();
?>
@include('layout.header')
<div class="container fixed-layout">
    <h1 class="welcome">Dobrodošel/la, <?= $user->getUserName() ?> na spletni strani Secret Santa <i class="fal fa-sack"></i></h1>
</div>
@include('layout.footer')
