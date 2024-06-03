
(function (jQuery) {
    "use strict";
    if (document.querySelectorAll('#d-activity').length) {
        const options = {
            series: [{
                name: '',
                data: [30, 50, 35, 60, 40, 80, 60]
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
                categories: [
                    'Equipo 1',
                    'Equipo 2',
                    'Equipo 3',
                    'Equipo 4',
                    'Equipo 5',
                    'Equipo 6',
                    'Equipo 7'
                ],
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
        })
    }

})(jQuery)
