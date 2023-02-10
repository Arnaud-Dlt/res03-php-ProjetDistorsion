<?php

require "controllers/UserController.php";
require "controllers/MessageController.php";
require "controllers/CategoryController.php";
require "controllers/RoomController.php";

class Router {
    
    private UserController $UserControl;
    private MessageController $MessageController;
    private CategoryController $CategoryController;
    private RoomController $RoomController;

    public function __construct()
    {
        $this->UserController = new UserController();
        $this->MessageController = new MessageController();
        $this->CategoryController = new CategoryController();
        $this->RoomController = new RoomController();
    }
    
    function checkRoute(string $route) : void 
    {
        if ($route === "creation-compte"){
            $this->UserController->register();
        }
        if ($route === "connexion"){
            $this->UserController->login();
        }
        if ($route === "bienvenu"){
            $this->UserController->welcome();
            $this->CategoryController->categoriesDisplay();
            $this->RoomController->roomsDisplay();
        }
        if ($route === "discussion"){
            $this->UserController->discussionDisplay();
            $this->CategoryController->categoriesDisplay();
            $this->RoomController->roomsDisplay();
        }
        else if ($route === "creation-categorie"){
            $this->CategotyController->create();
        }
        else if ($route === "creation-salle"){
            $this->RoomController->edit();
        }
        else{
            $this->UserControl->index();
        }
    }
}


?>