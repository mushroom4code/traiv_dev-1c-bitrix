<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Оптовая продажа крепежа и метизов по всей России — Трайв");
$APPLICATION->SetPageProperty("description", "Полный каталог продукции крепежных изделий с прайс -листами: болты и винты, гайки и шайбы, шпильки, саморезы, заклепки, такелаж, анкеры, шурупы, гвозди и дюбели и другое. Собственное производство продукции по индивидуальным заказам. Доставка по всей России");
$APPLICATION->SetTitle("Оптовый поставщик и производитель крепежа");

$LastModified = gmdate('D, d M Y H:i:s', filemtime('index.php'));
header('Last-Modified: '.$LastModified);

$IfModifiedSince = false;
if (isset($_ENV['HTTP_IF_MODIFIED_SINCE']))
    $IfModifiedSince = strtotime(substr($_ENV['HTTP_IF_MODIFIED_SINCE'], 5));
    if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']))
        $IfModifiedSince = strtotime(substr($_SERVER['HTTP_IF_MODIFIED_SINCE'], 5));
        if ($IfModifiedSince && $IfModifiedSince >= $LastModified) {
            header($_SERVER['SERVER_PROTOCOL'] . ' 304 Not Modified');
            exit;
        }
        
        require_once $_SERVER["DOCUMENT_ROOT"] .'/local/php_interface/include/Mobile_Detect.php';
        $detect = new Mobile_Detect;
        if ( $detect->isMobile() || $detect->isTablet()) {
            $mobile_check = true;
        }
        ?>
    <meta property="og:title" content="Трайв - крепёж и метизы оптом по России"/>
<section id="slider_area" class="d-none d-md-block d-lg-block d-xl-block">
<div class="slider_preloader"></div>
    <div class="container">
      <div class="row g-0">
      	<div class="col-8 pt-3">

<div class="slider">
      	<?php
      	
      	if ($mobile_check == false) {
      	
      	$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"main_page_slider", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "main_page_slider",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "5",
		"IBLOCK_TYPE" => "content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "LINK",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "ACTIVE_FROM",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "DESC",
		"STRICT_SECTION_CHECK" => "N"
	),
	false
);
      	}
      	?>
