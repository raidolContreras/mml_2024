$(document).ready(function () {
    var project = $('#project').val();
    $.ajax({
        type: "POST",
        url: "controller/ajax/getTeams.php",
        data: {
            idProject: project
        },
        dataType: "json",
        success: function (response) {
                var html = `<option value="">${translations.select_one}</option>`;
                response.forEach(function(team) {
                    html += '<option value="' + team.idTeam + '">' + team.teamName + '</option>';
                });
                $("#teamSelectEdit").html(html);
                $(".teamSelectEdit").html(html);
        },
        error: function(xhr, status, error) {
            console.error("Error en la solicitud AJAX:", error);
        }
    });
});
