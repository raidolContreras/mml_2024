<?php 

include "conection.php";

class FormsModel {
    static public function mdlGetUsers($email) {
        $pdo = Conexion::conectar();
        if ($email !== null) {
            $sql = "SELECT * FROM users WHERE email = :email";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch();

        } else {
            $sql = "SELECT * FROM users";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll();
        }

        $stmt->closeCursor();
        $stmt = null;
        return $result;
    }

    static public function mdlChangeLanguage($language, $idUser){
        $pdo = Conexion::conectar();
        $sql = "UPDATE users SET language = :language WHERE idUser = :idUser";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':language', $language, PDO::PARAM_STR);
        $stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return 'ok';
        } else {
            return 'error';
        }
        $stmt->closeCursor();
        $stmt = null;
    }

}