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
            $this->userController->loginDisplay($_POST);
        }
        else if ($route === "bienvenue"){
            $this->userController->welcomeDisplay();
        }
        else if ($route === "create-categories"){
            $this->userController->createCatDisplay();
        }
        else if ($route === "create-rooms"){
            $this->userController->createRoomDisplay();
        }
        else{
            $this->userController->indexDisplay();
        }
    }
}


?>