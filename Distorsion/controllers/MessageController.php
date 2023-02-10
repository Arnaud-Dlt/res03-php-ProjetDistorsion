<?php
require 'controllers/AbstractController.php';
require 'managers/MessageManager.php';

class MessageController extends AbstractController{
    private MessageManager $manager;
    
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
        $message = new Message($message['content']);
        $messages=$this->manager->insertMessage($message);
        $this->render("create", ["messages"=>$messages]);
    }
    
    public function editMessage(array $post)
    {
        
    }
}


?>