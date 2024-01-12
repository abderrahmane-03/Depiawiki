<?php

interface IUser {
    function insert(User $User);
    function display();
    function isEmailTaken($email);
    function isUsernameTaken($username);
    function validateLogin($username, $password);
    function countauthor();
}
?>