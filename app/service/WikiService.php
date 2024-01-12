<?php
require_once("../libraries/Database.php");
require_once("IWiki.php");
require_once("../model/Wiki.php");


class WikiService extends Database implements IWiki
{

    function insert(Wiki $Wiki)
    {
        $pdo = $this->connect();
    
        try {
            $pdo->beginTransaction();
    
            $idWiki = $Wiki->getIdWiki();
            $title = $Wiki->getTitle();
            $wikipic = $Wiki->getWikipic(); // Corrected method name
            $content = $Wiki->getContent();
            $datecreated = $Wiki->getdatecreated();
            $idcategory = $Wiki->getIdcategory();
            $idUser = $Wiki->getIdUser();
    
            $sql = "INSERT INTO Wiki (idWiki, title, pictureWiki, content, datecreated, archived, idCategory, idUser) 
                    VALUES (:idWiki, :title, :wikipic, :content, :datecreated, '0', :idCategory, :idUser)";
    
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':idWiki', $idWiki);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':wikipic', $wikipic); // Bind $wikipic
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':datecreated', $datecreated);
            $stmt->bindParam(':idCategory', $idcategory);
            $stmt->bindParam(':idUser', $idUser);
    
            $stmt->execute();
            $pdo->commit();
        } catch (PDOException $e) {
            $pdo->rollBack();
            die("Error: " . $e->getMessage());
        }
    }
    
    
    function edit(Wiki $Wiki)
    {
        $pdo = $this->connect();

        try {
            $pdo->beginTransaction();

            $wiki_ID = $Wiki->getIdWiki();
            $title = $Wiki->getTitle();
            $wikipic = $Wiki->getWikipic(); // Corrected method name
            $content = $Wiki->getContent();
            $datecreated = $Wiki->getdatecreated();
            $idcategory = $Wiki->getIdcategory();
            $idUser = $Wiki->getIdUser();

            $sql = "UPDATE Wiki SET idWiki = :idWiki, title = :title, pictureWiki = :wikipic, content = :content, datecreated = :datecreated, archived = '0', idCategory = :idCategory, idUser = :idUser WHERE idWiki = :idWiki";
 $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idWiki', $wiki_ID);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':wikipic', $wikipic); // Bind $wikipic
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':datecreated', $datecreated);
            $stmt->bindParam(':idCategory', $idcategory);
            $stmt->bindParam(':idUser', $idUser);
    

            $stmt->execute();

            $pdo->commit();
        } catch (PDOException $e) {
            $pdo->rollback();
            die("Error: " . $e->getMessage());
        }
    }
    function delete($WikiId)
    {
        $pdo = $this->connect();
        $sql = "DELETE FROM Wiki WHERE idWiki = :WikiId";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":WikiId", $WikiId, PDO::PARAM_INT);
        $stmt->execute();

    }
    function display()
    {
        $pdo = $this->connect();
    
        $sql = "SELECT Wiki.*, Category.nameCategory FROM Wiki
                LEFT JOIN Category ON Wiki.idCategory = Category.idCategory
                WHERE Wiki.archived='0'";
    
        $stmt = $pdo->prepare($sql);
    
        $stmt->execute();
        $Wikis = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $Wikis;
    }
    
    
    function displayonly(wiki $Wiki)
    {
        $pdo = $this->connect();
        $idUser = $Wiki->getIdUser();
        $sql = "SELECT Wiki.*, Category.nameCategory, GROUP_CONCAT(Tag.nameTag) AS tagNames
        FROM Wiki
        LEFT JOIN Category ON Wiki.idCategory = Category.idCategory
        LEFT JOIN Tagsofwiki ON Wiki.idWiki = Tagsofwiki.idWiki
        LEFT JOIN Tag ON Tagsofwiki.idTag = Tag.idTag
        WHERE Wiki.archived='0' AND Wiki.idUser=:idUser
        GROUP BY Wiki.idWiki";


        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':idUser', $idUser);
        $stmt->execute();
        $Wiki = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $Wiki;

    }
    
    function displayarchive()
    {
        $pdo = $this->connect();

        $sql = "SELECT * FROM Wiki WHERE archived='1'";

        $stmt = $pdo->prepare($sql);

        $stmt->execute();
        $Wiki = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $Wiki;

    }
    function archived(Wiki $Wiki)
    {
        $pdo = $this->connect();
        $idWiki = $Wiki->getIdWiki();
        $sql = "UPDATE Wiki SET archived = '1' WHERE idWiki = :idWiki";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':idWiki', $idWiki);
        $stmt->execute();
    }
    function unarchived(Wiki $Wiki)
    {
        $pdo = $this->connect();
        $idWiki = $Wiki->getIdWiki();
        $sql = "UPDATE Wiki SET archived = '0' WHERE idWiki = :idWiki";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':idWiki', $idWiki);
        $stmt->execute();
    }
    function countWiki()
    {
        $pdo = $this->connect();
        $query = $pdo->query("SELECT COUNT(idWiki) as wikicount FROM Wiki");
        $result = $query->fetch(PDO::FETCH_OBJ);
        return $result->wikicount;
    }
}

?>