<?php

namespace Controller;

use App\Session;
use App\Router;
use Model\Manager\UtilisateurManager;
use Model\Entity\Utilisateur;


class SecurityController
{

    public function login()
    {

        return [
            "view" => "connexion.php",
            "data" => null,
            "titrePage" => "FORUM | Connexion"
        ];
    }

    public function verifyUser()
    {
        $utilisateurManager = new UtilisateurManager();

        if (!empty($_POST['mail']) && !empty($_POST['password'])) {
            $content = strtolower(filter_var($_POST['mail'], FILTER_SANITIZE_STRING));
            $mdp = filter_var($_POST['password'], FILTER_SANITIZE_STRING);


            $user = $utilisateurManager->findByPseudoOrMail($content);

            if (empty($user)) {
                $_SESSION['wrongMail'] = 'Email/Pseudo invalide';
                return [
                    "view" => "connexion.php"

                ];
                exit();
            }

            foreach ($user as $info) {
                $mdp2 = $info->getMdp();
                if (!password_verify($mdp, $mdp2)) {
                    $_SESSION['wrongPass'] = 'Mot de passe invalide';
                    return [
                        "view" => "connexion.php"
                    ];
                    exit();
                }
                Session::setUser($info);
                return [
                    Router::redirectTo("home", "index")
                ];
            }
        }


        return ['view' => "connexion.php"];
    }

    public function register()
    {

        return [
            "view" => "inscription.php",
            "data" => null,
            "titrePage" => "FORUM | Inscription"
        ];
    }

    public function addUser()
    {
        // recup infos de $_POST

        foreach ($_POST as $key => $val) {
            if (!empty($val)) {
                ${$key} = $val;
            } else {
                //stocker erreur en session+redirection
            }
        }
        $mail = strtolower(filter_var($mail, FILTER_VALIDATE_EMAIL));
        if (!$mail) {
            $_SESSION['wrongMail'] = 'Veuillez entrer une adresse email au format valide !';
            return [
                "view" => "inscription.php"

            ];
            exit();
        }

        $pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_STRING);
        $mdp = filter_input(INPUT_POST, 'mdp', FILTER_SANITIZE_STRING);
        $confirmpass = filter_input(INPUT_POST, 'confirmpass', FILTER_SANITIZE_STRING);

        $utilisateurManager = new UtilisateurManager();

        if ($utilisateurManager->findByEmail($mail)) {
            $_SESSION['wrongMail'] = 'Email déjà utilisé !';
            return [
                "view" => "inscription.php"

            ];
            exit();
        }

        if ($utilisateurManager->findByPseudo($pseudo)) {
            $_SESSION['wrongPseudo'] = 'Pseudo non disponible !';
            return [
                "view" => "inscription.php"

            ];
            exit();
        }

        if (strlen($mdp) < 8) {
            $_SESSION['shortPass'] = 'Veuillez entrer un mot de passe de 8 caractères minimum';
            return [
                "view" => "inscription.php"

            ];
            exit();
        }


        if ($mdp !== $confirmpass) {
            $_SESSION['wrongPass'] = 'Veuillez entrer deux mots de passe identiques';
            return [
                "view" => "inscription.php"

            ];
            exit();
        }

        $mdp = password_hash($mdp, PASSWORD_BCRYPT);
        $params = [
            "pseudo" => $pseudo,
            "mdp" => $mdp,
            "mail" => $mail
        ];
        if ($utilisateurManager->addUser($params)) {
            $message = "Succès !";
        } else {
            $message = "Erreur !";
        }

        return [
            "view" => "inscription.php",
            "data" => [
                "message" => $message
            ],
            "titrePage" => 'FORUM | Inscription'
        ];
    }

    public function logout()
    {
        Session::removeUser();
        return Router::redirectTo('security', 'login');
    }

    public function editPasswordForm()
    {
        $id = $_SESSION['user']->getId();
        $manager = new UtilisateurManager();
        $user = $manager->findOneById($id);

        return [
            "view" => "editPasswordForm.php",
            "data" => [
                "user" => $user
            ],
            "titrePage" => "FORUM | Votre profil"
        ];
    }

    public function editPassword()
    {
        $manager = new UtilisateurManager();
        $id = $_SESSION['user']->getId();
        $mdpAct = filter_input(INPUT_POST, 'mdpAct', FILTER_SANITIZE_STRING);
        $mdp = filter_input(INPUT_POST, 'mdp', FILTER_SANITIZE_STRING);
        $mdp2 = filter_input(INPUT_POST, 'mdp2', FILTER_SANITIZE_STRING);

        if (!empty($_POST)) {
            $mdpUser = $_SESSION['user']->getMdp();
            if (password_verify($mdpAct, $mdpUser)) {
                if ($mdp == $mdp2) {
                    $mdp = password_hash($mdp, PASSWORD_BCRYPT);
                    $manager = $manager->editPasswordById($id, $mdp);
                    $manager = new UtilisateurManager();
                    $editedUser = $manager->findOneById($id);
                    Session::setUser($editedUser);
                    return Router::redirectTo('home', 'profil');
                }
            } else {
                $_SESSION['wrongPass'] = 'Mot de passe invalide';
                return [
                    "view" => "editPasswordForm.php"
                ];
                exit();
            }
        } else {
            $_SESSION['emptyPost'] = 'Veuillez remplir tout les champs';
            return [
                "view" => "editPasswordForm.php"

            ];
            exit();
        }
    }

    //     if (empty($_POST['mdpAct']) or empty($_POST['mdp']) or empty($_POST['mdp2'])) {
    //         $_SESSION['emptyPost'] = 'Veuillez remplir tout les champs';
    //         return [
    //             "view" => "editPasswordForm.php"

    //         ];
    //         exit();
    //     }


    //     $mdpUser = $_SESSION['user']->getMdp();
    //     if (!password_verify($mdpAct, $mdpUser)) {
    //         $_SESSION['wrongPass'] = 'Mot de passe invalide';
    //         return [
    //             "view" => "editPasswordForm.php"
    //         ];
    //         exit();
    //     }

    //     if (strlen($mdp) < 8) {
    //         $_SESSION['shortPass'] = 'Veuillez entrer un mot de passe de 8 caractères minimum';
    //         return [
    //             "view" => "editPasswordForm.php"

    //         ];
    //         exit();
    //     }


    //     if ($mdp !== $mdp2) {
    //         $_SESSION['samePass'] = 'Veuillez entrer deux mots de passe identiques';
    //         return [
    //             "view" => "editPasswordForm.php"

    //         ];
    //         exit();
    //     }
    //     $mdp = password_hash($mdp, PASSWORD_BCRYPT);
    //     $manager = $manager->editAvatarById($id, $mdp);
    //     

    //     return Router::redirectTo('home','profil');
    // }
}
