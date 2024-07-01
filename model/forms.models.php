<?php 

include "conection.php";

class FormsModel {
    static public function mdlGetUsers($item, $value) {
        $pdo = Conexion::conectar();
        if ($value !== null && $item !== 'idUser') {
            $sql = "SELECT * FROM users u
                        LEFT JOIN users_active_projects up ON up.idUser = u.idUser
                    WHERE $item = :value";
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

    public static function mdlLoginParticipant($email) {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM participants WHERE emailParticipant = :email");
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch();
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

    static public function mdlChangeLanguageParticipant($language, $idUser){
        $pdo = Conexion::conectar();
        $sql = "UPDATE participants SET language = :language WHERE idparticipant = :idUser";
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
            if($item != 'idProject') {
                $sql = "SELECT * FROM projects p LEFT JOIN colorsProject c ON c.project_idProject = p.idProject WHERE $item = :value";
            } else {
                $sql = "SELECT * FROM users_active_projects up
                            LEFT JOIN projects p ON p.idProject = up.idProject
                            LEFT JOIN colorsProject c ON c.project_idProject = p.idProject
                        where up.$item = :value AND p.statusProject = 1;";
            }
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':value', $value, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch();
        } else {
            $sql = "SELECT * FROM projects p
                    LEFT JOIN colorsProject c ON c.project_idProject = p.idProject
                    where p.statusProject = 1";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
        }
        $stmt->closeCursor();
        $stmt = null;
        return $result;
    }

    static public function mdlGetTeams($item, $value, $idProject){
        $pdo = Conexion::conectar();
        if ($value !== null && $idProject == null) {
            $sql = "SELECT * FROM teams t
                        LEFT JOIN projects p ON p.idProject = t.teams_idProject
                        LEFT JOIN users u ON u.users_idTeam = t.idTeam
                    WHERE t.$item = :value";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':value', $value, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch();
        } elseif($idProject !== null) {
            $sql = "SELECT * FROM teams t
                    LEFT JOIN projects p ON p.idProject = t.teams_idProject
                    where t.status = 1 AND t.teams_idProject = :idProject";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':idProject', $idProject, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll();
        } else {
            $sql = "SELECT * FROM teams t
                    LEFT JOIN projects p ON p.idProject = t.teams_idProject
                    where t.status = 1
                    ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
        }
        $stmt->closeCursor();
        $stmt = null;
        return $result;
    }

    static public function mdlGetPromedios($idProject) {
        $pdo = Conexion::conectar();
        $sql = "SELECT 
                        teamName, 
                        GREATEST(0, LEAST(100, (IFNULL(total_progress, 0) * 100.0 / IFNULL(total_goal, 1)))) AS progress_percentage,
                        IFNULL(total_progress, 0) AS total_progress,
                        IFNULL(total_goal, 0) AS total_goal
                    FROM 
                        (SELECT 
                            t.teamName, 
                            COALESCE(SUM(r.progress), 0) AS total_progress,
                            COALESCE(m.total_goal, 0) AS total_goal
                        FROM 
                            teams t
                        LEFT JOIN 
                            (SELECT 
                                s.idTeam, 
                                SUM(m.goal) AS total_goal
                            FROM 
                                structures s
                            LEFT JOIN 
                                matrix m ON m.idStructure = s.idStructure
                            GROUP BY 
                                s.idTeam) m ON m.idTeam = t.idTeam
                        LEFT JOIN 
                            structures s2 ON s2.idTeam = t.idTeam
                        LEFT JOIN 
                            matrix m2 ON m2.idStructure = s2.idStructure
                        LEFT JOIN 
                            reports r ON r.idMatrix = m2.idMatrix
                        WHERE t.teams_idProject = :idProject
                        GROUP BY 
                            t.teamName) subquery;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':idProject', $idProject, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll();
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

    // Método para obtener los archivos de un evento
    public static function mdlGetEventFiles($eventId, $idTeam) {
        if ($idTeam == 0) {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM event_to_team WHERE idEvent = :idEvent");
        } else {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM event_to_team WHERE idEvent = :idEvent AND idTeam = :teamId");
        }
        $stmt->bindParam(":idEvent", $eventId, PDO::PARAM_INT);
        $stmt->bindParam(":teamId", $idTeam, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $stmt->closeCursor();
        $stmt = null;
        return $result;
    }

    // Método para manejar la subida de archivos
    public static function mdlUploadEventFiles($eventId, $fileName, $fileType, $idTeam) {
        $stmt = Conexion::conectar()->prepare("INSERT INTO event_to_team (file, type, idEvent, idTeam) VALUES (:file, :type, :idEvent, :idTeam)");
        $stmt->bindParam(":file", $fileName, PDO::PARAM_STR);
        $stmt->bindParam(":type", $fileType, PDO::PARAM_STR);
        $stmt->bindParam(":idEvent", $eventId, PDO::PARAM_INT);
        $stmt->bindParam(":idTeam", $idTeam, PDO::PARAM_INT);
        $result = $stmt->execute();
        $stmt->closeCursor();
        $stmt = null;
        return $result;
    }

    public static function mdlDeleteEventFile($idEventToTeam) {
        $stmt = Conexion::conectar()->prepare("DELETE FROM event_to_team WHERE idEventToTeam = :idEventToTeam");
        $stmt->bindParam(":idEventToTeam", $idEventToTeam, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $result = "ok";
        } else {
            $result = "error";
        }
        $stmt->closeCursor();
        $stmt = null;
        return $result;
    }

    static public function mdlAddTeam($data){
        $teams_idProject = ($data['teams_idProject'] != '') ? $data['teams_idProject'] : NULL;
        $pdo = Conexion::conectar();
        $sql = "INSERT INTO teams (teamName, teamDescription, teamSchool, teams_idProject) VALUES (:teamName, :description, :school, :teams_idProject)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':teamName', $data['teamName'], PDO::PARAM_STR);
        $stmt->bindParam(':description', $data['description'], PDO::PARAM_STR);
        $stmt->bindParam(':school', $data['school'], PDO::PARAM_STR);
        $stmt->bindParam(':teams_idProject', $teams_idProject);
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
            FormsModel::mdlAddColorsProject($result);
        } else {
            $result = 'error';
        }
        $stmt->closeCursor();
        $stmt = null;
        return $result;
    }

    static public function mdlAddColorsProject($idProject){
        $pdo = Conexion::conectar();
        $sql = "INSERT INTO colorsProject (project_idProject) VALUES (:project_idProject)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':project_idProject', $idProject, PDO::PARAM_INT);
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
            $result = $pdo->lastInsertId();
        } else {
            $result = 'error';
        }
        $stmt->closeCursor();
        $stmt = null;
        return $result;
    }

    static public function mdlAddUserToProject($idUser){
        $pdo = Conexion::conectar();
        $sql = "INSERT INTO users_active_projects (idUser) VALUES (:idUser)";
        $stmt = $pdo->prepare($sql);
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
        $teams_idProject = ($data['teams_idProject'] != '') ? $data['teams_idProject'] : NULL;
        $pdo = Conexion::conectar();
        $sql = "UPDATE teams SET teamName = :teamName, teamDescription = :teamDescription, teamSchool = :teamSchool, teams_idProject = :teams_idProject WHERE idTeam = :idTeam";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':teamName', $data['teamName'], PDO::PARAM_STR);
        $stmt->bindParam(':teamDescription', $data['teamDescription'], PDO::PARAM_STR);
        $stmt->bindParam(':teamSchool', $data['teamSchool'], PDO::PARAM_STR);
        $stmt->bindParam(':teams_idProject', $teams_idProject);
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

    static public function mdlChangeProjectActive($idProject, $idUser){
        $pdo = Conexion::conectar();
        $sql = "UPDATE users_active_projects SET idProject = :idProject WHERE idUser = :idUser;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':idProject', $idProject, PDO::PARAM_INT);
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

    static public function mdlUpdateColors($data){
        $pdo = Conexion::conectar();
        $sql = "UPDATE colorsProject SET 
                    problem = :problem,
                    effect = :effect,
                    cause = :cause,
                    objetive = :objetive,
                    result = :result,
                    action = :action,
                    product = :product
                WHERE project_idProject = :project_idProject";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':problem', $data['problem'], PDO::PARAM_STR);
        $stmt->bindParam(':effect', $data['effect'], PDO::PARAM_STR);
        $stmt->bindParam(':cause', $data['cause'], PDO::PARAM_STR);
        $stmt->bindParam(':objetive', $data['objetive'], PDO::PARAM_STR);
        $stmt->bindParam(':result', $data['result'], PDO::PARAM_STR);
        $stmt->bindParam(':action', $data['action'], PDO::PARAM_STR);
        $stmt->bindParam(':product', $data['product'], PDO::PARAM_STR);
        $stmt->bindParam(':project_idProject', $data['project_idProject'], PDO::PARAM_INT);
        if ($stmt->execute()) {
            $result = 'ok';
        } else {
            $result = 'error';
        }
        $stmt->closeCursor();
        $stmt = null;
        return $result;
    }

    static public function mdlGetParticipant($item, $value) {
        $pdo = Conexion::conectar();
        $sql = "SELECT * FROM participants WHERE $item = :value";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':value', $value, PDO::PARAM_STR);
        $stmt->execute();
        if ($item == 'idparticipant') {
            $result = $stmt->fetch();
        } else {
            $result = $stmt->fetchAll();
        }
        $stmt->closeCursor();
        $stmt = null;
        return $result;
    }
    
    static public function mdlAddParticipants($data, $idTeam){
        $pdo = Conexion::conectar();
        try {
            $sql = "INSERT INTO participants(firstnameParticipant, lastnameParticipant, emailParticipant, password, idTeam) VALUES (:firstnameParticipant, :lastnameParticipant, :emailParticipant, :password, :idTeam)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':firstnameParticipant', $data['firstname'], PDO::PARAM_STR);
            $stmt->bindParam(':lastnameParticipant', $data['lastname'], PDO::PARAM_STR);
            $stmt->bindParam(':emailParticipant', $data['email'], PDO::PARAM_STR);
            $stmt->bindParam(':password', $data['cryptPassword'], PDO::PARAM_STR);
            $stmt->bindParam(':idTeam', $idTeam, PDO::PARAM_INT);
            
            if ($stmt->execute()) {
                $result = 'ok';
            } else {
                $result = 'error';
            }
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) { // Código de error para violación de unicidad
                $result = 'duplicate';
            } else {
                $result = 'error';
            }
        }
    
        if (isset($stmt)) {
            $stmt->closeCursor();
            $stmt = null;
        }
    
        return $result;
    }

    static public function mdlUpdateParticipant($data) {
        $pdo = Conexion::conectar();
        $sql = "UPDATE participants SET firstnameParticipant = :firstnameParticipant, lastnameParticipant = :lastnameParticipant, emailParticipant = :emailParticipant WHERE idparticipant = :idparticipant";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':firstnameParticipant', $data['firstname'], PDO::PARAM_STR);
        $stmt->bindParam(':lastnameParticipant', $data['lastname'], PDO::PARAM_STR);
        $stmt->bindParam(':emailParticipant', $data['email'], PDO::PARAM_STR);
        $stmt->bindParam(':idparticipant', $data['idparticipant'], PDO::PARAM_INT);
        if ($stmt->execute()) {
            $result = 'ok';
        } else {
            $result = 'error';
        }
        $stmt->closeCursor();
        $stmt = null;
        return $result;
    }

