<?php

namespace Model\Manager;

use App\AbstractManager;

class ReponseManager extends AbstractManager
{
    private static $classname = "Model\Entity\Reponse";

    public function __construct()
    {
        self::connect(self::$classname);
    }

    public function findAll()
    {

        $sql = "SELECT texte
                    FROM reponse";

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
                        FROM reponse 
                        WHERE id_reponse = :id";
        return self::getOneOrNullResult(
            self::select(
                $sql,
                ["id" => $id],
                false
            ),
            self::$classname
        );
    }

    public function findReponseByTopic($id)
    {
        $sql = "SELECT * 
            FROM reponse r
            INNER JOIN sujet s
            ON r.topic_id = s.id_sujet
            WHERE s.id_sujet = :id";
        return self::getResults(
            self::select(
                $sql,
                ["id" => $id],
                true
            ),
            self::$classname
        );
    }
    
    public function addReponseByTopic($array)
    {
        $sql = "INSERT INTO reponse(texte, utilisateur_id, topic_id)
       VALUES (:texte, :utilisateur_id, :topic_id)";

        return self::create($sql, $array);
    }

    public function deleteReponsesFromTopic($id)
    {
        $sql = "DELETE FROM reponse
                WHERE topic_id = :topic_id";

                return self::delete($sql, [
                    'topic_id' => $id
                ]);
    }

    public function deleteReponseFromTopic()
    {
        //a faire
    }

}
