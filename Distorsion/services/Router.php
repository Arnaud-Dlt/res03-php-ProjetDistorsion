<?php

require "controllers/UserController.php";
// require "controllers/MessageController.php";
require "controllers/CategoryController.php";
// require "controllers/RoomController.php";

class Router {
    
    private UserController $userControl;
    // private MessageController $messageController;
    private CategoryController $categoryController;
    // private RoomController $roomController;

    public function __construct()
    {
        $this->userController = new UserController();
        // $this->messageController = new MessageController();
        $this->categoryController = new CategoryController();
        // $this->roomController = new RoomController();
    }
    
    function checkRoute(string $route) : void 
    {
        if ($route === "accueil"){
            $this->userController->indexDisplay();
        }
        else if ($route === "créer-compte"){
            $this->userController->registerDisplay($_POST);
        }
        else if ($route === "connexion"){
            $this->userController->loginDisplay($_POST);
        }
        else if ($route === "bienvenue"){
            $this->userController->welcomeDisplay();
        }
        else if ($route === "créer-categorie"){
            $this->categoryController->createCatDisplay($_POST);
        }
        else if ($route === "créer-salon"){
            $this->userController->createRoomDisplay();
        }
        else{
            $this->userController->indexDisplay();
        }
    }
}


?>