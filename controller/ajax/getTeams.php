<?php

    require_once "../forms.controller.php";
    require_once "../../model/forms.models.php";
    $item = (isset($_POST['team'])) ? 'idTeam' : null;
    $value = (isset($_POST['team'])) ? $_POST['team'] : null;
    $idProject = (isset($_POST['idProject'])) ? $_POST['idProject'] : null;
    $response = FormsController::ctrGetTeams($item,$value,$idProject);
    echo json_encode($response);