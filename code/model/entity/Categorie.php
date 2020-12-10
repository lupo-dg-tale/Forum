<?php 
 
namespace Model\Entity;
 
use App\AbstractEntity;
 
class Categorie extends AbstractEntity{
 
    private $id;
    private $nom;
    private $icone;
 
    public function __construct($data){
        $this->hydrate($data);
    }

 
    

    /**
     * Get the value of nom
     */ 
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */ 
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of icone
     */ 
    public function getIcone()
    {
        return $this->icone;
    }

    /**
     * Set the value of icone
     *
     * @return  self
     */ 
    public function setIcone($icone)
    {
        $this->icone = $icone;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}