<?php
require 'controllers/AbstractController.php';

class UserController extends AbstractController{

    public function index()
    {
       $this->render("accueil", []);
    }
    
    public function register(array $user)
    {
        if(isset($_POST["username"]) && !empty($_POST["username"])
        && isset($_POST["registerEmail"]) && !empty($_POST["registerEmail"])
        && isset($_POST["registerPassword"]) && !empty($_POST["registerPassword"])
        && isset($_POST["confirm-password"]) && !empty($_POST["confirm-password"]))
        {
            if($_POST["registerPassword"] === $_POST["confirm-password"])
            {
        
            $hashPwd=password_hash($_POST["registerPassword"], PASSWORD_DEFAULT);
        
            $newUser=new User($_POST['username'],$_POST['registerEmail'], $hashPwd);
        
            saveUser($newUser);
            $this->render("bienvenu", []);
            }
    
            else 
            {
                echo "Les mots de passe sont différents !";
            }
    
            if(loadUser($_POST['registerEmail']===null))
            {
                echo "Email déjà utilisé";
            }

        }   
        
        else if(isset($_POST['username']) && empty($_POST['username']))
        {
            echo "Veuillez saisir un Pseudo";
        }
        else if(isset($_POST['registerEmail']) && empty($_POST['registerEmail']))
        {
            echo "Veuillez saisir un Email";
        }
        
        $users=$this->manager->saveUser($newUser);
        
        $this->render("register", ["users"=>$users]);
    }
    
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