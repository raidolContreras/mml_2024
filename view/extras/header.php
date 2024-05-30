<?php 
	$project = FormsController::ctrGetProject('p.idProject', $_SESSION['idProject']); 
	// print_r($project);
?>
<span class="screen-darken"></span>
<!-- loader Start -->
<div id="loading">
	<div class="loader simple-loader">
		<div class="loader-body"></div>
	</div>
</div>
<!-- loader END -->
<main class="main-content">
	<!--Nav Start-->
	<nav class="nav navbar navbar-expand-xl navbar-light iq-navbar">
		<div class="container-fluid navbar-inner">
			<button data-trigger="navbar_main" class="d-xl-none btn btn-primary rounded-pill p-1 pt-0" type="button">
				<svg width="20px" class="icon-20" viewBox="0 0 24 24">
					<path fill="currentColor" d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z"></path>
				</svg>
			</button>
			<div class="col-lg-2 col-lg-3 navbar-brand">
				<a href="./" class="navbar-brand">
					<!--Logo start-->
					<img src="assets/images/projects/<?php echo $project['idProject']. '/' .$project['logoProject'] ?>" class="img-fluid" style="max-height: 50px;" alt="Logo del proyecto">
                    
					<!-- <img style="width: 2rem; height:auto" src="assets/images/logo.png" alt="logo Edradix"> -->
					<!--logo End-->
					<h4 class="logo-title"><?php echo $project['nameProject'] ?></h4>
				</a>
			</div>
			<!-- Horizontal Menu Start -->
			<nav id="navbar_main" class="mobile-offcanvas nav navbar navbar-expand-xl hover-nav horizontal-nav mx-md-auto">
				<div class="container-fluid">
					<div class="offcanvas-header px-0">
						<div class="navbar-brand ms-3">
							<!--Logo start-->
							<!--logo End-->

							<!--Logo start-->
							<div class="logo-main">
								<div class="logo-normal">
									<img style="width: 2rem; height:auto" src="assets/images/logo.png" alt="logo Edradix">
								</div>
								<div class="logo-mini">
									<img style="width: 2rem; height:auto" src="assets/images/logo.png" alt="logo Edradix">
								</div>
							</div>
							<!--logo End-->
							<h4 class="logo-title">Radix</h4>
						</div>
						<button class="btn-close float-end"></button>
					</div>
					<ul class="navbar-nav">
						<li class="nav-item"><a class="nav-link" href="./" id="dashboard"> </a></li>
						<?php if ($_SESSION['level'] == 0):?>
							<li class="nav-item"><a class="nav-link" href="Admin" id="admin"> </a></li>
						<?php endif ?>
						<li class="nav-item"><a class="nav-link" href="Team" id="team"> </a></li>
						<li class="nav-item"><a class="nav-link" href="Trees" id="trees"> </a></li>
						<li class="nav-item"><a class="nav-link" href="Structure" id="structure"> </a></li>
						<li class="nav-item"><a class="nav-link" href="Matriz" id="matriz"> </a></li>
						<li class="nav-item"><a class="nav-link" href="Reports" id="reports"> </a></li>
						<li class="nav-item"><a class="nav-link" href="Events" id="events"> </a></li>
						<li class="nav-item"><a class="nav-link" href="Summary" id="summary"> </a></li>
					</ul>
				</div>
			</nav>
			<!-- Sidebar Menu End -->
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon">
					<span class="navbar-toggler-bar bar1 mt-2"></span>
					<span class="navbar-toggler-bar bar2"></span>
					<span class="navbar-toggler-bar bar3"></span>
				</span>
			</button>
			<div class="collapse navbar-collapse col-md-2" id="navbarSupportedContent">
				<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
					<li class="nav-item dropdown">
						<a href="#" class="search-toggle nav-link" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<img src="" class="img-fluid rounded-circle languaje-selected" alt="user" style="height: 30px; min-width: 30px; width: 30px;">
							<span class="bg-primary"></span>
						</a>
						<div class="sub-drop dropdown-menu dropdown-menu-end p-0" aria-labelledby="dropdownMenuButton2">
							<div class="card shadow-none m-0 border-0">
								<div class=" p-0 ">
									<ul class="list-group list-group-flush">
										<li class="iq-sub-card list-group-item" id="spanish" onclick="changeLanguage(1)">
											<a class="p-0" href="#">
												<img src="assets/images/Flag/flag-03.png" alt="img-flag" class="img-fluid m-2" style="width: 15px;height: 15px;min-width: 15px;" />Español
											</a>
										</li>
										<li class="iq-sub-card list-group-item" id="english" onclick="changeLanguage(2)">
											<a class="p-0" href="#">
												<img src="assets/images/Flag/flag001.png" alt="img-flag" class="img-fluid m-2" style="width: 15px;height: 15px;min-width: 15px;" />English
											</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link py-0 d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<img src="assets/images/avatars/01.png" alt="User-Profile" class="theme-color-default-img img-fluid avatar avatar-50 avatar-rounded">
							<img src="assets/images/avatars/avtar_1.png" alt="User-Profile" class="theme-color-purple-img img-fluid avatar avatar-50 avatar-rounded">
							<img src="assets/images/avatars/avtar_2.png" alt="User-Profile" class="theme-color-blue-img img-fluid avatar avatar-50 avatar-rounded">
							<img src="assets/images/avatars/avtar_4.png" alt="User-Profile" class="theme-color-green-img img-fluid avatar avatar-50 avatar-rounded">
							<img src="assets/images/avatars/avtar_5.png" alt="User-Profile" class="theme-color-yellow-img img-fluid avatar avatar-50 avatar-rounded">
							<img src="assets/images/avatars/avtar_3.png" alt="User-Profile" class="theme-color-pink-img img-fluid avatar avatar-50 avatar-rounded">
							<div class="caption ms-3 d-none d-md-block">
								<h6 class="mb-0 caption-title"><?php
									echo $_SESSION['firstname'].' '.$_SESSION['lastname'];
									$level = ($_SESSION['level'] == 0) ? 'Admin' : '';
								?></h6>
								<p class="mb-0 caption-sub-title <?php echo $level ?>"></p>
							</div>
						</a>
						<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
							<li><a class="dropdown-item profile" href="profile"></a></li>
							<li>
								<hr class="dropdown-divider">
							</li>
							<li onclick="logout()"><a class="dropdown-item">Cerrar sesión</a></li>
						</ul>
						<input type="hidden" id="name" value="<?php echo $_SESSION['firstname'].' '.$_SESSION['lastname']; ?>">
						<input type="hidden" id="email" value="<?php echo $_SESSION['email'] ?>">
						<input type="hidden" id="idTeam" value="<?php echo $_SESSION['idTeam'] ?>">
						<input type="hidden" id="user" value="<?php echo $_SESSION['idUser'] ?>">
						<input type="hidden" id="project" value="<?php echo $_SESSION['idProject'] ?>">
						<input type="hidden" id="level" value="<?php echo $_SESSION['level'] ?>">
					</li>
				</ul>
			</div>
		</div>
	</nav>


	<body class="auto theme-color-blue">
		<div class="conatiner-fluid content-inner pb-0">
			<div class="row">