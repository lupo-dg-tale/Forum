<form class="flex" action="?ctrl=forum&method=editProfil&id=<?= $_SESSION['user']->getId()?>" method="POST">
    <label for="pseudo">Nouveau pseudo</label>
    <input type="text" name="pseudo" id="pseudo" value="<?= $data['user']->getPseudo()?>">
    <?php if (isset($_SESSION['wrongPseudo'])) {
        echo $_SESSION['wrongPseudo'];
        unset($_SESSION['wrongPseudo']);
    }
    ?>
    <label for="email">Nouvel email</label>
    <input type="email" name="email" id="email" value="<?= $data['user']->getMail() ?>">
    <?php if (isset($_SESSION['wrongMail'])) {
        echo $_SESSION['wrongMail'];
        unset($_SESSION['wrongMail']);
    }
    ?>
    <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
    <input type="submit" name="submit" id="submit" value="Soumettre">
</form>