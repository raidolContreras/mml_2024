<?php 

include "conection.php";

class FormsModel {
    static public function mdlGetUsers($item, $value) {
        $pdo = Conexion::conectar();
        if ($value !== null && $item !== 'idUser') {
            $sql = "SELECT * FROM users WHERE $item = :value";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':value', $value, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch();
        } elseif ($item === 'idUser') {
            $sql = "SELECT u.firstname, u.lastname, u.email, u.level, u.users_idProjects, u.idUser, u.users_idTeam FROM users u
                    where u.status = 1 AND u.idUser = :value;";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':value', $value, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch();
        } else {
            $sql = "SELECT u.firstname, u.lastname, u.email, u.level, p.nameProject, u.idUser, t.teamName FROM users u
                    LEFT JOIN projects p ON p.idProject = u.users_idProjects
                    LEFT JOIN teams t ON t.idTeam = u.users_idTeam
                    where u.status = 1;";
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

    static public function mdlGetProject($item, $value){
        $pdo = Conexion::conectar();
        if ($value !== null) {
            $sql = "SELECT * FROM projects WHERE $item = :value";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':value', $value, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch();
        } else {
            $sql = "SELECT * FROM projects where statusProject = 1";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
        }
        $stmt->closeCursor();
        $stmt = null;
        return $result;
    }

    static public function mdlGetTeams($item, $value){
        $pdo = Conexion::conectar();
        if ($value !== null) {
            $sql = "SELECT * FROM teams WHERE $item = :value";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':value', $value, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch();
        } else {
            $sql = "SELECT * FROM teams t
                    LEFT JOIN projects p ON p.idProject = t.teams_idProject
                    where t.status = 1";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
        }
        $stmt->closeCursor();
        $stmt = null;
        return $result;
    }

    static public function mdlGetEvents($item, $value){
        $pdo = Conexion::conectar();
        if ($value !== null) {
            $sql = "SELECT * FROM events WHERE $item = :value";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':value', $value, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch();
        } else {
            $sql = "SELECT * FROM events";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
        }
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
            if($data['description'] == '' && $data['school'] == '') {
                $result = $pdo->lastInsertId();
            } else {
                $result = 'ok';
            }
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
    
	static public function mdlAddLogo($data){
		$pdo = Conexion::conectar();
		$sql = "UPDATE projects SET logoProject = :logo WHERE idProject = :idProject";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':logo', $data['logo'], PDO::PARAM_STR);
		$stmt->bindParam(':idProject', $data['idProject'], PDO::PARAM_INT);
		if($stmt->execute()){
			return "ok";
		} else {
			print_r($pdo->errorInfo());
		}
		$stmt->closeCursor();
		$stmt = null;
	}

    static public function mdlAddEvent($eventName){
        $pdo = Conexion::conectar();
        $sql = "INSERT INTO events (eventName) VALUES (:eventName)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':eventName', $eventName, PDO::PARAM_STR);
        if ($stmt->execute()) {
            $result = 'ok';
        } else {
            $result = 'error';
        }
        $stmt->closeCursor();
        $stmt = null;
        return $result;
    }

    static public function mdlAddUser($data){
        $pdo = Conexion::conectar();
        $sql = "INSERT INTO users (firstname, lastname, email, password, users_idProjects, users_idTeam, level) VALUES (:firstname, :lastname, :email, :password, :users_idProjects, :users_idTeam, :level)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':firstname', $data['firstname'], PDO::PARAM_STR);
        $stmt->bindParam(':lastname', $data['lastname'], PDO::PARAM_STR);
        $stmt->bindParam(':email', $data['email'], PDO::PARAM_STR);
        $stmt->bindParam(':password', $data['cryptPassword'], PDO::PARAM_STR);
        $stmt->bindParam(':users_idProjects', $data['users_idProjects'], PDO::PARAM_INT);
        $stmt->bindParam(':users_idTeam', $data['users_idTeam'], PDO::PARAM_INT);
        $stmt->bindParam(':level', $data['level'], PDO::PARAM_INT);
        if ($stmt->execute()) {
            $result = 'ok';
        } else {
            $result = 'error';
        }
        $stmt->closeCursor();
        $stmt = null;
        return $result;
    }

    static public function mdlUpdateUser($data, $idUser){
        $pdo = Conexion::conectar();
        $sql = "UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email, users_idProjects = :users_idProjects, users_idTeam = :users_idTeam, level = :level WHERE idUser = :idUser";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':firstname', $data['firstname'], PDO::PARAM_STR);
        $stmt->bindParam(':lastname', $data['lastname'], PDO::PARAM_STR);
        $stmt->bindParam(':email', $data['email'], PDO::PARAM_STR);
        $stmt->bindParam(':users_idProjects', $data['users_idProjects'], PDO::PARAM_INT);
        $stmt->bindParam(':users_idTeam', $data['users_idTeam'], PDO::PARAM_INT);
        $stmt->bindParam(':level', $data['level'], PDO::PARAM_INT);
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

    static public function mdlDeleteUser($item, $value){
        $pdo = Conexion::conectar();
        $sql = "DELETE FROM users WHERE $item = :value";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':value', $value, PDO::PARAM_STR);
        if ($stmt->execute()) {
            $result = 'ok';
        } else {
            $result = 'error';
        }
        $stmt->closeCursor();
        $stmt = null;
        return $result;
    }

    static public function mdlUpdateProject($data, $project) {
        $pdo = Conexion::conectar();
        $sql = "UPDATE projects SET nameProject = :nameProject, linkProject = :linkProject WHERE idProject = :idProject";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nameProject', $data['nameProject'], PDO::PARAM_STR);
        $stmt->bindParam(':linkProject', $data['linkProject'], PDO::PARAM_STR);
        $stmt->bindParam(':idProject', $project, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $result = 'ok';
        } else {
            $result = 'error';
        }
        $stmt->closeCursor();
        $stmt = null;
        return $result;
    }

    static public function mdlDeleteProject($idProject) {
        $pdo = Conexion::conectar();
        $sql = "DELETE FROM projects WHERE idProject = :idProject";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':idProject', $idProject, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $result = 'ok';
        } else {
            $result = 'error';
        }
        $stmt->closeCursor();
        $stmt = null;
        return $result;
    }

