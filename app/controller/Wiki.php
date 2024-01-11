<?php

require_once("../model/Wiki.php");
require_once("../service/WikiService.php");

$WikiService = new WikiService;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // if (isset($_POST['addWiki']) ) {
        
    //     $Title = $_POST['title'];
    //     $pictureWiki = $_FILES['Wikipic']["name"];
    //     $description = $_POST['description'];

    //     $Wiki = new Wiki($idWiki,$Title, $pictureWiki, $description);

    //     $WikiService->insert($Wiki);
    //     header("location:../view/adminWikis.php");
    //     exit();
    // } else 
    if (isset($_POST['archivedWiki'])) {
    $Wiki_ID = $_POST['archived_Wiki_ID'];
    $Wiki = new Wiki($Wiki_ID, '', '', '', '', '', ''); // Create a new Wiki object with the required attributes
    $WikiService->archived($Wiki);
    header("location:../view/adminWikis.php");
    exit();
}
    // elseif(isset($_POST["editWiki"])){
        
    //     $Wiki_ID= $_POST['id-edit'];
    //     $Title = $_POST['title'];
    //     $pictureWiki = $_FILES['Wikipic']["name"];
    //     $description = $_POST['description'];

    //     $Wiki = new Wiki($Wiki_ID,$Title, $pictureWiki, $description);
        
    //     $WikiService->edit($Wiki);
    
    //     header("location:../view/adminWikis.php");
    //     exit();
    // } 
}

$Wikis = $WikiService->display();



?>