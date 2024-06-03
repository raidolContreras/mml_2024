
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
                $('.Structure').css('display', 'block');
                $('.selectStructure').css('display', 'none');
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

    if (checkedCount >= 2) {
        checkboxes.forEach(checkbox => {
            if (!checkbox.checked) {
                checkbox.disabled = true;
            }
        });
    } else {
        checkboxes.forEach(checkbox => {
            checkbox.disabled = false;
        });
    }
}

$('.send_Selections_btn').on('click', function() {
    const selectedOptions = [];
    $('.form-check-input:checked').each(function() {
        selectedOptions.push($(this).attr('id'));
    });

    $.ajax({
        type: 'POST',
        url: 'controller/ajax/ajax.form.php',
        data: {
            selectedOptions: selectedOptions
        },
        dataType: 'json',
        success: function (data) {
            if (data && Object.keys(data).length !== 0) {
                alert(data.message);
            }
        }
    });
});