</div>
      	</div>
      	
      	<div class="col-4 pt-3 pl-3 position-relative">
      	
      	<!-- <div class="video_backlayer mt-3 ml-3"></div> -->
         <?php
         
         /*if ( $USER->IsAuthorized() )
         {
             if ($USER->GetID() == '3092' || $USER->GetID() == '7174' || $USER->GetID() == '7621' || $USER->GetID() == '1788' || $USER->GetID() == '2938' || $USER->GetID() == '7649' || $USER->GetID() == '7142' || $USER->GetID() == '7473' || $USER->GetID() == '7634' || $USER->GetID() == '7666') {*/
                 if ($mobile_check == false) {
                 $APPLICATION->IncludeComponent(
	"bitrix:player", 
	"video_main_page", 
	array(
		"PLAYER_TYPE" => "videojs",
		"USE_PLAYLIST" => "N",
		"PATH" => "/upload/video/videomp.mp4",
		"PLAYLIST_DIALOG" => "",
		"PROVIDER" => "video",
		"STREAMER" => "",
		"WIDTH" => "400",
		"HEIGHT" => "248",
		"PREVIEW" => "",
		"FILE_TITLE" => "Вступление",
		"FILE_DURATION" => "305",
		"FILE_AUTHOR" => "Иван Иванов",
		"FILE_DATE" => "01.08.2010",
		"FILE_DESCRIPTION" => "Презентация продукта",
		"SKIN_PATH" => "/bitrix/components/bitrix/player/mediaplayer/skins",
		"SKIN" => "",
		"CONTROLBAR" => "bottom",
		"WMODE" => "transparent",
		"PLAYLIST" => "right",
		"PLAYLIST_SIZE" => "180",
		"LOGO" => "/logo.png",
		"LOGO_LINK" => "http://ваш_сайт.com/",
		"LOGO_POSITION" => "bottom-left",
		"PLUGINS" => array(
			0 => "tweetit-1",
			1 => "fbit-1",
			2 => "",
		),
		"PLUGINS_TWEETIT-1" => "tweetit.link=",
		"PLUGINS_FBIT-1" => "fbit.link=",
		"ADDITIONAL_FLASHVARS" => "",
		"WMODE_WMV" => "window",
		"SHOW_CONTROLS" => "Y",
		"PLAYLIST_TYPE" => "xspf",
		"PLAYLIST_PREVIEW_WIDTH" => "64",
		"PLAYLIST_PREVIEW_HEIGHT" => "48",
		"SHOW_DIGITS" => "Y",
		"CONTROLS_BGCOLOR" => "FFFFFF",
		"CONTROLS_COLOR" => "000000",
		"CONTROLS_OVER_COLOR" => "000000",
		"SCREEN_COLOR" => "000000",
		"AUTOSTART" => "Y",
		"REPEAT" => "none",
		"VOLUME" => "90",
		"MUTE" => "Y",
		"HIGH_QUALITY" => "Y",
		"SHUFFLE" => "N",
		"START_ITEM" => "1",
		"ADVANCED_MODE_SETTINGS" => "Y",
		"PLAYER_ID" => "videomp",
		"BUFFER_LENGTH" => "10",
		"DOWNLOAD_LINK" => "http://ваш_сайт.com/video.flv",
		"DOWNLOAD_LINK_TARGET" => "_self",
		"ADDITIONAL_WMVVARS" => "",
		"ALLOW_SWF" => "Y",
		"COMPONENT_TEMPLATE" => "video_main_page",
		"USE_PLAYLIST_AS_SOURCES" => "N",
		"SIZE_TYPE" => "absolute",
		"PLAYLIST_HIDE" => "Y",
		"PLAYLIST_NUMBER" => "3",
		"PLAYBACK_RATE" => "1",
		"TYPE" => "mp4",
		"PRELOAD" => "N",
		"START_TIME" => "0",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);
                 }
             /*}
             else {
                 ?>
                 <a href="https://traiv-komplekt.ru/import/"><img src="<?=SITE_TEMPLATE_PATH?>/import-page/importozameshenie-main-page.jpg" class="" style="padding:0px 10px 0px 0px;"/></a>
                 <?php 
                 
             }
         }
         else
         {
             ?>
                 <a href="https://traiv-komplekt.ru/import/"><img src="<?=SITE_TEMPLATE_PATH?>/import-page/importozameshenie-main-page.jpg" class="" style="padding:0px 10px 0px 0px;"/></a>
                 <?php 
         }*/
?>
      	</div>  	
      </div>
    </div>
</section>

<section id="main_page_catalog">
    <div class="container">
    
      <div class="row d-flex align-items-center">
      	<div class="col-12 col-xl-10 col-lg-10 col-md-10"><div class='h1title'><span>Каталог крепежа и метизов</span></div></div>
      	<div class="col-2 d-none d-xl-block text-right"><a href="/catalog/" class="link_dashed_gray">Перейти в каталог</a></div>
      </div>
      
      <?$APPLICATION->IncludeComponent(
                    "bitrix:catalog.section.list",
                    "main_page_catalog",
                    Array(
                        "ADD_SECTIONS_CHAIN" => "N",
                        "CACHE_GROUPS" => "N",
                        "CACHE_TIME" => "36000000",
                        "CACHE_TYPE" => "A",
                        "COMPONENT_TEMPLATE" => "main_page_catalog",
                        "COUNT_ELEMENTS" => "Y",
                        "IBLOCK_ID" => "18",
                        "IBLOCK_TYPE" => "catalog",
                        "SECTION_CODE" => "",
                        "SECTION_FIELDS" => array(0=>"",1=>"",),
                        "SECTION_ID" => "",
                        "SECTION_URL" => "",
                        "SECTION_USER_FIELDS" => array(0=>"",1=>"",),
                        "SHOW_PARENT_NAME" => "Y",
                        "TOP_DEPTH" => "1",
                        "VIEW_MODE" => "LINE"
                    )
                );?>
      
    </div>
</section>

<section id="main_page_category">
    <div class="container">
    
      <div class="row d-flex align-items-center">
      	<div class="col-12 col-xl-10 col-lg-10 col-md-10"><h1 class='h1title'><span>Производитель и оптовый поставщик крепежа</span></h1></div>
      	<div class="col-2 d-none d-xl-block text-right"><a href="/catalog/" class="link_dashed_gray">Перейти в каталог</a></div>
      </div>
      
      <?
                            $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                ".default",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "EDIT_TEMPLATE" => "",
                                    "COMPONENT_TEMPLATE" => ".default",
                                    "PATH" => "/include/main_page_category.php"
                                )
                            );
                            ?>
      
    </div>
