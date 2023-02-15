<?php
require 'controllers/AbstractController.php';
require 'managers/UserManager.php';
require 'managers/MessageManager.php';

class UserController extends AbstractController{
    private UserManager $userManager;
    
    public function __construct()
    {
        $this->userManager = new UserManager("arnauddeletre_Distorsion", "3306", "db.3wa.io","arnauddeletre","900979afbcfa4468bcb42cce8d75b844");
    }


    public function indexDisplay()
    {   
        $_SESSION["message"] = "Vous n'êtes pas connecté";
        
        $superTable = $this->SuperTableCreation();
        $this->render("home", $superTable);
    }
    
    public function registerDisplay(array $post)
    {   
        if(empty($post)){
            $superTable = $this->SuperTableCreation();
            $this->render("register", $superTable);
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

                    $superTable = $this->SuperTableCreation();
                    $this->render("welcome", $superTable);
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
            $superTable = $this->SuperTableCreation();
            $this->render("login", $superTable);
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

                    $superTable = $this->SuperTableCreation();
                    $this->render("welcome", $superTable);
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
        $superTable = $this->SuperTableCreation();
        $this->render("create-room", $superTable);
    }
    
    public function SuperTableCreation(){

        $newCategoryManager = new CategoryManager("arnauddeletre_Distorsion", "3306", "db.3wa.io","arnauddeletre","900979afbcfa4468bcb42cce8d75b844");
        $newRoomManager = new RoomManager("arnauddeletre_Distorsion", "3306", "db.3wa.io","arnauddeletre","900979afbcfa4468bcb42cce8d75b844");
        $newMessageManager = new MessageManager("arnauddeletre_Distorsion", "3306", "db.3wa.io","arnauddeletre","900979afbcfa4468bcb42cce8d75b844");
        $allCategories=$newCategoryManager->loadAllCategory();
        $allRooms=$newRoomManager->loadAllRoom();
        $allMessages=$newMessageManager->loadAllMessage();

        $catRoomTab=[];
        foreach($allCategories as $category){
            $catRoomTab[$category->getName()]=[];
            foreach ($allRooms as $room){
                if ($room->getCategoryId()===$category->getId()){
                    $catRoomTab[$category->getName()][] = $room->getName();
                }
            }
        }

        $roomMessTab=[];
        foreach($allRooms as $room){
            $roomMessTab[$room->getName()]=[];
            foreach ($allMessages as $message){
                if ($message->getRoomId()===$room->getId()){
                    $roomMessTab[$room->getName()][] = $message->getContent();
                }
            }
        }

        $superTable = [$catRoomTab, $roomMessTab];

        return $superTable;
    }
    
    
}


?>



