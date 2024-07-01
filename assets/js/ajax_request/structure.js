var team = ($('#level').val() != 0) ? $('#idTeam').val() : $('#teamSelectEdit').val();

if ($('#level').val() != 0 ) {
    $('.teamSelect').css('display', 'none');
    structureSelect(team);
} else {

    $('#teamSelectEdit').on('change', function() {
        team = $('#teamSelectEdit').val();
        $('#idTeamSelect').val(team);
        
        if (team >= 1) {
            structureSelect(team)
        } else {
            $('.Structure').css('display', 'none');
            $('.selectStructure').css('display', 'none');
        }
    });
    
}

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
                LoadTreeData(idTeam, project);
            } else {
                var project = $('#project').val();
                var structureSelect = true;
                data.forEach(structure => {
                    if (structure.idProject == project) {
                        structureSelect = false;
                        problem1 = structure.problem1.substr(-2);
                        problem2 = structure.problem2.substr(-2);

                        $('#idStructure').val(structure.idStructure);
                        $('.main_results01').html(structure['mainResult'+problem1]);
                        $('.main_results02').html(structure['mainResult'+problem2]);
                        $('.main_objetive01').html(structure.mainObjetive);
                        $('.main_objetive02').html(structure.mainObjetive);
                        $('.action01').html(structure['action'+problem1]);
                        $('.action02').html(structure['action'+problem2]);
                        $('.main_actions01').html(structure['mainAction'+problem1]);
                        $('.main_actions02').html(structure['mainAction'+problem2]);
                        // Verifica si los campos de structure son nulos o indefinidos y asigna mensajes predeterminados si es necesario
                        var product1 = (structure.product1 != null) ? structure.product1 : translations.generate_product_message;
                        var product2 = (structure.product2 != null) ? structure.product2 : translations.generate_product_message;
                        
                        var activity1 = (structure.activity1 != null) ? structure.activity1 : translations.generate_activity_message;
                        var activity2 = (structure.activity2 != null) ? structure.activity2 : translations.generate_activity_message;
                        var activity3 = (structure.activity3 != null) ? structure.activity3 : translations.generate_activity_message;
                        var activity4 = (structure.activity4 != null) ? structure.activity4 : translations.generate_activity_message;
                        var activity5 = (structure.activity5 != null) ? structure.activity5 : translations.generate_activity_message;
                        var activity6 = (structure.activity6 != null) ? structure.activity6 : translations.generate_activity_message;
                        var activity7 = (structure.activity7 != null) ? structure.activity7 : translations.generate_activity_message;
                        var activity8 = (structure.activity8 != null) ? structure.activity8 : translations.generate_activity_message;
                        
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
                        
                        $('.Structure').css('display', 'block');
                        $('.selectStructure').css('display', 'none');
                    }
                });
                if (structureSelect) {
                    LoadTreeData(idTeam, project);
                }
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
                // Verificar si algún campo está vacío
                const fields = [
                    data.nameMain01, data.nameMain02, data.nameMain03, data.nameMain04,
                    data.nameEffect01, data.nameEffect02, data.nameEffect03, data.nameEffect04,
                    data.centralProblem,
                    data.causes01, data.causes02, data.causes03, data.causes04,
                    data.mainCauses01, data.mainCauses02, data.mainCauses03, data.mainCauses04,
                    data.mainResult01, data.mainResult02, data.mainResult03, data.mainResult04,
                    data.result01, data.result02, data.result03, data.result04,
                    data.mainObjetive,
                    data.action01, data.action02, data.action03, data.action04,
                    data.mainAction01, data.mainAction02, data.mainAction03, data.mainAction04
                ];

                const isComplete = fields.every(field => field && field.trim() !== '');

                if (!isComplete) {
                    $('.selectStructure').hide();
                    showAlertBootstrap2(translations.alert, translations.message_complete_tree, 'Trees');
                } else {
                    $('.selectStructure').show();
                }
            } else {
                $('.selectStructure').hide();
                $('.completeTree').show();
            }
        },
        error: function (error) {
            $('.selectStructure').hide();
            $('.completeTree').show();
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
    var team = ($('#level').val() != 0) ? $('#idTeam').val() : $('#teamSelectEdit').val();
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

function updateData(columName) {
    
    var idStructure = $('#idStructure').val();
    $('#editModal').modal('show');
    $.ajax({
        type: 'POST',
        url: 'controller/ajax/ajax.form.php',
        data: {
            searchStructure: idStructure,
        },
        dataType: 'json',
        success: function (data) {
            $('#value').val(data[columName]);
            $('#columnName').val(columName);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log("Error en la solicitud AJAX:", textStatus, errorThrown);
        }
    });
}

$('#editButton').on('click', function() {
    
    var idStructure = $('#idStructure').val();
    $.ajax({
        type: 'POST',
        url: 'controller/ajax/ajax.form.php',
        data: {
            updateStructure: idStructure,
            columName: $('#columnName').val(),
            value: $('#value').val()
        },
        success: function (data) {
            if (data === 'ok') {
                $('#editModal').modal('hide');
                $('#value').val('');
                showAlertBootstrap(translations.success, translations.update_Structure_Alert);
                structureSelect(team)
            }
        }
    });

});