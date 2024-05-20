$(document).ready(function () {
  // Obtener los proyectos y cargar las opciones en el select
  showColorsProject();
  selectProject($("#project").val());

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
            $("#project").val(selectedValue);
            selectProject($("#project").val());
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
    dataType: "json",
    success: function (response) {
      var html = `<option>${translations.select_one}</option>`;
      
      response.forEach(function (project) {

        var idProject = $("#project").val();

        var selected = (project.idProject == idProject )? "selected" : '';

        html += '<option value="' + project.idProject + '" '+ selected +' >' + project.nameProject + '</option>';

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

function selectProject(project) {
  $.ajax({
    type: "POST",
    url: "controller/ajax/getProjectsAdmin.php",
    data: {
      project: project
    },
    dataType: 'json',
    success: function (response) {
        
        $("#problemColor").val(response.problem);
        $(".problemDiv .clr-field").attr("style", `color: ${response.problem}`);

        $("#effectColor").val(response.effect);
        $(".effectDiv .clr-field").attr("style", `color: ${response.effect}`);

        $("#causeColor").val(response.cause);
        $(".causeDiv .clr-field").attr("style", `color: ${response.cause}`);

        $("#objectiveColor").val(response.objetive);
        $(".objetiveDiv .clr-field").attr("style", `color: ${response.objetive}`);

        $("#resultColor").val(response.result);
        $(".resutDiv .clr-field").attr("style", `color: ${response.result}`);

        $("#actionColor").val(response.action);
        $(".actionDiv .clr-field").attr("style", `color: ${response.action}`);

        $("#productColor").val(response.product);
        $(".productDiv .clr-field").attr("style", `color: ${response.product}`);
    }

  });
}

