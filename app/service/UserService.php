<?php 
require_once("../libraries/Database.php");
require_once("IUser.php");
require_once("../model/User.php");


class UserService extends Database implements IUser {
    
    function insert(User $User){
        $pdo = $this->connect();
    
        try {
            $pdo->beginTransaction();
    
            $idUser = $User->getIdUser();
            $Username = $User->getUsername();
            $email = $User->getemail();
            $password = $User->getpassword();
            $nameRole = $User->getnameRole();
    
            $sql = "INSERT INTO utilisateur (idUser, Username, nameRole,password,nameRole) VALUES (:idUser, :Username,:email ,:password,:nameRole)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':idUser', $idUser);
            $stmt->bindParam(':Username', $Username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':nameRole', $nameRole);
    
            $stmt->execute();
            $pdo->commit();
        } catch (PDOException $e) {
            $pdo->rollBack();
            die("Error: " . $e->getMessage());
        }
    }
    function edit(User $User){
        $pdo = $this->connect();
    
        try {
            $pdo->beginTransaction();

            $idUser = $User->getIdUser();
            $Username = $User->getUsername();
            $email = $User->getemail();
            $password = $User->getpassword();
            $nameRole = $User->getnameRole();
    
            $sql = "UPDATE Utilisateur SET idUser = :idUser, Username = :Username,email=:email, password = :password, nameRole=:nameRole WHERE idUser = :idUser";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
            $stmt->bindParam(':Username', $Username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':nameRole', $nameRole);
    
            $stmt->execute();
    
            $pdo->commit();
        } catch (PDOException $e){
            $pdo->rollback();
            die("Error: " . $e->getMessage());
        }
    }
    function delete($UserId){
        $pdo = $this->connect();
    $sql = "DELETE FROM Utilisateur WHERE idUser = :UserId";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":UserId",$UserId, PDO::PARAM_INT);
            $stmt->execute();
        
    }
    function display(){
        $pdo = $this->connect();
         
        $sql = "SELECT * FROM Utilisateur";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $User = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $User;
    
}
public function countauthor(){
    $pdo = $this->connect();
    $query = $pdo->query("SELECT COUNT(idUser) as authorCount FROM utilisateur WHERE nameRole='author'");
    $result = $query->fetch(PDO::FETCH_OBJ);
    return $result->authorCount;
}
}

?>