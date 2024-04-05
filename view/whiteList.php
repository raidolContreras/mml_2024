<?php 
    
	$pagina = $_GET['pagina'] ?? 'Dashboard';

	$navs = [
		'Dashboard',
	];
    
    // if(isset($_SESSION['logged']) && $_SESSION['logged'] == true){
        
        if (in_array($pagina, $navs)) {
            include "view/extras/header.php";
        }

        if ($pagina == 'Dashboard'){
    
            include "view/pages/$pagina.php";
    
        } else {
    
            include "error404.php";
    
        }
    // } elseif($pagina == 'login') {
    //     include "view/pages/login/login.php";
    // } else {
    //     header("Location: login");
    //     exit();
    // }