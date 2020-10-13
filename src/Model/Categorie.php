<?php

namespace src\Model;

Class Categorie {
    private $id;
    private $libelle;
    private $code;

    public function SqlGetAll(\PDO $bdd){
        $requete = $bdd->prepare("SELECT * FROM categorie");
        $requete->execute();
        $datas =  $requete->fetchAll(\PDO::FETCH_CLASS,'src\Model\Categorie');
        return $datas;
    }

    public function SqlGetById(\PDO $bdd, $id){
        $requete = $bdd->prepare("SELECT * FROM categorie WHERE id=:id");
        $requete->execute([
            "id" => $id
        ]);
        $requete->setFetchMode(\PDO::FETCH_CLASS,'src\Model\Categorie');
        $categorie = $requete->fetch();

        return $categorie;
    }

    public function SqlDeleteById(\PDO $bdd, $id){
        $requete = $bdd->prepare("DELETE FROM categorie WHERE id=:id");
        $requete->execute([
            "id" => $id
        ]);
        return true;
    }
    public function SqlUpdate(\PDO $bdd){
        try {
            $requete = $bdd->prepare("UPDATE categorie set libelle= :libelle, code = :code WHERE id = :id");

            $requete->execute([
                "id" => $this->getId(),
                "libelle" => $this->getLibelle(),
                "code" => $this->getCode(),
            ]);
            return "OK";
        }catch (\Exception $e){
            return $e->getMessage();
        }

    }
    public function SqlAdd(\PDO $bdd){
        try {
            $requete = $bdd->prepare("INSERT INTO categorie (libelle, code) VALUES(:libelle, :code)");

            $requete->execute([
                "libelle" => $this->getLibelle(),
                "code" => $this->getCode(),
            ]);
            return $bdd->lastInsertId();
        }catch (\Exception $e){
            return $e->getMessage();
        }

    }
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Article
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * @param mixed $libelle
     * @return Categorie
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     * @return Categorie
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }
}