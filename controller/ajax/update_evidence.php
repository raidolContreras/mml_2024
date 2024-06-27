<?php
require_once "../forms.controller.php";
require_once "../../model/forms.models.php";

$response = [
    'status' => 'error',
    'message' => 'No data received'
];

if (isset($_POST['uploadId']) && isset($_POST['files'])) {
    $uploadId = $_POST['uploadId'];
    $files = json_decode($_POST['files'], true);

    // Aquí puedes implementar la lógica para actualizar la evidencia en la base de datos
    // utilizando el $uploadId y los archivos subidos.
    // Por ejemplo:
    $result = FormsController::ctrAddFilesEvidence($uploadId, $files);

    if ($result) {
        $response['status'] = 'success';
        $response['message'] = 'Evidence updated successfully';
    } else {
        $response['message'] = 'Failed to update evidence';
    }
}

header('Content-Type: application/json');
echo json_encode($response);
