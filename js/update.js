function update() {
    var today = new Date();
    document.getElementById("cur-date").innerHTML = addOrdinalIndicator(today.getDate());
    document.getElementById("cur-month").innerHTML = getMonthByEnglish(today.getMonth());
    document.getElementById("cur-day").innerHTML = getDayByEnglish(today.getDay());
    document.getElementById("cur-year").innerHTML = today.getFullYear();
    document.getElementById("cal-month").innerHTML = getMonthByEnglish(today.getMonth());
    document.getElementById("cal-year").innerHTML = today.getFullYear();
    document.getElementById("back-year").innerHTML = today.getFullYear();
}

function getDayByEnglish(day) {
    if (day == 0) return "Sunday";
    if (day == 1) return "Monnday";
    if (day == 2) return "Tuesday";
    if (day == 3) return "Wednesday";
    if (day == 4) return "Thursday";
    if (day == 5) return "Friday";
    if (day == 6) return "Saturday";
}

function getMonthByEnglish(mon) {
    // if (mon == 0) return "Janary";
    // if (mon == 1) return "Fabruary";
    // if (mon == 2) return "Month";
    // if (mon == 3) return "April";
    // if (mon == 4) return "May";
    // if (mon == 5) return "Jun";
    // if (mon == 6) return "July";
    // if (mon == 7) return "August";
    // if (mon == 8) return "September";
    // if (mon == 9) return "Octorber";
    // if (mon == 10) return "November";
    // if (mon == 11) return "December";

    var monthName = ["January", "Fabruary", "Month", "April", "May", "Jun", "July", "August", "September", "October", "November", "December"];
    return monthName[mon];
}

function addOrdinalIndicator(date) {
    switch (date) {
        case 1:
        case 21:
        case 31: date + "<sup>st</sup>";

        case 2:
        case 22: return date + "<sup>nd</sup>";

        case 3:
        case 23: return date + "<sup>rd</sup>";

        default: return date + "<sup>th</sup>";
    }
}