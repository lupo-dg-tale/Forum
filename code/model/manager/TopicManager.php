<?php

namespace Model\Manager;

use App\AbstractManager;

class TopicManager extends AbstractManager
{
    private static $classname = "Model\Entity\Topic";

    public function __construct()
    {
        self::connect(self::$classname);
    }

    public function findAll()
    {

        $sql = "SELECT s.id_sujet, titre, COUNT(id_reponse) AS nbreponse, s.datecreation
            FROM sujet s
            INNER JOIN reponse r
            ON r.sujet_id = s.id_sujet
            GROUP BY s.id_sujet";

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
                        FROM sujet 
                        WHERE id_sujet = :id";
        return self::getOneOrNullResult(
            self::select(
                $sql,
                ["id" => $id],
                false
            ),
            self::$classname
        );
    }

    public function findByCategory($id_category)
    {
        $sql = "SELECT s.id_sujet, s.statut, s.titre, s.datecreation, s.contenu, s.utilisateur_id, s.categorie_id, count(r.id_reponse) AS nbReponse
        FROM sujet s
        LEFT JOIN reponse r
        ON s.id_sujet = r.topic_id
        WHERE categorie_id = :id
        GROUP BY s.id_sujet
            ";
        return self::getResults(
            self::select(
                $sql,
                ["id" => $id_category],
                true
            ),
            self::$classname
        );
    }

    public function addTopicByCat($array)
    {
        $sql = "INSERT INTO sujet(titre, contenu, categorie_id, utilisateur_id)
                VALUES (:titre, :contenu, :categorie_id, :utilisateur_id)";

        return self::create($sql, $array);
    }



    public function deleteTopic($id)
    {
        $sql = "DELETE FROM sujet
                WHERE id_sujet = :id_sujet
                ";

        return self::delete($sql, [
            'id_sujet' => $id
        ]);
    }
}
