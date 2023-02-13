<?php
require 'controllers/AbstractController.php';
require 'managers/CategoryManager.php';

class CategoryController extends AbstractController{
    private CategoryManager $categoryManager;
    
    public function __construct()
    {
        $this->manager = new CategoryManager("arnauddeletre_Distorsion", "3306", "db.3wa.io","arnauddeletre","900979afbcfa4468bcb42cce8d75b844");
    }
    
    
    public function index()
    {
        $categories=$this->manager->getAllCategory();
        $this->render("index", ["categories"=>$categories]);
    }
    
    public function createCategory(array $category)
    {
        $newCategory = new Category($category['name'],$category['description']);
        $categories=$this->manager->insertCategory($newCategory);
        $this->render("create", ["categories"=>$categories]);
    }
    
    public function editcategory(array $category)
    {
        
    }
}


?>