
$('#teamSelectEdit').on('change', function() {
    var team = $('#teamSelectEdit').val();
    $('#idTeamSelect').val(team);
    
    if (team >= 1) {
        getMatrix(team);
    } else {
        $('.matrix').css('display', 'none');
    }
});

var activity1 = '';
var activity2 = '';
var activity3 = '';
var activity4 = '';
var activity5 = '';
var activity6 = '';
var activity7 = '';
var activity8 = '';

var idStructure = 0;

function getMatrix(team) {
    $.ajax({
        type: 'POST',
        url: 'controller/ajax/ajax.form.php',
        data: {
            structureSelect: team
        },
        dataType: 'json',
        success: function (data) {

            if (data && Object.keys(data).length === 0) {
                $('.matrix').css('display', 'none');
            } else {
                var project = $('#project').val();
                var structureSelect = true;
                
                data.forEach(structure => {
                    if (structure.idProject == project) {
                        structureSelect = false;
                        problem1 = structure.problem1.substr(-2);
                        problem2 = structure.problem2.substr(-2);

                        // Verifica si los campos de structure son nulos o indefinidos y asigna mensajes predeterminados si es necesario
                        var product1 = structure.product1;
                        var product2 = structure.product2;
                        
                        activity1 = structure.activity1;
                        activity2 = structure.activity2;
                        activity3 = structure.activity3;
                        activity4 = structure.activity4;
                        activity5 = structure.activity5;
                        activity6 = structure.activity6;
                        activity7 = structure.activity7;
                        activity8 = structure.activity8;

                        idStructure = structure.idStructure;

                        $('#idStructure').val(idStructure);

                        for (var i = 1; i < 9; i++){
                            getStructureMatrix(i, idStructure);
                        }
                        
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
                        
                        $('.matrix').css('display', 'block');
                    }
                });
                if (structureSelect) {
                    $('.matrix').css('display', 'none');
                }
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log("Error en la solicitud AJAX:", textStatus, errorThrown);
        }
    });
}

function editMatriz(matriz) {
    
    var activities = {
        1: activity1,
        2: activity2,
        3: activity3,
        4: activity4,
        5: activity5,
        6: activity6,
        7: activity7,
        8: activity8
    };

    $('#editMatriz').modal('show');
    $('#editMatrizLabel').text(activities[matriz]);
    $('#activityNumber').val(matriz);
    getMatrixToEdit(matriz, idStructure);
}

$(document).ready(function() {
    $('.sendMatrix').on('click', function() {
        var description = $('#description').val();
        var startDate = $('#startDate').val();
        var endDate = $('#endDate').val();
        var frequency = $('#frequency').val();
        var indicatorActivity = $('#indicator_activity').val();
        var how = $('#how').val();
        var What_goal_activity = $('#What_goal_activity').val();
        var risks = $('#risks').val();
        var idMatrix = $('#idMatrix').val();
        var idStructure = $('#idStructure').val();
        var activity = $('#activityNumber').val();

        // Recuperar los estados de los checkboxes
        var evidenceTypes = {
            photos: $('#photos').is(':checked'),
            videos: $('#videos').is(':checked'),
            reports: $('#reports_input').is(':checked'),
            attendance: $('#attendance').is(':checked'),
            agreements: $('#agreements').is(':checked'),
            others: $('#others').is(':checked')
        };

        // Si deseas enviar estos datos a un servidor, puedes hacer una solicitud AJAX aquí
        $.ajax({
            type: "POST",
            url: "controller/ajax/ajax.form.php",
            data: {
                description: description,
                startDate: startDate,
                endDate: endDate,
                frequency: frequency,
                indicatorActivity: indicatorActivity,
                how: how,
                goal: What_goal_activity,
                risks: risks,
                evidenceTypes: evidenceTypes,
                idMatrix: idMatrix,
                idStructure: idStructure,
                activity: activity
            },
            success: function(response) {

                $('#editMatriz').modal('hide');

                if (response === 'ok') {
                    showAlertBootstrap(translations.success, 'Matriz agregada');
                    getStructureMatrix(activity, idStructure);
                } else if (response === 'update') {
                    showAlertBootstrap(translations.success, 'Matriz actualizada');
                    getStructureMatrix(activity, idStructure);
                } else {
                    showAlertBootstrap1(translations.alert, translations.error, 'editMatriz');
                }
            },
            error: function(error) {
                console.error('Error sending data', error);
            }
        });
    });
});

function getStructureMatrix(activity, structure) {
    $.ajax({
        type: 'POST',
        url: 'controller/ajax/ajax.form.php',
        data: {
            activity: activity,
            searchStructureMatrix: structure
        },
        dataType: 'json',
        success: function (data) {
            if (data){
                
                $('#narrative-summary-' + activity).html(data.description);
                
                var activeElements = [];
                
                if (data.photos == 1) {
                    activeElements.push(translations.Photos);
                }
                if (data.videos == 1) {
                    activeElements.push(translations.Videos);
                }
                if (data.reports == 1) {
                    activeElements.push(translations.Reports_input);
                }
                if (data.attendance == 1) {
                    activeElements.push(translations.Attendance_lists);
                }
                if (data.agreements == 1) {
                    activeElements.push(translations.Agreements);
                }
                if (data.others == 1) {
                    activeElements.push(translations.Others);
                }
                
                var html = "<ul style='list-style-type: none; padding-left: 0;'>";
                activeElements.forEach(function(element) {
                    html += "<li>" + element + "</li>";
                });
                html += "</ul>";
                
                $('#goal-' + activity).html(data.goal);
                $('#risk-' + activity).html(data.risks);
                $('#init-date-' + activity).html(data.start_date);
                $('#end-date-' + activity).html(data.end_date);
                
                $('#verification-sources-' + activity).html(html);
                $('#indicator-' + activity).html(translations.Number_of +' '+ data.indicator_activity +' '+ translations.that +' '+ data.how);
            }

        }
    });
}

function getMatrixToEdit(activity, structure) {
    $.ajax({
        type: 'POST',
        url: 'controller/ajax/ajax.form.php',
        data: {
            activity: activity,
            searchStructureMatrix: structure
        },
        dataType: 'json',
        success: function(data) {
            if (data) {
                updateFormFields(data);
            } else {
                clearFormFields();
            }
        }
    });
}

function updateFormFields(data) {
    var fields = {
        description: data.description,
        startDate: data.start_date,
        endDate: data.end_date,
        frequency: data.frequency,
        indicator_activity: data.indicator_activity,
        how: data.how,
        What_goal_activity: data.goal,
        risks: data.risks,
        idMatrix: data.idMatrix,
        idStructure: data.idStructure,
        activityNumber: data.activity
    };

    for (var field in fields) {
        $('#' + field).val(fields[field]);
    }

    var evidenceTypes = ['photos', 'videos', 'reports_input', 'attendance', 'agreements', 'others'];
    evidenceTypes.forEach(function(type) {
        $('#' + type).prop('checked', data[type] == 1);
    });
}

function clearFormFields() {
    var fields = [
        'description',
        'startDate',
        'endDate',
        'frequency',
        'indicator_activity',
        'how',
        'What_goal_activity',
        'risks',
        'idMatrix'
    ];

    fields.forEach(function(field) {
        $('#' + field).val('');
    });

    var evidenceTypes = ['photos', 'videos', 'reports_input', 'attendance', 'agreements', 'others'];
    evidenceTypes.forEach(function(type) {
        $('#' + type).prop('checked', false);
    });
}