    static public function mdlUpdateTeam($data, $idTeam) {
        $pdo = Conexion::conectar();
        $sql = "UPDATE teams SET teamName = :teamName, teamDescription = :teamDescription, teamSchool = :teamSchool, teams_idProject = :teams_idProject WHERE idTeam = :idTeam";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':teamName', $data['teamName'], PDO::PARAM_STR);
        $stmt->bindParam(':teamDescription', $data['teamDescription'], PDO::PARAM_STR);
        $stmt->bindParam(':teamSchool', $data['teamSchool'], PDO::PARAM_STR);
        $stmt->bindParam(':teams_idProject', $data['teams_idProject'], PDO::PARAM_INT);
        $stmt->bindParam(':idTeam', $idTeam, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $result = 'ok';
        } else {
            $result = 'error';
        }
        $stmt->closeCursor();
        $stmt = null;
        return $result;
    }

    static public function mdlDeleteTeam($idTeam) {
        $pdo = Conexion::conectar();
        $sql = "DELETE FROM teams WHERE idTeam = :idTeam";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':idTeam', $idTeam, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $result = 'ok';
        } else {
            $result = 'error';
        }
        $stmt->closeCursor();
        $stmt = null;
        return $result;
    }

    static public function mdlUpdateEvent($eventName, $idEvent){
        $pdo = Conexion::conectar();
        $sql = "UPDATE events SET eventName = :eventName WHERE idEvent = :idEvent";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':eventName', $eventName, PDO::PARAM_STR);
        $stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $result = 'ok';
        } else {
            $result = 'error';
        }
        $stmt->closeCursor();
        $stmt = null;
        return $result;
    }

    static public function mdlDeleteEvent($idEvent) {
        $pdo = Conexion::conectar();
        $sql = "DELETE FROM events WHERE idEvent = :idEvent";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $result = 'ok';
        } else {
            $result = 'error';
        }
        $stmt->closeCursor();
        $stmt = null;
        return $result;
    }

}