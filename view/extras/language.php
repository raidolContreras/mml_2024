<!-- Languages -->
<script>

var translations; // Declaración de la variable translations fuera de la función

async function cargarTraducciones(idioma) {
    if (idioma == '') {
        idioma = 'en'; // Por defecto, se establece el idioma en inglés si no hay selección en la sesión
    }
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
cargarTraducciones('<?php echo (isset($_SESSION['language'])) ? $_SESSION['language'] : 'en'; ?>').then(() => {
    // Ahora puedes usar las traducciones en cualquier lugar de tu código
    $('#dashboard').html(translations.dashboard);
    $('#team').html(translations.team);
    $('.team').html(translations.team);
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
    $('.download_template').html(translations.download_template);
    $('.color_settings').html(translations.color_settings);
    $('.problem').html(translations.problem);
    $('.effect').html(translations.effect);
    $('.cause').html(translations.cause);
    $('.objetive').html(translations.objetive);
    $('.result').html(translations.result);
    $('.action').html(translations.action);
    $('.acceptEdit').html(translations.accept);
    $('.product').html(translations.product);

    $('.massiveActions').html(translations.massiveActions);
    $('.deleteUser_btn').html(translations.deleteUser_btn);
    $('.addUser_btn').html(translations.addUser_btn);
    $('.editUser_btn').html(translations.editUser_btn);
    $('.users_list').html(translations.users_list);
    $('.name').html(translations.name);
    $('.email').html(translations.email);
    $('.password').html(translations.password);
    $('.project').html(translations.project);
    $('.user_type').html(translations.user_type);
    $('.actions').html(translations.actions);
    $('.firstname').html(translations.firstname);
    $('.lastname').html(translations.lastname);
    
    $('.addProject_btn').html(translations.addProject_btn);
    $('.editProject_btn').html(translations.editProject_btn);
    $('.alert-message').html(translations.alert);
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
    $('.editTeam_btn').html(translations.editTeam_btn);
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
    
    $('.acceptDelete').html(translations.accept);
    $('.acceptLogo').html(translations.accept);
    $('.updateProjectLogo').html(translations.updateLogo);

    $('.progress-title').text(translations.progress);
    
    $('.participants').text(translations.participants);
    $('#participantsModalLabel').text(translations.participantsModalLabel);
    $('#editParticipantsModalLabel').text(translations.editParticipantsModalLabel);

    $('#addParticipantBtn').html(translations.addParticipantBtn);
    $('.details_team_text').text(translations.details_team_text);
    $('.mentor').text(translations.mentor);
    $('.state').text(translations.state);
    $('.identifed_problem').text(translations.identifed_problem);
    $('.main_objetive').text(translations.main_objetive);
    $('.mainObjetive_title').text(translations.main_objetive);
    $('.addUsersModal').text(translations.addUsersModal);
    $('.message_delete_participants').text(translations.message_delete_participants);
    $('#deleteParticipantsModalLabel').text(translations.deleteParticipantsModalLabel);

    $('.addTrees_btn').text(translations.addTrees_btn);
    $('.addTrees').text(translations.addTrees);
    $('.problem_tree').text(translations.problem_tree);
    $('.goal_tree').text(translations.goal_tree);
    $('.main_effects').text(translations.main_effects);
    $('.effects').text(translations.effects);
    $('.central_problem').text(translations.central_problem);
    $('.causes').text(translations.causes);
    $('.main_causes').text(translations.main_causes);
    $('.main_results').text(translations.main_results);
    $('.results').text(translations.results);
    $('.main_actions').text(translations.main_actions);
    $('.activity').text(translations.activity);

    var html = `
        <option value="">${translations.select_one}</option>
        <option value="0">${translations.admin}</option>
        <option value="1">${translations.standar}</option>
    `;
    
    $('#level_user').html(html);
    $('#level_user_edit').html(html);
    $('.level_user_edit').html(html);
    
    $('.message_Select_mainActions').text(translations.message_Select_mainActions);
    $('.send_Selections').text(translations.send_Selections);
    
    $('.narrative_summary').text(translations.narrative_summary);
    $('.indicator').text(translations.indicator);
    $('.goal').text(translations.goal);
    $('.verification_sources').text(translations.verification_sources);
    $('.risks').text(translations.risks);
    $('.start_date').text(translations.start_date);
    $('.term_date').text(translations.term_date);
    
    
    $('#description_activity').html(translations.description_activity);
    $('#start_date_activity').html(translations.start_date_activity);
    $('#end_date_activity').html(translations.end_date_activity);
    $('#frequency_activity').html(translations.frequency_activity);
    $('#indicator_activity').html(translations.indicator_activity);
    $('#evidenceTypeLabel').html(translations.evidenceTypeLabel);
    $('#Number_of').html(translations.Number_of);
    $('#that').html(translations.that);
    $('#What_goal').html(translations.What_goal);
    $('#Photos').html(translations.Photos);
    $('#Videos').html(translations.Videos);
    $('#Reports_input').html(translations.Reports_input);
    $('#Attendance_lists').html(translations.Attendance_lists);
    $('#Agreements').html(translations.Agreements);
    $('#Others').html(translations.Others);
    $('#risk_activity').html(translations.risk_activity);

    $('.progress_activity').html(translations.progress_activity);
    $('.add').html(translations.add);
    $('.evidences').html(translations.evidences);
    $('.add_evidence').html(translations.add_evidence);
    $('.attach_evidence').html(translations.attach_evidence);
    $('.save_changes').html(translations.save_changes);
    $('.edit_evidence').html(translations.edit_evidence);

    $('.SelectEvent').html(translations.SelectEvent);
    $('.UploadVideoLink').html(translations.UploadVideoLink);
    $('.or').html(translations.Or);
    $('#UploadedFilesCount').html(translations.UploadedFilesCount);

    $('.Evidence').html(translations.Evidence);
    $('.Back').html(translations.Back);

    $('.Teacher').html(translations.Teacher);
    $('.Student').html(translations.Student);
    $('.Logout').html(translations.Logout);
    $('.EditField').html(translations.EditField);

    //placeholders
    $('#videoLink').attr('placeholder',translations.EnterYouTubeVideoLink);
    $('.EnterADescription').attr('placeholder',translations.EnterADescription);
    $('.EnterProgress').attr('placeholder',translations.EnterProgress);
    $('.EnterYouTubeVideoURL').attr('placeholder',translations.EnterYouTubeVideoURL);

    $('.title_photos').html(translations.Photos);
    $('.title_reports').html(translations.Reports_input);
    $('.title_attendance').html(translations.Attendance_lists);
    $('.title_agreements').html(translations.Agreements);
    $('.title_others').html(translations.Others);
    $('.title_video').html(translations.Videos);

    $('#Comment').html(translations.Comment);
    $('.commetTitle').html(translations.addComment);
    $('.Comment').html(translations.Comment);
    $('#Comment_Title').html(translations.Comment);
    $('#newPasswordLabel').html(translations.newPassword);
    $('#passwordChangeModalLabel').html(translations.passwordChangeModalLabel);

    $('.team_information').html(translations.team_information);

    var html2 = `
        <option value="0">${translations.select_one}</option>
        <option value="1">${translations.Monthly}</option>
        <option value="2">${translations.Bimonthly}</option>
        <option value="3">${translations.Biannual}</option>
        <option value="4">${translations.Other}</option>
    `;
    $('#frequency').html(html2);
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
        data: {language: language, user: <?php echo (isset($_SESSION['idUser'])) ? $_SESSION['idUser'] : '1' ?>},
        success: function(response) {
            if (response == 'ok'){
                window.location.reload();
            }
        }
    });
}

function changeLanguageParticipants(language) {
    if (language == 1) {
        language = 'es';
    } else {
        language = 'en';
    }
    $.ajax({
        type: "POST",
		url: "controller/ajax/ajax.form.php",
        data: {language: language, userParticipant: <?php echo (isset($_SESSION['idUser'])) ? $_SESSION['idUser'] : '1' ?>},
        success: function(response) {
            if (response == 'ok'){
                window.location.reload();
            }
        }
    });
}

</script>
<?php
    $language = isset($_SESSION['language']) ? $_SESSION['language'] : 'en';
?>
<input type="hidden" id="language" value="<?php echo $language; ?>">