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
/*$article = array_shift($arResult['ITEMS']);
if (!$article) return;*/

?>

<div class="traiv-news-list-main-page-articles">
    <h3 class="md-title md-title--blue">Другие работы</h3>
    <div class="row">

        <?
        /*echo $arParams["CURRENT_ID"];

        foreach ($arResult['ITEMS'] as $slice) {

            if (($delete_key = array_search($arParams["CURRENT_ID"], $slice)) !== false) {
                echo $delete_key;
                unset($slice[$delete_key]);
            }

        }*/

        $arrSlice = array_slice($arResult['ITEMS'], 0,4);
        foreach ($arrSlice as $article){
            if ($article['ID'] !== $arParams["CURRENT_ID"]){

        $this->AddEditAction($article['ID'], $article['EDIT_LINK'], CIBlock::GetArrayByID($article["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($article['ID'], $article['DELETE_LINK'], CIBlock::GetArrayByID($article["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>

        <div class="col x1d1" id="<?=$this->GetEditAreaId($article['ID']);?>">
            <div class="preview-item">
            <div class="image" style="background-image: url(<?=$article['PREVIEW_PICTURE']['SRC'] ?>)"></div>
            <!--<div class="description">-->
                <h4 class="preview-item__title">
                    <a href="<?=$article['DETAIL_PAGE_URL']?>"><?=$article['NAME']?></a>
                    <br>
                    <div class="date"><?=$article['DISPLAY_ACTIVE_FROM']?></div>
                </h4>

                <!--<div class="text"><?/*=TruncateText($article['PREVIEW_TEXT'], 250)*/?></div>-->
            <!--</div>-->
            </div>
        </div>
                <? } ?>
        <? } ?>
        <div class="col x1d1">
            <div class="u-align-right">
                <a href="/services/proizvodstvo-metizov/works/" class="iconed iconed--right index">
                    <span>Перейти ко всем статьям</span>
                    <i class="icon icon--add index"></i>
                </a>
            </div>
        </div>
    </div>
</div>