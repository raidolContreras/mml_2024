<?php

    require_once "../forms.controller.php";
    require_once "../../model/forms.models.php";
    $idProject = (isset($_POST['idProject'])) ? $_POST['idProject'] : null;
    $response = FormsController::ctrGetPromedios($idProject);
    echo json_encode($response);