<?php

interface IWiki {
    function insert(Wiki $Wiki,$selectedTagIds);
    function edit(Wiki $Wiki);
    function delete($WikiId);
    function archived(Wiki $Wiki);
    function displaylatest();
    function unarchived(Wiki $Wiki);
    function display();
    function displayonly(Wiki $Wiki);
    function displayarchive();
    
    function countWiki();
}
?>