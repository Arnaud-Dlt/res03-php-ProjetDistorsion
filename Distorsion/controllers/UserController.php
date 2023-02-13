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
    
    public function registerDisplay()
    {
        if (isset($_POST["registerUsername"])){
            $this->register();
            $this->render("welcome", []);
        }
        else{
            $this->render("register", []);
        }
    }
    
    public function loginDisplay()
    {
        if (isset($_POST["loginEmail"])){
            echo "Je suis dans le if";
            $this->login();
            $this->render("welcome", []);
        }
        else{
            echo "Je suis dans le else";
            $this->render("login", []);
        }
    }

    public function welcomeDisplay()
    {
        $this->render("welcome", []);
    }

    private function register(){
        if(isset($_POST["registerUsername"]) && !empty($_POST["registerUsername"])
        && isset($_POST["registerEmail"]) && !empty($_POST["registerEmail"])
        && isset($_POST["registerPassword"]) && !empty($_POST["registerPassword"])
        && isset($_POST["confirmPassword"]) && !empty($_POST["confirmPassword"])){
            
            if($_POST["registerPassword"] === $_POST["confirmPassword"]){
                $hashPwd=password_hash($_POST["registerPassword"], PASSWORD_DEFAULT);
                $newUser=new User($_POST['registerUsername'],$_POST['registerEmail'], $hashPwd);
                $this->userManager->saveUser($newUser);
            }
            else{
                echo "Les mots de passe sont différents !";
            }
            // if(loadUser($_POST['registerEmail']===null)){
            //     echo "Email déjà utilisé";
            // }
        }   
        
        else if(isset($_POST['registerUsername']) && empty($_POST['registerUsername'])){
            echo "Veuillez saisir un Pseudo";
        }
        else if(isset($_POST['registerEmail']) && empty($_POST['registerEmail'])){
            echo "Veuillez saisir un Email";
        }
        else if(isset($_POST['registerPassword']) && empty($_POST['registerPassword'])){
            echo "Veuillez saisir un mot de passe";
        }
        else if(isset($_POST['confirmPassword']) && empty($_POST['confirmPassword'])){
            echo "Veuillez confirmer votre mot de passe";
        }
        // $users=$this->manager->saveUser($newUser);
    }

    function login()
    {
        if(isset($_POST['loginEmail'])&& !empty($_POST["loginEmail"]) && isset($_POST['loginPassword']) && !empty($_POST["loginPassword"]))
        {
            $logEmail=$_POST["loginEmail"];
            $pwd=$_POST["loginPassword"];
            $userToConnect=$this->userManager->loadUser($logEmail);
            var_dump($userToConnect);
            if(password_verify($pwd, $userToConnect->getPassword()))
            {
                echo "Bienvenue";
                $_GET["route"]="admin-posts";
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