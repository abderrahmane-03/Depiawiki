<?php 
require_once("../libraries/Database.php");
require_once("ICategory.php");
require_once("../model/Category.php");


class CategoryService extends Database implements ICategory {
    
    function insert(Category $Category){
        $pdo = $this->connect();
    
        try {
            $pdo->beginTransaction();
    
            $idCategory = $Category->getIdCategory();
            $nameCategory = $Category->getNameCategory();
            $description = $Category->getDescription();
            $PictureCategory = $Category->getPictureCategory();
    
            $sql = "INSERT INTO Category (idCategory, nameCategory, description, pictureCategory) VALUES (:idCategory, :nameCategory,:description, :PictureCategory)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':idCategory', $idCategory);
            $stmt->bindParam(':nameCategory', $nameCategory);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':PictureCategory', $PictureCategory);
    
            $stmt->execute();
            $pdo->commit();
        } catch (PDOException $e) {
            $pdo->rollBack();
            die("Error: " . $e->getMessage());
        }
    }
    function edit(Category $Category){
        $pdo = $this->connect();
    
        try {
            $pdo->beginTransaction();
    
            $idCategory = $Category->getIdCategory();
            $nameCategory = $Category->getNameCategory();
            $description = $Category->getDescription();
            $PictureCategory = $Category->getPictureCategory();
    
            $sql = "UPDATE Category SET idCategory = :idCategory, nameCategory = :nameCategory, description= :description, PictureCategory = :PictureCategory WHERE idCategory = :idCategory";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':idCategory', $idCategory);
            $stmt->bindParam(':nameCategory', $nameCategory);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':PictureCategory', $PictureCategory);
    
            $stmt->execute();
    
            $pdo->commit();
        } catch (PDOException $e){
            $pdo->rollback();
            die("Error: " . $e->getMessage());
        }
    }
    function delete($CategoryId){
        $pdo = $this->connect();
    $sql = "DELETE FROM category WHERE idCategory = :CategoryId";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":CategoryId",$CategoryId, PDO::PARAM_INT);
            $stmt->execute();
        
    }
    function display(){
        $pdo = $this->connect();
         
        $sql = "SELECT * FROM Category";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $Category = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $Category;
    
}
public function countCategory(){
    $pdo = $this->connect();
$query=$pdo->query("SELECT COUNT(idCategory) as Categorycount FROM Category");
$result= $query->fetch(PDO::FETCH_OBJ);
return $result->Categorycount;
}
}

?>