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
        $_SESSION["message"] = "Vous n'êtes pas connecté";
        $this->render("home", []);
    }
    
    public function registerDisplay(array $post)
    {   
        if(empty($post)){
            $this->render("register", []);
        }
            
        else{
            if(isset($post["registerUsername"]) && !empty($post["registerUsername"])
            && isset($post["registerEmail"]) && !empty($post["registerEmail"])
            && isset($post["registerPassword"]) && !empty($post["registerPassword"])
            && isset($post["confirmPassword"]) && !empty($post["confirmPassword"])){
            
                if($post["registerPassword"] === $post["confirmPassword"]){
                    $hashPwd=password_hash($post["registerPassword"], PASSWORD_DEFAULT);
                    $newUser=new User($post['registerUsername'],$post['registerEmail'], $hashPwd);
                    $this->userManager->saveUser($newUser);
                    
                    $userToConnect=$this->userManager->loadUser($post['registerEmail']);

                    $_SESSION["connectedUser"] = true;
                    $_SESSION["userId"] = $userToConnect->getId();
                    $_SESSION["message"] = "Bienvenue ".$userToConnect->getUsername();

                    $newCategoryManager = new CategoryManager("arnauddeletre_Distorsion", "3306", "db.3wa.io","arnauddeletre","900979afbcfa4468bcb42cce8d75b844");
                    $allCategories=$newCategoryManager->loadAllCategory();
                    $this->render("welcome", $allCategories);
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
    }
    
    public function loginDisplay(array $post)
    {
        if(empty($post)){
            $this->render("login", []);
        }
        else{
            if(isset($post['loginEmail'])&& !empty($post["loginEmail"]) && isset($post['loginPassword']) && !empty($post["loginPassword"])){
                $logEmail=$post["loginEmail"];
                $pwd=$post["loginPassword"];
                $userToConnect=$this->userManager->loadUser($logEmail);
                if(password_verify($pwd, $userToConnect->getPassword())){

                    $_SESSION["connectedUser"] = true;
                    $_SESSION["userId"] = $userToConnect->getId();
                    $_SESSION["message"] = "Bienvenue ".$userToConnect->getUsername();

                    $newCategoryManager = new CategoryManager("arnauddeletre_Distorsion", "3306", "db.3wa.io","arnauddeletre","900979afbcfa4468bcb42cce8d75b844");
                    $allCategories=$newCategoryManager->loadAllCategory();
                    $this->render("welcome", $allCategories);
                }
                else{
                    echo "Identifiants inconnus";
                }
            }
            else{
                echo "Merci de compléter tous les champs";
            }
        }
    }

    public function createRoomDisplay()
    {
        $this->render("create-room", []);
    }
}




// $tabCatRoom=[];

// foreach($categories as $category){
    
//     $id=$category->getId();
    
//     foreach($rooms as $room){
        
//         if($id === $room->getId()){
//             array_push($tab, $room);
//         }
//     }
// }








?>


