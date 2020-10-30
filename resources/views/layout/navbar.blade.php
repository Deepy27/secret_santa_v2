<?php
use Illuminate\Support\Facades\Auth;
?>

<nav class="navbar navbar-expand-lg navbar-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/">Domov <i class="fas fa-home"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/room">Sobe</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/roomOption">Izbira sobe</a>
            </li>
        </ul>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <span class="navbar-text">
                    SecretSanta <i class="fas fa-hat-santa"></i>
                </span>
            </li>
        </ul>
        <ul class="navbar-nav">
            <?php
                if (Auth::check()) {
                    echo
                    "<li class='nav-item'>
                        <a class='nav-link' href='/logout'>Izpis <i class='fas fa-sign-out-alt'></i></a>
                    </li>";
                }
                else {
                    echo
                    "<li class='nav-item'>
                        <a class='nav-link' href='/register'>Registracija <i class='fas fa-sign-in-alt'></i></a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link' href='/login'>Vpis <i class='fas fa-sign-in-alt'></i></a>
                    </li>";
                }
            ?>
        </ul>
    </div>
</nav>
