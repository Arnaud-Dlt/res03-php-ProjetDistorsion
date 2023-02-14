<?php
// require 'controllers/AbstractController.php';
require 'managers/RoomManager.php';

class RoomController extends AbstractController{
    private RoomManager $roomManager;
    
    public function __construct()
    {
        $this->roomManager = new RoomManager("arnauddeletre_Distorsion", "3306", "db.3wa.io","arnauddeletre","900979afbcfa4468bcb42cce8d75b844");
    }
    
    public function createRoomDisplay(array $post)
    {
        if(isset($post['roomName'])){
            $this->createRoom($post);
            echo "room creer";
        }
        $this->render("create-room", []);
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