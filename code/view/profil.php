<h2>VOTRE PROFIL</h2>
<div class="flex pageProfil">
    <div class="avatar">
        <span><img src="<?= IMG_PATH . 'avatars/' . $_SESSION['user']->getAvatar() ?>" alt="image de profil"></span>
        <a href='?ctrl=forum&method=editAvatarForm'><img src="https://img.icons8.com/windows/32/000000/edit.png" />Changer d'avatar</a>
    </div>

    <div class="profil flex">
        <p class="pseudo"><?= $_SESSION['user']->getPseudo() ?></p>
        <p class="mail"><?= $_SESSION['user']->getMail() ?></p>
        <a href='?ctrl=forum&method=editProfilFormulaire'><img src="https://img.icons8.com/windows/32/000000/edit.png" />Modifier votre profil</a>
        <a href='?ctrl=security&method=editPasswordForm'><img src="https://img.icons8.com/windows/32/000000/edit.png" />Modifier votre mot de passe</a>
    </div>
</div>

<!--barre de recherche quand on clique sur une categorie
barre de recherche dans listUtilisateur -->