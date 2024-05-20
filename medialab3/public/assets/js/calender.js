var startDate, endDate;
var daysOfWeek = ['Ma', 'Di', 'Wo', 'Do', 'Vr', 'Za', 'Zo'];
var monthsOfYear = ['Januari', 'Februari', 'Maart', 'April', 'Mei', 'Juni', 'Juli', 'Augustus', 'September', 'Oktober', 'November', 'December'];
var currentMonth = new Date().getMonth();
var currentYear = new Date().getFullYear();

//Instellen maand dat iets niet beschikbaar is
var blockedStartDate = new Date(currentYear, currentMonth, 13);
var blockedEndDate = new Date(currentYear, currentMonth, 19);

generateCalendar(currentMonth, currentYear);

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
                cell.onclick = selectWeek;
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

function selectWeek(event) {
    if (event.target.classList.contains('blocked')) return;

    var cells = document.getElementById('calendar').getElementsByTagName('td');
    for (var i = 0; i < cells.length; i++) {
        cells[i].classList.remove('selected');
    }

    var row = event.target.parentElement;
    var firstDayOfWeek = (new Date(currentYear, currentMonth, 1).getDay() + 6) % 7;
    var lastDayOfWeek = (new Date(currentYear, currentMonth + 1, 0).getDay() + 6) % 7;

    startDate = parseInt(row.firstElementChild.innerText);
    endDate = parseInt(row.lastElementChild.innerText); // Verhoog de einddatum met één

    var startMonth = currentMonth;
    var endMonth = currentMonth;

    if (isNaN(startDate)) {
        startDate = new Date(currentYear, currentMonth, 0).getDate() - firstDayOfWeek + 1;
        startMonth = currentMonth == 0 ? 11 : currentMonth - 1;
    }
    if (isNaN(endDate)) {
        endDate = new Date(currentYear, currentMonth + 2, 1).getDate() + (6 - lastDayOfWeek) - 1; // Verhoog de einddatum met één
        endMonth = (currentMonth + 1) % 12;
    }

    for (var i = 0; i < row.children.length; i++) {
        row.children[i].classList.add('selected');
    }
    console.log("begindatum: " + startDate + '/' + (startMonth + 1) + '/' + currentYear);
    console.log("einddatum: " + endDate + '/' + (endMonth + 1) + '/' + currentYear);
}

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