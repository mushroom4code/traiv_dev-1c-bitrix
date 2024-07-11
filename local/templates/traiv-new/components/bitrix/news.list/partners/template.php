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
//$this->setFrameMode(true);
?>
<!-- <div class="traiv-news-list-main-page-news">-->

<?php
    if(count($arResult['ITEMS']) > 0){
 
        foreach ($arResult["ITEMS"] as $arItem): ?><?
        ?>
        				<div class="col-lg-12 col-md-12 mb-3 text-md-left text-center">
					<div class="partners-item bordered">
    					<div class="row">
        					<div class="col-lg-2 col-md-2 text-md-left text-center">
        						<img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" class="img-fluid">
        					</div>
        					<div class="col-lg-10 col-md-10 mb-30 text-md-left text-center">
        						<div class="partners-item-title"><?= $arItem["NAME"]?></div>
        						<div class="partners-item-note"><?= $arItem['PREVIEW_TEXT']?></div>
        					</div>
    					</div>
					</div>
				</div>
        	<!-- <div class="col-12 col-xl-4 col-lg-4 col-md-4 posts-i">
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
        	
		
		
<div class="posts-i-info">
                    <h3 class="posts-i-ttl"><?= $link_title;?></h3>
                    <div class="posts-i-ttl-note text-center">
                        <p>
                        <?=$arItem['PREVIEW_TEXT']?>
                        </p>
         <?php                
                                if (count($arItem["PROPERTIES"]["PDF_FILE"]["VALUE"]) > 0){
            foreach ($arItem["PROPERTIES"]["PDF_FILE"]["VALUE"] as $arFile){
                $arFileItem = CFile::GetFileArray($arFile);
                ?>
                
                <div class="btn-group-blue mt-3 pl-2">
                        	<a href="<?= $arFileItem["SRC"] ?>" target="_blank" class="btn-blue-small">
                            	<span><i class="fa fa-file-pdf-o" aria-hidden="true"></i><?= $arFileItem["FILE_NAME"] ?></span>
                            </a>
                        </div>
                <?php 
            }
        }
        ?>
                        
                        
                    </div>
                </div>

	</div>-->
        
    <? endforeach; ?>
<?php 
    }
?>
     