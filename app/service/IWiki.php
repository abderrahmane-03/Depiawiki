<?php

interface IWiki {
    function insert(Wiki $Wiki);
    function edit(Wiki $Wiki);
    function delete($WikiId);
    function archived(Wiki $Wiki);
    function display();
    
    function countWiki();
}
?>