$(document).ready(function () {
  // Obtener los proyectos y cargar las opciones en el select
  showColorsProject();

  $("#projectActive").on("change", function () {
    var selectedValue = $(this).val();
    if (selectedValue !== "Select an option") {
      $.ajax({
        type: "POST",
        url: "controller/ajax/ajax.form.php",
        data: {
          changeActive: selectedValue
        },
        success: function (response) {
          if (response === "ok") {
            showColorsProject();
            showAlertBootstrap(translations.success, translations.projectActive);
          } else {
            showAlertBootstrap(translations.alert, translations.projectActiveError);
          }
        },
        error: function (xhr, status, error) {
          console.error("Error en la solicitud AJAX:", error);
        }
      });
    }
  });
  $("#sendButton").on("click", function () {
    var problem = $("#problemColor").val();
    var effect = $("#effectColor").val();
    var cause = $("#causeColor").val();
    var objetive = $("#objectiveColor").val();
    var result = $("#resultColor").val();
    var action = $("#actionColor").val();
    var product = $("#productColor").val();
    var project = $("#projectActive").val();
    $.ajax({
      type: "POST",
      url: "controller/ajax/ajax.form.php",
      data: {
        problem: problem,
        effect: effect,
        cause: cause,
        objetive: objetive,
        result: result,
        action: action,
        product: product,
        project: project
      },
      success: function (response) {
        if (response === "ok") {
          showAlertBootstrap(translations.success, translations.updateProject);
        } else {
          showAlertBootstrap(translations.alert, translations.errorUpdateProject);
        }
      },
      error: function (xhr, status, error) {
        console.error("Error en la solicitud AJAX:", error);
      }
    });
  });
});

function showColorsProject() {
  $.ajax({
    type: "POST",
    url: "controller/ajax/getProjects.php",
    success: function (response) {
      var projects = JSON.parse(response);
      var html = `<option>${translations.select_one}</option>`;
      
      projects.forEach(function (project) {
        var selected = (project.active === 1) ? "selected" : '';
        html += '<option value="' + project.idProject + '" ' + selected + '>' + project.nameProject + '</option>';
        if (project.active === 1) {
          
          $("#problemColor").val(project.problem);
          $(".problemDiv .clr-field").attr("style", `color: ${project.problem}`);

          $("#effectColor").val(project.effect);
          $(".effectDiv .clr-field").attr("style", `color: ${project.effect}`);

          $("#causeColor").val(project.cause);
          $(".causeDiv .clr-field").attr("style", `color: ${project.cause}`);

          $("#objectiveColor").val(project.objetive);
          $(".objetiveDiv .clr-field").attr("style", `color: ${project.objetive}`);

          $("#resultColor").val(project.result);
          $(".resutDiv .clr-field").attr("style", `color: ${project.result}`);

          $("#actionColor").val(project.action);
          $(".actionDiv .clr-field").attr("style", `color: ${project.action}`);

          $("#productColor").val(project.product);
          $(".productDiv .clr-field").attr("style", `color: ${project.product}`);
        }
      });

      $("#projectActive").html(html);
      Coloris({
        themeMode: 'dark',
        alpha: false
      });
    },
    error: function (xhr, status, error) {
      console.error("Error en la solicitud AJAX:", error);
    }
  });
}

