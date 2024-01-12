<?php
require_once(__DIR__."/../libraries/Database.php");
require_once("IWiki.php");
require_once(__DIR__."/../model/Wiki.php");

require_once(__DIR__."/../model/Tag.php");

require_once(__DIR__."/../service/TagService.php");




class WikiService extends Database implements IWiki
{
    public function insert(Wiki $Wiki, $selectedTagIds) {
        $pdo = $this->connect();

        try {
            $pdo->beginTransaction();

            // Insert a new wiki
            $sql = "INSERT INTO Wiki (title, content, pictureWiki, dateCreated, archived, idCategory, idUser) 
                    VALUES (:title, :content, :pictureWiki, NOW(), '0', :idCategory, :idUser)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':title', $Wiki->getTitle());
            $stmt->bindValue(':content', $Wiki->getContent());
            $stmt->bindValue(':pictureWiki', $Wiki->getWikipic());
            $stmt->bindValue(':idCategory', $Wiki->getIdCategory());
            $stmt->bindValue(':idUser', $Wiki->getIdUser());
            $stmt->execute();

            // Get the ID of the newly added wiki
            $newWikiId = $pdo->lastInsertId();

            // Associate tags with the new wiki
            // $this->associateTagWithWiki($newWikiId, $selectedTagIds);

            $pdo->commit();

            return $newWikiId; // Return the ID of the newly added wiki
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

            $sql = "UPDATE Wiki SET idWiki = :idWiki, title = :title, pictureWiki = :wikipic, content = :content, archived = '0' WHERE idWiki = :idWiki";
            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idWiki', $wiki_ID);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':wikipic', $wikipic); // Bind $wikipic
            $stmt->bindParam(':content', $content);

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

        $sql = "SELECT Wiki.*, Category.nameCategory,utilisateur.username, GROUP_CONCAT(Tag.nameTag) AS tagNames
        FROM Wiki
        LEFT JOIN Category ON Wiki.idCategory = Category.idCategory
        LEFT JOIN Tagsofwiki ON Wiki.idWiki = Tagsofwiki.idWiki
        LEFT JOIN Tag ON Tagsofwiki.idTag = Tag.idTag
        LEFT JOIN utilisateur ON wiki.iduser = utilisateur.iduser
        WHERE Wiki.archived='0'
        GROUP BY Wiki.idWiki";
        $stmt = $pdo->prepare($sql);

        $stmt->execute();
        $Wikis = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $Wikis;
    }
    function displaylatest()
    {
        $pdo = $this->connect();

        $sql = "SELECT Wiki.*, Category.nameCategory, utilisateur.username, GROUP_CONCAT(Tag.nameTag) AS tagNames
        FROM Wiki
        LEFT JOIN Category ON Wiki.idCategory = Category.idCategory
        LEFT JOIN Tagsofwiki ON Wiki.idWiki = Tagsofwiki.idWiki
        LEFT JOIN Tag ON Tagsofwiki.idTag = Tag.idTag
        LEFT JOIN utilisateur ON Wiki.iduser = utilisateur.iduser
        WHERE Wiki.archived='0'
        GROUP BY Wiki.idWiki
        ORDER BY Wiki.idWiki DESC LIMIT 3";

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