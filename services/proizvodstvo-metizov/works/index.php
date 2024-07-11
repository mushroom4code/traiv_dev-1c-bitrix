<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Наши выполненные работы по производству и изготовлению крепежа, метизов и металлообработке.");
$APPLICATION->SetPageProperty("title", "Примеры работ компании \"Трайв\" по производству крепежа и метизов");
$APPLICATION->SetTitle("Основное производство");

?>  <section id="content">
        <div class="container">

            <?/*$APPLICATION->AddChainItem('Услуги', "/services/");?>
            <?$APPLICATION->AddChainItem('Производство и изготовление', "/services/proizvodstvo-metizov/");?>
            <?if (CSite::InDir('/services/proizvodstvo-metizov/works/index.php')){ ?>
            <?$APPLICATION->AddChainItem('Наши работы', "/services/proizvodstvo-metizov/works/");?>
            <?}*/?>

            <?/*$APPLICATION->IncludeComponent(
                "bitrix:breadcrumb",
                "traiv.production",
                Array(
                    "COMPONENT_TEMPLATE" => "traiv.new",
                    "COMPOSITE_FRAME_MODE" => "A",
                    "COMPOSITE_FRAME_TYPE" => "AUTO",
                    "PATH" => "/",
                    "SITE_ID" => "s1",
                    "START_FROM" => "0"
                )
            );*/?>
                            <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "traiv", Array(
                "COMPONENT_TEMPLATE" => ".default",
                "START_FROM" => "0",
                "PATH" => "",
                "SITE_ID" => "zf",
            ),
                false
            ); ?>
            
                                    <div class="row">
    <div class="col-12 col-xl-12 col-lg-12 col-md-12">
    	<h1><span><?$APPLICATION->ShowTitle(false)?></span></h1>
    </div>
</div>

<?php 
        if($APPLICATION->GetCurPage() == "/services/proizvodstvo-metizov/works/") {
        ?>
        <div class="row">
            <div class="col-12">
            <div class="our-works-tags-area">
            <?php 
            $property_enums = CIBlockPropertyEnum::GetList(Array("VALUE"=>"ASC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>'42', "CODE"=>"SERVTAGS"));
            ?>
            <span><a href="#" class="our-works-tags-area-link" data-pro-tags="all"><div class="active">Все работы</div></a></span>
            <?php 
            while($enum_fields = $property_enums->GetNext())
            {
                ?>
                <span><a href="#" class="our-works-tags-area-link" data-pro-tags="<?php echo $enum_fields['VALUE'];?>"><div><?php echo $enum_fields['VALUE'];?></div></a></span>
        		<?php
            }
        ?>
        </div>
        </div>      
        <?php 
    }
?>

           <div class="row">
        <div class="col-12">

                <?

                // Новости
                $APPLICATION->IncludeComponent(
	"bitrix:news", 
	"our-works", 
	array(
		"IBLOCK_TYPE" => "content",
		"IBLOCK_ID" => "42",
		"NEWS_COUNT" => "30",
		"USE_SEARCH" => "N",
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
		"SEF_FOLDER" => "/services/proizvodstvo-metizov/works/",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_NOTES" => "",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"SET_STATUS_404" => "N",
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
			4 => "",
		),
		"LIST_PROPERTY_CODE" => array(
			0 => "SERVTAGS",
			1 => "",
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
			0 => "",
			1 => "",
		),
		"DETAIL_DISPLAY_TOP_PAGER" => "N",
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "N",
		"DETAIL_PAGER_TITLE" => "Страница",
		"DETAIL_PAGER_TEMPLATE" => "",
		"DETAIL_PAGER_SHOW_ALL" => "Y",
		"PAGER_TEMPLATE" => "traiv",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"COMPONENT_TEMPLATE" => "our-works",
		"SET_LAST_MODIFIED" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"USE_SHARE" => "N",
		"DETAIL_SET_CANONICAL_URL" => "Y",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SHOW_404" => "Y",
		"MESSAGE_404" => "",
		"STRICT_SECTION_CHECK" => "N",
		"FILE_404" => "",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"FILTER_NAME" => "",
		"FILTER_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_PROPERTY_CODE" => array(
			0 => "SERVTAGS",
			1 => "",
		),
		"SEF_URL_TEMPLATES" => array(
			"news" => "",
			"section" => "",
			"detail" => "#ELEMENT_CODE#/",
		)
	),
	false
);
                ?>


        </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {

    		/*OurWorks*/
    		$('.our-works-tags-area-link').on('click',function(e){
    			e.preventDefault();
    			let tag_pro_name = $(this).attr( "data-pro-tags" ).toLowerCase();
    			if (tag_pro_name == 'all'){
    				$(".our-works-tags-area").find('.our-works-tags-area-link').children('div').removeClass('active');
    				$(this).children('div').addClass('active');
    				$(".posts-list").children(".posts2-i").css('display','block');	
    			} else {
    			$(".our-works-tags-area").find('.our-works-tags-area-link').children('div').removeClass('active');
    			$(this).children('div').addClass('active');
    			
    			$(".posts-list").children(".posts2-i").each( function(){
    			       var $this = $(this);
    			       var value = $this.attr( "data-pro-tags" ).toLowerCase();
    			       
    			       if (value.includes( tag_pro_name ))
    			    	   {
    			    	   	$this.css('display','block');
    			    	   }
    			       else
    			    	   {
    			    	   	$this.css('display','none');
    			    	   }
    			});
    			}
    			
    		});
    		/*end OurWorks*/
            
            //doesn't wait for images, style sheets etc..
            //is called after the DOM has been initialized
            $(".categories").removeClass('u-none');
        });
    </script>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>