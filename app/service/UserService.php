<?php 
require_once("../libraries/Database.php");
require_once("IUser.php");
require_once("../model/User.php");


class UserService extends Database implements IUser {
    function isEmailTaken($email) {
        $pdo = $this->connect();

        $sql = "SELECT COUNT(*) FROM utilisateur WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        return $stmt->fetchColumn() > 0;
    }

    function isUsernameTaken($username) {
        $pdo = $this->connect();

        $sql = "SELECT COUNT(*) FROM utilisateur WHERE Username = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        return $stmt->fetchColumn() > 0;
    }
    function validateLogin($username, $password) {
        $pdo = $this->connect();

        $sql = "SELECT * FROM utilisateur WHERE username = :username ";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            
            return $user; 
        }

        return false;
    }
    function insert(User $User){
        $pdo = $this->connect();
    
        try {
            $pdo->beginTransaction();
    
            $idUser = $User->getIdUser();
            $Username = $User->getUsername();
            $email = $User->getemail();
            $password = $User->getpassword();
    
            $sql = "INSERT INTO utilisateur (idUser, Username, email,password,nameRole) VALUES (:idUser, :Username,:email ,:password,'author')";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':idUser', $idUser);
            $stmt->bindParam(':Username', $Username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
    
            $stmt->execute();
            $pdo->commit();
        } catch (PDOException $e) {
            $pdo->rollBack();
            die("Error: " . $e->getMessage());
        }
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