<?php
    namespace Controller;
    
    use App\Session;
    use App\Router;
use Model\Entity\Categorie;
use Model\Manager\CategorieManager;

class HomeController {
        /**
         * Afficher la page d'accueil
         */
        public function index(){
            $manager = new CategorieManager();
            $cat = $manager->findAll();
            return [
                "view" => "home.php", 
                "data" => [
                    "categories" => $cat
                ],
                "titrePage" => "FORUM | Accueil"
            ];
        }

        public function profil(){
            return [
                "view" => "profil.php",
                "data" => null,
                "titrePage" => "FORUM | Votre profil"
            ];
        }

        // public function listCategorie(){
        //     $manager = new CategorieManager();
        //     $cat = $manager->findAll();
        //     return [
        //         "view" => "home.php", 
        //         "data" => [
        //             "categories" => $cat
        //         ],
        //         "titrePage" => "FORUM | Accueil"
        //     ];
        // }


    }