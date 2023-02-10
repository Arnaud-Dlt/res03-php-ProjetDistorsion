<?php

class Room {

    private ?int $id;
    private string $name;
    private string $description;
    private string $categoryId;

    public function __construct(string $name, string $description, string $categoryId)
    {
        $this->id = null;
        $this->name = $name;
        $this->description = $description;
        $this->categoryId = $categoryId;
    }

    // public getter
    public function getId() : ?int
    {
        return $this->id;
    }
    public function getName() : string
    {
        return $this->name;
    }
    public function getDescription() : string
    {
        return $this->description;
    }
    public function getCategoryId() : int
    {
        return $this->categoryId;
    }

    // public setter
    public function setId(int $id) : void
    {
        $this->id = $id;
    }
    public function setName(string $name) : void
    {
        $this->name = $name;
    }
    public function setDescription(string $description) : void
    {
        $this->description = $description;
    }
    public function setCategoryId(string $categoryId) : void
    {
        $this->categoryId = $categoryId;
    }
}

?>