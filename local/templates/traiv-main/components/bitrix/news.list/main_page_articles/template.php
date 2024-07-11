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
$article = array_shift($arResult['ITEMS']);
if (!$article) return;
?>
<div class="traiv-news-list-main-page-articles">
    <h2 class="md-title md-title--blue">Статьи</h2>
    <div class="row">
        <?
        $this->AddEditAction($article['ID'], $article['EDIT_LINK'], CIBlock::GetArrayByID($article["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($article['ID'], $article['DELETE_LINK'], CIBlock::GetArrayByID($article["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <div class="col x1d1" id="<?=$this->GetEditAreaId($article['ID']);?>">
            <div class="preview-item">
            <div class="image" style="background-image: url(<?=$article['PREVIEW_PICTURE']['SRC'] ?>)"></div>
            <div class="description">
                <div class="date"><?=$article['DISPLAY_ACTIVE_FROM']?></div>
                <h4 class="preview-item__title">
                    <a href="<?=$article['DETAIL_PAGE_URL']?>"><?=$article['NAME']?></a>
                </h4>
                <div class="text"><?=TruncateText($article['PREVIEW_TEXT'], 400)?></div>
            </div>
            </div>
        </div>
        <!-- <div class="col x1d1">
            <div class="u-align-right">
                <a href="/articles/" class="iconed iconed--right index">
                    <span>Перейти ко всем статьям</span>
                    <i class="icon icon--add index"></i>
                </a>
            </div>
        </div>-->
    </div>
</div>