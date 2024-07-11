$(document).ready(function(){
    $( ".grey-tag-word" ).wrapAll( "<div class='grey-tags' />").insertAfter($(".section_description "));
    $( ".grey-tag-word:first-of-type").before('<div class=\'tag-title\'>Рубрики: </div>');
});
