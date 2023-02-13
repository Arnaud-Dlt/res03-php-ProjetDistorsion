<?php

require "managers/AbstractManager.php";
require "models/User.php";

class UserManager extends AbstractManager{
    
        function loadUser(string $email): ? User { 
    
        $query=$db->prepare("SELECT * FROM users WHERE email= :email");
    
        $parameters=['email' => $email];
    
        $query->execute($parameters);
    
        $loadedUser = $query->fetch(PDO::FETCH_ASSOC);
    
        if($loadedUser===false){
            return null;
        }
    
        $newUser=new User($loadedUser["username"],$loadedUser["email"], $loadedUser["password"]);
    
        $newUser->setId($loadedUser["id"]);
    
        return $newUser;
    }
    
    public function saveUser(User $user) : User{
        
        $query = $db->prepare('INSERT INTO users VALUES (null, :value1, :value2, :value3)');
        $parameters = [
        'value1' => $user->getUsername(),
        'value2' => $user->getEmail(),
        'value3' => $user->getPassword()
        ];
        $query->execute($parameters);
        $insertUser = $query->fetch(PDO::FETCH_ASSOC);
        
        $newUser = new User ($insertUser["username"], $insertUser["email"], $insertUser["password"]);
        $newUser->setId($insertUser["id"]);
        
        return $newUser;
    }

    // public function getAllUsers() : array{
        
    //     $query = $this->db->prepare('SELECT * FROM users');
    //     $query->execute();
    //     $loadedUsers = $query->fetchAll(PDO::FETCH_ASSOC);
        
    //     $loadedUsersObject=[];
    //     foreach ($loadedUsers as $loadedUser){
    //         $loadedUserObject = new User ($loadedUser["email"], $loadedUser["username"], $loadedUser["password"]);
    //         $loadedUsersObject[] = $loadedUserObject;
    //     }

    //     return $loadedUsersObject;
    // }
    
    // public function getUserById(int $id) : User{

    //     $query = $db->prepare('SELECT * FROM users WHERE id=:value');
    //     $parameters = ['value' => $id];
    //     $query->execute($parameters);
    //     $loadedUser = $query->fetch(PDO::FETCH_ASSOC);
        
    //     $loadedUserObject = new User ($loadedUser["email"], $loadedUser["username"], $loadedUser["password"]);
    
    //     return $loadedUserObject;
    // }
    
    
    // public function editUser(User $user) : void{
        
    //     $query = $db->prepare('UPDATE users SET email=:value1, username=:value2 password=:value3 WHERE users.id=:id');
    //     $parameters = [
    //     'id' => $user->getid(),
    //     'value1' => $user->getEmail(),
    //     'value2' => $user->getUsername(),
    //     'value3' => $user->getPassword()
    //     ];
    //     $query->execute($parameters);
    //     $editedUser = $query->fetch(PDO::FETCH_ASSOC);
    // }
    
}

?>