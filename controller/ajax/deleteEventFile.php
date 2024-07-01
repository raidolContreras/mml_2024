<?php
require_once "../forms.controller.php";
require_once "../../model/forms.models.php";

if (isset($_POST['idEventToTeam'])) {
    $result = FormsController::ctrDeleteEventFile($_POST['idEventToTeam']);
    echo $result;
}
