<?php

class Wiki {

   private $idWiki;
   private $title;
   private $content;
   private $datecreated;
   private $archived;
   private $idcategory;
   private $iduser;


   public function __construct($idWiki,$title,$content,$datecreated,$archived,$idcategory,$iduser) {
    $this->idWiki = $idWiki;
    $this->title = $title;
    $this->content = $content;
    $this->datecreated = $datecreated;
    $this->archived = $archived;
    $this->idcategory = $idcategory;
    $this->iduser = $iduser;
   }
   
   public function getIdWiki(){
    return $this->idWiki;
}
public function setIdWiki($idWiki){
    $this->idWiki = $idWiki;
}
public function getTitle(){
    return $this->title;
}
public function setTitle($title){
    $this->title = $title;
}   
public function getContent(){
    return $this->content;
}
public function setContent($content){
    $this->content = $content;
}
public function getdatecreated(){
    return $this->datecreated;
}
public function setdatecreated($datecreated){
    $this->datecreated = $datecreated;
}
public function getArchived(){
    return $this->archived;
}
public function setArchived($archived){
    $this->archived = $archived;
}
public function getIdcategory(){
    return $this->idcategory;
}
public function setIdcategory($idcategory){
    $this->idcategory = $idcategory;
}
public function getIduser(){
    return $this->iduser;
}
public function setIduser($iduser){
    $this->iduser = $iduser;
}

}
?>