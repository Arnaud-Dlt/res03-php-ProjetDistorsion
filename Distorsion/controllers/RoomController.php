<?php
require 'controllers/AbstractController.php';
require 'managers/RoomManager.php';

class RoomController extends AbstractController{
    private RoomManager $manager;
    
    public function __construct()
    {
        $this->manager = new RoomManager("arnauddeletre_Distorsion", "3306", "db.3wa.io","arnauddeletre","900979afbcfa4468bcb42cce8d75b844");
    }
    
    
    public function index()
    {
        $users=$this->manager->getAllRoom();
        $this->render("index", ["users"=>$users]);
    }
    
    public function create(array $post)
    {
        $user = new Room($post['email'], $post['username'], $post['password']);
        $users=$this->manager->insertRoom($user);
        $this->render("create", ["users"=>$users]);
    }
    
    public function edit(array $post)
    {
        
    }
}


?>