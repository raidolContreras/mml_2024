var team = ($('#level').val() != 0) ? $('#idTeam').val() : $('#teamSelectEdit').val();
var level = $('#level').val();

if (level != 0 ) {
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
    
    let project = $('#project').val();
    $.ajax({
        type: 'POST',
        url: 'controller/ajax/ajax.form.php',
        data: { structureSelect: team, project: project},
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
                        mainAction1 = structure.mainAction1.substr(-2);
                        mainAction2 = structure.mainAction2.substr(-2);

                        $('#idStructure').val(structure.idStructure);
                        $('.main_results01').html(structure['mainResult'+mainAction1]);
                        $('.main_results02').html(structure['mainResult'+mainAction2]);
                        $('.main_objetive01').html(structure.mainObjetive);
                        $('.main_objetive02').html(structure.mainObjetive);
                        $('.action01').html(structure['action'+mainAction1]);
                        $('.action02').html(structure['action'+mainAction2]);
                        $('.main_actions01').html(structure['mainAction'+mainAction1]);
                        $('.main_actions02').html(structure['mainAction'+mainAction2]);
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
                    
                        fetchComments();
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
                
                $('.mainAction01').html(data.mainAction01);
                $('.mainAction02').html(data.mainAction02);
                $('.mainAction03').html(data.mainAction03);
                $('.mainAction04').html(data.mainAction04);
                $('#mainGoals').val(data.idMainGoals);
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
                    $('.Structure').hide();
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
    var idMainGoals = $('#mainGoals').val();

    $.ajax({
        type: 'POST',
        url: 'controller/ajax/ajax.form.php',
        data: {
            selectedOptions: selectedOptions,
            team: team,
            idMainGoals: idMainGoals
        },
        success: function (data) {
            if (data === 'ok') {
                showAlertBootstrap(translations.success, translations.select_Problems_Alert);
                structureSelect(team);
            }
        }
    });
});

function updateData(columnName) {
    var idStructure = $('#idStructure').val();
    $('#editModal').modal('show');
    
    // Truncar columnName eliminando el último carácter
    var truncatedColumnName = columnName.slice(0, -1);

    $.ajax({
        type: 'POST',
        url: 'controller/ajax/ajax.form.php',
        data: {
            searchStructure: idStructure,
        },
        dataType: 'json',
        success: function (data) {
            $('#value').val(data[columnName]);
            $('#columnName').val(columnName);
            
            $('#modalLabelEdit').html(translations[truncatedColumnName]);
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

const commentsList = document.getElementById('commentsList');

function openComment() {
    document.getElementById('commentText').value = '';
}

function fetchComments() {
    const idTeam = $('#teamSelectEdit').val();
    const fromTable = 'Structure';

    $.ajax({
        url: 'controller/ajax/getComments.php',
        type: 'POST',
        data: {
            idTeam: idTeam,
            fromTable: fromTable
        },
        dataType: 'json',
        success: function (data) {
            if (level == 0) {
                $('.Comments').css('display', 'block');
            }
            
            displayComments(data);
            $('.CommentsList').css('display', 'block');
        },
        error: function (error) {
            console.error('Error:', error);
        }
    });
}


function displayComments(comments) {
    commentsList.innerHTML = '';

    if (comments.length === 0) {
        commentsList.innerHTML = '<div class="col-12 text-center">No hay comentarios disponibles.</div>';
        return;
    }

    comments.forEach(comment => {
        const commentItem = document.createElement('div');
        commentItem.className = 'col-5 comment-item d-flex align-items-center m-3';
        commentItem.setAttribute('data-id', comment.idComment);

        const commentText = `<div class="comment-text flex-grow-1">${comment.comment}</div>`;
        let actions = '<div class="comment-actions">';

        if (comment.status != 1) {
            actions += `<button class="btn btn-success" disabled>Aprobado</button>`;
        } else if (level == 0) {
            actions += `<button class="btn btn-success" onclick="approveComment(this)">Aprobar</button>`;
        }

        if (level == 0) {
            actions += `<button class="btn btn-danger" onclick="deleteComment(this)">Borrar</button>`;
        }

        actions += `</div>`;

        commentItem.innerHTML = commentText + actions;
        commentsList.appendChild(commentItem);
    });
}

function addComment() {
    const commentText = document.getElementById('commentText').value.trim();
    const fromTable = 'Structure';
    const idTeam = ($('#level').val() == 1) ? $('#idTeam').val() : $('#teamSelectEdit').val();
    
    if (commentText === '') {
        alert('El comentario no puede estar vacío.');
        return;
    }

    $.ajax({
        url: 'controller/ajax/addComments.php',
        type: 'POST',
        data: {
            comment: commentText,
            fromTable: fromTable,
            idTeam: idTeam
        },
        success: function (data) {
            if (data === 'ok') {
                $('#commetModal').modal('hide');
                fetchComments();
            } else {
                alert('Error al enviar el comentario.');
                $('#commetModal').modal('hide');
            }
        },
        error: function (error) {
            console.error('Error:', error);
        }
    });

    document.getElementById('commentText').value = '';
    const commentModal = bootstrap.Modal.getInstance(document.getElementById('commetModal'));
    commentModal.hide();
}

function deleteComment(button) {
    const commentItem = button.closest('.comment-item');
    const commentId = commentItem.getAttribute('data-id');

    $.ajax({
        url: 'controller/ajax/deleteComment.php',
        type: 'POST',
        data: { id: commentId },
        success: function (response) {
            if (response === 'ok') {
                commentsList.removeChild(commentItem);
                alert('Comentario eliminado exitosamente.');
            } else {
                alert('Error al eliminar el comentario.');
            }
        },
        error: function (error) {
            console.error('Error:', error);
        }
    });
}

function approveComment(button) {
    const commentItem = button.closest('.comment-item');
    const commentId = commentItem.getAttribute('data-id');

    $.ajax({
        url: 'controller/ajax/approveComment.php',
        type: 'POST',
        data: { id: commentId },
        success: function (response) {
            if (response === 'ok') {
                commentItem.classList.add('approved');
                button.disabled = true;
                button.textContent = 'Aprobado';
                alert('Comentario aprobado exitosamente.');
            } else {
                alert('Error al aprobar el comentario.');
            }
        },
        error: function (error) {
            console.error('Error:', error);
        }
    });
}