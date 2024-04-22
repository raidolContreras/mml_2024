<?php

    require_once "../forms.controller.php";
    require_once "../../model/forms.models.php";

    $response = FormsController::ctrGetTeams(null,null);
    echo json_encode($response);