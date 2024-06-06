<?php

    require_once "../forms.controller.php";
    require_once "../../model/forms.models.php";
    $team = (isset($_POST['idTeam'])) ? $_POST['idTeam'] : null;
    $response = FormsController::ctrGetMatrix($team);
    echo json_encode($response);