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
<div class="order-germany">
    <script>
        var TRAIV_NEWS_COUNTER_NEW_DATE = '<?=date("Y-m-d", strtotime($arResult["ITEMS"][0]["DATE_ACTIVE_TO"]))?>';
    </script>
<?foreach($arResult["ITEMS"] as $key => $arItem):
    if ($key > 0) break;
    ?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>

	<div id="<?=$this->GetEditAreaId($arItem['ID']);?>">



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
                $ref_cat = '<a href="'.$section['SECTION_PAGE_URL'].'">'.$section['NAME'].'</a>';
            }
        }





        ?>


        <div class="header"><?echo $arItem["NAME"]?></div>
        <div class="dates">
            <b>До отправления груза<br>в <?=$arItem['PROPERTIES']['city']['VALUE']?> осталось:</b>
            <table>
                <tr class="time">
                    <td class="days"></td>
                    <td>:</td>
                    <td class="hours"></td>
                    <td>:</td>
                    <td class="minutes"></td>
                    <td>:</td>
                    <td class="seconds"></td>
                </tr>
                <tr class="label">
                    <td>дней</td>
                    <td></td>
                    <td>часов</td>
                    <td></td>
                    <td>минут</td>
                    <td></td>
                    <td>секунд</td>
                </tr>
            </table>
        </div>
        <div class="buttons-block">
            <?=$ref_products?>
            <?=$ref_cat?>
        </div>

        <div class="srok">Расчетное время в пути <b>12-14</b> дней</div>

    </div>
<?endforeach;?>
</div>
