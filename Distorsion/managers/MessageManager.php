<?php

require "models/Message.php";

class MessageManager extends AbstractManager{
    
    function loadAllMessage(): array 
    { 
        $query=$this->db->prepare("SELECT * FROM messages");
        $query->execute();
        $getAllMessage = $query->fetchAll(PDO::FETCH_ASSOC);
    
        $tabmessage=[];
        foreach($getAllMessage as $message)
        {
            $newMessage=new Message($message["content"], $message["room_id"], $message["user_id"]);
            array_push($tabmessage, $newMessage);
        }
        return $tabmessage;
    }
    
    public function saveMessage(Message $message) : ? Message{
        $query = $this->db->prepare('INSERT INTO messages VALUES (null, :value1)');
        $parameters = ['value1' => $message->getContent()];
        $query->execute($parameters);

        return $this->loadMessage($message->getContent());
    }
}
?>