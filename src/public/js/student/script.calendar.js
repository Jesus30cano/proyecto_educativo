// Calendario simple con JavaScript
document.addEventListener("DOMContentLoaded", function () {
  const calendar = document.getElementById("calendar");
  const today = new Date();
  const currentMonth = today.getMonth();
  const currentYear = today.getFullYear();

  const monthNames = [
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
  ];

  const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
  const firstDay = new Date(currentYear, currentMonth, 1).getDay();

  let calendarHTML = `
          <div class="text-center mb-3">
            <h5>${monthNames[currentMonth]} ${currentYear}</h5>
          </div>
          <table class="table table-bordered text-center">
            <thead>
              <tr>
                <th>Dom</th>
                <th>Lun</th>
                <th>Mar</th>
                <th>Mié</th>
                <th>Jue</th>
                <th>Vie</th>
                <th>Sáb</th>
              </tr>
            </thead>
            <tbody>
        `;

  let day = 1;
  for (let i = 0; i < 6; i++) {
    calendarHTML += "<tr>";
    for (let j = 0; j < 7; j++) {
      if (i === 0 && j < firstDay) {
        calendarHTML += "<td></td>";
      } else if (day > daysInMonth) {
        calendarHTML += "<td></td>";
      } else {
        const isToday = day === today.getDate() ? "table-primary" : "";
        calendarHTML += `<td class="${isToday}">${day}</td>`;
        day++;
      }
    }
    calendarHTML += "</tr>";
    if (day > daysInMonth) break;
  }

  calendarHTML += "</tbody></table>";
  calendar.innerHTML = calendarHTML;
});
