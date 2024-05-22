<?php 

require_once "../forms.controller.php";
require_once "../../model/forms.models.php";

session_start();

if(isset($_POST['emailLogin']) && isset($_POST['passwordLogin'])) {
    $email = $_POST['emailLogin'];
    $password = $_POST['passwordLogin'];
    $result = FormsController::ctrLogin($email, $password);
    if($result != 'Error: Password incorrect' && $result != 'Error: Email does not contain'){
        if ($result['sesion'] == 'ok') {
			$_SESSION['sesion'] = $result['sesion'];
			$_SESSION['idProject'] = ($result['idProject'] != '') ? $result['idProject'] :$result['users_idProjects'];
			$_SESSION['idTeam'] = $result['users_idTeam'];
			$_SESSION['idUser'] = $result['idUser'];
			$_SESSION['firstname'] = $result['firstname'];
			$_SESSION['lastname'] = $result['lastname'];
			$_SESSION['email'] = $result['email'];
			$_SESSION['level'] = $result['level'];
			$_SESSION['language'] = $result['language'];
            $_SESSION['logged'] = true;
		}
		echo $result['sesion'];
    } elseif($result == 'Error: Password incorrect'){
        echo 'Error: Password incorrect';
    } else {
        echo 'Error: Email does not contain';
    }
}

if (isset($_POST['language']) && isset($_POST['user'])) {
    $result = FormsController::ctrChangeLanguage($_POST['language'], $_POST['user']);
    if ($result == 'ok') {
        $_SESSION['language'] = $_POST['language'];
    }
    echo $result;
}

if (isset($_POST['teamName']) && isset($_POST['description']) && isset($_POST['school']) && isset($_POST['project'])) {
    $data = array(
        'teamName' => $_POST['teamName'],
        'description' => $_POST['description'],
        'school' => $_POST['school'],
        'teams_idProject' => $_POST['project'],
    );
    $result = FormsController::ctrAddTeam($data);
    echo $result;
}

if (isset($_POST['projectName']) && isset($_POST['projectLink'])) {
    $data = array(
        'projectName' => $_POST['projectName'],
        'projectLink' => $_POST['projectLink']
    );
    $result = FormsController::ctrAddProject($data);
    echo $result;
}

if (isset($_POST['idProject']) && isset($_FILES['logo'])) {
	$data = array(
		'idProject' => $_POST['idProject'],
		'logo' => $_FILES['logo']['name']
	);

    $addLogo = FormsController::ctrAddLogo($data);

	if ($addLogo == 'ok') {
		$targetDir = "../../assets/images/projects/" . $_POST['idProject'] . "/"; // Reemplaza con la ruta adecuada
		$fileName = basename($_FILES["logo"]["name"]);
		$targetFilePath = $targetDir . $fileName;
		$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

		// Verifica si la carpeta existe, si no, la crea
		if (!file_exists($targetDir)) {
			mkdir($targetDir, 0777, true);
		}

		// Verificar si el archivo es una imagen
		$allowTypes = array('jpg', 'jpeg', 'png');
		if (in_array($fileType, $allowTypes)) {
			// Mover el archivo al directorio de destino
			if (move_uploaded_file($_FILES["logo"]["tmp_name"], $targetFilePath)) {
				echo json_encode(array('status' => 'success', 'logoUrl' => $targetFilePath));
			} else {
				echo json_encode(array('status' => 'error', 'message' => 'Error al cargar el archivo.'));
			}
		} else {
			echo json_encode(array('status' => 'error', 'message' => 'Solo se permiten archivos de imagen (jpg, jpeg, png).'));
		}
	}

}

if (isset($_POST['eventName'])) {
	$result = FormsController::ctrAddEvent($_POST['eventName']);
	echo $result;
}

