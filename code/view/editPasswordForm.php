<form class="flex" action="?ctrl=security&method=editPassword&id=<?= $_SESSION['user']->getId() ?>" method="POST">
    <?php if (isset($_SESSION['emptyPost'])) {
        echo $_SESSION['emptyPost'];
        unset($_SESSION['emptyPost']);
    }
    ?>
    <input type="password" name="mdpAct" id="mdpAct" placeholder="Votre mot de passe actuel">
    <?php if (isset($_SESSION['wrongPass'])) {
        echo $_SESSION['wrongPass'];
        unset($_SESSION['wrongPass']);
    }
    ?>
    <input type="password" name="mdp" id="mdp" placeholder="Votre nouveau mot de passe">
    <?php if (isset($_SESSION['shortPass'])) {
        echo $_SESSION['shortPass'];
        unset($_SESSION['shortPass']);
    }
    ?>
    <input type="password" name="mdp2" id="mdp2" placeholder="Confirmez le nouveau mot de passe">
    <?php if (isset($_SESSION['samePass'])) {
        echo $_SESSION['samePass'];
        unset($_SESSION['samePass']);
    }
    ?>
    <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
    <input type="submit" name="submit" id="submit" value="Soumettre">
</form>