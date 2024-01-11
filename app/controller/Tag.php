<?php

require_once("../model/Tag.php");
require_once("../service/TagService.php");

$TagService = new TagService;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    if (isset($_POST['addTag']) ) {
        
        $tagName = $_POST['tagName'];
        

        $Tag = new Tag($idTag,$tagName);

        $TagService->insert($Tag);
        header("location:../view/adminTags.php");
        exit();
    } else if (isset($_POST['deleteTag'])) {
        
         $Tag_ID = $_POST['delete_Tag_ID'];
         $TagService->delete($Tag_ID);
         header("location:../view/adminTags.php");
        exit();
    }
    elseif(isset($_POST["editTag"])){
        
        $Tag_ID= $_POST['id-edit'];
        $tagName = $_POST['tagName'];
        

        $Tag = new Tag($Tag_ID,$tagName);
        
        $TagService->edit($Tag);
    
        header("location:../view/adminTags.php");
        exit();
    } 
}

$Tags = $TagService->display();



?>