<?php

// require "managers/AbstractManager.php";
require "models/Room.php";

class RoomManager extends AbstractManager{
    
    function loadAllRoom(): array 
    { 
        $query=$this->db->prepare("SELECT * FROM rooms");
        $query->execute();
        $getAllRooms = $query->fetchAll(PDO::FETCH_ASSOC);

        $tabRooms=[];
        foreach($getAllRooms as $room)
        {
            $newRoom=new Room($room["name"], $room["description"], $room["category_id"]);
            $newRoom->setId($room["id"]);
            array_push($tabRooms, $newRoom);
        }
        return $tabRooms;
    }
    
    public function saveRoom(Room $room) :void
    {
        $query = $this->db->prepare('INSERT INTO rooms VALUES (null, :value1, :value2, :value3)');
        $parameters = [
        'value1' => $room->getName(),
        'value2' => $room->getDescription(),
        'value3' => $room->getCategoryId()
        ];
        $query->execute($parameters);
    }
}
    
?>