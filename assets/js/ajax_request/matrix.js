
$('#teamSelectEdit').on('change', function() {
    var team = $('#teamSelectEdit').val();
    $('#idTeamSelect').val(team);
    
    if (team >= 1) {
        getMatrix(team);
    } else {
        $('.matrix').css('display', 'none');
    }
});

function getMatrix(team) {
    $.ajax({
        type: 'POST',
        url: 'controller/ajax/ajax.form.php',
        data: {
            structureSelect: team
        },
        dataType: 'json',
        success: function (data) {
            if (data && Object.keys(data).length === 0) {
                $('.matrix').css('display', 'none');
            } else {
                var project = $('#project').val();
                var structureSelect = true;
                data.forEach(structure => {
                    if (structure.idProject == project) {
                        structureSelect = false;
                        problem1 = structure.problem1.substr(-2);
                        problem2 = structure.problem2.substr(-2);

                        // Verifica si los campos de structure son nulos o indefinidos y asigna mensajes predeterminados si es necesario
                        var product1 = structure.product1;
                        var product2 = structure.product2;
                        
                        var activity1 = structure.activity1;
                        var activity2 = structure.activity2;
                        var activity3 = structure.activity3;
                        var activity4 = structure.activity4;
                        var activity5 = structure.activity5;
                        var activity6 = structure.activity6;
                        var activity7 = structure.activity7;
                        var activity8 = structure.activity8;
                        
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
                        
                        $('.matrix').css('display', 'block');
                    }
                });
                if (structureSelect) {
                    $('.matrix').css('display', 'none');
                }
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log("Error en la solicitud AJAX:", textStatus, errorThrown);
        }
    });
}