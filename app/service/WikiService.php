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
            $Title = $Wiki->getTitle();
            $content = $Wiki->getContent();
            $datecreated = $Wiki->getdatecreated();
            $archived = $Wiki->getArchived();
            $idcategory = $Wiki->getIdcategory();
            $idUser = $Wiki->getIdUser();


            $sql = "INSERT INTO Wiki (idWiki, Title, archived,datecreated,archived,idCategory,idUser) VALUES (:idWiki, :Title,:content ,:datecreated,:archived,:idCategory,:idUser)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':idWiki', $idWiki);
            $stmt->bindParam(':Title', $Title);
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':datecreated', $datecreated);
            $stmt->bindParam(':archived', $archived);
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

            $idWiki = $Wiki->getIdWiki();
            $Title = $Wiki->getTitle();
            $content = $Wiki->getContent();
            $datecreated = $Wiki->getdatecreated();
            $archived = $Wiki->getArchived();
            $idcategory = $Wiki->getIdcategory();
            $idUser = $Wiki->getIdUser();

            $sql = "UPDATE Wiki SET idWiki = :idWiki, Title = :Title,content=:content, datecreated = :datecreated, archived=:archived WHERE idWiki = :idWiki";
            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idWiki', $idWiki);
            $stmt->bindParam(':Title', $Title);
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':datecreated', $datecreated);
            $stmt->bindParam(':archived', $archived);
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

        $sql = "SELECT * FROM Wiki WHERE archived='0'";

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
    function countWiki()
    {
        $pdo = $this->connect();
        $query = $pdo->query("SELECT COUNT(idWiki) as wikicount FROM Wiki");
        $result = $query->fetch(PDO::FETCH_OBJ);
        return $result->wikicount;
    }
}

?>