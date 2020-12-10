<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $result['titrePage'] ?></title>
    <link rel="stylesheet" href="<?= CSS_PATH ?>style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>

<body>
    <header>
        <nav class="navbar sticky-top navbar-light nav">
            <?php
            if (app\Session::getUser()) {
                echo '<a class="navbar-brand text-white" href="?ctrl=security&method=logout">Déconnexion</a>
                     <a class="navbar-brand text-white vert" href="?ctrl=home&method=profil">Profil</a> ';
            } else {
                echo '<a class="navbar-brand text-white" href="?ctrl=security&method=register">Inscription</a>
            <a class="navbar-brand text-white vert" href="?ctrl=security&method=login">Connexion</a>';
            }
            ?>
        </nav>
        <h1 hidden>VIDEOGAMES FORUM</h1>
        <figure>
            <a href="?ctrl=home&method=index"><img class="banner" src="<?= IMG_PATH ?>banner.jpg" alt="bannière forum videogames"></a>
        </figure>
    </header>

    <main>
        <div id="page">
            <?= $page ?>
        </div>
    </main>

    <footer>
        <h2 class="connect">SUIVEZ L'ACTU</h2>
        <div class="flex losange">
            <a href="https://www.facebook.com/" target="_blank"><img id="facebook" class="icon" src="<?= IMG_PATH ?>icon-facebook.svg" alt="facebook"></a>
            <a href="https://twitter.com/login?lang=fr" target="_blank"><img id="twitter" class="icon" src="<?= IMG_PATH ?>icon-twitter.svg" alt="twitter"></a>
            <a href="https://www.youtube.com/" target="_blank"><img id="youtube" class="icon" src="<?= IMG_PATH ?>icon-youtube.svg" alt="youtube"></a>
        </div>
        <div class="flex credit">
            <img class="f-logo" src="<?= IMG_PATH ?>logomini.png" alt="logo videogames">
            <img src="<?= IMG_PATH ?>esrb.cp.png" alt="content inappropriate for children">
        </div>
        <nav class="footer-nav">
            <a href="#">Nous contacter</a>
            <a href="#">Accord de l'utilisateur</a>
            <a href="#">Politique de confidentialité</a>
            <a href="#">Politique de Cookies</a>
            <a href="#">Presse</a>
        </nav>
        <div class="copyright">
            <span>© 2020 VIDEO GAMES S.A. TOUS DROITS RÉSERVÉS</span>
            <p>VIDEO GAMES® est une marque déposée de VIDEO GAMES S.A. © 2020 VIDEO GAMES S.A. Tous droits réservés. Tous les autres droits et marques appartiennent à leurs propriétaires respectifs.</p>
            <a href="https://steamcommunity.com/profiles/76561198876704891/" target="_blank">Forum software by Lupo-DG-taLe®<span>© 2020-2021 Lupo-DG-taLe Ltd.</span></a>
        </div>
    </footer>

</body>

</html>