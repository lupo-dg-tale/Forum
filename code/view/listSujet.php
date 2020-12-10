<div class="flex categories">
    <ul class="category sujet flex">
        <?php

        foreach ($data['topics'] as $topic) {
            echo '<li><div class="sujet"><a href="?ctrl=forum&method=allReponses"><img class="folder" src="https://img.icons8.com/ios-filled/50/000000/folder-invoices.png"/> '.$topic->getTitre().'</a><img class="folder" src="https://img.icons8.com/ios-filled/50/000000/filled-chat.png"/>'. $topic->getNbreponse() .' '. $topic->getDatecreation(    ).'</div></li>';
        }

        ?>
    </ul>
</div>