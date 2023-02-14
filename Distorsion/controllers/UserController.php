<?php
require 'controllers/AbstractController.php';
require 'managers/UserManager.php';

class UserController extends AbstractController{
    private UserManager $userManager;
    
    public function __construct()
    {
        $this->userManager = new UserManager("arnauddeletre_Distorsion", "3306", "db.3wa.io","arnauddeletre","900979afbcfa4468bcb42cce8d75b844");
    }


    public function indexDisplay()
    {
        $this->render("home", []);
    }
    
    public function registerDisplay(array $post)
    {
        echo "coucou";
        if (isset($post["registerUsername"])){
            $this->register($post);
            $this->render("welcome", []);
        }
        else{
            $this->render("register", []);
        }
    }
    
    public function loginDisplay(array $post)
    {
        if (isset($post["loginEmail"])){
            $this->login($post);
            $this->render("welcome", []);
        }
        else{
            $this->render("login", []);
        }
    }

    
    
    public function createRoomDisplay()
    {
        $this->render("create-room", []);
    }

    private function register(){
        if(isset($post["registerUsername"]) && !empty($post["registerUsername"])
        && isset($post["registerEmail"]) && !empty($post["registerEmail"])
        && isset($post["registerPassword"]) && !empty($post["registerPassword"])
        && isset($post["confirmPassword"]) && !empty($post["confirmPassword"])){
            
            if($post["registerPassword"] === $post["confirmPassword"]){
                $hashPwd=password_hash($post["registerPassword"], PASSWORD_DEFAULT);
                $newUser=new User($post['registerUsername'],$post['registerEmail'], $hashPwd);
                $this->userManager->saveUser($newUser);
            }
            else{
                echo "Les mots de passe sont différents !";
            }
        }   
        
        else if(isset($post['registerUsername']) && empty($post['registerUsername'])){
            echo "Veuillez saisir un Pseudo";
        }
        else if(isset($post['registerEmail']) && empty($post['registerEmail'])){
            echo "Veuillez saisir un Email";
        }
        else if(isset($post['registerPassword']) && empty($post['registerPassword'])){
            echo "Veuillez saisir un mot de passe";
        }
        else if(isset($post['confirmPassword']) && empty($post['confirmPassword'])){
            echo "Veuillez confirmer votre mot de passe";
        }
    }

    private function login(array $post)
    {
        
        if(isset($post['loginEmail'])&& !empty($post["loginEmail"]) && isset($post['loginPassword']) && !empty($post["loginPassword"]))
        {
            $logEmail=$post["loginEmail"];
            $pwd=$post["loginPassword"];
            $userToConnect=$this->userManager->loadUser($logEmail);
            if(password_verify($pwd, $userToConnect->getPassword()))
            {
                $_GET["route"]="bienvenue";
                // $_SESSION["connectedUser"] = true;
                // $_SESSION["userId"] = $userToConnect->getId();
            }
            else 
            {
                echo "Identifiants inconnus";
            }
        }
    }
}


?>