<?php

class User
{

    private $idUser;
    private $username;
    private $email;
    private $password;
    private $nameRole;


    public function __construct($idUser,  $username, $email, $password, $nameRole)
    {
        $this->idUser = $idUser;
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

    public function getUsername()
    {
        return $this->username;
    }
    public function setUsername($username)
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