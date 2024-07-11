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
?>
<div class="hero load-js">
  <ul class="slideshow js-slideshow">
  	<?foreach($arResult["ITEMS"] as $arItem):?>

        <li class="slideshow__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <?if(!empty($arItem['PROPERTIES']['LINK']['VALUE'])){?>
                <a href="<?=$arItem['PROPERTIES']['LINK']['VALUE']?>">
            <?}?>
                <?
                        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
                <img src="<?=$arItem['RESIZE_IMAGE']['src']?>" alt="<?=$arItem['NAME']?>"
                    class="responsive hero__image">
                
            <?if(!empty($arItem['PROPERTIES']['LINK']['VALUE'])){?>
                </a>
            <?}?>
	    </li>
	  <?endforeach?>
  </ul>
</div>
