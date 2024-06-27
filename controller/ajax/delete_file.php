<?php
require_once "../forms.controller.php";
require_once "../../model/forms.models.php";

// Inicializar la respuesta por defecto
$response = [
    'status' => 'error',
    'message' => 'No data received'
];

if (isset($_POST['filePath']) && isset($_POST['idReport'])) {
    $filePath = '../../'.$_POST['filePath'];
    $idReport = $_POST['idReport'];


    // Eliminar el archivo del sistema de archivos
    if (file_exists($filePath)) {
        if (unlink($filePath)) {
            // Aquí puedes agregar la lógica para eliminar la referencia del archivo en la base de datos
            $result = FormsController::ctrRemoveFileFromEvidence($idReport, $filePath);

            if ($result) {
                $response['status'] = 'success';
                $response['message'] = 'File deleted successfully';
            } else {
                $response['message'] = 'Failed to remove file reference from database';
            }
        } else {
            $response['message'] = 'Failed to delete the file';
        }
    } else {
        $response['message'] = 'File does not exist';
    }
}

header('Content-Type: application/json');
echo json_encode($response);
?>

