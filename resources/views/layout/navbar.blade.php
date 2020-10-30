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
                <a class="nav-link" href="/">Domov</a>
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
                    SecretSanta
                </span>
            </li>
        </ul>
        <ul class="navbar-nav">
            <?php
                if (Auth::check()) {
                    echo
                    "<li class='nav-item'>
                        <a class='nav-link' href='/logout'>Izpis</a>
                    </li>";
                }
                else {
                    echo
                    "<li class='nav-item'>
                        <a class='nav-link' href='/register'>Registracija</a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link' href='/login'>Vpis</a>
                    </li>";
                }
            ?>
        </ul>
    </div>
</nav>
