<div class="flex categories">
    <ul class="flex category">
        <?php
        // var_dump($data);
        foreach ($data['categories'] as $cat) {
            echo '<li><div><a href="?ctrl=forum&method=showTopicsByCat&id=' . $cat->getId() . '"><img src="' . $cat->getIcone() . '" alt ="icone de catégorie" /> ' . $cat->getNom() . '</a></div></li>';
        }


        ?>
    </ul>
</div>
<div class="flex sujet reponse">
    <img class="opened" src="https://img.icons8.com/ios-filled/50/000000/opened-folder.png" />
    <?php
    echo $data['titre']->getTitre();
    ?>
</div>
<div class="contenu">
    <?php
    echo $data['titre']->getContenu();
    ?>
</div>
<a href="?ctrl=forum&method=suppTopic&id=<?= $_GET['id']?>"><img src="https://img.icons8.com/windows/32/000000/trash.png"/>Supprimer le sujet</a>
<a href="?ctrl=forum&method=editTopic&id=<?= $_GET['id']?>"><img src="https://img.icons8.com/windows/32/000000/edit.png"/>Modifier le sujet</a>
<div class="flex categories">
    <ul class="category sujet">
        <?php

        foreach ($data['reponses'] as $reponse) {
            echo '<li><div class="sujet reponse">' . $reponse->getTexte() . '</div></li>';
        }


        ?>
    </ul>
</div>

<?php
if (app\Session::getUser()) {
    echo '<div><h2>Repondre au sujet</h2></div><div><form class="flex" action="?ctrl=forum&method=addReponse&id=' . $_GET['id'] . '" method="POST"><textarea name="texte" id="texte" placeholder="Votre réponse" required></textarea><input type="hidden" name="csrf_token" value="' . $csrf_token . '"><input type="submit" name="submit" id="submit" value="Soumettre"></form></div>';
}
?>
<br>
<a href="?ctrl=forum&method=allUtilisateurs">Liste des utilisateurs</a>