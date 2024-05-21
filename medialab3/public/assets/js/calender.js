var startDate, endDate;
var daysOfWeek = ['Ma', 'Di', 'Wo', 'Do', 'Vr', 'Za', 'Zo'];
var monthsOfYear = ['Januari', 'Februari', 'Maart', 'April', 'Mei', 'Juni', 'Juli', 'Augustus', 'September', 'Oktober', 'November', 'December'];
var currentMonth = new Date().getMonth();
var currentYear = new Date().getFullYear();

// Instellen maand dat iets niet beschikbaar is
var blockedStartDate = new Date(currentYear, currentMonth, 13);
var blockedEndDate = new Date(currentYear, currentMonth, 19);

document.addEventListener('DOMContentLoaded', function() {
    generateCalendar(currentMonth, currentYear);

    document.getElementById('prevMonth').onclick = function() {
        if (currentMonth > 0) {
            currentMonth--;
        } else {
            currentMonth = 11;
            currentYear--;
        }
        generateCalendar(currentMonth, currentYear);
    };

    document.getElementById('nextMonth').onclick = function() {
        if (currentMonth < 11) {
            currentMonth++;
        } else {
            currentMonth = 0;
            currentYear++;
        }
        generateCalendar(currentMonth, currentYear);
    };
});

function generateCalendar(month, year) {
    var firstDay = (new Date(year, month, 1).getDay() + 6) % 7;

    var calendar = document.getElementById('calendar');
    calendar.innerHTML = '';

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

    var cells = document.getElementById('calendar').getElementsByTagName('td');
    for (var i = 0; i < cells.length; i++) {
        var day = parseInt(cells[i].innerText);
        var date = new Date(year, month, day);
        if (date >= blockedStartDate && date <= blockedEndDate) {
            cells[i].classList.add('blocked');
        }
    }

    document.getElementById('monthYear').innerText = monthsOfYear[month] + ' ' + year;
}

function selectDate(event) {
    if (event.target.classList.contains('blocked')) return;

    var cells = document.getElementById('calendar').getElementsByTagName('td');
    for (var i = 0; i < cells.length; i++) {
        cells[i].classList.remove('selected');
    }

    event.target.classList.add('selected');

    var selectedDate = new Date(currentYear, currentMonth, parseInt(event.target.innerText));
    var startOfWeek = new Date(selectedDate);
    startOfWeek.setDate(selectedDate.getDate() - selectedDate.getDay()); // Set start of week to Sunday
    var endOfWeek = new Date(startOfWeek);
    endOfWeek.setDate(startOfWeek.getDate() + 6); // Set end of week to Saturday

    /* for (var d = startOfWeek; d <= endOfWeek; d.setDate(d.getDate() + 1)) {
        for (var i = 0; i < cells.length; i++) {
            var day = parseInt(cells[i].innerText);
            var cellDate = new Date(currentYear, currentMonth, day);
            if (cellDate.toDateString() === d.toDateString()) {
                cells[i].classList.add('selected');
            }
        }
    } */

    document.getElementById('start_date').value = startOfWeek.toISOString().split('T')[0];
    document.getElementById('end_date').value = endOfWeek.toISOString().split('T')[0]; // Set end date to end of week
}
