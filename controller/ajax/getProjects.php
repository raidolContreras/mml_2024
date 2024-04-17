<?php

    require_once "../forms.controller.php";
    require_once "../../model/forms.models.php";

    $getUsers = FormsController::ctrGetProject();
    echo json_encode($getUsers);