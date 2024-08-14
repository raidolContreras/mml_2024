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
    <link rel="stylesheet" href="assets/css/custom.css"/>
    
    <!-- i18next CDN -->
    <script src="https://unpkg.com/i18next@21.6.3/i18next.min.js"></script>
    <script src="https://unpkg.com/i18next-http-backend@1.4.0/i18nextHttpBackend.min.js"></script>
</head>
<body class=" " data-bs-spy="scroll" data-bs-target="#elements-section" data-bs-offset="0" tabindex="0">
    <!-- loader Start -->
    <div id="loading">
        <div class="loader simple-loader">
            <div class="loader-body"></div>
        </div>    
    </div>
    <!-- loader END -->
    
    <div class="wrapper">
        <section class="login-content">
            <div class="row m-0 align-items-center bg-white vh-100">            
                <div class="col-md-6">
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <div class="card card-transparent shadow-none d-flex justify-content-center mb-0 auth-card">
                                <div class="card-body">
                                    
                                    <!-- Language selection -->
                                    <div class="language-select text-center mb-4">
                                        <button id="lang-en" class="btn btn-outline-primary me-2">English</button>
                                        <button id="lang-es" class="btn btn-outline-secondary">Español</button>
                                    </div>
                                    <a href="index.html" class="navbar-brand d-flex align-items-center mb-3">
                                        <!--Logo start-->
                                        <!--logo End-->
                                        
                                        <!--Logo start-->
                                        <div class="logo-main">
                                            <div class="logo-normal">
                                                <img style="width: 2rem; height:auto" src="assets/images/logo.png" alt="logo Edradix">
                                            </div>
                                            <div class="logo-mini">
                                                <img style="width: 1rem; height:auto" src="assets/images/logo.png" alt="logo Edradix">
                                            </div>
                                        </div>
                                        <!--logo End-->
                                        <h4 class="logo-title ms-3">Radix</h4>
                                    </a>
                                    <h2 class="mb-2 text-center" id="sign-in-title">Sign In</h2>
                                    <p class="text-center" id="login-text">Login to stay connected.</p>
                                    
                                    <form class="account-wrap">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="email" class="form-label" id="email-label">Email</label>
                                                    <input type="email" class="form-control" id="email" aria-describedby="email">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="password" class="form-label" id="password-label">Password</label>
                                                    <input type="password" class="form-control" id="password" aria-describedby="password">
                                                </div>
                                            </div>
                                            <div class="row col-lg-12 d-flex justify-content-between align-items-center">
                                               <div class="col-lg-6">
                                                  <a href="forgot_password" id="forgot-password">Forgot Password?</a>
                                                </div>
                                                <div class="col-lg-6 float-end">
                                                   <a href="participant_login" id="student-access">Student access</a>
                                                </div>
                                             </div>
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <button type="submit" class="btn btn-primary" id="sign-in">Sign In</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sign-bg">
                        <img class="logo-edradix" src="assets/images/logo.png" alt="logo Edradix">
                    </div>
                </div>
                <div class="col-md-6 d-md-block d-none bg-primary p-0 mt-n1 vh-100 overflow-hidden">
                    <img src="assets/images/dashboard/login.webp" class="img-fluid gradient-main animated-scaleX" alt="images">
                </div>
            </div>
        </section>
    </div>
    
    <?php
        include 'view/modals.php';
    ?>
    <!-- Library Bundle Script -->
    <script src="assets/js/core/libs.min.js"></script>
    
    <!-- External Library Bundle Script -->
    <script src="assets/js/core/external.min.js"></script>
    
    <!-- Widgetchart Script -->
    <script src="assets/js/charts/widgetcharts.js"></script>
    
    <!-- fslightbox Script -->
    <script src="assets/js/plugins/fslightbox.js"></script>
    
    <!-- Settings Script -->
    <script src="assets/js/plugins/setting.js"></script>
    
    <!-- Slider-tab Script -->
    <script src="assets/js/plugins/slider-tabs.js"></script>
    
    <!-- Form Wizard Script -->
    <script src="assets/js/plugins/form-wizard.js"></script>
    
    <script src="assets/js/ajax_request/login.js"></script>

    <!-- i18next Initialization Script -->
    <script>
        i18next.use(i18nextHttpBackend).init({
            lng: 'en', // Default language
            backend: {
                loadPath: 'locales/{{lng}}/translation.json' // Path to translation files
            }
        }, function(err, t) {
            updateContent();
        });

        function updateContent() {
            document.getElementById('sign-in-title').innerHTML = i18next.t('signIn');
            document.getElementById('login-text').innerHTML = i18next.t('loginText');
            document.getElementById('email-label').innerHTML = i18next.t('email');
            document.getElementById('password-label').innerHTML = i18next.t('password');
            document.getElementById('forgot-password').innerHTML = i18next.t('forgotPassword');
            document.getElementById('student-access').innerHTML = i18next.t('studentAccess');
            document.getElementById('sign-in').innerHTML = i18next.t('signIn');
        }

        document.getElementById('lang-en').addEventListener('click', function() {
            i18next.changeLanguage('en', updateContent);
        });
        document.getElementById('lang-es').addEventListener('click', function() {
            i18next.changeLanguage('es', updateContent);
        });
    </script>