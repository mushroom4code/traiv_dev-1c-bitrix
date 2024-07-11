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

$sectionsToShow = 9999;
if(count($arResult['SECTIONS'])){
?>
<div class="subsection">
    <!--
<div class="text-aligner">
        <div class="text-aligner__cell">
            <h2 class="md-title md-title--blue">Каталог изделий по виду крепежа</h2>
        </div>
    </div>
	-->
    <ul class="row">
    	<?foreach($arResult['SECTIONS'] as $arSection):?>
    	<?
        /*
            if($arItem['PREVIEW_PICTURE']['ID']){
                $file = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width' => 261, 'height' => 240), BX_RESIZE_IMAGE_EXACT, true);
            } else{
                $file = CFile::ResizeImageGet($arItem['DETAIL_PICTURE']['ID'], array('width' => 200, 'height' => 240), BX_RESIZE_IMAGE_EXACT, true);
            }
           */


		  	$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
				$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
    	?>
	    	<?if(!$sectionsToShow--) break?>
        <? (CSite::InDir('/catalog/index.php')) ? $flag = 'x1d7' : $flag = 'x1d6'?>
        <li class="col <?=$flag?> x1d2--md x1d2--s x1--xs" id="<?=$this->GetEditAreaId($arSection['ID'])?>">
            <div class="category-item">
                <div class="category-item__image">
                    <a href="<?=$arSection['SECTION_PAGE_URL']?>">
                    	<img src="<?=$arSection['PICTURE']['src']?>" alt="<?=$arSection['NAME']?>" class="lazy">
                    </a>
                </div>
                <h4 class="category-item__title">
								<span class="v-aligner">
									<a href="<?=$arSection['SECTION_PAGE_URL']?>" class="v-aligner__cell"><?=$arSection['NAME']?>
									<?echo ($arSection['ELEMENT_CNT'] > 0) ? '('.$arSection['ELEMENT_CNT'].')' : ''?></a>
								</span>
                </h4>
            </div>
        <?/*Закрывающий тег li отсутсвует намеренно*/?>
    	<?endforeach?>
    </ul>
</div>
<? } ?>