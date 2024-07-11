<? if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die(); ?>

<div class="traiv-filter-form-default">
    <div class="header-filter">Подбор крепежа по параметрам</div>
    <form method="get" action="/search/">
    <table>
        <tr class="labels">
            <td><label>Вид крепежа:</label></td>
            <td><label>Диаметр, мм</label></td>
            <td><label>Длинна, мм</label></td>
        </tr>
        <tr>
            <td>
                <div class="label">Вид крепежа:</div>
                <select name="vid">
                    <option>Не выбран</option>
                    <? foreach ($arResult["VID_KREPEWA"] as $id => $name):
                        $select = ($id == $arResult["SELECT"]["VID"]) ? 'selected="selected"' : '';
                        ?>
                        <option value="<?=$id?>" <?=$select?>><?=$name?></option>
                    <? endforeach;?>
                </select>
            </td>
            <td>
                <div class="label">Диаметр, мм</div>
                <input type="text" name="diametr" value="<?=$arResult["SELECT"]["DIAMETR"] ?>" />
            </td>
            <td>
                <div class="label">Длинна, мм</div>
                <input type="text" name="dlina" value="<?=$arResult["SELECT"]["DLINA"] ?>" />
            </td>
        </tr>
        <tr class="labels">
            <td><label>DIN, ISO, ГОСТ:</label></td>
            <td><label>Материал:</label></td>
            <td><label>Тип покрытия:</label></td>
        </tr>
        <tr>
            <td>
                <div class="label">DIN, ISO, ГОСТ:</div>
                <select name="gost">
                    <option>Не выбран</option>
                    <? foreach ($arResult["GOST"] as $id => $name):
                        $select = ($id == $arResult["SELECT"]["GOST"]) ? 'selected="selected"' : '';
                        ?>
                        <option value="<?=$id?>" <?=$select?>><?=$name?></option>
                    <? endforeach;?>
                </select>
            </td>
            <td>
                <div class="label">Материал:</div>
                <select name="material">
                    <option>Не выбран</option>
                    <? foreach ($arResult["MATERIAL"] as $id => $name):
                        $select = ($id == $arResult["SELECT"]["MATERIAL"]) ? 'selected="selected"' : '';
                    ?>
                        <option value="<?=$id?> <?=$select?>"><?=$name?></option>
                    <? endforeach;?>
                </select>
            </td>
            <td>
                <div class="label">Тип покрытия:</div>
                <select name="pokrytie">
                    <option>Не выбран</option>
                    <? foreach ($arResult["POKRYTIE"] as $id => $name):
                        $select = ($id == $arResult["SELECT"]["POKRYTIE"]) ? 'selected="selected"' : '';
                        ?>
                        <option value="<?=$id?>" <?=$select?>><?=$name?></option>
                    <? endforeach;?>
                </select>
            </td>
        </tr>
    </table>
    <div class="search-text">Поиск</div>
    <div class="button-send"></div>
    </form>
</div>
