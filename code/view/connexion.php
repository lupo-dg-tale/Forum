<form class="flex" action="?ctrl=security&method=verifyUser" method="POST">
    <?php
    if (isset($_SESSION['wrongMail'])) {
        echo $_SESSION['wrongMail'];
        unset($_SESSION['wrongMail']);
    }
    ?>
    <input type="text" name="mail" id="mail" placeholder="Pseudo/E-mail" required>
    <?php
     if (isset($_SESSION['wrongPass'])) {
        echo $_SESSION['wrongPass'];
        unset($_SESSION['wrongPass']);
    }
    ?>
    <input type="password" name="password" id="password" placeholder="Mot de passe" required>
    <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
    <div class="flex remember">
        <input type="checkbox" id="souvenir" name="souvenir">
        <label for="souvenir">Se souvenir de moi</label>
    </div>
    <input type="submit" name="submit" id="submit" value="S'identifier">
</form>
<p class="formu">Première visite sur VideoGames? <a href="?ctrl=security&method=register">Inscrivez-vous</a></p>

<?
// comm
?>