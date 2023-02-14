<?php
// require 'controllers/AbstractController.php';
require 'managers/RoomManager.php';
// require 'managers/CategoryManager.php';

class RoomController extends AbstractController{
    private RoomManager $roomManager;
    private CategoryManager $categoryManager;
    
    public function __construct()
    {
        $this->roomManager = new RoomManager("arnauddeletre_Distorsion", "3306", "db.3wa.io","arnauddeletre","900979afbcfa4468bcb42cce8d75b844");
        $this->categoryManager = new CategoryManager("arnauddeletre_Distorsion", "3306", "db.3wa.io","arnauddeletre","900979afbcfa4468bcb42cce8d75b844");
    }
    
    public function createRoomDisplay(array $post)
    {
        if(isset($post['roomName'])){
            $this->createRoom($post);
            $this->render("welcome", ["room creer"]);
        }
        $allCategories=$this->categoryManager->loadAllCategory();
        $this->render("create-room", $allCategories);
    }
    
    public function createRoom($post)
    {
        if(isset($post["roomName"]) && !empty($post["roomName"])
        && isset($post["roomDescription"]) && !empty($post["roomDescription"])
        && isset($post["categoryId"]) && !empty($post["categoryId"]))
        {
            $newRoom=new Room($post['roomName'], $post['roomDescription'], $post['categoryId']);
            $this->roomManager->saveRoom($newRoom);
        }   
        
        else if(isset($post['roomName']) && empty($post['roomName'])){
            echo "Veuillez saisir un nom de salon";
        }
        else if(isset($post['roomDescription']) && empty($post['roomDescription'])){
            echo "Veuillez saisir une description";
        }
    }
}


?>