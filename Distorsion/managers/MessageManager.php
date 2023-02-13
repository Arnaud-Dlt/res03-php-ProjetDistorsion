<?php

require "managers/AbstractManager.php";
require "models/Message.php";

class MessageManager extends AbstractManager{
    
    function loadAllMessage($message): array 
    { 
        $query=$db->prepare("SELECT * FROM messages");
    
        $query->execute();
    
        $loadedmessages = $query->fetchAll(PDO::FETCH_ASSOC);
    
        $tabmessages=[];
        
        foreach($getAllmessages as $message)
        {
            $newMessage=new Message($message["content"]);
            
            array_push($tabMessages, $newMessage);
        }
        
        return $tabMessages;
    }
    
    public function saveMessage(Message $message) : Message{
        
        $query = $db->prepare('INSERT INTO messages VALUES (null, :value1)');
        $parameters = ['value1' => $message->getContent()];
        $query->execute($parameters);
        $insertMessage = $query->fetch(PDO::FETCH_ASSOC);
        
        $newMessage = new Message ($insertMessage["content"]);
        $newMessage->setId($insertMessage["id"]);
        
        return $newMessage;
    }
?>