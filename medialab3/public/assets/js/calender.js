document.addEventListener("DOMContentLoaded", function () {
    var daysOfWeek = ["Ma", "Di", "Wo", "Do", "Vr", "Za", "Zo"];
    var monthsOfYear = [
        "Januari", "Februari", "Maart", "April", "Mei", "Juni",
        "Juli", "Augustus", "September", "Oktober", "November", "December"
    ];
    var currentMonth = new Date().getMonth();
    var currentYear = new Date().getFullYear();

    var blockedDates = [];

    // Blokkeer alle datums voor vandaag en meer dan twee weken in de toekomst
    var today = new Date();
    var twoWeeksLater = new Date();
    twoWeeksLater.setDate(today.getDate() + 14);

    for (var d = new Date(currentYear, 0, 1); d < today; d.setDate(d.getDate() + 1)) {
        blockedDates.push(new Date(d));
    }
    for (var d = new Date(twoWeeksLater.getTime() + (24 * 60 * 60 * 1000)); d <= new Date(currentYear, 11, 31); d.setDate(d.getDate() + 1)) {
        blockedDates.push(new Date(d));
    }

    // Voeg de onbeschikbare datums uit de hidden input toe aan blockedDates
    var unavailable_dates_input = document.getElementById("unavailable_dates");
    if (unavailable_dates_input) {
        var unavailable_dates = JSON.parse(unavailable_dates_input.value);
        unavailable_dates.forEach(function (dateString) {
            var date = new Date(dateString);
            var startOfWeek = new Date(date);
            var dayOfWeek = startOfWeek.getDay();
            startOfWeek.setDate(startOfWeek.getDate() - ((dayOfWeek + 6) % 7));
            var endOfWeek = new Date(startOfWeek);
            endOfWeek.setDate(startOfWeek.getDate() + 4);

            while (startOfWeek <= endOfWeek) {
                blockedDates.push(new Date(startOfWeek));
                startOfWeek.setDate(startOfWeek.getDate() + 1);
            }
        });
    }

    console.log("Blocked Dates: ", blockedDates);

    generateCalendar(currentMonth, currentYear);

    document.getElementById("prevMonth").onclick = function () {
        changeMonth(-1);
    };

    document.getElementById("nextMonth").onclick = function () {
        changeMonth(1);
    };

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

    function generateCalendar(month, year) {
        var firstDay = new Date(year, month, 1).getDay();
        firstDay = (firstDay + 6) % 7;  // Zorg ervoor dat de week begint op maandag
        var daysInMonth = new Date(year, month + 1, 0).getDate();

        var calendar = document.getElementById("calendar");
        calendar.innerHTML = "";

        var headerRow = calendar.insertRow();
        for (var i = 0; i < 7; i++) {
            var cell = headerRow.insertCell();
            cell.innerText = daysOfWeek[i];
        }

        var row = calendar.insertRow();
        for (var i = 0; i < firstDay; i++) {
            row.insertCell();
        }

        for (var day = 1; day <= daysInMonth; day++) {
            if (row.cells.length == 7) {
                row = calendar.insertRow();
            }
            var cell = row.insertCell();
            var date = new Date(year, month, day);

            cell.innerText = day;
            if (date.getDay() === 1) {  // Alleen maandagen
                cell.onclick = selectDate;
            } else {
                cell.classList.add("blocked");
            }

            // Controleer of datum geblokkeerd is
            for (var blocked of blockedDates) {
                if (blocked.toDateString() === date.toDateString()) {
                    cell.classList.add("blocked");
                }
            }
        }

        document.getElementById("monthYear").innerText = monthsOfYear[month] + " " + year;
    }

    function selectDate(event) {
        if (event.target.classList.contains("blocked")) return;

        var cells = document.getElementById("calendar").getElementsByTagName("td");
        for (var i = 0; i < cells.length; i++) {
            cells[i].classList.remove("selected");
        }

        event.target.classList.add("selected");

        var selectedDate = new Date(currentYear, currentMonth, parseInt(event.target.innerText));
        var startOfWeek = new Date(selectedDate);
        var dayOfWeek = startOfWeek.getDay();
        startOfWeek.setDate(startOfWeek.getDate() - ((dayOfWeek + 6) % 7)); // Zorg ervoor dat het op maandag begint
        var endOfWeek = new Date(startOfWeek);
        endOfWeek.setDate(startOfWeek.getDate() + 4);  // Maandag tot Vrijdag

        for (var d = new Date(startOfWeek); d <= endOfWeek; d.setDate(d.getDate() + 1)) {
            for (var i = 0; i < cells.length; i++) {
                var day = parseInt(cells[i].innerText);
                var cellDate = new Date(currentYear, currentMonth, day);
                if (!isNaN(day) && cellDate.toDateString() === d.toDateString()) {
                    cells[i].classList.add("selected");
                }
            }
        }

        var adjustedStartOfWeek = new Date(startOfWeek);
        var adjustedEndOfWeek = new Date(endOfWeek);
        adjustedStartOfWeek.setDate(adjustedStartOfWeek.getDate() + 1);
        adjustedEndOfWeek.setDate(adjustedEndOfWeek.getDate() + 1);

        document.getElementById("start_date").value = adjustedStartOfWeek.toISOString().split("T")[0];
        document.getElementById("end_date").value = adjustedEndOfWeek.toISOString().split("T")[0];
    }
});
