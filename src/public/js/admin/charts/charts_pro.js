document.addEventListener("DOMContentLoaded", function () {

    var options = {
        chart: {
            type: 'area',
            height: 300
        },
        series: [{
            name: 'Asistencias Profesores',
            data: [30, 40, 38, 50, 55, 52, 60, 65, 62, 70, 75, 80] // Ejemplo
        }],
        xaxis: {
            categories: [
                "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
                "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
            ]
        },
        colors: ['#1cc88a'] 
    };

    var chart = new ApexCharts(document.querySelector("#chartProfesores"), options);
    chart.render();
});
