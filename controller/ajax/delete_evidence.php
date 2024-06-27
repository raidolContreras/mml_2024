<?php
require_once "../forms.controller.php";
require_once "../../model/forms.models.php";

$response = [
    'status' => 'error',
    'message' => 'No data received'
];

if (isset($_POST['idReport'])) {
    $idReport = $_POST['idReport'];

    $result = FormsController::ctrDeleteReport($idReport);

    if ($result) {
        $response['status'] = 'success';
        $response['message'] = 'Report deleted successfully';
    } else {
        $response['message'] = 'Failed to delete report';
    }
}

header('Content-Type: application/json');
echo json_encode($response);