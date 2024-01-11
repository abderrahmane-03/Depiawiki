<?php

require_once("../model/Category.php");
require_once("../service/CategoryService.php");

$categoryService = new CategoryService;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    if (isset($_POST['addCategory']) ) {
        
        $Title = $_POST['title'];
        $pictureCategory = $_FILES['categorypic']["name"];
        $description = $_POST['description'];

        $category = new category($idCategory,$Title, $pictureCategory, $description);

        $categoryService->insert($category);
        header("location:../view/adminCategory.php");
        exit();
    } else if (isset($_POST['deletecategory'])) {
        
         $category_ID = $_POST['delete_category_ID'];
         $categoryService->delete($category_ID);
         header("location:../view/adminCategory.php");
        exit();
    }
    elseif(isset($_POST["editCategory"])){
        
        $Category_ID= $_POST['id-edit'];
        $Title = $_POST['title'];
        $pictureCategory = $_FILES['categorypic']["name"];
        $description = $_POST['description'];

        $category = new category($Category_ID,$Title, $pictureCategory, $description);
        
        $categoryService->edit($category);
    
        header("location:../view/adminCategory.php");
        exit();
    } 
}

$categorys = $categoryService->display();



?>