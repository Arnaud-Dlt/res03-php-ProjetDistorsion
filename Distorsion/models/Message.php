<?php

class Message {

    private ?int $id;
    private string $content;

    public function __construct(string $content)
    {
        $this->id = null;
        $this->content = $content;
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