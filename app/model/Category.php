<?php

class Category
{

    private $idCategory;
    private $nameCategory;
    private $description;
    private $pictureCategory;
    


    public function __construct($idCategory, $nameCategory, $pictureCategory, $description)
    {
        $this->idCategory = $idCategory;
        $this->nameCategory = $nameCategory;
        $this->description = $description;
        $this->pictureCategory = $pictureCategory;
    }

    public function getIdCategory()
    {
        return $this->idCategory;
    }
    public function setIdCategory($idCategory)
    {
        $this->idCategory = $idCategory;
    }
    public function getNameCategory()
    {
        return $this->nameCategory;
    }
    public function setNameCategory($nameCategory)
    {
        $this->nameCategory = $nameCategory;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function setDescription($description)
    {
        $this->description = $description;
    }
    public function getPictureCategory()
    {
        return $this->pictureCategory;
    }
    public function setPictureCategory($pictureCategory)
    {
        $this->pictureCategory = $pictureCategory;
    }
}
?>