</section>

 <section id="main_page_photogallery">
<div class="container">

      <div class="row d-flex align-items-center">
      	<div class="col-12 col-xl-10 col-lg-10 col-md-10"><div class='h1title'><span>Изделия и покрытия в деталях - наше эксклюзивное портфолио</span></div></div>
      	<div class="col-2 d-none d-xl-block text-right"><a href="/services/proizvodstvo-metizov/works/" class="link_dashed_gray">Наши работы</a></div>
      </div>

	<div class="row mp-serv-slider">
	
	<?php 
	$arSelectRs = Array("ID", "NAME", "DETAIL_PAGE_URL", "DETAIL_PICTURE", "DATE_ACTIVE_FROM");
	$arSortRs = array("date_active_from" => "DESC");
	$arFilterRs = array('IBLOCK_ID'=>"42",'ACTIVE'=>'Y');
	
	$db_list_inRs = CIBlockElement::GetList($arSortRs, $arFilterRs, false, Array("nTopCount" => 10), $arSelectRs);
	
	$res_rows = intval($db_list_inRs->SelectedRowsCount());
	
	if ($res_rows > 0) {
	    while($ar_result_inRs = $db_list_inRs->GetNext()){

	        $imgEl = CFile::GetPath($ar_result_inRs['DETAIL_PICTURE']);
	        ?>
	        <div class="col-12 col-sm-4 col-md-4 col-lg-4 p-xl-3 p-lg-3 p-md-3 position-relative mp-serv-slider-item">	        
    	        <a href="<?php echo '/services/proizvodstvo-metizov/works/'.$ar_result_inRs['CODE'];?>" class="mp-serv-item bordered">
    	        
	                <time class="posts-i-date" datetime="<?=$ar_result_inRs['DATE_ACTIVE_FROM'] ?>"><span><?=substr($ar_result_inRs['DATE_ACTIVE_FROM'],0,2) ?></span> 
		<?php 
		echo month2char(substr($ar_result_inRs['DATE_ACTIVE_FROM'],3,2));
		?>
		</time>
    	        
    	        		<div class="mp-serv-slider-item-img" style="background-image:url(<?php echo $imgEl;?>);"></div>
    	        		<div class="mp-serv-slider-item-name"><?php echo $ar_result_inRs['NAME'];?></div>
    			</a>
	        </div>
	        <?php 
	    }
	}
	?>
	
		
	</div>
</div>
 </section>
 <?php        


        if ($mobile_check == false) {
 ?>
 <section id="main_page_photogallery">
 
 <div class="container">
 <?php 
 $hlblock = Bitrix\Highloadblock\HighloadBlockTable::getById(14)->fetch();
 
 $entity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
 $entity_data_class = $entity->getDataClass();
 
 $data = $entity_data_class::getList(array(
     "select" => array("*"),
 ));
 
 if (intval($data->getSelectedRowsCount()) > 0){
     while($arData = $data->Fetch()){
         //echo $arData['UF_PHOTO'];
         ?>
         	<div class="row position-relative mt-5 mpgallery-area">
		<?php
		                                  foreach ($arData['UF_PHOTO'] as $ikey=>$ival){
                            		        $imgEl = CFile::GetPath($ival);
                            		        ?>
                            		        <div class="col-12 col-xl-3 col-lg-3 col-md-3 p-xl-3 p-lg-3 p-md-3 text-left position-relative">
                                            	<a href="<?php echo $imgEl;?>" class="mp-photo-item bordered position-relative fancy-img" data-fancybox="gallery">
                                            		<div class="mp-photo-img text-center" style="background-image:url(<?php echo $imgEl;?>);"></div>
                                            	</a>
                                            </div>
                            		    <?php
                            		    }
                            		?>
		</div>
         <?php
     }
 }
 ?>
 </div>

 </section>
 <?php 
        }
?>


<section id="main_page_directions">
              <?
                            $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                ".default",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "EDIT_TEMPLATE" => "",
                                    "COMPONENT_TEMPLATE" => ".default",
                                    "PATH" => "/include/main_page_directions.php"
                                )
                            );
                            ?>
