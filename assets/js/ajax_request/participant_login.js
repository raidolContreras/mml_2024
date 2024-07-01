$(document).ready(function () {
    $("form.account-wrap").submit(function (event) {
        // Evitar el envío del formulario por defecto
        event.preventDefault();

        var email = $("#email").val();
        var password = $("#password").val();

        // Realiza la solicitud Ajax
        $.ajax({
            type: "POST",
            url: "controller/ajax/ajax.form.php",
            data: {
                emailLoginStudent: email,
                passwordLoginStudent: password
            },
            success: function (response) {
                if (response === 'ok') {
                    window.location.href = './';
                } else if (response === 'status off') {
                    showAlertBootstrap('Usuario deshabilitado', 'Comuníquese con el administrador de la plataforma, para cualquier aclaración.');
                } else {
                    showAlertBootstrap('¡Atención!', 'Error al iniciar sesión, verifique su correo o contraseña');
                }
            },
            error: function (error) {
                console.log("Error en la solicitud Ajax:", error);
            }
        });
    });
});
