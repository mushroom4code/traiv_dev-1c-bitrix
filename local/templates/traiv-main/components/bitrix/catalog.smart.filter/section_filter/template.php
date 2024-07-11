<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);
if(count($arResult["ITEMS"])){
    usort($arResult["ITEMS"], create_function('$a,$b', ' return ($a["VALUE"] < $b["VALUE"]) ? -1 : ($a["VALUE"] == $b["VALUE"] ? 0 : 1); '));
    ?>
    <div class="island">
        <h3 class="md-title">Фильтр по разделу</h3>
        <form name="<?=$arResult["FILTER_NAME"]."_form"?>" action="<?=$arResult["FORM_ACTION"]?>" method="get" class="smartfilter c-filter">
            <?foreach($arResult["HIDDEN"] as $arItem):?>
                <input type="hidden" name="<?=$arItem["CONTROL_NAME"]?>" id="<?=$arItem["CONTROL_ID"]?>" value="<?=$arItem["HTML_VALUE"]?>"/>
            <?endforeach;?>
            <?foreach($arResult["ITEMS"] as $key=>$arItem):?>
                <?
                $key = $arItem["ENCODED_ID"];
                if(isset($arItem["PRICE"])):
                    if ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0)
                        continue;
                    ?>
                    <div class="c-filter__section  <?=$arItem['DISPLAY_EXPANDED'] ? 'is-opened' : '' ?>">
                        <h5 class="c-filter__toggle">Цена</h5>
                        <div class="c-filter__box">
                            <div class="c-filter__aligner">
                                <div class="c-filter__cell">
                                    <label>от</label>
                                </div>
                                <div class="c-filter__cell">
                                    <input
                                            value="<?=$arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
                                            type="text"
                                            name='<?=$arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>'
                                            id='<?=$arItem["VALUES"]["MIN"]["CONTROL_ID"]?>'
                                            placeholder='<?=$arItem["VALUES"]["MIN"]["VALUE"]?>'
                                            onkeyup="smartFilter.keyup(this)"
                                            class="form-control form-control--inline">
                                </div>
                                <div class="c-filter__cell">
                                    <label>до</label>
                                </div>
                                <div class="c-filter__cell">
                                    <input
                                            value="<?=$arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
                                            type="text"
                                            name='<?=$arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>'
                                            id='<?=$arItem["VALUES"]["MAX"]["CONTROL_ID"]?>'
                                            placeholder='<?=$arItem["VALUES"]["MAX"]["VALUE"]?>'
                                            onkeyup="smartFilter.keyup(this)"
                                            class="form-control form-control--inline">
                                </div>
                            </div>
                        </div>
                    </div>
                <?endif?>
            <?endforeach?>

            <?foreach($arResult["ITEMS"] as $key=>$arItem):?>

                <?
                if (empty($arItem["VALUES"]) || isset($arItem["PRICE"])) continue;
                if ($arItem["DISPLAY_TYPE"] == "A"
                    && (
                        $arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0
                    )
                )
                    continue;
                ?><?
                $arCur = current($arItem["VALUES"]);
                switch ($arItem["DISPLAY_TYPE"])
                {
                    case "A":
                        break; // sliders are not needed, so we skipped it
                    case "B"://NUMBERS
                        ?>
                        <div class="c-filter__section   <?=$arItem['DISPLAY_EXPANDED'] ? 'is-opened' : '' ?>">
                            <h5 class="c-filter__toggle"><?=$arItem['NAME']?></h5>
                            <div class="c-filter__box">
                                <div class="c-filter__aligner">
                                    <div class="c-filter__cell">
                                        <label>от</label>
                                    </div>
                                    <div class="c-filter__cell">
                                        <input type="text" name='<?=$arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>' id='<?=$arItem["VALUES"]["MIN"]["CONTROL_ID"]?>' placeholder='<?=$arItem["VALUES"]["MIN"]["VALUE"]?>' onkeyup="smartFilter.keyup(this)" class="form-control form-control--inline">
                                    </div>
                                    <div class="c-filter__cell">
                                        <label>до</label>
                                    </div>
                                    <div class="c-filter__cell">
                                        <input type="text" name='<?=$arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>' id='<?=$arItem["VALUES"]["MAX"]["CONTROL_ID"]?>' placeholder='<?=$arItem["VALUES"]["MAX"]["VALUE"]?>' onkeyup="smartFilter.keyup(this)" class="form-control form-control--inline">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?
                        break;

                    default://CHECKBOXES
                        ?>

                        <div class="c-filter__section   <?=$arItem['DISPLAY_EXPANDED'] ? 'is-opened' : '' ?>">
                            <h5 class="c-filter__toggle"><?=$arItem['NAME']?></h5>
                            <div class="c-filter__box">
                                <ul class="u-clear-list">
                                    <?foreach($arItem["VALUES"] as $val => $ar):
                                        ?><li>
                                        <label class="checkbox">
                                            <input type="checkbox" value="<?=$ar["HTML_VALUE"] ?>" name="<?=$ar["CONTROL_NAME"] ?>" id="<?=$ar["CONTROL_ID"] ?>" <?= $ar["CHECKED"]? 'checked="checked"': '' ?> onclick="smartFilter.click(this)" class="checkbox__input">
                                            <span class="checkbox__inner"><?=$ar['VALUE']?></span>
                                        </label>
                                        </li><?endforeach;?>
                                </ul>
                            </div>
                        </div>
                        <?
                } //switch
                ?>

            <?endforeach?>

            <div class="c-filter__controls">
                <input
                        class="btn btn--submit btn--small"
                        type="submit"
                        id="set_filter"
                        name="set_filter"
                        value="<?=GetMessage("CT_BCSF_SET_FILTER")?>" />
                <input
                        class="btn-reset"
                        type="submit"
                        id="del_filter"
                        name="del_filter"
                        value="<?=GetMessage("CT_BCSF_DEL_FILTER")?>" />

                <div
                        class="c-filter__tooltip"
                        id="modef"
                    <?if(!isset($arResult["ELEMENT_COUNT"])) echo 'style="display:none"';?>
                        style="display: inline-block;">
                    <?echo GetMessage("CT_BCSF_FILTER_COUNT", array("#ELEMENT_COUNT#" => '<span id="modef_num">'.intval($arResult["ELEMENT_COUNT"]).'</span>'));?>
                    <a
                            class="btn btn--submit btn--small"
                            href="<?= $arResult["FILTER_URL"]?>" target=""><?= GetMessage("CT_BCSF_FILTER_SHOW")?></a>
                </div>
            </div>
        </form>
    </div>

    <script>
        var smartFilter = new JCSmartFilter('<?= CUtil::JSEscape($arResult["FORM_ACTION"])?>', 'vertical', <?=CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"])?>);
    </script>

<? }