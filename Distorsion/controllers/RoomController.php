<?php
require 'controllers/AbstractController.php';
require 'managers/RoomManager.php';

class RoomController extends AbstractController{
    private RoomManager $roomManager;
    
    public function __construct()
    {
        $this->manager = new RoomManager("arnauddeletre_Distorsion", "3306", "db.3wa.io","arnauddeletre","900979afbcfa4468bcb42cce8d75b844");
    }
    
    
    public function index()
    {
        $rooms=$this->manager->getAllRoom();
        
        $this->render("index", ["rooms"=>$rooms]);
    }
    
    public function createRoom(array $room)
    {
        $newRoom = new Room($room['email'], $room['username'], $room['password']);
        
        $users=$this->manager->insertRoom($newRoom);
        
        $this->render("create", ["users"=>$users]);
    }
    
    public function editRoom(array $room)
    {
        
    }
}


?>