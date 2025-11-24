document.addEventListener("DOMContentLoaded", function () {
  var options = {
    chart: {
      type: "area",
      height: 300,
    },
    series: [
      {
        name: "Asistencias Estudiantes",
        data: [45, 60, 55, 70, 66, 80, 90, 95, 75, 88, 92, 100], // Ejemplo
      },
    ],
    xaxis: {
      categories: [
        "Enero",
        "Febrero",
        "Marzo",
        "Abril",
        "Mayo",
        "Junio",
        "Julio",
        "Agosto",
        "Septiembre",
        "Octubre",
        "Noviembre",
        "Diciembre",
      ],
    },
    colors: ["#4e73df"], // azul sb-admin-2
  };

  var chart = new ApexCharts(
    document.querySelector("#chartEstudiantes"),
    options
  );
  chart.render();
});
