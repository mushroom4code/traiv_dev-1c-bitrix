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


  	<?foreach($arResult["ITEMS"] as $arItem):
          //  $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
           // $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <?if(!empty($arItem['PROPERTIES']['LINK']['VALUE'])){?>
                <a href="<?=$arItem['PROPERTIES']['LINK']['VALUE']?>">
            <?}?>
            <div><!-- <a target="_blank" rel="nofollow" href="/partners/">--><img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" style="width:100%;"><!-- </a>--></div>
        <!-- <div><a target="_blank" rel="nofollow" href="/partners/"><img src="<?=$arItem['IMAGE']['src']?>"></a></div>-->
        <?if(!empty($arItem['PROPERTIES']['LINK']['VALUE'])){?>
                </a>
            <?}?>
        <?endforeach?>
