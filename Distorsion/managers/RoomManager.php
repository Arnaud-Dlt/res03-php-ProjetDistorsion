<?php

require "managers/AbstractManager.php";
require "models/Room.php";

class RoomManager extends AbstractManager{
    
    function loadAllRoom($room): array 
    { 
        
        $query=$db->prepare("SELECT * FROM rooms");
    
        $query->execute();
    
        $loadedRooms = $query->fetchAll(PDO::FETCH_ASSOC);
    
        $tabrooms=[];
        foreach($loadedRooms as $room)
        {
            $newRoom=new Room($room["name"],$room["description"]);
            array_push($tabrooms, $newRoom);
        }
        return $tabrooms;
    }
    
    public function saveRoom(Room $room) : Room 
    {
        $query = $db->prepare('INSERT INTO rooms VALUES (null, :value1, :value2, :value3)');
        
        $parameters = ['value1' => $room->getName(),'value2' => $room->getDescription()];
        
        $query->execute($parameters);
        
        $insertRoom = $query->fetch(PDO::FETCH_ASSOC);
        
        $newRoom = new Room ($insertRoom["name"], $insertRoom["description"]);
        
        $newRoom->setId($insertRoom["id"]);
        
        return $newRoom;
    }
    
?>