<?php 
require_once(__DIR__."/../libraries/Database.php");
require_once("ITag.php");
require_once(__DIR__."/../model/Tag.php");


class TagService extends Database implements ITag {
   
    function insert(Tag $Tag){
        $pdo = $this->connect();
    
        try {
            $pdo->beginTransaction();
    
            $idTag = $Tag->getIdTag();
            $nameTag = $Tag->getNameTag();
    
            $sql = "INSERT INTO Tag (idTag, nameTag) VALUES (:idTag, :nameTag)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':idTag', $idTag);
            $stmt->bindParam(':nameTag', $nameTag);
    
            $stmt->execute();
            $pdo->commit();
        } catch (PDOException $e) {
            $pdo->rollBack();
            die("Error: " . $e->getMessage());
        }
    }
    function edit(Tag $Tag){
        $pdo = $this->connect();
    
        try {
            $pdo->beginTransaction();
    
            $idTag = $Tag->getIdTag();
            $nameTag = $Tag->getNameTag();
    
            $sql = "UPDATE Tag SET idTag = :idTag, nameTag = :nameTag WHERE idTag = :idTag";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':idTag', $idTag, PDO::PARAM_INT);
            $stmt->bindParam(':nameTag', $nameTag);
    
            $stmt->execute();
    
            $pdo->commit();
        } catch (PDOException $e){
            $pdo->rollback();
            die("Error: " . $e->getMessage());
        }
    }
    function delete($TagId){
        $pdo = $this->connect();
    $sql = "DELETE FROM Tag WHERE idTag = :TagId";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":TagId",$TagId, PDO::PARAM_INT);
            $stmt->execute();
        
    }
    function display(){
        $pdo = $this->connect();
         
        $sql = "SELECT * FROM Tag";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $Tag = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $Tag;
    
}
 
 function getTagsForWiki($wikiId) {
    $pdo = $this->connect();

    $sql = "SELECT t.* FROM tag t
            JOIN tagsofwiki tw ON t.idTag = tw.idTag
            WHERE tw.idWiki = :wikiId";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':wikiId', $wikiId, PDO::PARAM_INT);

    $stmt->execute();
    $tags = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $tags;
}
public function countTag(){
    $pdo = $this->connect();
$query=$pdo->query("SELECT COUNT(idTag) as Tagcount FROM tag");
$result= $query->fetch(PDO::FETCH_OBJ);
return $result->Tagcount;
}


function associateTagWithWiki( $tagId,$wikiId){
    $pdo = $this->connect();

    try {
        $pdo->beginTransaction();

        $sql = "INSERT INTO Tagsofwiki (idTag, idWiki) VALUES (:tagId, :wikiId)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':tagId', $tagId, PDO::PARAM_INT);
        $stmt->bindParam(':wikiId', $wikiId, PDO::PARAM_INT);

        $stmt->execute();
        
        $pdo->commit();
    } catch (PDOException $e) {
        $pdo->rollBack();
        die("Error: " . $e->getMessage());
    }
}
}




?>