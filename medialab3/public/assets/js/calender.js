document.addEventListener("DOMContentLoaded", function () {
    var daysOfWeek = ["Ma", "Di", "Wo", "Do", "Vr", "Za", "Zo"];
    var monthsOfYear = [
        "Januari", "Februari", "Maart", "April", "Mei", "Juni",
        "Juli", "Augustus", "September", "Oktober", "November", "December"
    ];
    var currentMonth = new Date().getMonth();
    var currentYear = new Date().getFullYear();

    var blockedDates = [];

    // Blokkeer alle datums voor vandaag
    var today = new Date();
    for (var d = new Date(currentYear, 0, 1); d < today; d.setDate(d.getDate() + 1)) {
        blockedDates.push(new Date(d));
    }

    // Voeg de onbeschikbare datums uit de hidden input toe aan blockedDates
    var unavailable_dates_input = document.getElementById("unavailable_dates");
    if (unavailable_dates_input) {
        var unavailable_dates = JSON.parse(unavailable_dates_input.value);
        unavailable_dates.forEach(function (dateString) {
            var date = new Date(dateString);
            var sixDaysBefore = new Date(date);
            sixDaysBefore.setDate(date.getDate() - 5);

            var endDate = new Date(date);
            endDate.setDate(date.getDate() + 6);

            while (sixDaysBefore <= endDate) {
                blockedDates.push(new Date(sixDaysBefore));
                sixDaysBefore.setDate(sixDaysBefore.getDate() + 1);
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

        var cells = calendar.getElementsByTagName("td");
        for (var blocked of blockedDates) {
            for (var i = 0; i < cells.length; i++) {
                var day = parseInt(cells[i].innerText);
                var cellDate = new Date(year, month, day);
                if (!isNaN(day) && blocked.toDateString() === cellDate.toDateString()) {
                    cells[i].classList.add("blocked");
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
        var dayOfWeek = selectedDate.getDay();
        var startOfWeek = new Date(selectedDate);
        startOfWeek.setDate(selectedDate.getDate() - ((dayOfWeek + 6) % 7));
        var endOfWeek = new Date(startOfWeek);
        endOfWeek.setDate(startOfWeek.getDate() + 6);

        for (var d = new Date(startOfWeek); d <= endOfWeek; d.setDate(d.getDate() + 1)) {
            for (var i = 0; i < cells.length; i++) {
                var day = parseInt(cells[i].innerText);
                var cellDate = new Date(currentYear, currentMonth, day);
                if (!isNaN(day) && cellDate.toDateString() === d.toDateString()) {
                    cells[i].classList.add("selected");
                }
            }
        }

        document.getElementById("start_date").value = startOfWeek.toISOString().split("T")[0];
        document.getElementById("end_date").value = endOfWeek.toISOString().split("T")[0];
    }
});
