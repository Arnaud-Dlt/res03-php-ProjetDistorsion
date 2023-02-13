<?php

require "managers/AbstractManager.php";
require "models/Room.php";

class RoomManager extends AbstractManager{
    
    function loadAllRoom($room): array 
    { 
        $query=$db->prepare("SELECT * FROM rooms");
    
        $query->execute();
    
        $getAllRooms = $query->fetchAll(PDO::FETCH_ASSOC);
    
        $tabRooms=[];
        
        foreach($getAllRooms as $room)
        {
            $newRoom=new Room($room["name"],$room["description"]);
            
            array_push($tabRooms, $newRoom);
        }
        return $tabRooms;
    }
    
    public function saveRoom(Room $room) : ? Room{
        $query = $this->db->prepare('INSERT INTO rooms VALUES (null, :value1, :value2)');
        $parameters = [
        'value1' => $room->getName(),
        'value2' => $room->getDescription()
        ];
        $query->execute($parameters);

        return $this->loadRoom($room->getEmail());
    }
    
?>