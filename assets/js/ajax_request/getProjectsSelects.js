$(document).ready(function () {
    $.ajax({
        type: "POST",
        url: "controller/ajax/getProjects.php",
        success: function (response) {
            try {
                var projects = JSON.parse(response);
                var html = `<option value="" selected>${translations.select_one}</option>`;
                projects.forEach(function(project) {
                    html += '<option value="' + project.idProject + '">' + project.nameProject + '</option>';
                });
                $("#projectSelect").html(html);
                $("#projectSelectEdit").html(html);
            } catch (error) {
                console.error("Error al parsear la respuesta del servidor:", error);
            }
        },
        error: function(xhr, status, error) {
            console.error("Error en la solicitud AJAX:", error);
        }
    });
});
