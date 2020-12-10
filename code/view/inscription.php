<p><?= $data['message'] ?></p>
<form class="flex" action="?ctrl=security&method=addUser" method="POST">
    <?php if (isset($_SESSION['wrongMail'])) {
        echo $_SESSION['wrongMail'];
        unset($_SESSION['wrongMail']);
    }
    ?>
    <input class="inputback" type="email" name="mail" id="mail" placeholder="Votre e-mail" required>
    <?php if (isset($_SESSION['wrongPseudo'])) {
        echo $_SESSION['wrongPseudo'];
        unset($_SESSION['wrongPseudo']);
    }
    ?>
    <input type="text" name="pseudo" id="pseudo" placeholder="Choisissez un pseudo" required>
    <?php if (isset($_SESSION['shortPass'])) {
        echo $_SESSION['shortPass'];
        unset($_SESSION['shortPass']);
    }
    ?>
    <input class="inputback" type="password" name="mdp" id="mdp" placeholder="Définir un mot de passe" required>
    <?php if (isset($_SESSION['wrongPass'])) {
        echo $_SESSION['wrongPass'];
        unset($_SESSION['wrongPass']);
    }
    ?>
    <input class="inputback" type="password" name="confirmpass" id="confirmpass" placeholder="Confirmez le mot de passe" required>
    <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
    <input class="inputback regButton" type="submit" name="submit" id="submit" value="S'inscrire">
</form>
<p class="formu">Déjà membre ? <a id="connect" href="?ctrl=security&method=login">Connectez-vous</a></p>