<?php

require_once "../forms.controller.php";
require_once "../../model/forms.models.php";

// Directorio de carga
$uploadDirectory = '../../assets/uploads/'. $_POST['matrix']. '/';

// Crear el directorio de carga si no existe
if (!is_dir($uploadDirectory)) {
    mkdir($uploadDirectory, 0755, true);
}

// Inicializar la respuesta por defecto
$response = [
    'status' => 'error',
    'message' => 'No files uploaded'
];
if (FormsController::ctrAddEvidence($_POST['matrix'], $_POST['description'], $_POST['progress'])) {

}
try {
    if (!empty($_FILES)) {
        foreach ($_FILES as $key => $fileArray) {
            if (is_array($fileArray['name'])) {
                for ($i = 0; $i < count($fileArray['name']); $i++) {
                    $filePath = $uploadDirectory . basename($fileArray['name'][$i]);
                    if (move_uploaded_file($fileArray['tmp_name'][$i], $filePath)) {
                        error_log("File uploaded: " . $filePath); // Registrar en el log
                    } else {
                        error_log("Failed to upload: " . $fileArray['name'][$i]); // Registrar error en el log
                    }
                }
            } else {
                $filePath = $uploadDirectory . basename($fileArray['name']);
                if (move_uploaded_file($fileArray['tmp_name'], $filePath)) {
                    error_log("File uploaded: " . $filePath); // Registrar en el log
                } else {
                    error_log("Failed to upload: " . $fileArray['name']); // Registrar error en el log
                }
            }
        }

        $response['status'] = 'success';
        $response['message'] = 'Files uploaded successfully';
    }
} catch (Exception $e) {
    error_log("Exception: " . $e->getMessage()); // Registrar la excepción en el log
    $response['message'] = 'An error occurred: ' . $e->getMessage();
}

header('Content-Type: application/json');
echo json_encode($response);
