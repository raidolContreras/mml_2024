<?php 

include "conection.php";

class FormsModel {
    static public function mdlGetUsers($item, $value) {
        $pdo = Conexion::conectar();
        if ($value !== null) {
            $sql = "SELECT * FROM users WHERE $item = :value";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':value', $value, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch();
        } else {
            $sql = "SELECT * FROM users";
            $stmt = $pdo->prepare($sql);
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
            $result = 'ok';
        } else {
            $result = 'error';
        }
        $stmt->closeCursor();
        $stmt = null;
        return $result;
    }

    static public function mdlGetProject(){
        $pdo = Conexion::conectar();
        $sql = "SELECT * FROM projects where statusProject = 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $stmt->closeCursor();
        $stmt = null;
        return $result;
    }

    static public function mdlGetTeams(){
        $pdo = Conexion::conectar();
        $sql = "SELECT * FROM teams where status = 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $stmt->closeCursor();
        $stmt = null;
        return $result;
    }

    static public function mdlGetEvents(){
        $pdo = Conexion::conectar();
        $sql = "SELECT * FROM events";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $stmt->closeCursor();
        $stmt = null;
        return $result;
    }

    static public function mdlAddTeam($data){
        $pdo = Conexion::conectar();
        $sql = "INSERT INTO teams (teamName, teamDescription, teamSchool) VALUES (:teamName, :description, :school)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':teamName', $data['teamName'], PDO::PARAM_STR);
        $stmt->bindParam(':description', $data['description'], PDO::PARAM_STR);
        $stmt->bindParam(':school', $data['school'], PDO::PARAM_STR);
        if ($stmt->execute()) {
            $result = 'ok';
        } else {
            $result = 'error';
        }
        $stmt->closeCursor();
        $stmt = null;
        return $result;
    }

    static public function mdlAddProject($data){
        $pdo = Conexion::conectar();
        $sql = "INSERT INTO projects (nameProject, linkProject) VALUES (:nameProject, :linkProject)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nameProject', $data['projectName'], PDO::PARAM_STR);
        $stmt->bindParam(':linkProject', $data['projectLink'], PDO::PARAM_STR);
        if ($stmt->execute()) {
            $result = $pdo->lastInsertId();
        } else {
            $result = 'error';
        }
        $stmt->closeCursor();
        $stmt = null;
        return $result;
    }

}