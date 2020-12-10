<?php
    namespace Model\Manager;
    
    use App\AbstractManager;
    
    class CategorieManager extends AbstractManager
    {
        private static $classname = "Model\Entity\Categorie";

        public function __construct(){
            self::connect(self::$classname);
        }

        public function findAll(){

            $sql = "SELECT *
                    FROM categorie";

            return self::getResults(
                self::select($sql,
                    null, 
                    true
                ), 
                self::$classname
            );
        }

        public function findOneById($id){
            $sql = "SELECT * 
                        FROM categorie 
                        WHERE id_categorie = :id";
            return self::getOneOrNullResult(
                self::select($sql, 
                    ["id" => $id], 
                    false
                ), 
                self::$classname
            );
        }

    }