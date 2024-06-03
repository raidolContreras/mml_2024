
$('#teamSelectEdit').on('change', function() {
    var team = $('#teamSelectEdit').val();
    $('#idTeamSelect').val(team);
    
    if (team >= 1) {
        structureSelect(team)
    } else {
        $('.Structure').css('display', 'none');
        $('.selectStructure').css('display', 'none');
    }
});

function structureSelect(idTeam) {
    $.ajax({
        type: 'POST',
        url: 'controller/ajax/ajax.form.php',
        data: {
            structureSelect: idTeam
        },
        dataType: 'json',
        success: function (data) {
            if (data && Object.keys(data).length === 0) {
                var project = $('#project').val();
                $('.Structure').css('display', 'none');
                $('.selectStructure').css('display', 'block');
                LoadTreeData(idTeam, project);
            } else {
                var project = $('#project').val();

                $('.Structure').css('display', 'block');
                $('.selectStructure').css('display', 'none');

                data.forEach(structure => {
                    if (structure.idProject == project) {
                        problem1 = structure.problem1.substr(-2);
                        problem2 = structure.problem2.substr(-2);
                        
                        $('.main_results01').html(structure['mainResult'+problem1]);
                        $('.main_results02').html(structure['mainResult'+problem2]);
                        $('.main_objetive01').html(structure.mainObjetive);
                        $('.main_objetive02').html(structure.mainObjetive);
                        $('.action01').html(structure['action'+problem1]);
                        $('.action02').html(structure['action'+problem2]);
                        $('.main_actions01').html(structure['mainAction'+problem1]);
                        $('.main_actions02').html(structure['mainAction'+problem2]);
                        // Verifica si structure.product1 y structure.product2 son números válidos
                        var product1 = (typeof structure.product1 === 'number' && !isNaN(structure.product1)) ? structure.product1 : 'Da click para generar un producto';
                        var product2 = (typeof structure.product2 === 'number' && !isNaN(structure.product2)) ? structure.product2 : 'Da click para generar un producto';
                        
                        var activity1 = (typeof structure.activity01 === 'number' && !isNaN(structure.activity01)) ? structure.activity01 : 'Da click para generara actividad';
                        var activity2 = (typeof structure.activity02 === 'number' && !isNaN(structure.activity02)) ? structure.activity02 : 'Da click para generara actividad';
                        var activity3 = (typeof structure.activity03 === 'number' && !isNaN(structure.activity03)) ? structure.activity03 : 'Da click para generara actividad';
                        var activity4 = (typeof structure.activity04 === 'number' && !isNaN(structure.activity04)) ? structure.activity04 : 'Da click para generara actividad';
                        var activity5 = (typeof structure.activity05 === 'number' && !isNaN(structure.activity05)) ? structure.activity05 : 'Da click para generara actividad';
                        var activity6 = (typeof structure.activity06 === 'number' && !isNaN(structure.activity06)) ? structure.activity06 : 'Da click para generara actividad';
                        var activity7 = (typeof structure.activity07 === 'number' && !isNaN(structure.activity07)) ? structure.activity07 : 'Da click para generara actividad';
                        var activity8 = (typeof structure.activity09 === 'number' && !isNaN(structure.activity09)) ? structure.activity09 : 'Da click para generara actividad';

                        // Asigna los valores a los elementos HTML correspondientes
                        $('.product01').html(product1);
                        $('.product02').html(product2);

                        $('.activity01').html(activity1);
                        $('.activity02').html(activity2);
                        $('.activity03').html(activity3);
                        $('.activity04').html(activity4);
                        $('.activity05').html(activity5);
                        $('.activity06').html(activity6);
                        $('.activity07').html(activity7);
                        $('.activity08').html(activity8);
                    }
                });
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log("Error en la solicitud AJAX:", textStatus, errorThrown);
        }
    });
}

function LoadTreeData(idTeam, idProject) {
    
    $.ajax({
        type: 'POST',
        url: 'controller/ajax/ajax.form.php',
        data: {
            loadProblemTreeData: idTeam,
            projectId: idProject
        },
        dataType: 'json',
        success: function (data) {
            if (data && Object.keys(data).length !== 0) {
                $('.nameMain01').html(data.nameMain01);
                $('.nameMain02').html(data.nameMain02);
                $('.nameMain03').html(data.nameMain03);
                $('.nameMain04').html(data.nameMain04);
                $('#mainProblems').val(data.idMainProblems);
            }
        }
    });
}

function limitCheckboxes() {
    const checkboxes = document.querySelectorAll('.form-check-input');
    let checkedCount = 0;

    checkboxes.forEach(checkbox => {
        if (checkbox.checked) {
            checkedCount++;
        }
    });

    const sendButton = document.querySelector('.send_Selections_btn');

    if (checkedCount >= 2) {
        checkboxes.forEach(checkbox => {
            if (!checkbox.checked) {
                checkbox.disabled = true;
            }
        });
        sendButton.disabled = false;
    } else {
        checkboxes.forEach(checkbox => {
            checkbox.disabled = false;
        });
        sendButton.disabled = true;
    }
}

$('.send_Selections_btn').on('click', function() {
    const selectedOptions = [];
    $('.form-check-input:checked').each(function() {
        selectedOptions.push($(this).attr('id'));
    });

    var team = $('#teamSelectEdit').val();
    var idMainProblems = $('#mainProblems').val();

    $.ajax({
        type: 'POST',
        url: 'controller/ajax/ajax.form.php',
        data: {
            selectedOptions: selectedOptions,
            team: team,
            idMainProblems: idMainProblems
        },
        success: function (data) {
            if (data === 'ok') {
                showAlertBootstrap(translations.success, translations.select_Problems_Alert);
                structureSelect(team);
            }
        }
    });
});