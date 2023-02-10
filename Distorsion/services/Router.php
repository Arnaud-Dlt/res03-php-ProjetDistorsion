<?php

require "controllers/UserController.php";

class Router {
    
    private UserController $UserControl;

    public function __construct()
    {
        $this->UserControl = new UserController();
    }
    
    function checkRoute(string $route) : void 
    {
        if ($route === "users"){
            $this->UserControl->index();
        }
        else if ($route === "user-create"){
            $this->UserControl->create();
        }
        else if ($route === "user-edit"){
            $this->UserControl->edit();
        }
        else{
            $this->UserControl->index();
        }
    }
}


?>