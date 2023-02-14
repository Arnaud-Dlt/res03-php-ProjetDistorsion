<?php
// require 'controllers/AbstractController.php';
require 'managers/CategoryManager.php';

class CategoryController extends AbstractController{
    private CategoryManager $categoryManager;
    
    public function __construct()
    {
        $this->categoryManager = new CategoryManager("arnauddeletre_Distorsion", "3306", "db.3wa.io","arnauddeletre","900979afbcfa4468bcb42cce8d75b844");
    }
    
    public function createCatDisplay(array $post)
    {
        if(isset($post['catName'])){
            $this->createCategory($post);
            $this->render("welcome", ["categorie creer"]);
        }
        $this->render("create-category", []);
    }
    
    public function createCategory($post)
    {
        if(isset($post["catName"]) && !empty($post["catName"])
        && isset($post["catDescription"]) && !empty($post["catDescription"])){
            
            $newCategory=new Category($post['catName'],$post['catDescription']);
            $this->categoryManager->saveCategory($newCategory);
        }   
        
        else if(isset($post['catName']) && empty($post['catName'])){
            echo "Veuillez saisir un nom de catégorie";
        }
        else if(isset($post['catDescription']) && empty($post['catDescription'])){
            echo "Veuillez saisir une description";
        }
    }
}


?>