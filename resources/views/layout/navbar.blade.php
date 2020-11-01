<?php
use Illuminate\Support\Facades\Auth;
?>

<nav class="navbar navbar-expand-lg navbar-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <?php
        if (Auth::check()) {
            echo '<ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/"><i class="fas fa-home"></i> Domov</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/room"><i class="far fa-list"></i> Moje sobe</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/roomOption"><i class="fal fa-plus-square"></i> Nova soba</a>
            </li>
        </ul>';
        }
        ?>

        <ul class="navbar-nav">
            <?php
            if (Auth::check()) {
                echo
                "<li class='nav-item'>
                        <a class='nav-link' href='/logout'><i class='fas fa-sign-out-alt'></i> Izpis</a>
                    </li>";
            } else {
                echo "
                    <li class='nav-item'>
                        <a class='nav-link' href='/login'><i class='fas fa-user-shield'></i> Vpis</a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link' href='/register'><i class='fas fa-user-plus'></i> Registracija</a>
                    </li>";
            }
            ?>
        </ul>
    </div>
</nav>
