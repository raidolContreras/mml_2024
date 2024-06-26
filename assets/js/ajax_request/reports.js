function seeReports(matrix) {
    $('#seeReports').modal('show');
}

function evidences(idEvidences) {
    $('#evidencesModal').modal('show');
    $('#seeReports').modal('hide');
}

function chargeEvidences(id) {
    
}

$('#teamSelectEdit').on('change', function() {
    var team = $('#teamSelectEdit').val();
    $('#idTeamSelect').val(team);
    if (team >= 1) {
        getMatrix(team);
    } else {
        $('.reports').css('display', 'none');
    }
});

let activities = Array(8).fill('');
let idStructure = 0;

async function getMatrix(team) {
    try {
        const response = await $.ajax({
            type: 'POST',
            url: 'controller/ajax/ajax.form.php',
            data: { structureSelect: team },
            dataType: 'json'
        });

        if (!response || Object.keys(response).length === 0) {
            $('.reports').css('display', 'none');
            return;
        }

        let project = $('#project').val();
        let structureSelect = true;
        let numberActivities = 0;
        let numberMatrix = 0;

        for (let structure of response) {
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
                idStructure = structure.idStructure;

                if (numberActivities === 8) {
                    for (let index = 0; index < activities.length; index++) {
                        const matrix = await getStructureMatrix(index + 1, idStructure);
                        if (matrix) {
                            numberMatrix++;
                        }
                    }
                    
                    if (numberMatrix === 8) {

                        $('.product01').html(product1);
                        $('.product02').html(product2);

                        activities.forEach((activity, index) => {
                            $('.activity0' + (index + 1)).html(activity || '');
                        });
                        
                        $('.reports').css('display', 'block');
                    }
                }
            }
        }

        if (structureSelect) {
            $('.reports').css('display', 'none');
        }
    } catch (error) {
        console.log("Error en la solicitud AJAX:", error);
    }
}

function getStructureMatrix(activity, structure) {
    return new Promise((resolve, reject) => {
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
                    $('.totalGoal0' + activity).html(data.goal);
                    let progress = (data.progress != null) ? data.progress : 0;
                    $('.totalProgress0' + activity).html(progress);
                    resolve(data);
                } else {
                    resolve(null);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                reject(errorThrown);
            }
        });
    });
}
