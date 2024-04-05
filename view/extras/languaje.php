<!-- Languages -->
<script>

    var translations;

    function cargarTraducciones(idioma) {
        var ruta = 'assets/languajes/' + idioma + '.json';
        if (idioma == 'en') {
            $('.languaje-selected').attr('src', 'assets/images/Flag/flag001.png');
            $('#english').addClass('active');
            
        } else {
            $('.languaje-selected').attr('src', 'assets/images/Flag/flag-03.png');
            $('#spanish').addClass('active');
        }
        fetch(ruta)
            .then(response => response.json())
            .then(data => {
                translations = data;
                $('#dashboard').html(translations.dashboard);
                $('#admin').html(translations.admin);
                $('#team').html(translations.team);
                $('#trees').html(translations.trees);
                $('#structure').html(translations.structure);
                $('#matriz').html(translations.matriz);
                $('#reports').html(translations.reports);
                $('#events').html(translations.events);
                $('#summary').html(translations.summary);
            })
            .catch(error => console.error('Error al cargar las traducciones: ', error));
    }

    // Uso
    cargarTraducciones('es');

</script>
