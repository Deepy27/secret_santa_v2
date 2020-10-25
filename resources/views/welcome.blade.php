<?php
use App\User;
$user = new User();
?>
@extends('layout.header')
<div class="container form">
    <h1>Dobrodošel/la, <?= $user->getUserName() ?> na spletni strani Secret Santa</h1>
</div>
@extends('layout.footer')
