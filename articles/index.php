<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Статьи о крепеже и метизах");
$APPLICATION->SetPageProperty("title", "Статьи о крепеже и метизах");
$APPLICATION->SetTitle("Статьи о крепеже и метизах");

if(empty($_REQUEST['PAGE_COUNT'])){
    $_REQUEST['PAGE_COUNT'] = 9;
} ?>


    <section id="content">
        <div class="container">

            <? $APPLICATION->IncludeComponent(
	"bitrix:breadcrumb", 
	"traiv-new", 
	array(
		"COMPONENT_TEMPLATE" => "traiv",
		"START_FROM" => "0",
		"PATH" => "",
		"SITE_ID" => "s1",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
); ?>

<?php if($APPLICATION->GetCurPage() == "/articles/") {
?>
<div class="row">
<div class="col-12 col-xl-12 col-lg-12 col-md-12">
<h1><span>Статьи о крепеже и метизах</span></h1>
</div>
</div>
<?php 
}
?>

                <?

                if ( $USER->IsAuthorized() )
                {
                    if ($USER->GetID() == '3092') {
                        $news_count = 30;
                    }
                    else {
                        $news_count = $_REQUEST["PAGE_COUNT"];
                    }
                }
                else
                {
                    $news_count = $_REQUEST["PAGE_COUNT"];
                }
                
                        $APPLICATION->IncludeComponent(
	"bitrix:news", 
	"articles", 
	array(
		"IBLOCK_TYPE" => "content",
		"IBLOCK_ID" => "7",
		"NEWS_COUNT" => $news_count,
		"USE_SEARCH" => "Y",
		"USE_RSS" => "N",
		"USE_RATING" => "N",
		"USE_CATEGORIES" => "N",
		"USE_REVIEW" => "N",
		"USE_FILTER" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"CHECK_DATES" => "Y",
		"SEF_MODE" => "Y",
		"SEF_FOLDER" => "/articles/",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_NOTES" => "",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"SET_STATUS_404" => "Y",
		"SET_TITLE" => "Y",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "Y",
		"ADD_ELEMENT_CHAIN" => "Y",
		"USE_PERMISSIONS" => "N",
		"PREVIEW_TRUNCATE_LEN" => "",
		"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"LIST_FIELD_CODE" => array(
			0 => "PREVIEW_TEXT",
			1 => "PREVIEW_PICTURE",
			2 => "DETAIL_TEXT",
			3 => "DETAIL_PICTURE",
			4 => "TYPE_ARTICLES",
			5 => "",
		),
		"LIST_PROPERTY_CODE" => array(
			0 => "NO_INDEX",
			1 => "TYPE_ARTICLES",
			2 => "",
		),
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"DISPLAY_NAME" => "Y",
		"META_KEYWORDS" => "-",
		"META_DESCRIPTION" => "-",
		"BROWSER_TITLE" => "-",
		"DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"DETAIL_FIELD_CODE" => array(
			0 => "PREVIEW_TEXT",
			1 => "PREVIEW_PICTURE",
			2 => "DETAIL_TEXT",
			3 => "DETAIL_PICTURE",
			4 => "",
		),
		"DETAIL_PROPERTY_CODE" => array(
			0 => "LONG_TEXT",
			1 => "NO_INDEX",
			2 => "",
		),
		"DETAIL_DISPLAY_TOP_PAGER" => "N",
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
		"DETAIL_PAGER_TITLE" => "Страница",
		"DETAIL_PAGER_TEMPLATE" => "",
		"DETAIL_PAGER_SHOW_ALL" => "Y",
		"PAGER_TEMPLATE" => "visual-2021",
		"DISPLAY_TOP_PAGER" => "Y",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"COMPONENT_TEMPLATE" => "articles",
		"SET_LAST_MODIFIED" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"USE_SHARE" => "N",
		"DETAIL_SET_CANONICAL_URL" => "Y",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"STRICT_SECTION_CHECK" => "N",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"FILE_404" => "",
		"SEF_URL_TEMPLATES" => array(
			"news" => "",
			"section" => "",
			"detail" => "#ELEMENT_CODE#/",
			"search" => "search/",
		)
	),
	false
);
                   
                
                ?>

        </div>

    </section>

    <script>
        $(document).ready(function() {

            setTimeout(function(){
        	
        	if ($(".news-detail").length > 0){
        		let hlist = $(".eraser-9000")/*.children()*/.not('.posts-list').find("h2,h3,h4,h5,h6");

        		if (hlist.length > 0){
        		    if (hlist.length >= 6) {
var hs = $('.detail_picture').height() - $('#article-char-elem').height() - 10;
        			$('<div class="news-detail-content" style="height:'+ hs +'px;"><span class="news-detail-content-title">Содержание:</span></div>').appendTo('.news-detail-content-area');
        			var hstemp = hs + 30;
        			$('.player-content-area').css('height', hstemp +'px');
        			//$('.item-player-area').css('height', '285px');
                		}
        		    else
        		    {
        			$('<div class="news-detail-content"><span class="news-detail-content-title">Содержание:</span></div>').appendTo('.news-detail-content-area');
        			$('.player-content-area').css('height', '100%');
        			//$('.item-player-area').css('height', '285px');
            		    }
        			
        			//$('.news-detail-content').css('height', hdetail_picture + 'px');
        			$(".news-detail").children().not('.posts-list').find("h2,h3,h4,h5,h6").each(function(e) {
        				$(this).attr('id','h' + e);
        				//let tp = parseInt($(this).offset().top);
        				//$( "<div><a href='#' class='news-detail-content-link' rel='h" + e + "'>"+ (e+1) +". "+ $(this).text() + "</a></div>" ).appendTo( ".news-detail-content" );
        				//$( "<div><a href='#' class='news-detail-content-link' data-rel='h" + e + "' rel='h" + e + "'>"+ $(this).text() + "</a></div>" ).appendTo( ".news-detail-content" );
        				$( "<div><a href='#' class='news-detail-content-link' data-rel='h" + e + "' rel='nofollow'>"+ $(this).text() + "</a></div>" ).appendTo( ".news-detail-content" );
        			});
if (hlist.length >= 6){
        			$( "<div><a href='#' class='news-detail-content-link-all'>Смотреть все</a></div>" ).appendTo( ".news-detail-content" );
}
        			
        			$('.news-detail-content-link').on('click',function(e){
        				e.preventDefault();
        				let tp = $(this).attr('data-rel');
        				 $('body,html').animate({scrollTop: $("#" + tp).offset().top - 168}, 400);
        			});
        			
        			//$('.news-detail-content').append("a");

        			$('.news-detail-content-link-all').on('click',function(e){
        				e.preventDefault();
        				$(this).css('display','none');
        				$('.news-detail-content').animate({height: 100+'%'}, 400);
    				});
        			
        		}
        	}
            }, 2000);
            
            $(".categories").removeClass('u-none');
        });
    </script>

<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>