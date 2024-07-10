<?php
    require_once "../forms.controller.php";
    require_once "../../model/forms.models.php";

        $idTeam = $_POST['idTeam'];
        $fromTable = $_POST['fromTable'];
        
        $response = FormsController::ctrGetComments($idTeam, $fromTable);
        echo json_encode($response);