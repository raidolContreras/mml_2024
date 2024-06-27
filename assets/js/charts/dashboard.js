(function (jQuery) {
    "use strict";
    if (document.querySelectorAll('#d-activity').length) {
        // Función para inicializar el gráfico
        function initializeChart(data) {
            const options = {
                series: [{
                    name: 'Teams',
                    data: data.values
                }],
                chart: {
                    type: 'bar',
                    height: 300,
                    stacked: true,
                    toolbar: {
                        show: false
                    }
                },
                colors: "#3a57e8",
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
                        minHeight: 30,
                        maxHeight: 35,
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
                        minWidth: 19,
                        maxWidth: 19,
                        style: {
                            colors: "#8A92A6",
                        },
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
            url: 'controller/ajax/getTeams.php',
            dataType: 'json',
            success: function (response) {
                // Procesar los datos para obtener las categorías y valores
                const categories = response.map(item => item.teamName);
                const values = response.map(item => item.active); // Suponiendo que 'active' contiene el valor que quieres graficar
                
                const data = {
                    categories: categories,
                    values: values
                };
                initializeChart(data);

                $.ajax({
                    url: 'controller/ajax/getPromedios.php',
                    dataType: 'json',
                    success: function (response) {
                    }
                });
            },
            error: function (error) {
                console.error('Error al obtener los datos:', error);
            }
        });
    }
})(jQuery);