</section>


<section id="main_page_news_art">

<div class="container">
    <div class="row">
    
    <div class="col-12 col-xl-4 col-lg-4 col-md-4">
        <div class="row">
            <div class="col-12 col-xl-10 col-lg-12 col-md-12">
            	<div class="h1title mb-0"><a href="/news/"><span>Новости</span></a></div>
            </div>
            
            <div class="col-12 col-xl-12 col-lg-12 col-md-12">

            	<?$APPLICATION->IncludeComponent(
            	    "bitrix:news.list",
            	    "main_page_news_2021",
            	    Array(
            	        "ACTIVE_DATE_FORMAT" => "d.m.Y",
            	        "ADD_SECTIONS_CHAIN" => "N",
            	        "AJAX_MODE" => "N",
            	        "AJAX_OPTION_ADDITIONAL" => "",
            	        "AJAX_OPTION_HISTORY" => "N",
            	        "AJAX_OPTION_JUMP" => "N",
            	        "AJAX_OPTION_STYLE" => "N",
            	        "CACHE_FILTER" => "N",
            	        "CACHE_GROUPS" => "Y",
            	        "CACHE_TIME" => "36000000",
            	        "CACHE_TYPE" => "A",
            	        "CHECK_DATES" => "Y",
            	        "COMPONENT_TEMPLATE" => ".default",
            	        "DETAIL_URL" => "",
            	        "DISPLAY_BOTTOM_PAGER" => "N",
            	        "DISPLAY_DATE" => "Y",
            	        "DISPLAY_NAME" => "Y",
            	        "DISPLAY_PICTURE" => "Y",
            	        "DISPLAY_PREVIEW_TEXT" => "Y",
            	        "DISPLAY_TOP_PAGER" => "N",
            	        "FIELD_CODE" => array(0=>"",1=>"",),
            	        "FILTER_NAME" => "",
            	        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            	        "IBLOCK_ID" => "6",
            	        "IBLOCK_TYPE" => "content",
            	        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
            	        "INCLUDE_SUBSECTIONS" => "Y",
            	        "MESSAGE_404" => "",
            	        "NEWS_COUNT" => "1",
            	        "PAGER_BASE_LINK_ENABLE" => "N",
            	        "PAGER_DESC_NUMBERING" => "N",
            	        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            	        "PAGER_SHOW_ALL" => "N",
            	        "PAGER_SHOW_ALWAYS" => "N",
            	        "PAGER_TEMPLATE" => ".default",
            	        "PAGER_TITLE" => "Новости",
            	        "PARENT_SECTION" => "",
            	        "PARENT_SECTION_CODE" => "",
            	        "PREVIEW_TRUNCATE_LEN" => "",
            	        "PROPERTY_CODE" => array(0=>"",1=>"",),
            	        "SET_BROWSER_TITLE" => "N",
            	        "SET_LAST_MODIFIED" => "N",
            	        "SET_META_DESCRIPTION" => "N",
            	        "SET_META_KEYWORDS" => "N",
            	        "SET_STATUS_404" => "N",
            	        "SET_TITLE" => "N",
            	        "SHOW_404" => "N",
            	        "SORT_BY1" => "SORT",
            	        "SORT_BY2" => "ACTIVE_FROM",
            	        "SORT_ORDER1" => "ASC",
            	        "SORT_ORDER2" => "DESC"
            	    )
            	    );
            	?>
            </div>
            
        </div>
    </div>
    
     <div class="col-12 col-xl-4 col-lg-4 col-md-4">
     
     <div class="row">
            <div class="col-12 col-xl-10 col-lg-12 col-md-12">
            	<div class="h1title mb-0"><a href="/articles/"><span>Статьи</span></a></div>
            </div>
             <div class="col-12 col-xl-12 col-lg-12 col-md-12">
             
            <?php 
            $APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "main_page_articles_2021",
                Array(
                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "ADD_SECTIONS_CHAIN" => "N",
                    "AJAX_MODE" => "N",
                    "AJAX_OPTION_ADDITIONAL" => "",
                    "AJAX_OPTION_HISTORY" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "N",
                    "CACHE_FILTER" => "N",
                    "CACHE_GROUPS" => "Y",
                    "CACHE_TIME" => "36000000",
                    "CACHE_TYPE" => "A",
                    "CHECK_DATES" => "Y",
                    "COMPONENT_TEMPLATE" => ".default",
                    "DETAIL_URL" => "",
                    "DISPLAY_BOTTOM_PAGER" => "N",
                    "DISPLAY_DATE" => "Y",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "Y",
                    "DISPLAY_PREVIEW_TEXT" => "Y",
                    "DISPLAY_TOP_PAGER" => "N",
                    "FIELD_CODE" => array(0=>"",1=>"",),
                    "FILTER_NAME" => "",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "IBLOCK_ID" => "7",
                    "IBLOCK_TYPE" => "content",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                    "INCLUDE_SUBSECTIONS" => "Y",
                    "MESSAGE_404" => "",
                    "NEWS_COUNT" => "1",
                    "PAGER_BASE_LINK_ENABLE" => "N",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "N",
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_TEMPLATE" => ".default",
                    "PAGER_TITLE" => "Новости",
                    "PARENT_SECTION" => "",
                    "PARENT_SECTION_CODE" => "",
                    "PREVIEW_TRUNCATE_LEN" => "",
                    "PROPERTY_CODE" => array(0=>"",1=>"",),
                    "SET_BROWSER_TITLE" => "N",
                    "SET_LAST_MODIFIED" => "N",
                    "SET_META_DESCRIPTION" => "N",
                    "SET_META_KEYWORDS" => "N",
                    "SET_STATUS_404" => "N",
                    "SET_TITLE" => "N",
                    "SHOW_404" => "N",
                    "SORT_BY1" => "SORT",
                    "SORT_BY2" => "ACTIVE_FROM",
                    "SORT_ORDER1" => "ASC",
                    "SORT_ORDER2" => "DESC"
                )
                );
            ?>
            </div>
            
	</div>
     
     </div>
     

                <div class="col-12 col-xl-4 col-lg-4 col-md-4">
        <div class="row">
            <div class="col-12 col-xl-10 col-lg-12 col-md-12">
            	<div class="h1title mb-0"><a href="/edu-center/"><span>Центр обучения</span></a></div>
            </div>
            
            <div class="col-12 col-xl-12 col-lg-12 col-md-12">

            	        <div class="posts-wrap"><div class="row posts-list"><div class="col-12 posts2-i" id="bx_3485106786_296174"><a class="posts-i-img" href="/edu-center/"><span style="background: url(<?=SITE_TEMPLATE_PATH?>/images/uchcentre.jpeg)"></span></a> <div class="posts-i-ttl"><a href="/edu-center/"><span itemprop="headline">Курс Оператор станков с ЧПУ</span></a></div></div></div></div>
            	        <?php 
            	/*
            	$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"main_page_transit", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "main_page_transit",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "48",
		"IBLOCK_TYPE" => "content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "1",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "DATE_INSERT",
			2 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "ACTIVE_FROM",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "DESC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);
            	*/?>
            </div>
            
        </div>
    </div>

    
    </div>
