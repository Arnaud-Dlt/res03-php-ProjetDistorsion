<?php
require 'controllers/AbstractController.php';
require 'managers/CategoryManager.php';

class CategoryController extends AbstractController{
    private CategoryManager $categoryManager;
    
    public function __construct()
    {
        $this->categoryManager = new CategoryManager("arnauddeletre_Distorsion", "3306", "db.3wa.io","arnauddeletre","900979afbcfa4468bcb42cce8d75b844");
    }
    
    
    public function createCategory()
    {
        if(isset($_POST["catName"]) && !empty($_POST["catName"])
        && isset($_POST["catDescription"]) && !empty($_POST["catDescription"])){
            
            if(loadCategory($_POST['catName']===null)){
                echo "Nom déjà utilisé";
            }
            
            else {
                $newCategory=new Category($_POST['catName'],$_POST['catDescription']);
                $this->categoryManager->saveCategory($newCategory);
            }
        }   
        
        else if(isset($_POST['catName']) && empty($_POST['catName'])){
            echo "Veuillez saisir un nom de catégorie";
        }
        else if(isset($_POST['catDescription']) && empty($_POST['catDescription'])){
            echo "Veuillez saisir une description";
        }
    }
    
}


?>