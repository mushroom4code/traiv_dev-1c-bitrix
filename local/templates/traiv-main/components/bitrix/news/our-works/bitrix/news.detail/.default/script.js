$( document ).ready(function() { /* dirty fix. its hard to work with covid-19 */
    $('.crumbs__link').each(function( index ) {
        if ($(this).html() == 'Наши работы'){
            $(this).attr('href', '/services/proizvodstvo-metizov/works/')
        }
    });
});