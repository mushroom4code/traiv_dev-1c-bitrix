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
$this->setFrameMode(true);

$sectionsToShow = 1;
        ?>
        <div class="row h-100">
    	<div class="col-lg-4 col-md-6 text-md-left text-center" id="<?=$this->GetEditAreaId($arResult['SECTIONS'][0]['ID'])?>">
        	<a href="<?=$arResult['SECTIONS'][0]['SECTION_PAGE_URL']?>" class="ca-item bordered text-center ca_main_title">
        	<img src="<?=$arResult['SECTIONS'][0]['RESIZE_IMAGE']['src']?>" alt="<?=$arResult['SECTIONS'][0]['NAME']?>" class="img-fluid mb-3" alt="img">
        	<div class="mb-0"><?/*=$arResult['SECTIONS'][0]['NAME']*/?>Все категории товаров</div>
        	<p class="mb-0">(<?=$arResult['SECTIONS'][0]['ELEMENT_CNT']?>)</p>
        	</a>
    	</div>
    	<div class="col-lg-8 col-md-6 col-sm-12 mb-30 text-md-left text-center">
    	<div class="row d-flex align-items-center">
    	<?
    	foreach($arResult['SECTIONS'] as $arSection){
    	    if ($sectionsToShow !== 1) {
    	        
		  	$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
			$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
			if ($sectionsToShow > 4){
			    $mt = "mt-4";
			}
			?>
    	<div class="col-lg-4 col-md-6 col-sm-6 <?php echo $mt;?> text-md-left text-center" id="<?=$this->GetEditAreaId($arSection['ID'])?>">
            <a href="<?=$arSection['SECTION_PAGE_URL']?>" class="ca-item bordered text-center">
    			<div class="text-center ca-item-img-area">
    			<img src="<?=$arSection['RESIZE_IMAGE']['src']?>" alt="<?=$arSection['NAME']?>" class="img-fluid mb-3 ca-item-img" alt="img">
    			</div>
    			<span class="mb-0 ca-item-title-child"><?=$arSection['NAME']?></span>
    			<p class="mb-0 ca-item-rows-child">(<?=$arSection['ELEMENT_CNT']?>)</p>
    		</a>
        </div>
    	<?
    	    }
    	    $sectionsToShow++;
}?>
</div>
</div>
</div>

