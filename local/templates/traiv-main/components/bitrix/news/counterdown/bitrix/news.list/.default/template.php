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
<div class="news-list counterdown-main">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
    <script src="/local/templates/traiv-main/js/counterdown.js"></script>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>

	<div class="news-item schet_block" id="<?=$this->GetEditAreaId($arItem['ID']);?>">



		<?

        $now = new DateTime(); // текущее время на сервере
        $date = DateTime::createFromFormat("d.m.Y H:i:s", $arItem["DATE_ACTIVE_TO"]); // задаем дату в любом формате
        $interval = $now->diff($date); // получаем разницу в виде объекта DateInterval

        if($interval->format("%R") === '+'){

            $label = '<span
                class="action-timer-watches" id="action-timer-watches"
                data-date="'.$arItem["DATE_ACTIVE_TO"].'"
                data-year="'.explode(".", explode(" ", $arItem["DATE_ACTIVE_TO"])[0])[2].'"
                data-month="'.explode(".", explode(" ", $arItem["DATE_ACTIVE_TO"])[0])[1].'"
                data-day="'.explode(".", explode(" ", $arItem["DATE_ACTIVE_TO"])[0])[0].'"
                data-hour="'.explode(":", explode(" ", $arItem["DATE_ACTIVE_TO"])[1])[0].'"
                data-minute="'.explode(":", explode(" ", $arItem["DATE_ACTIVE_TO"])[1])[1].'"
                data-second="'.explode(":", explode(" ", $arItem["DATE_ACTIVE_TO"])[1])[2].'"

                >
                <span class="action-timer-days" id="action-timer-days">'.$interval->days.'</span>:<span class="action-timer-hours" id="action-timer-hours">'.$interval->format("%H").'</span>:<span class="action-timer-minutes" id="action-timer-minutes">'.$interval->format("%I").'</span>:<span class="action-timer-seconds" id="action-timer-seconds">'.$interval->format("%S").'</span>
            </span>';

        }

        $ref_cat = '';
        if($arItem['PROPERTIES']['section_link']['VALUE'] > 0){
            $section = CIBlockSection::GetByID($arItem['PROPERTIES']['section_link']['VALUE']);
            if($section = $section->GetNext()){
                $ref_cat = '<a href="'.$section['SECTION_PAGE_URL'].'" class="buttond">'.$section['NAME'].'</a>';
            }
        }

        $ref_products = '';
        if(count($arItem['PROPERTIES']['products']['VALUE']) > 0){
            $ref_products = '<a 
                    href="/ozhidaemye-tovary/?id='.$arItem['ID'].'" 
                    class="buttond">УСПЕЙ ЗАКАЗАТЬ!</a>';
        }

        ?>


        <span class="gl_h1"><?echo $arItem["NAME"]?></span>
        <span class="na_sklad">До отправления груза<br>в <?=$arItem['PROPERTIES']['city']['VALUE']?> осталось:</span>
        <span class="time_sklad"><?=$label?></span>
        <?=$ref_products?>
        <?=$ref_cat?>
		<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
			<div>
                <?= $arItem["PREVIEW_TEXT"];?>
            </div>
		<?endif;?>
		<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
			<div style="clear:both"></div>
		<?endif?>

		<span class="raschet_time">Расчетное время в пути<br>12-14 дней</span>

	</div>
<?endforeach;?>
</div>
