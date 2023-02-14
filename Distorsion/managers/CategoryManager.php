<?php

// require "managers/AbstractManager.php";
require "models/Category.php";

class CategoryManager extends AbstractManager
{
    
    function loadAllCategory($category): array 
    { 
        $query=$db->prepare("SELECT * FROM categories");
    
        $query->execute();
    
        $getAllCategories = $query->fetchAll(PDO::FETCH_ASSOC);
    
        $tabCategories=[];
        
        foreach($getAllCategories as $category)
        {
            $newCategory=new Category($category["name"],$category["description"]);
            
            array_push($tabCategories, $newCategory);
        }
        return $tabCategories;
    }
    
    public function saveCategory(Category $category) :void
    {
        $query = $this->db->prepare('INSERT INTO categories VALUES (null, :value1, :value2)');
        $parameters = [
        'value1' => $category->getName(),
        'value2' => $category->getDescription()
        ];
        $query->execute($parameters);
        
    }
}
?>