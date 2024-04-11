<!-- Languages -->
<script>

var translations; // Declaración de la variable translations fuera de la función

async function cargarTraducciones(idioma) {
    var ruta = 'assets/languajes/' + idioma + '.json';
    if (idioma == 'en') {
        $('.languaje-selected').attr('src', 'assets/images/Flag/flag001.png');
        $('#english').addClass('active');
        
    } else {
        $('.languaje-selected').attr('src', 'assets/images/Flag/flag-03.png');
        $('#spanish').addClass('active');
    }
    
    // Devolver la promesa para manejarla fuera de la función
    let response = await fetch(ruta);
    let data = await response.json();
    translations = data;
    return translations; // Devolver las traducciones para poder usarlas fuera de la función
}

// Uso
cargarTraducciones('<?php echo $_SESSION['language']; ?>').then(() => {
    // Ahora puedes usar las traducciones en cualquier lugar de tu código
    $('#dashboard').html(translations.dashboard);
    $('#admin').html(translations.admin);
    $('#team').html(translations.team);
    $('#trees').html(translations.trees);
    $('#structure').html(translations.structure);
    $('#matriz').html(translations.matriz);
    $('#reports').html(translations.reports);
    $('#events').html(translations.events);
    $('#summary').html(translations.summary);
    $('.Admin').html(translations.admin);
    $('.profile').html(translations.profile);

    $('.progress-title').text(translations.progress);
});

function changeLanguage(language) {
    if (language == 1) {
        language = 'es';
    } else {
        language = 'en';
    }
    $.ajax({
        type: "POST",
		url: "controller/ajax/ajax.form.php",
        data: {language: language, user: <?php echo $_SESSION['idUser'] ?>},
        success: function(response) {
            if (response == 'ok'){
                window.location.reload();
            }
        }
    });
}
</script>
