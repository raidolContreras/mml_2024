$(document).ready(async function () {
    var language = $('#language').val();
    await cargarTraducciones(language);

    var level = $('#level').val();
    if (level != 0) {
        $('.teamSelect').hide();
        var idTeam = $('#idTeam').val();
        getMatrix(idTeam);
    } else {
        $('#teamSelectEdit').on('change', function () {
            var team = $('#teamSelectEdit').val();
            $('#idTeamSelect').val(team);

            if (team >= 1) {
                getMatrix(team);
            } else {
                $('.Structure').hide();
                $('.selectStructure').hide();
            }
        });
    }
});

let activities = Array(8).fill('');
let idStructure = 0;
var activityNumber;

function getMatrix(team) {
    $.ajax({
        type: 'POST',
        url: 'controller/ajax/ajax.form.php',
        data: { structureSelect: team },
        dataType: 'json',
        success: function (data) {
            if (!data || Object.keys(data).length === 0) {
                $('.matrix').hide();
                return;
            }

            let project = $('#project').val();
            let structureSelect = true;
            let numberActivities = 0;

            data.forEach(structure => {
                if (structure.idProject == project) {
                    structureSelect = false;

                    let product1 = structure.product1 || '';
                    let product2 = structure.product2 || '';

                    activities = [
                        structure.activity1,
                        structure.activity2,
                        structure.activity3,
                        structure.activity4,
                        structure.activity5,
                        structure.activity6,
                        structure.activity7,
                        structure.activity8
                    ];

                    numberActivities = activities.filter(activity => activity != null).length;

                    if (numberActivities === 8) {
                        idStructure = structure.idStructure;
                        $('#idStructure').val(idStructure);

                        activities.forEach((_, index) => {
                            getStructureMatrix(index + 1, idStructure);
                        });

                        $('.product01').html(product1);
                        $('.product02').html(product2);

                        activities.forEach((activity, index) => {
                            $('.activity0' + (index + 1)).html(activity || '');
                        });
                        $('.matrix').show();
                    } else {
                        $('.matrix').hide();
                        showAlertBootstrap2(translations.alert, translations.structure_no_activities, 'Structure');
                    }
                }
            });

            if (structureSelect) {
                $('.matrix').hide();
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log("Error en la solicitud AJAX:", textStatus, errorThrown);
        }
    });
}

$('.sendMatrix').on('click', sendMatrixData);

function sendMatrixData() {
    let formData = {
        description: $('#description').val(),
        startDate: $('#startDate').val(),
        endDate: $('#endDate').val(),
        frequency: $('#frequency').val(),
        indicatorActivity: $('#indicator_activity').val(),
        how: $('#how').val(),
        goal: $('#What_goal_activity').val(),
        risks: $('#risks').val(),
        evidenceTypes: {
            photos: $('#photos').is(':checked'),
            videos: $('#videos').is(':checked'),
            reports: $('#reports_input').is(':checked'),
            attendance: $('#attendance').is(':checked'),
            agreements: $('#agreements').is(':checked'),
            others: $('#others').is(':checked')
        },
        idMatrix: $('#idMatrix').val(),
        idStructure: idStructure,
        activity: activityNumber
    };

    $.ajax({
        type: "POST",
        url: "controller/ajax/ajax.form.php",
        data: formData,
        success: function (response) {
            $('#editMatriz').modal('hide');
            if (response === 'ok') {
                showAlertBootstrap(translations.success, 'Matriz agregada');
            } else if (response === 'update') {
                showAlertBootstrap(translations.success, 'Matriz actualizada');
            } else {
                showAlertBootstrap1(translations.alert, translations.error, 'editMatriz');
            }
            getStructureMatrix(formData.activity, formData.idStructure);
        },
        error: function (error) {
            console.error('Error sending data', error);
        }
    });
}

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
            if (data) {
                $('#narrative-summary-' + activity).html(data.description);
                let activeElements = [];

                if (data.photos == 1) activeElements.push(translations.Photos);
                if (data.videos == 1) activeElements.push(translations.Videos);
                if (data.reports == 1) activeElements.push(translations.Reports_input);
                if (data.attendance == 1) activeElements.push(translations.Attendance_lists);
                if (data.agreements == 1) activeElements.push(translations.Agreements);
                if (data.others == 1) activeElements.push(translations.Others);

                let html = "<ul style='list-style-type: none; padding-left: 0;'>" + activeElements.map(el => `<li>${el}</li>`).join('') + "</ul>";

                $('#goal-' + activity).html(data.goal);
                $('#risk-' + activity).html(data.risks);
                $('#init-date-' + activity).html(data.start_date);
                $('#end-date-' + activity).html(data.end_date);
                $('#verification-sources-' + activity).html(html);
                if (data.indicator_activity != null){
                    $('#indicator-' + activity).html(`${translations.Number_of} ${data.indicator_activity} ${translations.that} ${data.how}`);
                }
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
        success: function (data) {
            if (data) {
                updateFormFields(data);
            } else {
                clearFormFields();
            }
        }
    });
}

function updateFormFields(data) {
    console.log(data);
    const fields = {
        description: data.description,
        startDate: data.start_date,
        endDate: data.end_date,
        frequency: data.frequency,
        indicator_activity: data.indicator_activity,
        how: data.how,
        What_goal_activity: data.goal,
        risks: data.risks,
        idMatrix: data.idMatrix
    };

    Object.keys(fields).forEach(field => {
        $('#' + field).val(fields[field]);
    });

    const evidenceTypes = ['photos', 'videos', 'reports_input', 'attendance', 'agreements', 'others'];
    evidenceTypes.forEach(type => {
        console.log(data[type]);
        $('#' + type).prop('checked', data[type] == 1);
    });
}

function clearFormFields() {
    const fields = [
        'description', 'startDate', 'endDate', 'frequency',
        'indicator_activity', 'how', 'What_goal_activity', 'risks', 'idMatrix'
    ];

    fields.forEach(field => {
        $('#' + field).val('');
    });

    const evidenceTypes = ['photos', 'videos', 'reports_input', 'attendance', 'agreements', 'others'];
    evidenceTypes.forEach(type => {
        $('#' + type).prop('checked', false);
    });
}

function editMatriz(matriz) {
    let idStructure = $('#idStructure').val();
    $('#editMatriz').modal('show');
    $('#editMatrizLabel').text(activities[matriz - 1]);
    console.log(activities[matriz - 1]);
    activityNumber = matriz;
    $('#activityNumber').val(activityNumber);
    getMatrixToEdit(matriz, idStructure);
}
