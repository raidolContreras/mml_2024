$(document).ready(async function () {
    try {
        let response = await $.ajax({
            type: "POST",
            url: "controller/ajax/getEvents.php",
            dataType: "json"
        });

        var html = '';
        var language = $('#language').val();
        await cargarTraducciones(language);

        html += `<option value="">${translations.select_one}</option>`;
        
        response.forEach(function(team) {
            html += '<option value="' + team.idEvent + '">' + team.eventName + '</option>';
        });
        
        $("#eventSelectEdit").html(html);

    } catch (error) {
        console.error("Error en la solicitud AJAX:", error);
    }
});
