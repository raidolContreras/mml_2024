$(document).ready(async function () {
    var project = $('#project').val();
    
    try {
        let response = await $.ajax({
            type: "POST",
            url: "controller/ajax/getTeams.php",
            data: {
                idProject: project
            },
            dataType: "json"
        });

        var html = '';
        var language = $('#language').val();
        await cargarTraducciones(language);

        html += `<option value="">${translations.select_one}</option>`;
        
        response.forEach(function(team) {
            html += '<option value="' + team.idTeam + '">' + team.teamName + '</option>';
        });
        
        $("#teamSelectEdit").html(html);
        $(".teamSelectEdit").html(html);

    } catch (error) {
        console.error("Error en la solicitud AJAX:", error);
    }
});
