<!DOCTYPE html>
<html lang="en">
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
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <!-- Language selection -->
                    <div class="language-select text-center mb-3 mt-3">
                        <button id="lang-en" class="btn btn-outline-primary me-2">English</button>
                        <button id="lang-es" class="btn btn-outline-secondary">Español</button>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title text-center" id="forgot-password-title">Forgot Password</h3>
                        <p class="text-center" id="forgot-password-instructions">Enter your email address and we'll send you a link to reset your password.</p>
                        
                        
                        <form id="forgotPassForms" method="POST">
                            <div class="form-group">
                                <label for="email" id="email-label">Email Address</label>
                                <input type="email" id="email" class="form-control" required>
                            </div>
                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-primary w-100" id="send-reset-link">Send Reset Link</button>
                            </div>
                        </form>
                        <div class="text-center mt-3">
                            <a href="Login" id="back-to-login">Back to Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
            lng: '<?php echo $_SESSION['language']?>', // Default language
            backend: {
                loadPath: 'locales/{{lng}}/translationfp.json' // Ruta a los archivos de traducción
            }
        }, function(err, t) {
            updateContent();
        });

        function updateContent() {
            document.getElementById('forgot-password-title').innerHTML = i18next.t('forgotPasswordTitle');
            document.getElementById('forgot-password-instructions').innerHTML = i18next.t('forgotPasswordInstructions');
            document.getElementById('email-label').innerHTML = i18next.t('emailAddress');
            document.getElementById('send-reset-link').innerHTML = i18next.t('sendResetLink');
            document.getElementById('back-to-login').innerHTML = i18next.t('backToLogin');
        }

        document.getElementById('lang-en').addEventListener('click', function() {
            i18next.changeLanguage('en', updateContent);
            $.ajax({
                url: 'controller/ajax/ajax.form.php',
                type: 'POST',
                data: {update_language: 'en'},
                success: function(response) {
                    console.log(response);
                }
            });
        });
        document.getElementById('lang-es').addEventListener('click', function() {
            i18next.changeLanguage('es', updateContent);
            $.ajax({
                url: 'controller/ajax/ajax.form.php',
                type: 'POST',
                data: {update_language: 'es'},
                success: function(response) {
                    console.log(response);
                }
            });
        });
    </script>
</body>
</html>
