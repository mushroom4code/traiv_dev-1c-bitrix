document.onmouseup = function(el) {

    var $selectedtext = window.getSelection().toString();

    var myData = $selectedtext;

    const modifyCopy = (e) => {
        e.clipboardData.setData('text/plain', myData);
        document.execCommand('copy');
        e.preventDefault();
    };

    document.addEventListener('copy', modifyCopy);
}