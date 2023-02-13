<?php

require "controllers/DisplayController.php";

class Router {
    
    private DisplayController $displayController;

    public function __construct()
    {
        $this->displayController = new DisplayController();
    }
    
    function checkRoute(string $route) : void 
    {
        if ($route === "accueil"){
            $this->displayController->index();
        }
        if ($route === "créer-compte"){
            $this->displayController->index();
        }
        if ($route === "connexion"){
            $this->displayController->index();
        }
        if ($route === "bienvenu"){
            $this->displayController->index();
        }


        if ($route === "discussion"){
            $this->UserController->discussionDisplay();
            // $this->CategoryController->categoriesDisplay();
            // $this->RoomController->roomsDisplay();
        }
        else if ($route === "creation-categorie"){
            $this->CategotyController->createCategory();
        }
        else if ($route === "creation-salle"){
            $this->RoomController->createRoom();
        }
        else{
            $this->UserController->index();
        }
    }
}


?>