</div>

</section>

<section id="main_page_quicklinks">

<div class="container">
    <div class="row">
    
        <div class="col-lg-7 col-md-6 text-md-left text-center">
    		<div class="row h-100">
    			<div class="col-lg-6 col-md-12 text-md-left text-center">
    			<a href="/calculator/" class='quicklinks-item bordered'>
    				<div class='quicklinks-item-content'>
    					<img src="<?=SITE_TEMPLATE_PATH?>/images/quicklinks1.jpg" class="quicklinks-item-content-img"/>
    					<div class="quicklinks-item-title">Калькулятор крепежа и метизов</div>
    					<p>Новейший калькулятор расчета массы крепежа.</p>
    				</div>
    				<!-- <div class="quicklinks-item-menu"><i class="fa fa-ellipsis-v"></i></div> -->
    			</a>
    			</div>
    			
    			<div class="col-lg-6 col-md-12 text-md-left text-center">
        			<a href="/price-list/" class='quicklinks-item bordered'>
    				<div class='quicklinks-item-content'>
    					<img src="<?=SITE_TEMPLATE_PATH?>/images/quicklinks9.jpg" class="quicklinks-item-content-img"/>
    					<div class="quicklinks-item-title">Прайс - листы</div>
    					<p>Предоставим информацию по нашему ассортименту.</p>
    				</div>
    			</a>
    			</div>
    			
    			<div class="col-lg-6 col-md-12 mt-3 text-md-left text-center d-none">
        			<div class='quicklinks-item bordered'>
        			<div class='quicklinks-item-content'>
    					<img src="<?=SITE_TEMPLATE_PATH?>/images/quicklinks3.jpg"/>
    					<div class="quicklinks-item-title">Латунный крепеж</div>
    					<p>Латунь, как и исходные для ее изготовления материалы, не магнитится.</p>
    				</div>
        			</div>
    			</div>
    			
    		</div>    		
        </div>
        
        <div class="col-lg-5 col-md-6 col-sm-12 mb-30 text-md-left text-center">
        	<div class="row h-100">
        	
    			<div class="col-lg-4 col-md-12 text-md-left text-center">
    			<a href="/gosti-na-krepezh/" class='quicklinks-item bordered'>
        			<div class='quicklinks-item-content'>
    					<!-- <img src="<?=SITE_TEMPLATE_PATH?>/images/quicklinks4.jpg"/> -->
    					<div class="quicklinks-item-title-big">ГОСТ</div>
    					<div class="quicklinks-item-title">ГОСТ на крепеж</div>
    					<p>Весь крепеж по стандарту ГОСТ.</p>
    				</div>
        			</a>
    			</div>
    			
    			<div class="col-lg-4 col-md-12 text-md-left text-center">
    			<a href="/din-na-krepezh/" class='quicklinks-item bordered'>
        			<div class='quicklinks-item-content'>
    					<!-- <img src="<?=SITE_TEMPLATE_PATH?>/images/quicklinks4.jpg"/> -->
    					<div class="quicklinks-item-title-big">DIN</div>
    					<div class="quicklinks-item-title">DIN на крепеж</div>
    					<p>Весь крепеж по стандарту DIN.</p>
    				</div>
        			</a>
    			</div>
    			
    			<div class="col-lg-4 col-md-12 text-md-left text-center">
    			<a href="/din-na-krepezh/" class='quicklinks-item bordered'>
        			<div class='quicklinks-item-content'>
    					<!-- <img src="<?=SITE_TEMPLATE_PATH?>/images/quicklinks4.jpg"/> -->
    					<div class="quicklinks-item-title-big">ОСТ</div>
    					<div class="quicklinks-item-title">ОСТ на крепеж</div>
    					<p>Весь крепеж по стандарту ОСТ.</p>
    				</div>
        			</a>
    			</div>
    			
    			<div class="col-lg-6 col-md-12 mt-3 text-md-left text-center d-none">
    			<div class='quicklinks-item bordered'>
        			<div class='quicklinks-item-content'>
    					<img src="<?=SITE_TEMPLATE_PATH?>/images/quicklinks7.jpg"/>
    					<div class="quicklinks-item-title">Трайв! Все дело в деталях!</div>
    					<p>В числе наших партнеров крупные производственные компании и предприятия.</p>
    				</div>
        			</div>
    			</div>
    			
    			<div class="col-lg-6 col-md-12 mt-3 text-md-left text-center d-none">
    			<div class='quicklinks-item bordered'>
        			<div class='quicklinks-item-content'>
    					<img src="<?=SITE_TEMPLATE_PATH?>/images/quicklinks8.jpg"/>
    					<div class="quicklinks-item-title">Трайв! Все дело в деталях!</div>
    					<p>В числе наших партнеров крупные производственные компании и предприятия.</p>
    				</div>
        			</div>
    			</div>
    			
			</div>
        </div>
    
    </div>
</div>

</section>

<section id="main_page_content">

    <div class="container">
    
      <div class="row d-flex align-items-center">
      	<div class="col-12 col-xl-12 col-lg-12 col-md-12">
      	<?$APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    ".default",
                    Array(
                        "AREA_FILE_SHOW" => "page",
                        "AREA_FILE_SUFFIX" => "inc_1",
                        "EDIT_TEMPLATE" => ""
                    )
                );?>
      	</div>
      </div>
      
      </div>

</section>

<section id="main_page_map">
	<div id="map_mp">
	
    	<div class="map_office_area">
    	
    	</div>
	
	</div>
</section><? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>