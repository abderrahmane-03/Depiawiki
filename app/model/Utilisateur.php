<?php

class Utilisateur
{

    private $idUser;
    private $fullName;
    private $pictureUser;
    private $username;
    private $email;
    private $password;
    private $nameRole;


    public function __construct($idUser, $fullName, $pictureUser, $username, $email, $password, $nameRole)
    {
        $this->idUser = $idUser;
        $this->fullName = $fullName;
        $this->pictureUser = $pictureUser;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->nameRole = $nameRole;
    }

    public function getIdUser()
    {
        return $this->idUser;
    }
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    }
    public function getfullName()
    {
        return $this->fullName;
    }
    public function setfullName($fullName)
    {
        $this->fullName = $fullName;
    }
    public function getpictureUser()
    {
        return $this->pictureUser;
    }
    public function setpictureUser($pictureUser)
    {
        $this->pictureUser = $pictureUser;
    }
    public function getusername()
    {
        return $this->username;
    }
    public function setusername($username)
    {
        $this->username = $username;
    }
    public function getemail()
    {
        return $this->email;
    }
    public function setemail($email)
    {
        $this->email = $email;
    }
    public function getpassword()
    {
        return $this->password;
    }
    public function setpassword($password)
    {
        $this->password = $password;
    }
    public function getnameRole()
    {
        return $this->nameRole;
    }
    public function setnameRole($nameRole)
    {
        $this->nameRole = $nameRole;
    }
}
?>