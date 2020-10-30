<?php
use App\User;
$user = new User();
?>
@include('layout.header')
<div class="container form">
    <h1>Dobrodošel/la, <?= $user->getUserName() ?> na spletni strani Secret Santa <i class="fal fa-sack"></i></h1>
</div>
@include('layout.footer')
