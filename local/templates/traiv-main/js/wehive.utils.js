function removeDoubleSpacesAndTrim(str) {
    if (str == undefined){
        return '';
    }

    str = str.replace(/\s\s/g, '');

    if (!String.prototype.trim) {
        (function () {
            var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
            String.prototype.trim = function () {
                return this.replace(rtrim, '');
            };
        })();
    }

    str = str.trim();
    return str;
}