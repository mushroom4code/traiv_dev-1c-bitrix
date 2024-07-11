function decrementTime() {

    var d = document.getElementById("action-timer-days");
    var h = document.getElementById("action-timer-hours");
    var m = document.getElementById("action-timer-minutes");
    var s = document.getElementById("action-timer-seconds");

    var $watches = $('#action-timer-watches');
    

    var baseTime = new Date(
        parseInt($watches.data("year")),
        parseInt($watches.data("month")) - 1,
        parseInt($watches.data("day")),
        parseInt($watches.data("hour")),
        parseInt($watches.data("minute")),
        parseInt($watches.data("second"))
    );


    var cur = new Date();
    // сколько осталось миллисекунд
    var diff = (baseTime - cur);
    // сколько миллисекунд до конца секунды
    //var millis = diff % 1000;
    diff = Math.floor(diff/1000);
    // сколько секунд до конца минуты
    var sec = diff % 60;
    if(sec < 10) sec = "0"+sec;
    diff = Math.floor(diff/60);
    // сколько минут до конца часа
    var min = diff % 60;
    if(min < 10) min = "0"+min;
    diff = Math.floor(diff/60);
    // сколько часов до конца дня
    var hours = diff % 24;
    if(hours < 10) hours = "0"+hours;

    d.innerHTML = Math.floor(diff / 24);
    h.innerHTML = hours;
    m.innerHTML = min;
    s.innerHTML = sec;

}

$(window).load(function () {
    setInterval(decrementTime, 1000);
});
