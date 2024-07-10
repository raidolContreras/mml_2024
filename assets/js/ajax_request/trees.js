var level = $('#level').val();
$(document).ready(function() {
    if (level == 0) {
        $('#teamSelectEdit').on('change', function() {
            var team = $('#teamSelectEdit').val();
            $('#idTeamSelect').val(team);
            if (team >= 1) {
                var project = $('#project').val();
                loadProblemTreeData(team, project);
            } else {
                $('.Comments').css('display', 'none');
                $('.chargerTree').css('display', 'none');
            }
        });
    } else {
        $('.teamSelect').css('display', 'none');
        loadProblemTreeData(parseInt($('#idTeam').val()), $('#project').val());
    }

    $('.target-card').on('click', function() {
        $('#editTreeModal').modal('show');
        $('.editTrees_btn').html($(this).data('name'));
        var inputEdit = $(this).data('text');
        $('#tree').val($(this).data('tree'));
        $('#column').val(inputEdit);
        $('#edit').val($('.' + inputEdit).html());
    });

    $('#editButton').on('click', function() {
        var edit = $('#edit').val();
        var column = $('#column').val();
        var tree = $('#tree').val();
        var idMainProblems = $('#idMainProblems').val();
        var idMainGoals = $('#idMainGoals').val();

        var idTeam = ($('#level').val() == 1) ? $('#idTeam').val() : $('#teamSelectEdit').val();
        var idProject = $('#project').val();

        $.ajax({
            type: 'POST',
            url: 'controller/ajax/ajax.form.php',
            data: {
                edit: edit,
                column: column,
                tree: tree,
                idMainProblems: idMainProblems,
                idMainGoals: idMainGoals,
                idTeam: idTeam,
                idProject: idProject
            },
            success: function(response) {
                if (response == 'ok') {
                    var project = $('#project').val();
                    $('#editTreeModal').modal('hide');
                    loadProblemTreeData(idTeam, project);
                }
            }
        });
    });

    function loadProblemTreeData(idTeam, project) {
        $.ajax({
            type: 'POST',
            url: 'controller/ajax/ajax.form.php',
            data: {
                loadProblemTreeData: idTeam,
                projectId: project
            },
            dataType: 'json',
            success: function(response) {

                    $('#idMainProblems').val(response.idMainProblems || '');
                    $('#idMainGoals').val(response.idMainGoals || '');

                    $('.nameMain01').html(response.nameMain01 || '');
                    $('.nameMain02').html(response.nameMain02 || '');
                    $('.nameMain03').html(response.nameMain03 || '');
                    $('.nameMain04').html(response.nameMain04 || '');
                    $('.nameEffect01').html(response.nameEffect01 || '');
                    $('.nameEffect02').html(response.nameEffect02 || '');
                    $('.nameEffect03').html(response.nameEffect03 || '');
                    $('.nameEffect04').html(response.nameEffect04 || '');
                    $('.centralProblem').html(response.centralProblem || '');
                    $('.causes01').html(response.causes01 || '');
                    $('.causes02').html(response.causes02 || '');
                    $('.causes03').html(response.causes03 || '');
                    $('.causes04').html(response.causes04 || '');
                    $('.mainCauses01').html(response.mainCauses01 || '');
                    $('.mainCauses02').html(response.mainCauses02 || '');
                    $('.mainCauses03').html(response.mainCauses03 || '');
                    $('.mainCauses04').html(response.mainCauses04 || '');

                    $('.mainResult01').html(response.mainResult01 || '');
                    $('.mainResult02').html(response.mainResult02 || '');
                    $('.mainResult03').html(response.mainResult03 || '');
                    $('.mainResult04').html(response.mainResult04 || '');
                    $('.result01').html(response.result01 || '');
                    $('.result02').html(response.result02 || '');
                    $('.result03').html(response.result03 || '');
                    $('.result04').html(response.result04 || '');
                    $('.mainObjetive').html(response.mainObjetive || '');
                    $('.action01').html(response.action01 || '');
                    $('.action02').html(response.action02 || '');
                    $('.action03').html(response.action03 || '');
                    $('.action04').html(response.action04 || '');
                    $('.mainAction01').html(response.mainAction01 || '');
                    $('.mainAction02').html(response.mainAction02 || '');
                    $('.mainAction03').html(response.mainAction03 || '');
                    $('.mainAction04').html(response.mainAction04 || '');

                    $('.chargerTree').css('display', 'flex');
                    
                    if (level == 0) {
                        $('.Comments').css('display', 'block');
                        fetchComments();
                    }
            }
        });
    }
});

const commentsList = document.getElementById('commentsList');

function openComment() {
    document.getElementById('commentText').value = '';
}

function fetchComments() {
    const idTeam = $('#teamSelectEdit').val();
    const fromTable = 'Trees';

    $.ajax({
        url: 'controller/ajax/getComments.php',
        type: 'POST',
        data: {
            idTeam: idTeam,
            fromTable: fromTable
        },
        dataType: 'json',
        success: function (data) {
            displayComments(data);
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

        let html = `
            <div class="comment-text flex-grow-1">${comment.comment}</div>
            <div class="comment-actions">
        `;

        if (comment.status == 1) {
            html += `
                <button class="btn btn-success" onclick="approveComment(this)">Aprobar</button>
            `;
        } else {
            html += `
                <button class="btn btn-success" disabled>Aprobado</button>
            `;
        }

        html += `
                <button class="btn btn-danger" onclick="deleteComment(this)">Borrar</button>
            </div>
        `;

        commentItem.innerHTML = html;
        commentsList.appendChild(commentItem);
    });
}

function addComment() {
    const commentText = document.getElementById('commentText').value.trim();
    const fromTable = 'Trees';
    const idTeam = $('#teamSelectEdit').val();
    
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