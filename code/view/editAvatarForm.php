<form class="flex" action="?ctrl=forum&method=editAvatar&id=<?= $_SESSION['user']->getId() ?>" method="POST" enctype="multipart/form-data">
    <label for="avatar">Nouvel avatar :</label>
    <input type="file" name="avatar" id="avatar">
    <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
    <input type="submit" name="submit" id="submit" value="Soumettre">
</form>