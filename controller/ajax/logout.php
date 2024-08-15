<?php
session_start();
$language = $_SESSION['language'];
session_destroy();

session_start();
$_SESSION['language'] = $language;
echo 'ok';