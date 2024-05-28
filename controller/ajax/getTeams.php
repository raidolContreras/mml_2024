<?php

    require_once "../forms.controller.php";
    require_once "../../model/forms.models.php";
    $item = (isset($_POST['team'])) ? 'idTeam' : null;
    $value = (isset($_POST['team'])) ? $_POST['team'] : null;
    $response = FormsController::ctrGetTeams($item,$value);
    echo json_encode($response);