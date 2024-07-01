<?php
    require_once "../forms.controller.php";
    require_once "../../model/forms.models.php";

    if (isset($_POST['eventId'])) {
        $eventId = $_POST['eventId'];
        $idTeam = $_POST['idTeam'];
        $response = FormsController::ctrGetEventFiles($eventId, $idTeam);
        echo json_encode($response);
    }