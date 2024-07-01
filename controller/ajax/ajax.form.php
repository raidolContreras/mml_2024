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
				$teamExist = FormsController::ctrGetTeams('teamName', $team, null);
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

function generateRandomPassword($length = 8) {
    $upper = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $lower = "abcdefghijklmnopqrstuvwxyz";
    $numbers = "0123456789";
    $all = $upper . $lower . $numbers;

    $password = '';
    $password .= $upper[rand(0, strlen($upper) - 1)];
    $password .= $lower[rand(0, strlen($lower) - 1)];
    $password .= $numbers[rand(0, strlen($numbers) - 1)];

    for ($i = 3; $i < $length; $i++) {
        $password .= $all[rand(0, strlen($all) - 1)];
    }

    // Mezclar la contraseña para evitar que los caracteres añadidos al principio estén en el mismo orden
    $password = str_shuffle($password);

    return $password;
}

// Función para enviar correo electrónico
function sendEmail($to, $subject, $message) {
    $headers = "From: no-reply@radixeducation.org\r\n";
    $headers .= "Reply-To: no-reply@radixeducation.org\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    mail($to, $subject, $message, $headers);
}

if (isset($_FILES['pacientList'])) {
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
                    $password = generateRandomPassword();
                    $cryptPassword = crypt($password, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                    $data = array(
                        'firstname' => $fields[0],
                        'lastname' => $fields[1],
                        'email' => $fields[2],
                        'password' => $password, // guardar la contraseña original
                        'cryptPassword' => $cryptPassword // guardar la contraseña encriptada
                    );

                    if (isset($_POST['team'])) {
                        $result = FormsController::ctrAddParticipants($data, $_POST['team']);
                        
                        if ($result == 'ok') {
                            // Enviar correo electrónico
                            $to = $fields[2];
                            $subject = "Bienvenido a nuestro equipo";
                            $message = "Hola " . $fields[0] . " " . $fields[1] . ",<br><br>";
                            $message .= "Tu cuenta ha sido creada exitosamente. Aquí están tus datos de acceso:<br>";
                            $message .= "Email: " . $fields[2] . "<br>";
                            $message .= "Contraseña: " . $password . "<br><br>";
                            $message .= "Saludos,<br>El equipo";
                            sendEmail($to, $subject, $message);
                        }
                    } else {
                        $result = 'Sin equipo';
                    }
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
	echo json_encode(FormsController::ctrGetProject('p.idProject', $_POST['SelectProject']));
}

if(isset($_POST['SearchTeam'])){
	echo json_encode(FormsController::ctrGetTeams('idTeam', $_POST['SearchTeam'], null));
}

if(isset($_POST['searchTeamParticipants'])){
	echo json_encode(FormsController::ctrGetTeams('idTeam', $_POST['searchTeamParticipants'], null));
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

if(isset($_POST['createUser']) &&
	isset($_POST['firstname']) &&
	isset($_POST['lastname']) &&
	isset($_POST['email']) &&
	isset($_POST['project']) &&
	isset($_POST['team']) &&
	isset($_POST['level']) 
	){
		
		$cryptPassword = crypt($_POST['password'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

		$user = array(
            'firstname' => $_POST['firstname'],
            'lastname' => $_POST['lastname'],
            'email' => $_POST['email'],
            'cryptPassword' => $cryptPassword,
            'users_idProjects' => $_POST['project'],
            'users_idTeam' => $_POST['team'],
            'level' => $_POST['level']
        );

		$userCheck = FormsController::ctrGetUsers('email', $user['email']);
		if (empty($userCheck)) {
			$result = FormsController::ctrAddUser($user);
		} else {
			$result = false;
			echo 'Correo duplicado: '.$user['email'].'<br>';
		}
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
	echo json_encode(FormsController::ctrGetTeams('idTeam', $_POST['searchTeam'], null));
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

if (isset($_POST['loadProblemTreeData'])){
    $result = FormsController::ctrGetProblemTree($_POST['loadProblemTreeData'], $_POST['projectId']);
    echo json_encode($result);
}

if (isset($_FILES['treeList'])) {
	if (isset($_FILES['treeList']) && $_FILES['treeList']['error'] === UPLOAD_ERR_OK) {

		$idTeam = $_POST['team'];
		$idProject = $_POST['project'];
		
		// Ruta donde se almacenará el archivo temporalmente
		$fileTmpPath = $_FILES['treeList']['tmp_name'];
	
		// Obtener el contenido del archivo CSV
		$csvData = file_get_contents($fileTmpPath);
	
		// Parsear el contenido del archivo CSV
		$lines = explode("\n", $csvData);
		$users = [];
		$i = 0;
		$a = 0;
		foreach ($lines as $line) {
			// Verificar que la línea no esté vacía
			if (!empty($line)) {
				if ($i == 2) {
					$fields = str_getcsv($line);
					// Verificar que hay al menos 4 campos en la línea
					if (count($fields) == 17) {
						if ($a == 0) {
							$data = array(
								"nameMain01" => $fields[0],
								"nameMain02" => $fields[1],
								"nameMain03" => $fields[2],
								"nameMain04" => $fields[3],
								"nameEffect01" => $fields[4],
								"nameEffect02" => $fields[5],
								"nameEffect03" => $fields[6],
								"nameEffect04" => $fields[7],
								"centralProblem" => $fields[8],
								"causes01" => $fields[9],
								"causes02" => $fields[10],
								"causes03" => $fields[11],
								"causes04" => $fields[12],
								"mainCauses01" => $fields[13],
								"mainCauses02" => $fields[14],
								"mainCauses03" => $fields[15],
								"mainCauses04" => $fields[16]
							);
							$result = FormsController::ctrAddMainProblem($data, $idTeam, $idProject);
						} elseif ($a == 1) {
							if ($result == 'ok') {
								$data = array(
									"mainResult01" => $fields[0],
									"mainResult02" => $fields[1],
									"mainResult03" => $fields[2],
									"mainResult04" => $fields[3],
									"result01" => $fields[4],
									"result02" => $fields[5],
									"result03" => $fields[6],
									"result04" => $fields[7],
									"mainObjetive" => $fields[8],
									"action01" => $fields[9],
									"action02" => $fields[10],
									"action03" => $fields[11],
									"action04" => $fields[12],
									"mainAction01" => $fields[13],
									"mainAction02" => $fields[14],
									"mainAction03" => $fields[15],
									"mainAction04" => $fields[16]
								);
								$result = FormsController::ctrAddMainObjetive($data, $idTeam, $idProject);
							}
						}
					} else {
						// Manejar la línea con un número insuficiente de campos
						echo "Error: la línea no tiene suficientes campos. ". count($fields);
					}
					$a++;
					$i = 0;
				} else {
					$i++;
				}
			}
		}
		echo $result;
	} else {
		echo "Error al cargar el archivo CSV.";
	}
}

if (
    isset($_POST['edit']) &&
    isset($_POST['column']) &&
    isset($_POST['tree']) &&
    isset($_POST['idMainProblems']) &&
    isset($_POST['idMainGoals']) &&
    isset($_POST['idTeam']) &&
    isset($_POST['idProject'])
) {
    // Si idMainProblems está vacío, crear una nueva entrada para los problemas principales
    if (empty($_POST['idMainProblems'])) {
        $data = array(
            "nameMain01" => ($_POST['column'] == 'nameMain01') ? $_POST['edit'] : '',
            "nameMain02" => ($_POST['column'] == 'nameMain02') ? $_POST['edit'] : '',
            "nameMain03" => ($_POST['column'] == 'nameMain03') ? $_POST['edit'] : '',
            "nameMain04" => ($_POST['column'] == 'nameMain04') ? $_POST['edit'] : '',
            "nameEffect01" => ($_POST['column'] == 'nameEffect01') ? $_POST['edit'] : '',
            "nameEffect02" => ($_POST['column'] == 'nameEffect02') ? $_POST['edit'] : '',
            "nameEffect03" => ($_POST['column'] == 'nameEffect03') ? $_POST['edit'] : '',
            "nameEffect04" => ($_POST['column'] == 'nameEffect04') ? $_POST['edit'] : '',
            "centralProblem" => ($_POST['column'] == 'centralProblem') ? $_POST['edit'] : '',
            "causes01" => ($_POST['column'] == 'causes01') ? $_POST['edit'] : '',
            "causes02" => ($_POST['column'] == 'causes02') ? $_POST['edit'] : '',
            "causes03" => ($_POST['column'] == 'causes03') ? $_POST['edit'] : '',
            "causes04" => ($_POST['column'] == 'causes04') ? $_POST['edit'] : '',
            "mainCauses01" => ($_POST['column'] == 'mainCauses01') ? $_POST['edit'] : '',
            "mainCauses02" => ($_POST['column'] == 'mainCauses02') ? $_POST['edit'] : '',
            "mainCauses03" => ($_POST['column'] == 'mainCauses03') ? $_POST['edit'] : '',
            "mainCauses04" => ($_POST['column'] == 'mainCauses04') ? $_POST['edit'] : ''
        );
        $result = FormsController::ctrAddMainProblem($data, $_POST['idTeam'], $_POST['idProject']);
        
        // Obtener el ID recién creado
        if ($result) {
            $_POST['idMainProblems'] = $result; // Asigna el nuevo ID a idMainProblems
        } else {
            echo 'error';
            exit;
        }
    }

    // Si idMainGoals está vacío, crear una nueva entrada para los objetivos principales
    if (empty($_POST['idMainGoals'])) {
        $data = array(
            "mainResult01" => ($_POST['column'] == 'mainResult01') ? $_POST['edit'] : '',
            "mainResult02" => ($_POST['column'] == 'mainResult02') ? $_POST['edit'] : '',
            "mainResult03" => ($_POST['column'] == 'mainResult03') ? $_POST['edit'] : '',
            "mainResult04" => ($_POST['column'] == 'mainResult04') ? $_POST['edit'] : '',
            "result01" => ($_POST['column'] == 'result01') ? $_POST['edit'] : '',
            "result02" => ($_POST['column'] == 'result02') ? $_POST['edit'] : '',
            "result03" => ($_POST['column'] == 'result03') ? $_POST['edit'] : '',
            "result04" => ($_POST['column'] == 'result04') ? $_POST['edit'] : '',
            "mainObjetive" => ($_POST['column'] == 'mainObjetive') ? $_POST['edit'] : '',
            "action01" => ($_POST['column'] == 'action01') ? $_POST['edit'] : '',
            "action02" => ($_POST['column'] == 'action02') ? $_POST['edit'] : '',
            "action03" => ($_POST['column'] == 'action03') ? $_POST['edit'] : '',
            "action04" => ($_POST['column'] == 'action04') ? $_POST['edit'] : '',
            "mainAction01" => ($_POST['column'] == 'mainAction01') ? $_POST['edit'] : '',
            "mainAction02" => ($_POST['column'] == 'mainAction02') ? $_POST['edit'] : '',
            "mainAction03" => ($_POST['column'] == 'mainAction03') ? $_POST['edit'] : '',
            "mainAction04" => ($_POST['column'] == 'mainAction04') ? $_POST['edit'] : ''
        );
        $result = FormsController::ctrAddMainObjetive($data, $_POST['idTeam'], $_POST['idProject']);
        
        // Obtener el ID recién creado
        if ($result) {
            $_POST['idMainGoals'] = $result; // Asigna el nuevo ID a idMainGoals
        } else {
            echo 'error';
            exit;
        }
    }

    // Actualizar datos existentes
    if ($_POST['tree'] == 'main_problems') {
        $data = array(
            'edit' => $_POST['edit'],
            'column' => $_POST['column'],
            'idMainProblems' => $_POST['idMainProblems']
        );
        $result = FormsController::ctrUpdateMainProblems($data);
    } else {
        $data = array(
            'edit' => $_POST['edit'],
            'column' => $_POST['column'],
            'idMainGoals' => $_POST['idMainGoals']
        );
        $result = FormsController::ctrUpdateMainGoals($data);
    }
    echo $result;
}


if (isset($_POST['structureSelect'])) {
	echo json_encode(FormsController::ctrGetStructure($_POST['structureSelect']));
}

if (isset($_POST['selectedOptions'])) {
	$selectedOptions = $_POST['selectedOptions'];

    // Asegúrate de que hay al menos dos opciones seleccionadas
    if (count($selectedOptions) >= 2) {
        $problem1 = $selectedOptions[0];
        $problem2 = $selectedOptions[1];

        $data = array(
            'problem1' => $problem1,
            'problem2' => $problem2,
			'idTeam' => $_POST['team'],
			'idMainProblems' => $_POST['idMainProblems'],
        );

		echo FormsController::ctrSelectProblems($data);
    }
}

if (isset($_POST['searchStructure'])) {
	echo json_encode(FormsController::ctrGetOnlyStructure($_POST['searchStructure']));
}

if (isset($_POST['updateStructure'])) {
	$data = array(
        'idStructure' => $_POST['updateStructure'],
        'column' => $_POST['columName'],
		'value' => $_POST['value']
    );
    $result = FormsController::ctrUpdateStructure($data);
    echo $result;
}

if (isset($_POST['idMatrix'])) {
	$data = array(
		'description' => $_POST['description'],
		'startDate' => $_POST['startDate'],
		'endDate' => $_POST['endDate'],
		'frequency' => $_POST['frequency'],
		'indicatorActivity' => $_POST['indicatorActivity'],
		'how' => $_POST['how'],
		'goal' => $_POST['goal'],
		'risks' => $_POST['risks'],
		'evidenceTypes' => $_POST['evidenceTypes'],
		'idMatrix' => $_POST['idMatrix'],
		'idStructure' => $_POST['idStructure'],
		'activity' => $_POST['activity']
	);
	$result = FormsController::ctrAddMatrix($data);
	echo $result;
}

if (isset($_POST['searchStructureMatrix'])) {
	$result = FormsController::ctrSearchStructureMatrix($_POST['searchStructureMatrix'], $_POST['activity']);
	echo json_encode($result);
}

if (isset($_POST['searchReportsToMatrix'])) {
	$result = FormsController::ctrSearchReportsToMatrix($_POST['searchReportsToMatrix']);
    echo json_encode($result);
}

if (isset($_POST['getReportDetails'])) {
    $idReport = $_POST['getReportDetails'];
    $report = FormsController::ctrGetReportDetails($idReport);

    if ($report) {
        echo json_encode(['status' => 'success', 'data' => $report]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to get report details']);
    }
    exit;
}

if (isset($_POST['updateReport'])) {
    $idReport = $_POST['updateReport'];
    $description = $_POST['description'];
    $progress = $_POST['progress'];
    $result = FormsController::ctrUpdateReport($idReport, $description, $progress);

    if ($result) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update report']);
    }
    exit;
}
