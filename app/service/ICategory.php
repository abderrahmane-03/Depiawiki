<?php

interface ICategory {
    function insert(Category $Category);
    function edit(Category $Category);
    function delete($CategoryId);
    function display();
    function countcategory();
}
?>