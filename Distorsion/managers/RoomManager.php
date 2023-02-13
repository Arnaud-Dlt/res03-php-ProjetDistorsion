<?php

require "managers/AbstractManager.php";
require "models/Room.php";

class RoomManager extends AbstractManager{
    
        function loadAllRoom($room): array 
        { 
        
        $query=$db->prepare("SELECT * FROM rooms");
    
        $parameters=['email' => $email];
    
        $query->execute($parameters);
    
        $loadedRoom = $query->fetchAll(PDO::FETCH_ASSOC);
    
        if($loadedRoom===false){
            return null;
        }
    
        $newRoom=new User($loadedRoom["name"],$loadedRoom["description"]);
    
        $newRoom->setId($loadedRoom["id"]);
    
        return $newRoom;
    }
    
    public function saveRoom(Room $room) : Room{
        
        $query = $db->prepare('INSERT INTO rooms VALUES (null, :value1, :value2, :value3)');
        $parameters = [
        'value1' => $room->getName(),
        'value2' => $room->getDescription()
        ];
        $query->execute($parameters);
        $insertRoom = $query->fetch(PDO::FETCH_ASSOC);
        
        $newRoom = new Room ($insertRoom["name"], $insertRoom["description"]);
        $newRoom->setId($insertRoom["id"]);
        
        return $newUser;
    }
    
?>