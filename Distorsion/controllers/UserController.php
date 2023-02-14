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