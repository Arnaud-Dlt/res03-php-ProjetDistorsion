<?php
require 'controllers/AbstractController.php';
require 'managers/MessageManager.php';

class MessageController extends AbstractController{
    private MessageManager $messageManager;
    
    public function __construct()
    {
        $this->manager = new MessageManager("arnauddeletre_Distorsion", "3306", "db.3wa.io","arnauddeletre","900979afbcfa4468bcb42cce8d75b844");
    }
    
    
    public function index()
    {
        $messages=$this->manager->getAllMessage();
        $this->render("index", ["messages"=>$messages]);
    }
    
    public function createMessage(array $message)
    {
        $newMessage = new Message($message['content']);
        $messages=$this->manager->insertMessage($newMessage);
        $this->render("create", ["messages"=>$messages]);
    }
    
    public function editMessage(array $message)
    {
        
    }
}


?>