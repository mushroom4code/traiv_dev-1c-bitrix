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
<div class="traiv-news-list-main-page-news">
    <h2 class="md-title md-title--blue">Новости</h2>

    <div class="row">
        <?foreach($arResult['ITEMS'] as $arItem):?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div class="col x1d2 x1d1--s" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <div class="preview-item">
                    <div class="image" style="background-image: url(<?=$arItem['PREVIEW_PICTURE']['SRC'] ?>)"></div>
                    <div class="description">
                        <div class="date"><?=$arItem['DISPLAY_ACTIVE_FROM'] ?></div>
                        <h4 class="preview-item__title">
                            <a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a>
                        </h4>

                        <div class="text"><?=TruncateText($arItem['PREVIEW_TEXT'], 150)?></div>
                    </div>

                </div>
            </div>
        <?endforeach;?>


        <!-- <div class="col x1d1">
            <div class="u-align-right">
                <a href="/news/" class="iconed iconed--right iconed--offset-right">
                    <span>Перейти ко всем новостям</span>
                    <i class="icon icon--add index"></i>
                </a>
            </div>
        </div>-->
    </div>
</div>