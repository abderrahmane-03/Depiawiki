<?php

class Categorie
{

    private $idCategory;
    private $nameCategory;
    private $description;
    private $pictureCategory;
    


    public function __construct($idCategory, $nameCategory, $description, $pictureCategory)
    {
        $this->idCategory = $idCategory;
        $this->nameCategory = $nameCategory;
        $this->description = $description;
        $this->pictureCategory = $pictureCategory;
    }

    public function getidCategory()
    {
        return $this->idCategory;
    }
    public function setidCategory($idCategory)
    {
        $this->idCategory = $idCategory;
    }
    public function getnameCategory()
    {
        return $this->nameCategory;
    }
    public function setnameCategory($nameCategory)
    {
        $this->nameCategory = $nameCategory;
    }
    public function getdescription()
    {
        return $this->description;
    }
    public function setdescription($description)
    {
        $this->description = $description;
    }
    public function getpictureCategory()
    {
        return $this->pictureCategory;
    }
    public function setpictureCategory($pictureCategory)
    {
        $this->pictureCategory = $pictureCategory;
    }
}
?>