<?php 

namespace src\Controller;

use src\Model\Categorie;
use src\Model\BDD;

Class CategorieController extends AbstractController{
    public function Add(){
        if($_POST){
            $categorie = new Categorie();
            $categorie->setLibelle($_POST["libelle"]);
            $categorie->setCode($_POST["code"]);
            $id = $categorie->SqlAdd(BDD::getInstance());
            header("Location:/categorie/show/$id");
        }else{
            return $this->twig->render("Categorie/add.html.twig");
        }


    }

    public function All(){
        $categorie = new Categorie();
        $datas = $categorie->SqlGetAll(BDD::getInstance());
        return $this->twig->render("Categorie/all.html.twig", [
            "categories"=>$datas
        ]);
    }

    public function Show($id){
        $categorie = new Categorie();
        $datas = $categorie->SqlGetById(BDD::getInstance(),$id);

        return $this->twig->render("Categorie/show.html.twig", [
            "categorie"=>$datas
        ]);
    }

    public function Delete($id){
        $categorie = new Categorie();
        $datas = $categorie->SqlDeleteById(BDD::getInstance(),$id);

        header("Location:/Categorie/All");
    }

    public function Update($id){
        $categories = new Categorie();
        $categorie = $categories->SqlGetById(BDD::getInstance(),$id);

        if($_POST){

            $categorie->setLibelle($_POST["libelle"]);
            $categorie->setCode($_POST["code"]);

            $categorie->SqlUpdate(BDD::getInstance());
            header("Location:/categorie/show/$id");
        }else{
            return $this->twig->render("Categorie/update.html.twig", [
                "categorie"=>$categorie
            ]);
        }

    }

}