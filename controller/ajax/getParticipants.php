<?php

    require_once "../forms.controller.php";
    require_once "../../model/forms.models.php";
    $idTeam = $_POST['idTeam'];
    $response = FormsController::ctrGetParticipant('idTeam', $idTeam);
    echo json_encode($response);