<div class="flex categories">
    <ul class="flex category">
        <?php

        use app\Session;

        foreach ($data['categories'] as $cat) {
            echo '<li><div><a href="?ctrl=forum&method=showTopicsByCat&id=' . $cat->getId() . '"><img src="' . $cat->getIcone() . '" alt ="icone de catégorie" /> ' . $cat->getNom() . '</a></div></li>';
        }


        ?>
    </ul>
</div>

<div class="flex categories">
    <ul class="category sujet flex">
        <?php
        if (!empty($data['topics'])) {
            foreach ($data['topics'] as $topic) {
                echo '<li><div class="sujet"><a href="?ctrl=forum&method=showReponseByCat&id=' . $topic->getId() . '"><img class="folder" src="https://img.icons8.com/ios-filled/50/000000/folder-invoices.png"/> ' . $topic->getTitre() . '</a><img class="folder" src="https://img.icons8.com/ios-filled/50/000000/filled-chat.png"/><p>' . $topic->getNbReponse() . '</p><p> ' . $topic->getDatecreation() . '</p></div></li>';
            }
        }
// logo cadenas sujet clos ou pas (booléen)
// ajouter nom du proprio sujet
        ?>

    </ul>
</div>

<?php

if (!empty($data['topics']) && app\Session::getUser()) {
    echo '<div><h2>Ajouter un nouveau sujet</h2></div><div><form class="flex" action="?ctrl=forum&method=addTopic&id= ' . $_GET['id'] . '" method="POST"><input type="text" name="titre" id="titre" placeholder="Titre du sujet" required><input type="text" name="contenu" id="contenu" placeholder="Contenu du sujet" required><input type="hidden" name="csrf_token" value="' . $csrf_token . '"><input type="submit" name="submit" id="submit" value="Soumettre"></form></div>';
}

?>