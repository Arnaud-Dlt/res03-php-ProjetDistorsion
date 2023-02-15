<?php
require 'controllers/AbstractController.php';
require 'managers/MessageManager.php';

class MessageController extends AbstractController{
    private MessageManager $messageManager;
    
    public function __construct()
    {
        $this->messageManager = new MessageManager("arnauddeletre_Distorsion", "3306", "db.3wa.io","arnauddeletre","900979afbcfa4468bcb42cce8d75b844");
    }
    
    
    public function createMessageDisplay(array $post)
    {
        if(isset($post['content'])){
            $this->createMessage($post);
        }
        $allMessages=$this->messageManager->loadAllMessage();
        $this->render("", $allMessages);
    }
    
    public function createMessage(array $message)
    {
        if(isset($post[""]) && !empty($post[""])){
            
            $newMessage=new Message($post['content']);
            $this->messageManager->saveMessage($newMessage);
        }   
        
        else {
            
        }
    }
}


?>