if (isset($_FILES['userList'])) {
	if (isset($_FILES['userList']) && $_FILES['userList']['error'] === UPLOAD_ERR_OK) {
		
		$emails = array();
		// Ruta donde se almacenará el archivo temporalmente
		$fileTmpPath = $_FILES['userList']['tmp_name'];
	
		// Obtener el contenido del archivo CSV
		$csvData = file_get_contents($fileTmpPath);
	
		// Parsear el contenido del archivo CSV
		$lines = explode("\n", $csvData);
		$users = [];
		$init = false;
		$send = true;
		foreach ($lines as $line) {
			// Verificar que la línea no esté vacía
			if (!empty($line)) {
				if ($init) {
					$fields = str_getcsv($line);
					// Verificar que hay al menos 4 campos en la línea
					if (count($fields) >= 4) {
		                $cryptPassword = crypt($fields[3], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
						
						$level = 2; // Valor predeterminado

						if ($fields[4] == 'administrator') {
							$level = 0;
						} elseif ($fields[4] == 'standar' || $fields[4] == 'teacher') {
							$level = 1;
						}
						
						$project = $fields[5];
						$team = $fields[6];
						$user = [
							'firstname' => $fields[0],
							'lastname' => $fields[1],
							'email' => $fields[2],
							'cryptPassword' => $cryptPassword,
							'password' => $fields[3],
							'users_idProjects' => null,
							'users_idTeams' => null,
							'level' => $level
						];
						$users[] = $user;
					} else {
						// Manejar la línea con un número insuficiente de campos
						echo "Error: la línea no tiene suficientes campos.";
					}
				} else {
					$init = true;
				}
			}
		}
        $status = 'ok';
		foreach ($users as $user) {

			if ($project != ''){
				$projectExist = FormsController::ctrGetProject('nameProject', $project);
				if (empty($projectExist)) {
					$data = array(
						'projectName' => $project,
						'projectLink' => ''
					);
					// El proyecto no existe, por lo que lo agregamos
					$idProject = FormsController::ctrAddProject($data);
					$user['users_idProjects'] = $idProject;
				} else {
					$user['users_idProjects'] = $projectExist['idProject'];
				}
			}
			if ($team != ''){
				$teamExist = FormsController::ctrGetTeams('teamName', $team);
				if (empty($teamExist)) {
					$data = array(
						'teamName' => $team,
						'description' => '',
						'school' => ''
					);
					// El equipo no existe, por lo que lo agregamos
					$idTeam = FormsController::ctrAddTeam($data);
					$user['users_idTeam'] = $idTeam;
				} else {
					$user['users_idTeam'] = $teamExist['idTeam'];
				}
			}
			$userCheck = FormsController::ctrGetUsers('email', $user['email']);
			if (empty($userCheck)) {
				$status = FormsController::ctrAddUser($user);
			} else {
				$send = false;
				echo 'Correo duplicado: '.$user['email'].'<br>';
				// $userUpdate = FormsController::ctrUpdateUser($user, $userCheck['idUser']);
			}
		}
		if ($send) {
            echo 'ok';
        }
	} else {
		echo "Error al cargar el archivo CSV.";
	}
}

if (isset($_FILES['deleteUserList'])){
	$result = '';
	if (isset($_FILES['deleteUserList']) && $_FILES['deleteUserList']['error'] === UPLOAD_ERR_OK) {
		// Ruta donde se almacenará el archivo temporalmente
		$fileTmpPath = $_FILES['deleteUserList']['tmp_name'];
	
		// Obtener el contenido del archivo CSV
		$csvData = file_get_contents($fileTmpPath);
	
		// Parsear el contenido del archivo CSV
		$lines = explode("\n", $csvData);
		$init = false;
		foreach ($lines as $line) {
			// Verificar que la línea no esté vacía
			if (!empty($line)) {
				if ($init) {
					$fields = str_getcsv($line);
					
					$userCheck = FormsController::ctrGetUsers('email', $fields[0]);
					if (!empty($userCheck)) {
						$result = FormsController::ctrDeleteUser('email',$fields[0]);
					}

				} else {
					$init = true;
				}
				
			}
		}
	}
	echo $result;
}

if (isset($_FILES['pacientList'])){
	$result = '';
	if (isset($_FILES['pacientList']) && $_FILES['pacientList']['error'] === UPLOAD_ERR_OK) {
		// Ruta donde se almacenará el archivo temporalmente
		$fileTmpPath = $_FILES['pacientList']['tmp_name'];
	
		// Obtener el contenido del archivo CSV
		$csvData = file_get_contents($fileTmpPath);
	
		// Parsear el contenido del archivo CSV
		$lines = explode("\n", $csvData);
		$init = false;
		foreach ($lines as $line) {
			// Verificar que la línea no esté vacía
			if (!empty($line)) {
				if ($init) {
					$fields = str_getcsv($line);
					$data = array(
						'firstname' => $fields[0],
                        'lastname' => $fields[1],
                        'email' => $fields[2]
					);
					if (isset($_POST['team'])) {
						$result = FormsController::ctrAddParticipants($data, $_POST['team']);
					} else $result = 'Sin equipo';
				} else {
					$init = true;
				}
				
			}
		}
	}
	echo $result;
}

if(isset($_POST['SearchUser'])){
	echo json_encode(FormsController::ctrGetUsers('idUser', $_POST['SearchUser']));
}

if(isset($_POST['SelectProject'])){
	echo json_encode(FormsController::ctrGetProject('idProject', $_POST['SelectProject']));
}

if(isset($_POST['SearchTeam'])){
	echo json_encode(FormsController::ctrGetTeams('idTeam', $_POST['SearchTeam']));
}

if(isset($_POST['searchTeamParticipants'])){
	echo json_encode(FormsController::ctrGetTeams('idTeam', $_POST['searchTeamParticipants']));
}

if(isset($_POST['SelectEvent'])){
	echo json_encode(FormsController::ctrGetEvents('idEvent', $_POST['SelectEvent']));
}

if(isset($_POST['EditUser']) &&
	isset($_POST['firstname']) &&
	isset($_POST['lastname']) &&
	isset($_POST['email']) &&
	isset($_POST['projectSelectEdit']) &&
	isset($_POST['teamSelectEdit']) &&
	isset($_POST['level']) 
	){
		$data = array(
            'firstname' => $_POST['firstname'],
            'lastname' => $_POST['lastname'],
            'email' => $_POST['email'],
            'users_idProjects' => $_POST['projectSelectEdit'],
            'users_idTeam' => $_POST['teamSelectEdit'],
            'level' => $_POST['level']
        );
        $result = FormsController::ctrUpdateUser($data, $_POST['EditUser']);
        echo $result;
}

if(isset($_POST['DeleteUser'])){
    $result = FormsController::ctrDeleteUser('idUser',$_POST['DeleteUser']);
    echo $result;
}

if(isset($_POST['EditProject']) &&
	isset($_POST['projectNameEdit']) &&
	isset($_POST['projectLinkEdit'])
	){
		$data = array(
            'nameProject' => $_POST['projectNameEdit'],
            'linkProject' => $_POST['projectLinkEdit']
        );
        $result = FormsController::ctrUpdateProject($data, $_POST['EditProject']);
        echo $result;
}

if(isset($_POST['DeleteProject'])){
    $result = FormsController::ctrDeleteProject($_POST['DeleteProject']);
    echo $result;
}

if(isset($_POST['EditTeam']) &&
	isset($_POST['teamNameEdit']) &&
	isset($_POST['descriptionEdit']) &&
	isset($_POST['schoolEdit']) &&
	isset($_POST['projectEdit'])
	){
		$data = array(
            'teamName' => $_POST['teamNameEdit'],
            'teamDescription' => $_POST['descriptionEdit'],
           'teamSchool' => $_POST['schoolEdit'],
            'teams_idProject' => $_POST['projectEdit']
        );
        $result = FormsController::ctrUpdateTeam($data, $_POST['EditTeam']);
        echo $result;
}

if(isset($_POST['DeleteTeam'])){
    $result = FormsController::ctrDeleteTeam($_POST['DeleteTeam']);
    echo $result;
}

if(isset($_POST['eventNameEdit']) && isset($_POST['idEventEdit'])){
	$result = FormsController::ctrUpdateEvent($_POST['eventNameEdit'], $_POST['idEventEdit']);
    echo $result;
}

if(isset($_POST['DeleteEvent'])){
    $result = FormsController::ctrDeleteEvent($_POST['DeleteEvent']);
    echo $result;
}

if (isset($_POST['changeActive'])) {
	$result = FormsController::ctrChangeProjectActive($_POST['changeActive'], $_SESSION['idUser']);
	if ($result == 'ok') {
		$_SESSION['idProject'] = $_POST['changeActive'];
	}
    echo $result;
}

if(isset($_POST['problem']) &&
	isset($_POST['effect']) &&
	isset($_POST['cause']) &&
	isset($_POST['objetive']) &&
	isset($_POST['result']) &&
	isset($_POST['action']) &&
	isset($_POST['product']) &&
	isset($_POST['project'])
	){
		$data = array(
            'problem' => $_POST['problem'],
            'effect' => $_POST['effect'],
            'cause' => $_POST['cause'],
            'objetive' => $_POST['objetive'],
           'result' => $_POST['result'],
            'action' => $_POST['action'],
            'product' => $_POST['product'],
            'project_idProject' => $_POST['project']
        );
        $result = FormsController::ctrUpdateColors($data);
        echo $result;
}

if(isset($_POST['searchParticipant'])){
	echo json_encode(FormsController::ctrGetParticipant('idparticipant', $_POST['searchParticipant']));
}

if(isset($_POST['searchTeam'])){
	echo json_encode(FormsController::ctrGetTeams('idTeam', $_POST['searchTeam']));
}

if (isset($_POST['updateTeam'])){
	$data = array(
		'idTeam' => $_POST['updateTeam'],
        'teamState' => $_POST['state'],
        'identifiedProblem' => $_POST['identifiedProblem'],
        'mainObjective' => $_POST['mainObjective']
	);
	$result = FormsController::ctrUpdateTeamExtras($data);
	echo $result;
}

if (isset($_POST['updateParticipant'])){
	$data = array(
        'idparticipant' => $_POST['updateParticipant'],
        'firstname' => $_POST['firstnameParticipant'],
        'lastname' => $_POST['lastnameParticipant'],
       	'email' => $_POST['emailParticipant']
    );
    $result = FormsController::ctrUpdateParticipant($data);
    echo $result;
}

if (isset($_POST['deleteParticipant'])){
    $result = FormsController::ctrDeleteParticipant($_POST['deleteParticipant']);
    echo $result;
}