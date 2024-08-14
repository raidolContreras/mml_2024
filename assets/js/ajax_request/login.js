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
				emailLogin: email,
				passwordLogin: password
			},
			success: function (response) {

			    if (response === 'ok') {
                    window.location.href = './';
			    }else if (response === 'status off') {
                    showAlertBootstrap(translations.UserDisabled, translations.ContactAdministratorForClarification);
                } else {
                    showAlertBootstrap(translations.alert, translations.LoginErrorCheckEmailOrPassword);
			    }
			},
			error: function (error) {
				console.log("Error en la solicitud Ajax:", error);
			}
		});
	});

	$('#forgotPassForms').submit(function (event)  {
		event.preventDefault();
		var emailForgot = $("#email").val();
		$.ajax({
			type: "POST",
            url: "controller/ajax/ajax.form.php",
            data: {
                forgotPass: emailForgot
            },
            success: function (response) {
                if (response) {
                    showAlertBootstrap(translations.PasswordRecovery, translations.CheckYourEmail);
                } else {
                    showAlertBootstrap(translations.alert, translations.EmailNotFound);
                }
            },
            error: function (error) {
                console.log("Error en la solicitud Ajax:", error);
            }
		});
	});
});