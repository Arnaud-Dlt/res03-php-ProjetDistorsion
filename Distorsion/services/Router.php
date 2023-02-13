<?php

require "controllers/UserController.php";
// require "controllers/MessageController.php";
// require "controllers/CategoryController.php";
// require "controllers/RoomController.php";

class Router {
    
    private UserController $userControl;
    // private MessageController $MessageController;
    // private CategoryController $CategoryController;
    // private RoomController $RoomController;

    public function __construct()
    {
        $this->userController = new UserController();
        // $this->MessageController = new MessageController();
        // $this->CategoryController = new CategoryController();
        // $this->RoomController = new RoomController();
    }
    
    function checkRoute(string $route) : void 
    {
        if ($route === "accueil"){
            $this->userController->indexDisplay();
        }
        else if ($route === "créer-compte"){
            $this->userController->registerDisplay();
        }
        else if ($route === "connexion"){
            $this->userController->loginDisplay();
        }
        else if ($route === "bienvenu"){
            $this->userController->welcomeDisplay();
        }


        // if ($route === "discussion"){
        //     $this->userController->discussionDisplay();
        //     // $this->CategoryController->categoriesDisplay();
        //     // $this->RoomController->roomsDisplay();
        // }
        // else if ($route === "creation-categorie"){
        //     $this->uategotyController->createCategory();
        // }
        // else if ($route === "creation-salle"){
        //     $this->roomController->createRoom();
        // }
        else{
            $this->userController->indexDisplay();
        }
    }
}


?>