<?php

class Tag
{

    private $idtag; 
    private $Nametag;


    public function __construct($idtag, $Nametag)
    {
        $this->idtag = $idtag;
        $this->Nametag = $Nametag;
        
    }

    public function getIdtag()
    {
        return $this->idtag;
    }
    public function setIdtag($idtag)
    {
        $this->idtag = $idtag;
    }
    public function getNametag()
    {
        return $this->Nametag;
    }
    public function setNametag($Nametag)
    {
        $this->Nametag = $Nametag;
    }
}
?>