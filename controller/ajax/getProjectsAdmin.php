<?php

    require_once "../forms.controller.php";
    require_once "../../model/forms.models.php";
    $project = $_POST['project'];
    $response = FormsController::ctrGetProject('idProject', $project);
    echo json_encode($response);