    static public function mdlUpdateTeamExtras($data) {
        $pdo = Conexion::conectar();
        $sql = "UPDATE teams SET teamState = :teamState, identifiedProblem = :identifiedProblem, mainObjective = :mainObjective WHERE idTeam = :idTeam";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':teamState', $data['teamState'], PDO::PARAM_STR);
        $stmt->bindParam(':identifiedProblem', $data['identifiedProblem'], PDO::PARAM_STR);
        $stmt->bindParam(':mainObjective', $data['mainObjective'], PDO::PARAM_STR);
        $stmt->bindParam(':idTeam', $data['idTeam'], PDO::PARAM_INT);
        if ($stmt->execute()) {
            $result = 'ok';
        } else {
            $result = 'error';
        }
        $stmt->closeCursor();
        $stmt = null;
        return $result;
    }

    static public function mdlDeleteParticipant($idParticipant) {
        $pdo = Conexion::conectar();
        $sql = "DELETE FROM participants WHERE idparticipant = :idparticipant";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':idparticipant', $idParticipant, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $result = 'ok';
        } else {
            $result = 'error';
        }
        $stmt->closeCursor();
        $stmt = null;
        return $result;
    }

    static public function mdlGetProblemTree($idTeam, $idProject) {
        $pdo = Conexion::conectar();
        $sql = "SELECT * FROM main_problems p
                    JOIN main_goals o ON o.idTeam = p.idTeam
                WHERE p.idTeam = :idTeam AND p.idProject = :idProject";
        $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':idTeam', $idTeam, PDO::PARAM_INT);
            $stmt->bindParam(':idProject', $idProject, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch();

        $stmt->closeCursor();
        $stmt = null;
        return $result;
    }

    static public function mdlAddMainProblem($data, $idTeam, $idProject) {
        $pdo = Conexion::conectar();
        $sql = "INSERT INTO main_problems(nameMain01, nameMain02, nameMain03, nameMain04, nameEffect01, nameEffect02, nameEffect03, nameEffect04, centralProblem, causes01, causes02, causes03, causes04, mainCauses01, mainCauses02, mainCauses03, mainCauses04, idTeam, idProject) VALUES (:nameMain01, :nameMain02, :nameMain03, :nameMain04, :nameEffect01, :nameEffect02, :nameEffect03, :nameEffect04, :centralProblem, :causes01, :causes02, :causes03, :causes04, :mainCauses01, :mainCauses02, :mainCauses03, :mainCauses04, :idTeam, :idProject)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nameMain01', $data['nameMain01'], PDO::PARAM_STR);
        $stmt->bindParam(':nameMain02', $data['nameMain02'], PDO::PARAM_STR);
        $stmt->bindParam(':nameMain03', $data['nameMain03'], PDO::PARAM_STR);
        $stmt->bindParam(':nameMain04', $data['nameMain04'], PDO::PARAM_STR);
        $stmt->bindParam(':nameEffect01', $data['nameEffect01'], PDO::PARAM_STR);
        $stmt->bindParam(':nameEffect02', $data['nameEffect02'], PDO::PARAM_STR);
        $stmt->bindParam(':nameEffect03', $data['nameEffect03'], PDO::PARAM_STR);
        $stmt->bindParam(':nameEffect04', $data['nameEffect04'], PDO::PARAM_STR);
        $stmt->bindParam(':centralProblem', $data['centralProblem'], PDO::PARAM_STR);
        $stmt->bindParam(':causes01', $data['causes01'], PDO::PARAM_STR);
        $stmt->bindParam(':causes02', $data['causes02'], PDO::PARAM_STR);
        $stmt->bindParam(':causes03', $data['causes03'], PDO::PARAM_STR);
        $stmt->bindParam(':causes04', $data['causes04'], PDO::PARAM_STR);
        $stmt->bindParam(':mainCauses01', $data['mainCauses01'], PDO::PARAM_STR);
        $stmt->bindParam(':mainCauses02', $data['mainCauses02'], PDO::PARAM_STR);
        $stmt->bindParam(':mainCauses03', $data['mainCauses03'], PDO::PARAM_STR);
        $stmt->bindParam(':mainCauses04', $data['mainCauses04'], PDO::PARAM_STR);
        $stmt->bindParam(':idTeam', $idTeam, PDO::PARAM_INT);
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

    static public function mdlAddMainObjetive($data, $idTeam, $idProject) {
        $pdo = Conexion::conectar();
        $sql = "INSERT INTO main_goals(mainResult01, mainResult02, mainResult03, mainResult04, result01, result02, result03, result04, mainObjetive, action01, action02, action03, action04, mainAction01, mainAction02, mainAction03, mainAction04, idTeam, idProject) VALUES (:mainResult01, :mainResult02, :mainResult03, :mainResult04, :result01, :result02, :result03, :result04, :mainObjetive, :action01, :action02, :action03, :action04, :mainAction01, :mainAction02, :mainAction03, :mainAction04, :idTeam, :idProject)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':mainResult01', $data['mainResult01'], PDO::PARAM_STR);
        $stmt->bindParam(':mainResult02', $data['mainResult02'], PDO::PARAM_STR);
        $stmt->bindParam(':mainResult03', $data['mainResult03'], PDO::PARAM_STR);
        $stmt->bindParam(':mainResult04', $data['mainResult04'], PDO::PARAM_STR);
        $stmt->bindParam(':result01', $data['result01'], PDO::PARAM_STR);
        $stmt->bindParam(':result02', $data['result02'], PDO::PARAM_STR);
        $stmt->bindParam(':result03', $data['result03'], PDO::PARAM_STR);
        $stmt->bindParam(':result04', $data['result04'], PDO::PARAM_STR);
        $stmt->bindParam(':mainObjetive', $data['mainObjetive'], PDO::PARAM_STR);
        $stmt->bindParam(':action01', $data['action01'], PDO::PARAM_STR);
        $stmt->bindParam(':action02', $data['action02'], PDO::PARAM_STR);
        $stmt->bindParam(':action03', $data['action03'], PDO::PARAM_STR);
        $stmt->bindParam(':action04', $data['action04'], PDO::PARAM_STR);
        $stmt->bindParam(':mainAction01', $data['mainAction01'], PDO::PARAM_STR);
        $stmt->bindParam(':mainAction02', $data['mainAction02'], PDO::PARAM_STR);
        $stmt->bindParam(':mainAction03', $data['mainAction03'], PDO::PARAM_STR);
        $stmt->bindParam(':mainAction04', $data['mainAction04'], PDO::PARAM_STR);
        $stmt->bindParam(':idTeam', $idTeam, PDO::PARAM_INT);
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

    static public function mdlUpdateMainProblems($data) {
        $pdo = Conexion::conectar();
        $sql = "UPDATE main_problems SET ". $data['column'] ." = :column WHERE idMainProblems = :idMainProblems";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':column', $data['edit'], PDO::PARAM_STR);
        $stmt->bindParam(':idMainProblems', $data['idMainProblems'], PDO::PARAM_INT);
        if ($stmt->execute()) {
            $result = 'ok';
        } else {
            $result = 'error';
        }
        $stmt->closeCursor();
        $stmt = null;
        return $result;
    }

    static public function mdlUpdateMainGoals($data) {
        $pdo = Conexion::conectar();
        $sql = "UPDATE main_goals SET ". $data['column'] ." = :column WHERE idMainGoals = :idMainGoals";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':column', $data['edit'], PDO::PARAM_STR);
        $stmt->bindParam(':idMainGoals', $data['idMainGoals'], PDO::PARAM_INT);
        if ($stmt->execute()) {
            $result = 'ok';
        } else {
            $result = 'error';
        }
        $stmt->closeCursor();
        $stmt = null;
        return $result;
    }

    static public function mdlGetStructure($idTeam) {
        $pdo = Conexion::conectar();
        $sql = "SELECT s.*, 
                mp.nameMain01, mp.nameMain02, mp.nameMain03, mp.nameMain04,
                mg.mainResult01, mg.mainResult02, mg.mainResult03, mg.mainResult04,
                mg.mainObjetive,
                mg.action01, mg.action02, mg.action03, mg.action04,
                mg.mainAction01, mg.mainAction02, mg.mainAction03, mg.mainAction04, mg.idProject
                FROM structures s
                    LEFT JOIN main_problems mp ON mp.idMainProblems = s.idMainProblems
                    LEFT JOIN main_goals mg ON mg.idTeam = mp.idTeam AND mg.idProject = mp.idProject
                WHERE s.idTeam = :idTeam";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':idTeam', $idTeam, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $stmt->closeCursor();
        $stmt = null;
        return $result;
    }

    static public function mdlGetOnlyStructure($idStructure) {
        $pdo = Conexion::conectar();
        $sql = "SELECT * FROM structures WHERE idStructure = :idStructure";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':idStructure', $idStructure, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch();
        $stmt->closeCursor();
        $stmt = null;
        return $result;
    }

    static public function mdlSelectProblems($data) {
        $pdo = Conexion::conectar();
        $sql = "INSERT INTO structures(problem1, problem2, idMainProblems, idTeam) VALUES (:problem1, :problem2, :idMainProblems, :idTeam)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':problem1', $data['problem1'], PDO::PARAM_STR);
        $stmt->bindParam(':problem2', $data['problem2'], PDO::PARAM_STR);
        $stmt->bindParam(':idMainProblems', $data['idMainProblems'], PDO::PARAM_INT);
        $stmt->bindParam(':idTeam', $data['idTeam'], PDO::PARAM_INT);
        if ($stmt->execute()) {
            $result = 'ok';
        } else {
            $result = 'error';
        }
        $stmt->closeCursor();
        $stmt = null;
        return $result;
    }

    static public function mdlUpdateStructure($data) {
        $pdo = Conexion::conectar();
        $sql = "UPDATE structures SET ". $data['column'] ." = :column WHERE idStructure = :idStructure";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':column', $data['value'], PDO::PARAM_STR);
        $stmt->bindParam(':idStructure', $data['idStructure'], PDO::PARAM_INT);
        if ($stmt->execute()) {
            $result = 'ok';
        } else {
            $result = 'error';
        }
        $stmt->closeCursor();
        $stmt = null;
        return $result;
    }

    static public function mdlSelectMatrix($idMatrix) {
        $pdo = Conexion::conectar();
        $sql = "SELECT * FROM matrix WHERE idMatrix = :idMatrix";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':idMatrix', $idMatrix, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch();
        $stmt->closeCursor();
        $stmt = null;
        return $result;
    }

    static public function mdlAddMatrix($data) {
        
        $photos = ($data['evidenceTypes']['photos'] == 'true') ? 1 : 0;
        $videos = ($data['evidenceTypes']['videos'] == 'true') ? 1 : 0;
        $reports = ($data['evidenceTypes']['reports'] == 'true') ? 1 : 0;
        $attendance = ($data['evidenceTypes']['attendance'] == 'true') ? 1 : 0;
        $agreements = ($data['evidenceTypes']['agreements'] == 'true') ? 1 : 0;
        $others = ($data['evidenceTypes']['others'] == 'true') ? 1 : 0;

        $pdo = Conexion::conectar();
        $sql = "INSERT INTO matrix(idStructure, activity, description, start_date, end_date, frequency, indicator_activity, how, goal, risks, photos, videos, reports, attendance, agreements, others) VALUES (:idStructure, :activity, :description, :start_date, :end_date, :frequency, :indicator_activity, :how, :goal, :risks, :photos, :videos, :reports, :attendance, :agreements, :others)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':idStructure', $data['idStructure'], PDO::PARAM_INT);
        $stmt->bindParam(':activity', $data['activity'], PDO::PARAM_INT);
        $stmt->bindParam(':description', $data['description'], PDO::PARAM_STR);
        $stmt->bindParam(':start_date', $data['startDate'], PDO::PARAM_STR);
        $stmt->bindParam(':end_date', $data['endDate'], PDO::PARAM_STR);
        $stmt->bindParam(':frequency', $data['frequency'], PDO::PARAM_STR);
        $stmt->bindParam(':indicator_activity', $data['indicatorActivity'], PDO::PARAM_STR);
        $stmt->bindParam(':how', $data['how'], PDO::PARAM_STR);
        $stmt->bindParam(':goal', $data['goal'], PDO::PARAM_INT);
        $stmt->bindParam(':risks', $data['risks'], PDO::PARAM_STR);
        $stmt->bindParam(':photos', $photos, PDO::PARAM_INT);
        $stmt->bindParam(':videos', $videos, PDO::PARAM_INT);
        $stmt->bindParam(':reports', $reports, PDO::PARAM_INT);
        $stmt->bindParam(':attendance', $attendance, PDO::PARAM_INT);
        $stmt->bindParam(':agreements', $agreements, PDO::PARAM_INT);
        $stmt->bindParam(':others', $others, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            $result = 'ok';
        } else {
            $result = 'error';
        }
        $stmt->closeCursor();
        $stmt = null;
        return $result;
    }

    static public function mdlUpdateMatrix($data) {
        
        $photos = ($data['evidenceTypes']['photos'] == 'true') ? 1 : 0;
        $videos = ($data['evidenceTypes']['videos'] == 'true') ? 1 : 0;
        $reports = ($data['evidenceTypes']['reports'] == 'true') ? 1 : 0;
        $attendance = ($data['evidenceTypes']['attendance'] == 'true') ? 1 : 0;
        $agreements = ($data['evidenceTypes']['agreements'] == 'true') ? 1 : 0;
        $others = ($data['evidenceTypes']['others'] == 'true') ? 1 : 0;

        $pdo = Conexion::conectar();
        $sql = "UPDATE matrix SET idStructure = :idStructure,activity = :activity,description = :description,start_date = :start_date,end_date = :end_date,frequency = :frequency,indicator_activity = :indicator_activity,how = :how,goal = :goal,risks = :risks,photos = :photos,videos = :videos,reports = :reports,attendance = :attendance,agreements = :agreements,others = :others WHERE idMatrix = :idMatrix";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':idStructure', $data['idStructure'], PDO::PARAM_INT);
        $stmt->bindParam(':activity', $data['activity'], PDO::PARAM_INT);
        $stmt->bindParam(':description', $data['description'], PDO::PARAM_STR);
        $stmt->bindParam(':start_date', $data['startDate'], PDO::PARAM_STR);
        $stmt->bindParam(':end_date', $data['endDate'], PDO::PARAM_STR);
        $stmt->bindParam(':frequency', $data['frequency'], PDO::PARAM_STR);
        $stmt->bindParam(':indicator_activity', $data['indicatorActivity'], PDO::PARAM_STR);
        $stmt->bindParam(':how', $data['how'], PDO::PARAM_STR);
        $stmt->bindParam(':goal', $data['goal'], PDO::PARAM_INT);
        $stmt->bindParam(':risks', $data['risks'], PDO::PARAM_STR);
        $stmt->bindParam(':photos', $photos, PDO::PARAM_INT);
        $stmt->bindParam(':videos', $videos, PDO::PARAM_INT);
        $stmt->bindParam(':reports', $reports, PDO::PARAM_INT);
        $stmt->bindParam(':attendance', $attendance, PDO::PARAM_INT);
        $stmt->bindParam(':agreements', $agreements, PDO::PARAM_INT);
        $stmt->bindParam(':others', $others, PDO::PARAM_INT);
        $stmt->bindParam(':idMatrix', $data['idMatrix'], PDO::PARAM_INT);
        if ($stmt->execute()) {
            $result = 'update';
        } else {
            $result = 'error';
        }
        $stmt->closeCursor();
        $stmt = null;
        return $result;
    }

    static public function mdlSearchStructureMatrix($idStructure, $activity) {
        $pdo = Conexion::conectar();
        $sql = "SELECT m.*, sum(r.progress) as progress, r.idReport FROM matrix m 
                LEFT JOIN reports r ON r.idMatrix = m.idMatrix WHERE idStructure = :idStructure AND activity = :activity";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':idStructure', $idStructure, PDO::PARAM_INT);
        $stmt->bindParam(':activity', $activity, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch();
        $stmt->closeCursor();
        $stmt = null;
        return $result;
    }

    static public function mdlSearchReportsToMatrix($idMatrix) {
        $pdo = Conexion::conectar();
        $sql = "SELECT * FROM reports WHERE idMatrix = :idMatrix";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':idMatrix', $idMatrix, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $stmt->closeCursor();
        $stmt = null;
        return $result;
    }

    static public function mdlAddEvidence($idMatrix, $description, $progress, $videos) {
        $pdo = Conexion::conectar();
        $sql = "INSERT INTO reports(idMatrix, description, progress, videos) VALUES (:idMatrix, :description, :progress, :videos)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':idMatrix', $idMatrix, PDO::PARAM_INT);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':progress', $progress, PDO::PARAM_STR);
        $stmt->bindParam(':videos', $videos, PDO::PARAM_STR);
        if ($stmt->execute()) {
            $result = $pdo->lastInsertId();
        } else {
            $result = 'error';
        }
        $stmt->closeCursor();
        $stmt = null;
        return $result;
    }

    static public function mdlAddFilesEvidence($uploadId, $files){
        $pdo = Conexion::conectar();
        $filesJson = json_encode($files); // Convertir array a JSON
    
        $sql = "UPDATE reports SET files = :files WHERE idReport = :idReport";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':files', $filesJson, PDO::PARAM_STR);
        $stmt->bindParam(':idReport', $uploadId, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $result = 'update';
        } else {
            $result = 'error';
        }
        $stmt->closeCursor();
        $stmt = null;
        return $result;
    }

    public static function mdlRemoveFileFromEvidence($idReport, $filePath) {
        $pdo = Conexion::conectar();
        // Obtener los archivos actuales
        $sql = "SELECT files FROM reports WHERE idReport = :idReport";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':idReport', $idReport, PDO::PARAM_INT);
        $stmt->execute();
        $currentFiles = $stmt->fetch(PDO::FETCH_ASSOC)['files'];
        
        if ($currentFiles) {
            $filesArray = json_decode($currentFiles, true);
    
            // Filtrar el archivo que se va a eliminar
            $filteredFiles = array_filter($filesArray, function($file) use ($filePath) {
                return $file['path'] !== $filePath;
            });
    
            // Convertir de nuevo a JSON
            $updatedFilesJson = json_encode(array_values($filteredFiles));
    
            // Actualizar la base de datos con los archivos restantes
            $sql = "UPDATE reports SET files = :files WHERE idReport = :idReport";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':files', $updatedFilesJson, PDO::PARAM_STR);
            $stmt->bindParam(':idReport', $idReport, PDO::PARAM_INT);
    
            if ($stmt->execute()) {
                return true;
            }
        }
        return false;
    }

    public static function mdlGetReportDetails($idReport, $idMatrix) {
        $pdo = Conexion::conectar();
        if ($idMatrix == null){
            $sql = "SELECT * FROM reports WHERE idReport = :idReport";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':idReport', $idReport, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $sql = "SELECT progress FROM reports WHERE idMatrix = :idMatrix";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':idMatrix', $idMatrix, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    
    public static function mdlUpdateReport($idReport, $description, $progress) {
        $pdo = Conexion::conectar();
        $sql = "UPDATE reports SET description = :description, progress = :progress WHERE idReport = :idReport";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':progress', $progress, PDO::PARAM_INT);
        $stmt->bindParam(':idReport', $idReport, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public static function mdlDeleteReport($idReport) {
        $pdo = Conexion::conectar();
        $sql = "DELETE FROM reports WHERE idReport = :idReport";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':idReport', $idReport, PDO::PARAM_INT);
        return $stmt->execute();
    }

}