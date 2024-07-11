<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<div class="row position-relative">   
<?php 

/*echo "<pre>";
print_r($arResult["ITEMS"]);
echo "</pre>";*/

$i = 0;
foreach ($arResult["ITEMS"] as $arItem) { ?><?

        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'],
            CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'],
            CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
            array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        
        $art_height = $arItem["PROPERTIES"]["ART_HEIGHT"]["VALUE"];
        
        if (!empty($art_height) && $art_height > 0){
            $h100 = "style='height:$art_height.px;'";
        }
        
        $h_check_item = $arItem["H_CHECK"]["CHECK"];
        if (!empty($h_check_item) && $h_check_item == 1){
            $h100 = "style='height:100%;'";
        }
        
        $type_articles = $arItem["PROPERTIES"]["TYPE_ARTICLES"]["VALUE"];
        $type_art_join_value = $arItem["PROPERTIES"]["ART_JOIN"]["VALUE_ENUM_ID"];
        $type_articles_id = $arItem["PROPERTIES"]["TYPE_ARTICLES"]["VALUE_ENUM_ID"];
        $type_grid = $arItem["PROPERTIES"]["TYPE_GRID"]["VALUE"];
        
        $type_background = $arItem["PROPERTIES"]["TYPE_BACKGROUND"]["VALUE_ENUM_ID"];
        $big_title_width = $arItem["PROPERTIES"]["BIG_TITLE_WIDTH"]["VALUE"];
        $art_shadow = $arItem["PROPERTIES"]["ART_SHADOW"]["VALUE_ENUM_ID"];
        
        if (!empty($art_shadow) && $art_shadow == '17829'){
            $style_block = "magazine-i-bordered1";
        } else {
            $style_block = "magazine-i-bordered";
        }
        
        $type_background_color = $arItem["PROPERTIES"]["TYPE_BACKGROUND_COLOR"]["VALUE"];
        if (empty($type_background_color)){
            $type_background_color = $arItem["PROPERTIES"]["TYPE_BACKGROUND_COLOR"]["DEFAULT_VALUE"];
        }
        
        if (!empty($big_title_width)){
            $big_title_width_value = "w".$big_title_width;
        } else {
            $big_title_width_value = "w50";
        }
        
        if (!empty($type_background) && $type_background == '17808'){
            $type_background_value = "magazine-i-type";
        } else {
            $type_background_value = "magazine-i-type-relative";
        }
        
        
        
        if (!empty($type_grid)){
            $type_grid_value = "col-12 col-xl-$type_grid col-lg-$type_grid col-md-$type_grid magazine-i";
        } else {
            $type_grid_value = "col magazine-i";
        }
        
        if ( $type_articles_id == "17801" ) {
            $type_articles_out = "<div class='$type_background_value'><div class='alert alert-primary' role='alert'><i class='fa fa-industry'></i>$type_articles</div></div>";
        } else if ( $type_articles_id == "17802" ) {
            $type_articles_out = "<div class='$type_background_value'><div class='alert alert-primary' role='alert'><i class='fa fa-microphone'></i>$type_articles</div></div>";
        } else if ( $type_articles_id == "17803" ) {
            $type_articles_out = "<div class='$type_background_value'><div class='alert alert-primary' role='alert'><i class='fa fa-podcast'></i>$type_articles</div></div>";
        } else if ( $type_articles_id == "17804" ) {
            $type_articles_out = "<div class='$type_background_value'><div class='alert alert-warning' role='alert'><i class='fa fa-diamond'></i>$type_articles</div></div>";
        } else if ( $type_articles_id == "17805" ) {
            $type_articles_out = "<div class='$type_background_value'><div class='alert alert-light' role='alert'><i class='fa fa-compass'></i>$type_articles</div></div>";
        }
        
        //join with next
        if ($type_art_join_value == '17822') {
            ?>
            <div class="<?=$type_grid_value?>">
            <div class="row g-0 h-100">
            <?php 
        } else {
            $check_grid_width = $type_grid_value;
        }
/*background image*/
if (!empty($type_background) && $type_background == '17808'){
?>        
    <div class="<?=$type_grid_value?>">
        <a class="magazine-i-img" href="<?=$arItem['DETAIL_PAGE_URL']?>" <?=$h100;?>>
            <span style="background: url(<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>)"></span>
            <?=$type_articles_out;?>
            <div class="magazine-i-title <?=$big_title_width_value;?>">
            	<span class="big-title"><?=$arItem['NAME']?></span>
            </div>
            <div class="magazine-i-note <?=$big_title_width_value;?>">
            	<span class="small-title"><?=TruncateText($arItem['PREVIEW_TEXT'], 150)?></span>
            </div>
        </a>            
    </div>
<?php 
}
/*background image*/


/*background color*/
if (!empty($type_background) && $type_background == '17806') {
    if ($type_art_join_value == '17821'){
        ?>
    		<div class="col-md-12 col-xl-12 mt-4">    
        <?php
    }else if ($type_art_join_value == '17822') {
        ?>
    		<div class="col-md-12 col-xl-12">    
        <?php
    } else {
        ?>
    <div class="<?=$type_grid_value?>">    
        <?php 
    }
?>
        <div class="card text-black <?=$style_block;?>" style="background-color: #<?=$type_background_color;?>;">
          <div class="card-body p-5">
<?=$type_articles_out;?>
            <a href="#" class="magazine-link-block"><?=$arItem['NAME']?></a>

            <hr>

<div class="row d-flex justify-content-between">
            <div class="col-lg-4 col-md-4 text-md-left">
              	<span class="mb-0 magazine-i-date"><?=$arItem['DISPLAY_ACTIVE_FROM'] ?></span>
              </div>
              
              <div class="col-lg-8 col-md-8 text-md-right">
              	<div class="magazine-i-prop-relative">
            <a href="#" rel="nofollow" class="magazine_link_gray" style="padding:0px 20px;"><i class="fa fa-eye"></i>40 000</a><a href="#" rel="nofollow" class="magazine_link_gray" style="padding:0px 10px;"><i class="fa fa-thumbs-o-up"></i>250</a><a href="#" rel="nofollow" class="magazine_link_gray" style="padding:0px 10px;"><i class="fa fa-comment-o"></i>80</a></div>
              </div>
              
            </div>

          </div>
        </div>
        </div>
        <!-- вот этот тег нужно проверять -->
        <!-- </div> -->
        <!-- //вот этот тег нужно проверять -->
<?php 
}
/*end background color*/


if ($type_art_join_value == '17821'){
    ?>
    </div>
    </div>
    <?php 
}
        
        /*if ($i == 6){
            break;
        }*/
        
       /* if ($i == 0){
?>

       <div class="col-12 col-xl-12 col-lg-12 col-md-12 magazine-i">
            <a class="magazine-i-img" href="<?=$arItem['DETAIL_PAGE_URL']?>">
            	<span style="background: url(<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>)"></span>
            	
			<?php 
			echo $type_articles_out;
			?>
            
            <div class="magazine-i-title-50">
            	<span class="big-title"><?=$arItem['NAME']?></span>
            </div>

<div class="magazine-i-note">
            	<span class="small-title"><?=TruncateText($arItem['PREVIEW_TEXT'], 150)?></span>
            </div>
            	
            </a>
            
        </div>

<?php
        } else if($i == 1){
            
            ?>
                <div class="col-lg-7 text-center magazine-i">
    	<div class="row g-0 h-100">
    		<div class="col-lg-12 col-md-12 text-md-left text-center">
            
                		<!-- // -->
    		 <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-12 col-xl-12">

        <div class="card text-white magazine-i-bordered" style="background-color: #1f959b; border-radius: 15px;">
          <div class="card-body p-5">

<div class="magazine-i-type-relative">
            	<div class="alert alert-light" role="alert"><i class="fa fa-compass"></i>Импортозамещение</div>
            </div>

            <a href="#" class="magazine-link-block-white"><?=$arItem['NAME']?></a>

            <hr>

<div class="row d-flex justify-content-between">
            <div class="col-lg-4 col-md-4 text-md-left">
              	<span class="mb-0 magazine-i-date"><?=$arItem['DISPLAY_ACTIVE_FROM'] ?></span>
              </div>
              
              <div class="col-lg-8 col-md-8 text-md-right">
              	<div class="magazine-i-prop-relative">
            <a href="#" rel="nofollow" class="magazine_link_white" style="padding:0px 20px;"><i class="fa fa-eye"></i>40 000</a><a href="#" rel="nofollow" class="magazine_link_white" style="padding:0px 10px;"><i class="fa fa-thumbs-o-up"></i>250</a><a href="#" rel="nofollow" class="magazine_link_white" style="padding:0px 10px;"><i class="fa fa-comment-o"></i>80</a></div>
              </div>
              
            </div>

          </div>
        </div>

      </div>
    </div>
    		<!-- // -->
            
            
            <?php
        } else if($i == 2){
            ?>
            </div>
            
                		<div class="col-lg-12 col-md-12 text-md-left text-center mt-5">
    		    		<!-- // -->
    		 <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-12 col-xl-12">

        <div class="card text-black magazine-i-bordered1" style="background-color: #fff; border-radius: 15px;">
          <div class="card-body p-5">

<div class="magazine-i-type-relative">
            	<div class="alert alert-warning" role="alert"><i class="fa fa-diamond"></i>Крепеж</div>
            </div>

            

            <a href="#" class="magazine-link-block"><?=$arItem['NAME']?></a>

            <hr>

<div class="row d-flex justify-content-between">
            <div class="col-lg-4 col-md-4 text-md-left">
              	<span class="mb-0 magazine-i-date"><?=$arItem['DISPLAY_ACTIVE_FROM'] ?></span>
              </div>
              
              <div class="col-lg-8 col-md-8 text-md-right">
              	<div class="magazine-i-prop-relative">
            <a href="#" rel="nofollow" class="magazine_link_gray" style="padding:0px 20px;"><i class="fa fa-eye"></i>40 000</a><a href="#" rel="nofollow" class="magazine_link_gray" style="padding:0px 10px;"><i class="fa fa-thumbs-o-up"></i>250</a><a href="#" rel="nofollow" class="magazine_link_gray" style="padding:0px 10px;"><i class="fa fa-comment-o"></i>80</a></div>
              </div>
              
            </div>

          </div>
        </div>

      </div>
    </div>
    		<!-- // -->
    		</div>
            
                	</div>
    </div>
            <?php 
        } else if($i == 3){
            ?>
            
                    <div class="col-lg-5 magazine-i">
    	<div class="row g-0 h-100">
    		        <div class="col-12 col-xl-12 col-lg-12 col-md-12 h-100">
            <a class="magazine-i-img" href="<?=$arItem['DETAIL_PAGE_URL']?>" style="height:100%;">
            	<span style="background: url(<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>)"></span>
            	
            	<div class="magazine-i-type">
            	<div class="alert alert-primary" role="alert"><i class="fa fa-podcast"></i>Кейс</div>
            </div>
            
            <div class="magazine-i-title">
            	<div class="big-title-link-white"><?=$arItem['NAME']?></div>
            </div>
            	
            </a>
            
            
        
    		</div>
    		</div>
    
    
</div>
            
            <?php 
        } else if($i == 4){
            ?>
            
                    <div class="col-lg-6 magazine-i" style="min-height:450px;">
    	<div class="row g-0 h-100">
    		        <div class="col-12 col-xl-12 col-lg-12 col-md-12 h-100">
            <a class="magazine-i-img" href="<?=$arItem['DETAIL_PAGE_URL']?>" style="height:100%;">
            	<span style="background: url(<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>)"></span>
            	
            	<div class="magazine-i-type">
            	<div class="alert alert-light" role="alert"><i class="fa fa-compass"></i>Импортозамещение</div>
            </div>
            
            <div class="magazine-i-title">
            	<div class="big-title-link-white"><?=$arItem['NAME']?></div>
            </div>
            	
            </a>
            
            
        
    		</div>
    		</div>
    
    
</div>
            
            <?php 
        }  else if($i == 5){
            ?>
            
                    <div class="col-lg-6 magazine-i" style="min-height:450px;">
    	<div class="row g-0 h-100">
    		        <div class="col-12 col-xl-12 col-lg-12 col-md-12 h-100">
            <a class="magazine-i-img" href="<?=$arItem['DETAIL_PAGE_URL']?>" style="height:100%;">
            	<span style="background: url(<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>)"></span>
            	
            	<div class="magazine-i-type">
            	<div class="alert alert-warning" role="alert"><i class="fa fa-diamond"></i>Крепеж</div>
            </div>
            
            <div class="magazine-i-title">
            	<div class="big-title-link-white"><?=$arItem['NAME']?></div>
            </div>
            	
            </a>
            
            
        
    		</div>
    		</div>
    
    
</div>
            
            <?php 
        }*/
$i++;
}
?>
</div>

<div class="row d-none">
<!-- <div class="articles_area">-->
<!-- <div class="posts-list posts-list-np">-->
<div class="col-12 mb-3">
    <? /*if ($arParams["DISPLAY_TOP_PAGER"]): ?>
        <?= $arResult["NAV_STRING"] ?><br/>
    <? endif; */?>
</div>
    <div class="col-12 mt-3">
    <? /*if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
        <?= $arResult["NAV_STRING"] ?><br/>
    <? endif;*/ ?>
    </div>
<!-- </div> -->
<!-- </div> -->
</div>


