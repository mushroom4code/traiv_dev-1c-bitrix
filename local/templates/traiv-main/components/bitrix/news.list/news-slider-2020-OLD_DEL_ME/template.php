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


$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/slick-1.8.1/slick.js");
$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/js/slick-1.8.1/slick.css");


$this->setFrameMode(true);
?>
<div class="traiv-news-list-main-page-news">
    <a href="/services/proizvodstvo-metizov/works/"><h3 class="md-title md-title--blue">Наши работы</h3></a>

    <div class="row slickdiv">
        <?foreach($arResult['ITEMS'] as $arItem):?>
        <!--<pre><?/*print_r($arItem['ID'])*/?></pre>-->
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div class="col x1d3 x1d1--s" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <div class="preview-item">
                    <div class="image"> <!--style="background-image: url(<?/*=$arItem['PREVIEW_PICTURE']['SRC'] */?>)"--><img src="<?=$arItem['PREVIEW_PICTURE']['SRC'] ?>" class="news-list-item-image"></div>
                    <div class="description">
                        <div class="date"><?=$arItem['DISPLAY_ACTIVE_FROM'] ?></div>
                        <h4 class="preview-item__title">
                            <a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a>
                        </h4>

                        <div class="text"><?=TruncateText($arItem['PREVIEW_TEXT'], 175)?></div>
                    </div>

                </div>
            </div>
        <?endforeach;?>


        <div class="col x1d1">
            <div class="u-align-right">
                <a href="/services/proizvodstvo-metizov/works/" class="iconed iconed--right iconed--offset-right">
                    <span>Перейти к разделу</span>
                    <i class="icon icon--add index"></i>
                </a>
            </div>
        </div>
    </div>
</div>