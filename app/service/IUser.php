<?php

interface IUser {
    function insert(User $User);
    function edit(User $User);
    function delete($UserId);
    function display();
}
?>