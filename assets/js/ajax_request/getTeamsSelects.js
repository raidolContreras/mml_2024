$(document).ready(function () {
    $.ajax({
        type: "POST",
        url: "controller/ajax/getTeams.php",
        success: function (response) {
            try {
                var teams = JSON.parse(response);
                var html = `<option value="">${translations.select_one}</option>`;
                teams.forEach(function(team) {
                    html += '<option value="' + team.idTeam + '">' + team.teamName + '</option>';
                });
                $("#teamSelectEdit").html(html);
                $(".teamSelectEdit").html(html);
            } catch (error) {
                console.error("Error al parsear la respuesta del servidor:", error);
            }
        },
        error: function(xhr, status, error) {
            console.error("Error en la solicitud AJAX:", error);
        }
    });
});
