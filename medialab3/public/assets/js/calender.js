document.addEventListener("DOMContentLoaded", function () {
    var startDate, endDate;
    var daysOfWeek = ["Ma", "Di", "Wo", "Do", "Vr", "Za", "Zo"];
    var monthsOfYear = [
        "Januari",
        "Februari",
        "Maart",
        "April",
        "Mei",
        "Juni",
        "Juli",
        "Augustus",
        "September",
        "Oktober",
        "November",
        "December",
    ];
    var currentMonth = new Date().getMonth();
    var currentYear = new Date().getFullYear();

    // Geblokkeerde datums, initieel leeg, dynamisch in te stellen
    var blockedDates = [];

    // Check of unavailable_dates is ingesteld en zo ja, converteer naar een array van Date-objecten
    var unavailable_dates_input = document.getElementById("unavailable_dates");
    if (unavailable_dates_input) {
        var unavailable_dates = JSON.parse(unavailable_dates_input.value);
        blockedDates = unavailable_dates.flatMap(function (dateString) {
            var date = new Date(dateString);
            // Voeg de huidige onbeschikbare datum toe
            var blockedDates = [date];
            // Voeg zes dagen voor de huidige onbeschikbare datum toe
            var sixDaysBefore = new Date(date);
            sixDaysBefore.setDate(date.getDate() - 5);
            blockedDates.push(sixDaysBefore);

            var endDate = new Date(date);
            endDate.setDate(date.getDate()); // Einddatum is 6 dagen na de onbeschikbare datum
            while (sixDaysBefore < endDate) {
                sixDaysBefore.setDate(sixDaysBefore.getDate() + 1);
                blockedDates.push(new Date(sixDaysBefore)); // Voeg de tussenliggende datum toe
            }
            return blockedDates;
        });
    }

    // Bepaal de huidige datum en bereken de start van de huidige week (maandag)
    var today = new Date();
    var startOfCurrentWeek = new Date(today);
    startOfCurrentWeek.setDate(today.getDate() - ((today.getDay() + 6) % 7)); // Start van de huidige week (maandag)

    // Voeg alle datums tot en met de huidige week toe aan de geblokkeerde datums
    for (
        var d = new Date(currentYear, 0, 1);
        d <= startOfCurrentWeek;
        d.setDate(d.getDate() + 1)
    ) {
        blockedDates.push(new Date(d));
    }

    // Voeg alle datums tot en met de rest van de week toe aan de geblokkeerde datums
    var endOfCurrentWeek = new Date(startOfCurrentWeek);
    endOfCurrentWeek.setDate(endOfCurrentWeek.getDate() + 6); // Eind van de huidige week (zondag)
    for (
        var d = new Date(today);
        d <= endOfCurrentWeek;
        d.setDate(d.getDate() + 1)
    ) {
        blockedDates.push(new Date(d));
    }

    // Kalender genereren bij het laden van de pagina
    generateCalendar(currentMonth, currentYear);

    // Event listeners voor maandnavigatie
    document.getElementById("prevMonth").onclick = function () {
        changeMonth(-1);
    };

    document.getElementById("nextMonth").onclick = function () {
        changeMonth(1);
    };

    // Functie om de maand te wijzigen
    function changeMonth(delta) {
        currentMonth += delta;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        } else if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        generateCalendar(currentMonth, currentYear);
    }

    // Kalender genereren
    function generateCalendar(month, year) {
        var firstDay = (new Date(year, month, 1).getDay() + 6) % 7;

        var calendar = document.getElementById("calendar");
        calendar.innerHTML = "";

        var headerRow = calendar.insertRow();
        for (var i = 0; i < 7; i++) {
            var cell = headerRow.insertCell();
            cell.innerText = daysOfWeek[i];
        }

        for (var i = 0; i < 6; i++) {
            var row = calendar.insertRow();
            for (var j = 0; j < 7; j++) {
                var cell = row.insertCell();
                var day = i * 7 + j - firstDay + 1;
                if (day > 0 && day <= new Date(year, month + 1, 0).getDate()) {
                    cell.innerText = day;
                    cell.onclick = selectDate;
                }
            }
        }

        // Markeer geblokkeerde datums
        var cells = calendar.getElementsByTagName("td");
        for (var blocked of blockedDates) {
            for (var i = 0; i < cells.length; i++) {
                var day = parseInt(cells[i].innerText);
                var cellDate = new Date(year, month, day);
                if (blocked.toDateString() === cellDate.toDateString()) {
                    cells[i].classList.add("blocked");
                }
            }
        }

        document.getElementById("monthYear").innerText =
            monthsOfYear[month] + " " + year;
    }

    // Datum selecteren
    function selectDate(event) {
        if (event.target.classList.contains("blocked")) return;

        var cells = document
            .getElementById("calendar")
            .getElementsByTagName("td");
        for (var i = 0; i < cells.length; i++) {
            cells[i].classList.remove("selected");
        }

        event.target.classList.add("selected");

        var selectedDate = new Date(
            currentYear,
            currentMonth,
            parseInt(event.target.innerText)
        );
        var dayOfWeek = selectedDate.getDay();
        var startOfWeek = new Date(selectedDate);
        startOfWeek.setDate(selectedDate.getDate() - ((dayOfWeek + 6) % 7)); // Set start of week to Monday
        var endOfWeek = new Date(startOfWeek);
        endOfWeek.setDate(startOfWeek.getDate() + 6); // Set end of week to Sunday

        // Markeer de geselecteerde week
        for (
            var d = new Date(startOfWeek);
            d <= endOfWeek;
            d.setDate(d.getDate() + 1)
        ) {
            for (var i = 0; i < cells.length; i++) {
                var day = parseInt(cells[i].innerText);
                var cellDate = new Date(currentYear, currentMonth, day);
                if (cellDate.toDateString() === d.toDateString()) {
                    cells[i].classList.add("selected");
                }
            }
        }

        // Stel de start- en einddatum in
        document.getElementById("start_date").value = startOfWeek
            .toISOString()
            .split("T")[0];
        document.getElementById("end_date").value = endOfWeek
            .toISOString()
            .split("T")[0];
    }
});
