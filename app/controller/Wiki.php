<?php

require_once("../model/Wiki.php");
require_once("../service/WikiService.php");

require_once("../service/TagService.php");
session_start();
$WikiService = new WikiService;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['addWiki'])) {

            $Title = $_POST['title'];
            $pictureWiki = $_FILES['Wikipic']["name"];
            $Content = $_POST['content'];
            $Category_id = $_POST['Category_Id'];
            $user_id = $_SESSION['user_id'];
        
            $Wiki = new Wiki();
            $Wiki->setTitle($Title);
            $Wiki->setwikipic($pictureWiki);
            $Wiki->setContent($Content);
            $Wiki->setIdcategory($Category_id);
            $Wiki->setIduser($user_id);
        
            
            $wikiId = $WikiService->insert($Wiki);
            
            $selectedTags = isset($_POST['tag']) ? $_POST['tag'] : [];
        
            if (!empty($selectedTags) && !empty($wikiId)) {
                $TagService = new TagService();
                foreach ($selectedTags as $tagId) {
                    $TagService->associateTagWithWiki($tagId, $wikiId);
                }
            }
        
            header("location:../view/authorWikis.php");
            exit();
        }
         elseif (isset($_POST['archivedWiki'])) {
        $Wiki_ID = $_POST['archived_Wiki_ID'];
        $Wiki = new Wiki();
        $WikiService->archived($Wiki);
        header("location:../view/adminWikis.php");
        exit();
    }
    elseif (isset($_POST['unarchiveWiki'])) {
        $Wiki_ID = $_POST['unarchive_Wiki_ID'];
        $Wiki = new Wiki();
        $WikiService->unarchived($Wiki);
        header("location:../view/archivedWikis.php");
        exit();
    } elseif (isset($_POST["editWiki"])) {
        $wiki_ID= $_POST['id-edit'];
        $Title = $_POST['title'];
        $pictureWiki = $_FILES['Wikipic']["name"];
        $Content = $_POST['content'];
        $Category_id = $_POST['Category_Id'];
        $user_id = $_SESSION['user_id'];

        $Wiki = new Wiki();
        $Wiki->setIdWiki($wiki_ID);
        $Wiki->setTitle($Title);
        $Wiki->setwikipic($pictureWiki);
        $Wiki->setContent($Content);
        $Wiki->setIdcategory($Category_id);
        $Wiki->setIduser($user_id);

        $WikiService->edit($Wiki);

        header("location:../view/authorWikis.php");
        exit();
    }
    elseif (isset($_POST['deletewiki'])) {
        
        $wiki_ID = $_POST['delete_Wiki_ID'];
        $WikiService->delete($wiki_ID);
        header("location:../view/authorWikis.php");
       exit();
   }
}

$Wikis = $WikiService->display();



?>