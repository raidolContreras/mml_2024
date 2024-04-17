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
    $('#team').html(translations.team);
    $('#trees').html(translations.trees);
    $('#structure').html(translations.structure);
    $('#matriz').html(translations.matriz);
    $('#reports').html(translations.reports);
    $('#events').html(translations.events);
    $('#summary').html(translations.summary);

    $('#admin').html(translations.admin);
    $('.save').html(translations.save);
    $('.Admin').html(translations.admin);
    $('.profile').html(translations.profile);

    // Apartado del administrador
    $('.settings').html(translations.settings);
    <?php

    // Definir un array asociativo que mapee las páginas a las clases y elementos correspondientes
    $pageMappings = [
        'Admin' => ['.settings', '#admin'],
        'Users' => ['.users', '#admin'],
        'Projects' => ['.projects', '#admin'],
        'Teams' => ['.teams', '#admin'],
        'EventSettings' => ['.events', '#admin'],
        'Dashboard' => '#dashboard',
        'Team' => '#team',
        'Trees' => '#trees',
        'Structure' => '#structure',
        'Matriz' => '#matriz',
        'Reports' => '#reports',
        'Events' => '#events',
        'Summary' => '#summary',
    ];

    // Verificar si la página actual está mapeada y agregar las clases y activar los elementos correspondientes
    if (array_key_exists($pagina, $pageMappings)) {
        // Si la página está asociada a clases y elementos específicos
        if (is_array($pageMappings[$pagina])) {
            foreach ($pageMappings[$pagina] as $element) {
                echo "$('$element').addClass('active');";
            }
        } else { // Si la página está asociada a un solo elemento
            echo "$('$pageMappings[$pagina]').addClass('active');";
        }
    }
    ?>
    
    $('.current_project').html(translations.current_project);
    $('.level_user').html(translations.level_user);
    $('.color_settings').html(translations.color_settings);
    $('.problem').html(translations.problem);
    $('.effect').html(translations.effect);
    $('.cause').html(translations.cause);
    $('.objetive').html(translations.objetive);
    $('.result').html(translations.result);
    $('.action').html(translations.action);
    $('.product').html(translations.product);

    $('.addUser_btn').html(translations.addUser_btn);
    $('.users_list').html(translations.users_list);
    $('.name').html(translations.name);
    $('.email').html(translations.email);
    $('.project').html(translations.project);
    $('.user_type').html(translations.user_type);
    $('.actions').html(translations.actions);
    
    $('.addProject_btn').html(translations.addProject_btn);
    $('.project_list').html(translations.project_list);
    $('.exampleModalLabel').html(translations.exampleModalLabel);
    $('.projectName').html(translations.projectName);
    $('.projectLink').html(translations.projectLink);
    $('.projectColor').html(translations.projectColor);
    $('.projectLogo').html(translations.projectLogo);
    $('.accept').html(translations.accept);
    $('.cancel').html(translations.cancel);
    
    $('.team_list').html(translations.team_list);
    $('.addTeam_btn').html(translations.addTeam_btn);
    $('.teamName').html(translations.teamName);
    $('.description').html(translations.description);
    $('.school').html(translations.school);
    
    $('.event_list').html(translations.event_list);
    $('.eventName').html(translations.eventName);
    $('.addEvent_btn').html(translations.addEvent_btn);

    $('.users').html(translations.users);
    $('.projects').html(translations.projects);
    $('.teams').html(translations.teams);
    $('.events').html(translations.events);

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
