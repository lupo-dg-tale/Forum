<?php

namespace Controller;

use App\Session;
use App\Upload;
use App\Router;
use Model\Entity\Topic;
use Model\Manager\TopicManager;
use Model\Manager\PostManager;
use Model\Manager\CategorieManager;
use Model\Manager\ReponseManager;
use Model\Manager\UtilisateurManager;

class ForumController
{

    public function index()
    {
        Router::redirectTo("home", "index");
    }

    /**
     * Afficher tous les topics par catégorie
     */
    public function allTopic()
    {

        $manTopic = new TopicManager();
        $topics = $manTopic->findAll();

        return [
            "view" => "home.php",
            "data" => [
                "topics" => $topics
            ],
            "titrePage" => "FORUM | Sujets"
        ];
    }

    public function showReponseByCat()
    {
        $id = (isset($_GET['id'])) ? $_GET['id'] : null;
        $manReponse = new ReponseManager();
        $reponses = $manReponse->findReponseByTopic($id);
        $manTopic = new TopicManager();
        $titreTopic = $manTopic->findOneById($id);
        $categories = $this->showCat();
        $titre = $this->showTitreTopic($id);


        return [
            "view" => "listReponse.php",
            "data" => [
                "reponses" => $reponses,
                "categories" => $categories,
                "titre" => $titre

            ],
            "titrePage" => "FORUM | " . $titreTopic->getTitre()
        ];
    }

    public function allUtilisateurs()
    {

        $manUtilisateur = new UtilisateurManager();
        $utilisateurs = $manUtilisateur->findAll();

        return [
            "view" => "listUtilisateur.php",
            "data" => [
                "utilisateurs" => $utilisateurs
            ],
            "titrePage" => "FORUM | Utilisateurs"
        ];
    }

    /**
     * Afficher les posts d'un topic
     */
    // public function show()
    // {

    //     $id = (isset($_GET['id'])) ? $_GET['id'] : null;
    //     $manTopic = new TopicManager();
    //     $manPost = new PostManager();

    //     $topic = $manTopic->findOneById($id);
    //     $posts = $manPost->findByTopic($id);

    //     return [
    //         "view" => "forum/posts.php",
    //         "data" => [
    //             "topic" => $topic,
    //             "posts" => $posts,
    //         ],
    //         "titrePage" => "FORUM | " . $topic
    //     ];
    // }

    /**
     * Afficher les topics d'une categorie
     */
    public function showTopicsByCat()
    {

        $id = (isset($_GET['id'])) ? $_GET['id'] : null;
        $manTopic = new TopicManager();
        $manCat = new CategorieManager();

        $topic = $manTopic->findByCategory($id); //On récupère les topics en fonction de l'id de la catégorie
        $cat = $manCat->findOneById($id); //On récupère la catégorie concernée
        $categories = $manCat->findAll(); //On récupère la liste des catégories pour les réafficher

        return [
            "view" => "home.php",
            "data" => [
                "topics" => $topic,
                "categorie" => $cat,
                "categories" => $categories,
            ],
            "titrePage" => "FORUM | " . $cat->getNom()
        ];
    }

    private function showCat()
    {
        $manager = new CategorieManager();
        $cat = $manager->findAll();
        return $cat;
    }

    private function showTitreTopic($id)
    {
        $manager = new TopicManager();
        $titre = $manager->findOneById($id);
        return $titre; // appeler cette méthode dans la méthode showReponseByCat
    }

    public function addTopic()
    {
        foreach ($_POST as $key => $val) {
            if (!empty($val)) {
                ${$key} = $val;
            } else {
                //stocker erreur en session+redirection
            }
        }
        $manager = new TopicManager();
        $utilisateur_id = $_SESSION['user']->getId();
        $categorie_id = $_GET['id'];
        $contenu = filter_input(INPUT_POST, 'contenu', FILTER_SANITIZE_STRING);
        $titre = filter_input(INPUT_POST, 'titre', FILTER_SANITIZE_STRING);
        $params = [
            'titre' => $titre,
            'contenu' => $contenu,
            'categorie_id' => $categorie_id,
            'utilisateur_id' => $utilisateur_id
        ];

        $manager = $manager->addTopicByCat($params);
        return Router::redirectTo('forum', 'showTopicsByCat&id=' . $_GET["id"] . '');
    }

    public function addReponse()
    {
        foreach ($_POST as $key => $val) {
            if (!empty($val)) {
                ${$key} = $val;
            } else {
                //stocker erreur en session+redirection
            }
        }
        $managerRep = new ReponseManager();
        $utilisateur_id = $_SESSION['user']->getId();
        $topic_id = $_GET['id'];
        $texte = filter_input(INPUT_POST, 'texte', FILTER_SANITIZE_STRING);
        $params = [
            'texte' => $texte,
            'utilisateur_id' => $utilisateur_id,
            'topic_id' => $topic_id
        ];


        $managerRep = $managerRep->addReponseByTopic($params);
        return Router::redirectTo('forum', 'showReponseByCat&id=' . $_GET['id'] . '');
    }


    public function suppTopic()
    {
        $managerTopic = new TopicManager();
        $managerReponse = new ReponseManager();
        $id = $_GET['id'];
        $managerReponse = $managerReponse->deleteReponsesFromTopic($id);
        $managerTopic = $managerTopic->deleteTopic($id);
    }


    public function suppReponse()
    {
        //a faire
    }

    public function editProfilFormulaire()
    {
        $id = $_SESSION['user']->getId();
        $manager = new UtilisateurManager();
        $user = $manager->findOneById($id);

        return [
            "view" => "editProfilForm.php",
            "data" => [
                "user" => $user
            ],
            "titrePage" => "FORUM | Votre profil"
        ];
    }

    public function editProfil()
    {

        $manager = new UtilisateurManager();
        $id = $_SESSION['user']->getId();
        $pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_STRING);

        if ($manager->findByPseudo($pseudo)) {
            $_SESSION['wrongPseudo'] = 'Pseudo non disponible !';
            header("Location:?ctrl=forum&method=editProfilFormulaire");
            die;
        }
        $email = $_POST['email'];
        $email = strtolower(filter_var($email, FILTER_VALIDATE_EMAIL));

        if (!$email) {
            $_SESSION['wrongMail'] = 'Veuillez entrer une adresse email au format valide !';
            return Router::redirectTo('forum','editProfilFormulaire');
        }

        $manager = $manager->editProfilById($id, $pseudo, $email);

        // //stocker un nouveau user (le user modifié) grâce au manager->findOneById($id)
        $manager = new UtilisateurManager();
        $editedUser = $manager->findOneById($id);

        //stocker ce nouveau user en session grâce à Session::setUser() 
        Session::setUser($editedUser);
        return Router::redirectTo('home', 'profil');
    }

    public function editAvatarForm()
    {
        $id = $_SESSION['user']->getId();
        $manager = new UtilisateurManager();
        $user = $manager->findOneById($id);

        return [
            "view" => "editAvatarForm.php",
            "data" => [
                "user" => $user
            ],
            "titrePage" => "FORUM | Votre profil"
        ];
    }

    public function editAvatar()
    {
        $manager = new UtilisateurManager();
        $id = $_SESSION['user']->getId();
        $avatar = Upload::uploadFile('avatar', 'avatar-' . $id, IMG_PATH . "avatars/");
        $manager = $manager->editAvatarById($id, $avatar);

        $manager = new UtilisateurManager();
        $editedUser = $manager->findOneById($id);
        Session::setUser($editedUser);
        return Router::redirectTo('home', 'profil');
    }
}
