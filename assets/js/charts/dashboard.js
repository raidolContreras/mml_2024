(function (jQuery) {
    "use strict";
    if (document.querySelectorAll('#d-activity').length) {
        // Función para inicializar el gráfico
        function initializeChart(data) {
            const options = {
                series: [{
                    name: '',
                    data: data.values
                }],
                chart: {
                    type: 'bar',
                    height: 400,
                    stacked: true,
                    toolbar: {
                        show: false
                    }
                },
                colors: ["#3a57e8", "#ff8c00", "#ff4500", "#32cd32", "#8a2be2", "#ff69b4", "#00ced1", "#ffd700"], // Colores distintos para cada barra
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '25%',
                        endingShape: 'rounded',
                        borderRadius: 10,
                    },
                },
                legend: {
                    show: false
                },
                dataLabels: {
                    enabled: true,
                    formatter: function (val) {
                        return val + "%"
                    }
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent'],
                    curve: 'smooth'
                },
                xaxis: {
                    categories: data.categories,
                    labels: {
                        minHeight: 50,
                        maxHeight: 55,
                        style: {
                            colors: "#8A92A6",
                            fontSize: '15px',
                            fontFamily: 'Arial, sans-serif',
                            fontWeight: 'bold',
                            textTransform: 'uppercase'
                        }
                    },
                },
                yaxis: {
                    max: 100, // Ajuste el máximo del eje y a 100
                    title: {
                        text: ''
                    },
                    labels: {
                        minWidth: 30, // Ajusta el ancho mínimo para que las etiquetas no se corten
                        maxWidth: 40, // Ajusta el ancho máximo si es necesario
                        style: {
                            colors: "#8A92A6",
                        },
                        formatter: function (val) {
                            return val + "%";
                        }
                    }
                },
                fill: {
                    opacity: 0.7
                },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return val + "%"
                        }
                    }
                }
            };

            const chart = new ApexCharts(document.querySelector("#d-activity"), options);
            chart.render();
            document.addEventListener('ColorChange', (e) => {
                const newOpt = { colors: [e.detail.detail1], }
                chart.updateOptions(newOpt)
            });
        }
        
        // Realiza la llamada AJAX para obtener los datos
        $.ajax({
            type: 'POST',
            url: 'controller/ajax/getPromedios.php',
            data: {
                idProject: $('#project').val()
            },
            dataType: 'json',
            success: function (response) {
                // Procesar los datos para obtener las categorías y valores
                const categories = response.map(item => item.teamName);
                const values = response.map(item => Math.round(item.progress_percentage * 100) / 100); // Redondear a 2 decimales
                
                const data = {
                    categories: categories,
                    values: values
                };
                initializeChart(data);
            },
            error: function (error) {
                console.error('Error al obtener los datos:', error);
            }
        });
    }
})(jQuery);
