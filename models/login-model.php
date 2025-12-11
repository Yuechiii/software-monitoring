<?php

class LoginModel extends Connector
{

    //Connect to hrms database and get the user info
    public function validateCredentials($username, $password)
    {
        $stmt = $this->conn->prepare("SELECT * FROM credentials WHERE username = :username AND password = :password");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}



?>