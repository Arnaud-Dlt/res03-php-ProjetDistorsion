<?php

class Message {

    private ?int $id;
    private string $content;
    private int $roomId;
    private int $userId;
    

    public function __construct(string $content, int $roomId, int $userId)
    {
        $this->id = null;
        $this->content = $content;
        $this->roomId = $roomId;
        $this->userId = $userId;
    }

    // public getter
    public function getId() : ?int
    {
        return $this->id;
    }
    public function getContent() : string
    {
        return $this->content;
    }

    // public setter
    public function setId(int $id) : void
    {
        $this->id = $id;
    }
    public function setContent(string $content) : void
    {
        $this->content = $content;
    }
}

?>