document.onmouseup = function(el) {

    var $selectedtext = window.getSelection().toString();

    var myData = "##### При копировании информационных материалов размещение обратной ссылки на сайт Трайв-Комплект (https://traiv-komplekt.ru) обязательно. " +
        "" +
        "В противном случае, согласно статье 146 УК РФ, мы можем подать на Вас в суд! #####" +
        "" +
        "" + $selectedtext;

    const modifyCopy = (e) => {
        e.clipboardData.setData('text/plain', myData);
        document.execCommand('copy');
        e.preventDefault();
    };

    document.addEventListener('copy', modifyCopy);
}