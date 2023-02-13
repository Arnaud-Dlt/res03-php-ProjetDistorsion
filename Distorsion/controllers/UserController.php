<?php
require 'controllers/AbstractController.php';
require 'managers/UserManager.php';

class UserController extends AbstractController{
    private UserManager $userManager;
    
    public function __construct()
    {
        $this->manager = new UserManager("arnauddeletre_Distorsion", "3306", "db.3wa.io","arnauddeletre","900979afbcfa4468bcb42cce8d75b844");
    }
    
    
    public function index()
    {
       $this->render("accueil", []);
    }
    
    public function register(array $user)
    {
        if(isset($_POST["username"]) && !empty($_POST["username"])
        && isset($_POST["email"]) && !empty($_POST["email"])
        && isset($_POST["password"]) && !empty($_POST["password"])
        && isset($_POST["confirm-password"]) && !empty($_POST["confirm-password"]))
        {
            if($_POST["passwordRegister"] === $_POST["confirm-password"])
            {
        
            $hashPwd=password_hash($_POST["passwordRegister"], PASSWORD_DEFAULT);
        
            $newUser=new User($_POST['username'],$_POST['email'], $hashPwd);
        
            saveUser($newUser);
            }
    
            else 
            {
                echo "Les mots de passe sont différents !";
            }
    
            if(loadUser($_POST['emailRegister']===null))
            {
                echo "Email déjà utilisé";
            }

        }   
        
        else if(isset($_POST['username']) && empty($_POST['username']))
        {
            echo "Veuillez saisir un Prenom";
        }
        else if(isset($_POST['email']) && empty($_POST['email']))
        {
            echo "Veuillez saisir un Email";
        }
        
        $users=$this->manager->saveUser($newUser);
        
        $this->render("create", ["users"=>$users]);
    }
    
    public function editUser(array $newUser)
    {
        
    }
    
    function login()
    {
        if(isset($_POST['email'])&& !empty($_POST["email"]) && isset($_POST['password']) && !empty($_POST["password"]))
        {
            $logEmail=$_POST["email"];
            $pwd=$_POST["password"];
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