<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
?>

<?php
    if(count($arResult['ITEMS']) > 0){
 $i = 1;
        foreach ($arResult["ITEMS"] as $arItem): ?><?
        
                /*if ($arItem["PROPERTIES"]["ITEM_PRODUCT"]["VALUE"] == 'Да') {
                    ?>
                    <div class="col-12 col-xl-12 col-lg-12 col-md-12">
                        <div class="delimiter">
                        	<span></span>
                        </div>
                    </div>
                    <div class="clearfix "></div>
                    <?php 
                }*/
        //echo $i;
        if ($i <= 3) {
            $d = "";
        } else {
            $d = "style='display:none;'";
        }
        ?>
        
        	<div class="col-12 col-xl-4 col-lg-4 col-md-4 posts-i" <?php echo $d;?>>
        	<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])){
        	    $link = $arItem['DETAIL_PAGE_URL'];
        	    $link_title = '<a href='.$arItem["DETAIL_PAGE_URL"].'>'.$arItem["NAME"].'</a>';
        	    ?>
        	    <a class="posts-i-img" href="<?=$link?>"><span style="background: url(<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>)"></span></a>
        	    <?php 
        	} else {
        	    ?>
        	    <div class="posts-i-img"><span style="background: url(<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>)"></span></div>
        	    <?php 
        	    $link = "#";
        	    $link_title = '<div class="posts-i-ttl-title">'.$arItem["NAME"].'</div>';
        	}
        	?>
        	
		
		
<div class="posts-i-info" style="top:0px;transform: none;">
                    <div class="posts-i-ttl"><?= $link_title;?></div>
                    <div class="posts-i-ttl-note">
         <?php                
                                if (count($arItem["PROPERTIES"]["PDF_FILE"]["VALUE"]) > 0){
            foreach ($arItem["PROPERTIES"]["PDF_FILE"]["VALUE"] as $arFile){
                $arFileItem = CFile::GetFileArray($arFile);
                ?>
                
                <div class="mt-1">
                        	<a href="<?= $arFileItem["SRC"] ?>" target="_blank" class="btn-blue-small-not-back" onclick="ym(18248638,'reachGoal','get_offer'); return true;">
                            	<span><i class="fa fa-file-pdf-o" aria-hidden="true"></i><?= $arFileItem["FILE_NAME"] ?></span>
                            </a>
                        </div>
                <?php 
            }
        }
        ?>
                        
                        
                    </div>
                </div>

	</div>
        
    <?
    $i++;
    endforeach; ?>
    
    <div class="col-12 col-md-12 col-xs-12 col-xl-12 col-lg-12 text-center">
    	<a href="javascript:void(0);" class="btn-blue-more" id="service-more"><span class="load_more_btn_text">Показать все</span></a>
    </div>
    
<?php 
    }
?>
     