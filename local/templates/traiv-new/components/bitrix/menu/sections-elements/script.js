$().ready(function() {
  /**
     * open city
     */
    $('.question-name').click(function() {
        $this = $(this);
        $('.question-element-list__item').click(function() {
            $this = $(this);
            $('.question-element-list__item--active').removeClass('question-element-list__item--active');
            $this.addClass('question-element-list__item--active');
            $('.question-element-list__item--active').addClass('question-element-list__item');
            $this.removeClass('question-element-list__item');
            
        });
        $('.question-element-list--active').slideUp(function() {
            $(this).parent().addClass('question-section');
            $(this).addClass('question-element-list');
            $(this).parent().removeClass('question-section--active');
            $(this).removeClass('question-element-list--active');
        });

        $(this).parent().find('.question-element-list').slideDown(function() {
            $(this).addClass('question-element-list--active');
            $(this).parent().addClass('question-section--active');
            $(this).removeClass('question-element-list');
            $(this).parent().removeClass('question-section');
            $(this).parent().parent().find('.question-section--almost-active').removeClass('question-section--almost-active').addClass('question-section');;
        });

    });
    $('.content__left_menu__header').on('click', function(e) {
        $('#vertical-multilevel-menu').toggleClass('active');
    });
});
var jsvhover = function()
{
	var menuDiv = document.getElementById("vertical-multilevel-menu");
	if (!menuDiv)
		return;

  var nodes = menuDiv.getElementsByTagName("li");
  for (var i=0; i<nodes.length; i++) 
  {
    nodes[i].onmouseover = function()
    {
      this.className += " jsvhover";
    }
    
    nodes[i].onmouseout = function()
    {
      this.className = this.className.replace(new RegExp(" jsvhover\\b"), "");
    }
  }
}

if (window.attachEvent) 
	window.attachEvent("onload", jsvhover); 
