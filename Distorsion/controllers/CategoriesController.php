<?php
require 'controllers/AbstractController.php';
require 'managers/CategoryManager.php';

class CategoriesController extends AbstractController{
    private CategoriesManager $manager;
    
    public function __construct()
    {
        $this->manager = new CategoryManager("arnauddeletre_Distorsion", "3306", "db.3wa.io","arnauddeletre","900979afbcfa4468bcb42cce8d75b844");
    }
    
    
    public function index()
    {
        $category=$this->manager->getAllCategory();
        $this->render("index", ["users"=>$category]);
    }
    
    public function create(array $category)
    {
        $category = new Category($category['name'], $category['description']);
        $users=$this->manager->insertCategory($category);
        $this->render("create", ["category"=>$category]);
    }
    
    public function edit(array $post)
    {
        
    }
}


?>