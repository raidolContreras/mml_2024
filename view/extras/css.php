
<head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      
      <!-- Favicon -->
      <link rel="shortcut icon" href="assets/images/favicon.ico" />
      
      <!-- Library / Plugin Css Build -->
      <link rel="stylesheet" href="assets/css/core/libs.min.css" />
      
      
      <!-- Hope Ui Design System Css -->
      <link rel="stylesheet" href="assets/css/hope-ui.min.css?v=2.0.0" />
      
      <!-- Custom Css -->
      <link rel="stylesheet" href="assets/css/custom.min.css?v=2.0.0" />
      
      <!-- Dark Css -->
      <link rel="stylesheet" href="assets/css/dark.min.css"/>
      
      <!-- Customizer Css -->
      <link rel="stylesheet" href="assets/css/customizer.min.css" />
      
      <!-- RTL Css -->
      <link rel="stylesheet" href="assets/css/rtl.min.css"/>
      
      <link rel="stylesheet" href="assets/css/style.css"/>
      <?php 
	    $pagina = $_GET['pagina'] ?? 'Dashboard';
      if($pagina == 'Admin'){
      } elseif($pagina == 'Users' || $pagina == 'Projects' || $pagina == 'Team' || $pagina == 'Trees') {
        // Importar librerías de Dropzone
        echo '<link href="assets/vendor/dropzone/dropzone.css" rel="stylesheet">';
      }
      

   ?>
      
  </head>