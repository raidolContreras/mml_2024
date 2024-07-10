<?php
require_once "../forms.controller.php";
require_once "../../model/forms.models.php";

$id = $_POST['id'];
$result = FormsController::ctrApproveComment($id);

echo $result ? 'ok' : 'error';
