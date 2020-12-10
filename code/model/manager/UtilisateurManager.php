<?php

namespace Model\Manager;

use App\AbstractManager;

class UtilisateurManager extends AbstractManager
{
    private static $classname = "Model\Entity\Utilisateur";

    public function __construct()
    {
        self::connect(self::$classname);
    }

    public function findAll()
    {

        $sql = "SELECT id_utilisateur, pseudo, role, dateinscription 
                    FROM utilisateur";

        return self::getResults(
            self::select(
                $sql,
                null,
                true
            ),
            self::$classname
        );
    }

    public function findOneById($id)
    {
        $sql = "SELECT * 
                        FROM utilisateur 
                        WHERE id_utilisateur = :id";
        return self::getOneOrNullResult(
            self::select(
                $sql,
                ["id" => $id],
                false
            ),
            self::$classname
        );
    }

    public function findByEmail($mail)
    {
        $sql = "SELECT mail
                    FROM utilisateur
                    WHERE mail = :mail";
        return self::getOneOrNullResult(
            self::select(
                $sql,
                ["mail" => $mail],
                false
            ),
            self::$classname
        );
    }

    public function findByPseudo($pseudo)
    {
        $sql = "SELECT pseudo
                    FROM utilisateur
                    WHERE pseudo = :pseudo";
        return self::getOneOrNullResult(
            self::select(
                $sql,
                ["pseudo" => $pseudo],
                false
            ),
            self::$classname
        );
    }

    public function findByPseudoOrMail($var)
    {
        $sql = "SELECT *
        FROM utilisateur
        WHERE mail = :content OR pseudo = :content";
        return self::getResults(
            self::select(
                $sql,
                [":content" => $var]
            ),
            self::$classname
        );
    }

    public function addUser($array)
    {
        $sql = "INSERT INTO utilisateur (pseudo, mdp, mail) 
                VALUES (:pseudo, :mdp, :mail)";
        return self::create(
            $sql,
            $array
        );
    }

    public function editProfilById($id, $pseudo, $email)
    {
        $sql = "UPDATE utilisateur
                SET pseudo = :pseudo, mail = :email
                WHERE id_utilisateur = :id_utilisateur";
        return self::update($sql, [
            ':id_utilisateur' => $id,
            ':pseudo' => $pseudo,
            ':email' => $email
        ]);
    }


    public function editAvatarById($id, $avatar)
    {
        $sql = "UPDATE utilisateur
        SET avatar = :avatar
        WHERE id_utilisateur = :id_utilisateur";
        return self::update($sql, [
            ':id_utilisateur' => $id,
            ':avatar' => $avatar
        ]);
    }

    public function editPasswordById($id, $mdp)
    {
        $sql = "UPDATE utilisateur
                    SET mdp = :mdp
                    WHERE id_utilisateur = :id_utilisateur";
        return self::update($sql, [
            ':id_utilisateur' => $id,
            ':mdp' => $mdp

        ]);
    }
}
