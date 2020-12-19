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
        case 31:
            return date + "<sup>st</sup>";

        case 2:
        case 22:
            return date + "<sup>nd</sup>";

        case 3:
        case 23:
            return date + "<sup>rd</sup>";

        default:
            return date + "<sup>th</sup>";
    }
}

function fillInMonth() {
    //更新月份&年份顯示
    document.getElementById("cal-year").innerHTML = todayYear;
    document.getElementById("cal-month").innerHTML = getMonthByEnglish(todayMonth);

    var firstDayOfToday = new Date(todayYear, todayMonth, 1).getDay(); //取得當年當月1號的星期
    // console.log(firstDayOfToday);


    var monthDays = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31]; //每個月擁有的天數
    //2月閏年判斷
    if ((todayYear % 400 === 0) || (todayYear % 4 === 0 && todayYear % 100 != 0)) {
        monthDays[1] = 29;
    }

    //在日期格標籤上添加以及刪除class屬性
    for(i = 0;i <= 6; i++){
        if(date[i].classList.contains('prev-month-last-day')) date[i].classList.remove('prev-month-last-day');
    }
    if(firstDayOfToday > 0) date[firstDayOfToday-1].classList.add('prev-month-last-day');

    //填滿日期
    for (i = 0; i < monthDays[todayMonth]; i++) {
        date[firstDayOfToday + i].innerHTML = i + 1;
        if (date[firstDayOfToday + i].classList.contains('color')) date[firstDayOfToday + i].classList.remove('color');
    }

    //上個月的最後一天
    var lastMonth = todayMonth - 1;
    //如果只有單行敘述，可只列一排
    if (lastMonth === -1) lastMonth = 11;
    var lastDay = monthDays[lastMonth];
    for (var i = firstDayOfToday - 1; i >= 0; i--) {
        date[i].innerHTML = lastDay;
        date[i].classList.add("color");
        lastDay--;
    }

    //填下個月的開始
    var nextMonthOfFirstDay = firstDayOfToday + monthDays[todayMonth];
    // console.log(nextMonthOfFirstDay);
    j = 1;
    for (i = nextMonthOfFirstDay; i <= 41; i++) {
        date[i].innerHTML = j;
        date[i].classList.add("color");
        j++;
    }

    //移除今天日期元素
    if (document.getElementById("current-day")) {
        document.getElementById("current-day").removeAttribute("id");
    }
    //判斷是否為當天的日期
    if ((today.getMonth() === todayMonth) && (today.getFullYear() === todayYear)) {
        todayDate = today.getDate(); //取得今天的日期
        // console.log(todayDate);
        date[firstDayOfToday + todayDate - 1].setAttribute("id", "current-day"); //把屬性貼到今日的格子上
    }
    changeColor();
    
}

function previousMonth() {
    // console.log("上一個月");
    todayMonth--;
    if (todayMonth === -1) {
        todayMonth = 11; //當當月是一月的時候(0)，則前一個月為12月(11)
        todayYear--;
    }
    fillInMonth();
}

function nextMonth() {
    // console.log("下一個月");
    todayMonth++;
    if (todayMonth === 12) {
        todayMonth = 0;
        todayYear++;
    }
    fillInMonth();
}

document.onkeydown = function(e) {
    switch (e.keyCode) {
        case 37:
            previousMonth();
            break;
        case 39:
            nextMonth();
            break;
    }
};