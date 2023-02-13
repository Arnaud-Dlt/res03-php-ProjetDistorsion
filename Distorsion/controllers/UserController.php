<?php
require 'controllers/AbstractController.php';
require 'managers/UserManager.php';

class UserController extends AbstractController{
    private UserManager $userManager;
    
    public function __construct()
    {
        $this->manager = new UserManager("arnauddeletre_Distorsion", "3306", "db.3wa.io","arnauddeletre","900979afbcfa4468bcb42cce8d75b844");
    }


    public function indexDisplay()
    {
        $this->render("home", []);
    }
    
    public function registerDisplay()
    {
        $this->render("register", []);
    }
    
    public function loginDisplay()
    {
        $this->render("login", []);
    }

    public function welcomeDisplay()
    {
        $this->render("welcome", []);
    }


        // if(isset($_POST["username"]) && !empty($_POST["username"])
        // && isset($_POST["registerEmail"]) && !empty($_POST["registerEmail"])
        // && isset($_POST["registerPassword"]) && !empty($_POST["registerPassword"])
        // && isset($_POST["confirm-password"]) && !empty($_POST["confirm-password"]))
        // {
        //     if($_POST["registerPassword"] === $_POST["confirm-password"])
        //     {
        
        //     $hashPwd=password_hash($_POST["registerPassword"], PASSWORD_DEFAULT);
        
        //     $newUser=new User($_POST['username'],$_POST['registerEmail'], $hashPwd);
        
        //     saveUser($newUser);
        //     $this->render("bienvenu", []);
        //     }
    
        //     else 
        //     {
        //         echo "Les mots de passe sont différents !";
        //     }
    
        //     if(loadUser($_POST['registerEmail']===null))
        //     {
        //         echo "Email déjà utilisé";
        //     }

        // }   
        
        // else if(isset($_POST['username']) && empty($_POST['username']))
        // {
        //     echo "Veuillez saisir un Pseudo";
        // }
        // else if(isset($_POST['registerEmail']) && empty($_POST['registerEmail']))
        // {
        //     echo "Veuillez saisir un Email";
        // }
        
        // $users=$this->manager->saveUser($newUser);


    public function editUser(array $newUser)
    {
        
    }
    
    function login()
    {
        if(isset($_POST['loginEmail'])&& !empty($_POST["loginEmail"]) && isset($_POST['loginPassword']) && !empty($_POST["loginPassword"]))
        {
            $logEmail=$_POST["loginEmail"];
            $pwd=$_POST["loginPassword"];
            $userToConnect=loadUser($logEmail);
    
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