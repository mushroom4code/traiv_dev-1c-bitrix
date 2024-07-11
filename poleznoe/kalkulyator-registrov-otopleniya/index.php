<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Калькулятор стоимости регистров отопления (цена)");
$APPLICATION->SetTitle("Калькулятор регистров");
?>	<section id="content">
    <div class="container">
        <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "traiv", Array(
            "COMPONENT_TEMPLATE" => ".default",
            "START_FROM" => "0",
            "PATH" => "",
            "SITE_ID" => "zf",
        ),
            false
        ); ?>
<div class="plashka_ff">

        <script type="text/javascript" src="/local/templates/traiv-main/js/vendor/jquery-ui.js"></script>

        <div class="region region-content">

            <div id="block-block-15" class="block block-block">
                <div class="block-inner">
                    <div class="content">
<h1>Калькулятор регистров</h1>
                        <p>Онлайн-калькулятор предназначен для расчёта характеристик и стоимости регистров отопления из гладких труб. С его помощью Вы можете рассчитать регистр отопления с нужными Вам параметрами, такими как: длина (без учёта входных/выходных патрубков), диаметр основной трубы, количество рядов (сегментов, секций) и тип конструкции. Дополнительные опции — грунтовка и покраска — влияют только на стоимость отопительного прибора и не учитываются в расчётах теплоотдачи и прочих характеристик.</p>
                        <p>Расчётные характеристики пересчитываются автоматически, “на лету”, при изменении входных параметров.</p>
                        <p>Для того, чтобы определить стоимость нестандартных регистров отопления, отправьте нам Ваши эскизы либо спецификации.</p>
                    </div>
                </div>
            </div>

            <div id="block-system-main" class="block block-system">
                <div class="block-inner">
                    <div class="content">
                        <?/*<form action="" method="post" id="ajax-calculator-form" accept-charset="UTF-8"><div><a name="t" id="t"></a><p class="text-right table_description" style="padding-bottom:5px;">Цены обновлены 20.11.2017, 16:37 и актуальны на текущий момент.</p><p class="table_diameter_desc text-center"><label>Диаметр и толщина стенки трубы</label></p>
                                <table id="table_diameter" class="table table-bordered">
                                    <thead><tr><th>D \ T</th><th>2</th><th>2.5</th><th>3</th><th>3.5</th><th>4</th><th>4.5</th><th>5</th><th>6</th></tr></thead><tbody>
                                    <tr><th>42</th><td class="td_value"><div class="form-item form-type-radio form-item-tube-diameter">
                                                <input type="radio" id="edit-tube-diameter-13-17" name="tube_diameter" value="13_17" checked="checked" class="form-radio">  <label class="option" for="edit-tube-diameter-13-17">  </label>

                                            </div>
                                        </td><td class="td_value"><div class="form-item form-type-radio form-item-tube-diameter">
                                                <input type="radio" id="edit-tube-diameter-13-18" name="tube_diameter" value="13_18" class="form-radio">  <label class="option" for="edit-tube-diameter-13-18">  </label>

                                            </div>
                                        </td><td class="td_value"><div class="form-item form-type-radio form-item-tube-diameter">
                                                <input type="radio" id="edit-tube-diameter-13-19" name="tube_diameter" value="13_19" class="form-radio">  <label class="option" for="edit-tube-diameter-13-19">  </label>

                                            </div>
                                        </td><td class="td_empty"></td><td class="td_empty"></td><td class="td_empty"></td><td class="td_empty"></td><td class="td_empty"></td></tr><tr><th>48</th><td class="td_value"><div class="form-item form-type-radio form-item-tube-diameter">
                                                <input type="radio" id="edit-tube-diameter-14-17" name="tube_diameter" value="14_17" class="form-radio">  <label class="option" for="edit-tube-diameter-14-17">  </label>

                                            </div>
                                        </td><td class="td_value"><div class="form-item form-type-radio form-item-tube-diameter">
                                                <input type="radio" id="edit-tube-diameter-14-18" name="tube_diameter" value="14_18" class="form-radio">  <label class="option" for="edit-tube-diameter-14-18">  </label>

                                            </div>
                                        </td><td class="td_value"><div class="form-item form-type-radio form-item-tube-diameter">
                                                <input type="radio" id="edit-tube-diameter-14-19" name="tube_diameter" value="14_19" class="form-radio">  <label class="option" for="edit-tube-diameter-14-19">  </label>

                                            </div>
                                        </td><td class="td_empty"></td><td class="td_empty"></td><td class="td_empty"></td><td class="td_empty"></td><td class="td_empty"></td></tr><tr><th>57</th><td class="td_empty"></td><td class="td_value"><div class="form-item form-type-radio form-item-tube-diameter">
                                                <input type="radio" id="edit-tube-diameter-15-18" name="tube_diameter" value="15_18" class="form-radio">  <label class="option" for="edit-tube-diameter-15-18">  </label>

                                            </div>
                                        </td><td class="td_value"><div class="form-item form-type-radio form-item-tube-diameter">
                                                <input type="radio" id="edit-tube-diameter-15-19" name="tube_diameter" value="15_19" class="form-radio">  <label class="option" for="edit-tube-diameter-15-19">  </label>

                                            </div>
                                        </td><td class="td_value"><div class="form-item form-type-radio form-item-tube-diameter">
                                                <input type="radio" id="edit-tube-diameter-15-20" name="tube_diameter" value="15_20" class="form-radio">  <label class="option" for="edit-tube-diameter-15-20">  </label>

                                            </div>
                                        </td><td class="td_value"><div class="form-item form-type-radio form-item-tube-diameter">
                                                <input type="radio" id="edit-tube-diameter-15-21" name="tube_diameter" value="15_21" class="form-radio">  <label class="option" for="edit-tube-diameter-15-21">  </label>

                                            </div>
                                        </td><td class="td_empty"></td><td class="td_empty"></td><td class="td_empty"></td></tr><tr><th>76</th><td class="td_empty"></td><td class="td_value"><div class="form-item form-type-radio form-item-tube-diameter">
                                                <input type="radio" id="edit-tube-diameter-16-18" name="tube_diameter" value="16_18" class="form-radio">  <label class="option" for="edit-tube-diameter-16-18">  </label>

                                            </div>
                                        </td><td class="td_value"><div class="form-item form-type-radio form-item-tube-diameter">
                                                <input type="radio" id="edit-tube-diameter-16-19" name="tube_diameter" value="16_19" class="form-radio">  <label class="option" for="edit-tube-diameter-16-19">  </label>

                                            </div>
                                        </td><td class="td_value"><div class="form-item form-type-radio form-item-tube-diameter">
                                                <input type="radio" id="edit-tube-diameter-16-20" name="tube_diameter" value="16_20" class="form-radio">  <label class="option" for="edit-tube-diameter-16-20">  </label>

                                            </div>
                                        </td><td class="td_value"><div class="form-item form-type-radio form-item-tube-diameter">
                                                <input type="radio" id="edit-tube-diameter-16-21" name="tube_diameter" value="16_21" class="form-radio">  <label class="option" for="edit-tube-diameter-16-21">  </label>

                                            </div>
                                        </td><td class="td_empty"></td><td class="td_empty"></td><td class="td_empty"></td></tr><tr><th>89</th><td class="td_empty"></td><td class="td_empty"></td><td class="td_value"><div class="form-item form-type-radio form-item-tube-diameter">
                                                <input type="radio" id="edit-tube-diameter-17-19" name="tube_diameter" value="17_19" class="form-radio">  <label class="option" for="edit-tube-diameter-17-19">  </label>

                                            </div>
                                        </td><td class="td_value"><div class="form-item form-type-radio form-item-tube-diameter">
                                                <input type="radio" id="edit-tube-diameter-17-20" name="tube_diameter" value="17_20" class="form-radio">  <label class="option" for="edit-tube-diameter-17-20">  </label>

                                            </div>
                                        </td><td class="td_value"><div class="form-item form-type-radio form-item-tube-diameter">
                                                <input type="radio" id="edit-tube-diameter-17-21" name="tube_diameter" value="17_21" class="form-radio">  <label class="option" for="edit-tube-diameter-17-21">  </label>

                                            </div>
                                        </td><td class="td_empty"></td><td class="td_empty"></td><td class="td_empty"></td></tr><tr><th>108</th><td class="td_empty"></td><td class="td_empty"></td><td class="td_value"><div class="form-item form-type-radio form-item-tube-diameter">
                                                <input type="radio" id="edit-tube-diameter-18-19" name="tube_diameter" value="18_19" class="form-radio">  <label class="option" for="edit-tube-diameter-18-19">  </label>

                                            </div>
                                        </td><td class="td_value"><div class="form-item form-type-radio form-item-tube-diameter">
                                                <input type="radio" id="edit-tube-diameter-18-20" name="tube_diameter" value="18_20" class="form-radio">  <label class="option" for="edit-tube-diameter-18-20">  </label>

                                            </div>
                                        </td><td class="td_value"><div class="form-item form-type-radio form-item-tube-diameter">
                                                <input type="radio" id="edit-tube-diameter-18-21" name="tube_diameter" value="18_21" class="form-radio">  <label class="option" for="edit-tube-diameter-18-21">  </label>

                                            </div>
                                        </td><td class="td_value"><div class="form-item form-type-radio form-item-tube-diameter">
                                                <input type="radio" id="edit-tube-diameter-18-22" name="tube_diameter" value="18_22" class="form-radio">  <label class="option" for="edit-tube-diameter-18-22">  </label>

                                            </div>
                                        </td><td class="td_value"><div class="form-item form-type-radio form-item-tube-diameter">
                                                <input type="radio" id="edit-tube-diameter-18-23" name="tube_diameter" value="18_23" class="form-radio">  <label class="option" for="edit-tube-diameter-18-23">  </label>

                                            </div>
                                        </td><td class="td_empty"></td></tr><tr><th>114</th><td class="td_empty"></td><td class="td_empty"></td><td class="td_empty"></td><td class="td_empty"></td><td class="td_value"><div class="form-item form-type-radio form-item-tube-diameter">
                                                <input type="radio" id="edit-tube-diameter-19-21" name="tube_diameter" value="19_21" class="form-radio">  <label class="option" for="edit-tube-diameter-19-21">  </label>

                                            </div>
                                        </td><td class="td_value"><div class="form-item form-type-radio form-item-tube-diameter">
                                                <input type="radio" id="edit-tube-diameter-19-22" name="tube_diameter" value="19_22" class="form-radio">  <label class="option" for="edit-tube-diameter-19-22">  </label>

                                            </div>
                                        </td><td class="td_value"><div class="form-item form-type-radio form-item-tube-diameter">
                                                <input type="radio" id="edit-tube-diameter-19-23" name="tube_diameter" value="19_23" class="form-radio">  <label class="option" for="edit-tube-diameter-19-23">  </label>

                                            </div>
                                        </td><td class="td_empty"></td></tr><tr><th>133</th><td class="td_empty"></td><td class="td_empty"></td><td class="td_empty"></td><td class="td_empty"></td><td class="td_value"><div class="form-item form-type-radio form-item-tube-diameter">
                                                <input type="radio" id="edit-tube-diameter-20-21" name="tube_diameter" value="20_21" class="form-radio">  <label class="option" for="edit-tube-diameter-20-21">  </label>

                                            </div>
                                        </td><td class="td_value"><div class="form-item form-type-radio form-item-tube-diameter">
                                                <input type="radio" id="edit-tube-diameter-20-22" name="tube_diameter" value="20_22" class="form-radio">  <label class="option" for="edit-tube-diameter-20-22">  </label>

                                            </div>
                                        </td><td class="td_value"><div class="form-item form-type-radio form-item-tube-diameter">
                                                <input type="radio" id="edit-tube-diameter-20-23" name="tube_diameter" value="20_23" class="form-radio">  <label class="option" for="edit-tube-diameter-20-23">  </label>

                                            </div>
                                        </td><td class="td_empty"></td></tr><tr><th>159</th><td class="td_empty"></td><td class="td_empty"></td><td class="td_empty"></td><td class="td_empty"></td><td class="td_value"><div class="form-item form-type-radio form-item-tube-diameter">
                                                <input type="radio" id="edit-tube-diameter-21-21" name="tube_diameter" value="21_21" class="form-radio">  <label class="option" for="edit-tube-diameter-21-21">  </label>

                                            </div>
                                        </td><td class="td_value"><div class="form-item form-type-radio form-item-tube-diameter">
                                                <input type="radio" id="edit-tube-diameter-21-22" name="tube_diameter" value="21_22" class="form-radio">  <label class="option" for="edit-tube-diameter-21-22">  </label>

                                            </div>
                                        </td><td class="td_value"><div class="form-item form-type-radio form-item-tube-diameter">
                                                <input type="radio" id="edit-tube-diameter-21-23" name="tube_diameter" value="21_23" class="form-radio">  <label class="option" for="edit-tube-diameter-21-23">  </label>

                                            </div>
                                        </td><td class="td_value"><div class="form-item form-type-radio form-item-tube-diameter">
                                                <input type="radio" id="edit-tube-diameter-21-24" name="tube_diameter" value="21_24" class="form-radio">  <label class="option" for="edit-tube-diameter-21-24">  </label>

                                            </div>
                                        </td></tr><tr><th>219</th><td class="td_empty"></td><td class="td_empty"></td><td class="td_empty"></td><td class="td_empty"></td><td class="td_empty"></td><td class="td_empty"></td><td class="td_value"><div class="form-item form-type-radio form-item-tube-diameter">
                                                <input type="radio" id="edit-tube-diameter-22-23" name="tube_diameter" value="22_23" class="form-radio">  <label class="option" for="edit-tube-diameter-22-23">  </label>

                                            </div>
                                        </td><td class="td_value"><div class="form-item form-type-radio form-item-tube-diameter">
                                                <input type="radio" id="edit-tube-diameter-22-24" name="tube_diameter" value="22_24" class="form-radio">  <label class="option" for="edit-tube-diameter-22-24">  </label>

                                            </div>
                                        </td></tr></tbody></table><div class="row"><div class="col-md-6 col-sm-6 col-xs-6"><div class="form-item form-type-textfield form-item-count-segments">
                                            <label for="edit-count-segments">Количество рядов </label>
                                            <input type="text" id="edit-count-segments" name="count_segments" value="2" size="5" maxlength="128" class="form-text">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6"><div class="form-item-length-register"><label>Длина регистра</label><div><div class="form-item form-type-textfield form-item-length-register-m">
                                                    <input type="text" id="edit-length-register-m" name="length_register_m" value="3.9" size="5" maxlength="128" class="form-text"> <span class="field-suffix">м.</span>
                                                </div>
                                                <div class="form-item form-type-textfield form-item-length-register-sm">
                                                    <input type="text" id="edit-length-register-sm" name="length_register_sm" value="0" size="5" maxlength="128" class="form-text"> <span class="field-suffix">см.</span>
                                                </div>
                                            </div></div></div></div><div class="row"><div class="col-md-6 col-sm-6  col-xs-6"><div class="form-item form-type-radios form-item-type-gag">
                                            <label for="edit-type-gag">Тип заглушек </label>
                                            <div id="edit-type-gag" class="form-radios"><div class="form-item form-type-radio form-item-type-gag">
                                                    <input type="radio" id="edit-type-gag-0" name="type_gag" value="0" checked="checked" class="form-radio">  <label class="option" for="edit-type-gag-0">Плоские </label>

                                                </div>
                                                <div class="form-item form-type-radio form-item-type-gag">
                                                    <input type="radio" id="edit-type-gag-1" name="type_gag" value="1" class="form-radio">  <label class="option" for="edit-type-gag-1">Эллиптические </label>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6  col-xs-6"><div class="form-item form-type-radios form-item-type-construction">
                                            <label for="edit-type-construction">Тип конструкции </label>
                                            <div id="edit-type-construction" class="form-radios"><div class="form-item form-type-radio form-item-type-construction">
                                                    <input type="radio" id="edit-type-construction-3" name="type_construction" value="3" class="form-radio">  <label class="option" for="edit-type-construction-3">Однорядный </label>

                                                </div>
                                                <div class="form-item form-type-radio form-item-type-construction">
                                                    <input type="radio" id="edit-type-construction-0" name="type_construction" value="0" checked="checked" class="form-radio">  <label class="option" for="edit-type-construction-0">Секционный </label>

                                                </div>
                                                <div class="form-item form-type-radio form-item-type-construction">
                                                    <input type="radio" id="edit-type-construction-1" name="type_construction" value="1" class="form-radio">  <label class="option" for="edit-type-construction-1">Змеевиковый </label>

                                                </div>
                                                <div class="form-item form-type-radio form-item-type-construction">
                                                    <input type="radio" id="edit-type-construction-2" name="type_construction" value="2" class="form-radio">  <label class="option" for="edit-type-construction-2">Автономный </label>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="total_price_calc">Цена - <span></span> рублей<!--<input type="submit" id="edit-submit" name="op" value="В корзину" class="form-submit">--></div>
                                <noindex>
                                    <table id="table-client-info" class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th width="40%">Параметр</th>
                                            <th width="20%">Единицы измерения</th>
                                            <th width="40%">Значение</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr><td>Модель</td><td></td><td class="model-name"></td></tr>
                                        <tr><td>Тип конструкции</td><td></td><td class="type-construction"></td></tr>
                                        <tr><td>Торцевые заглушки</td><td></td><td class="type-gag"></td></tr>
                                        <tr><td>Тип установки</td><td></td><td class="type-mounting"></td></tr>
                                        <tr><td>Количество рядов</td><td>шт</td><td class="count-segments"></td></tr>
                                        <tr><td>Диаметр трубы</td><td>мм</td><td class="tube-diameter"></td></tr>
                                        <tr><td>Толщина стенки</td><td>мм</td><td class="wall-thickness"></td></tr>
                                        <tr><td>Длина</td><td>мм</td><td class="length-register"></td></tr>
                                        <tr><td>Высота</td><td>мм</td><td class="construction-height"></td></tr>
                                        <tr><td>Глубина</td><td>мм</td><td class="construction-depth"></td></tr>
                                        <tr><td>Диаметр перемычек</td><td>мм</td><td class="diameter-jumpers"></td></tr>
                                        <tr><td>Межосевое расстояние</td><td>мм</td><td class="axle-base-distance"></td></tr>
                                        <tr><td>Расстояние между рядами</td><td>мм</td><td class="distance-segments"></td></tr>
                                        <tr><td>Площадь поверхности</td><td>м<sup>2</sup></td><td class="surface-area"></td></tr>
                                        <tr><td>Суммарная длина гладких труб</td><td>м</td><td class="total-length-tube"></td></tr>
                                        <tr><td>Объём теплоносителя</td><td>л | м<sup>3</sup></td><td class="volume-coolant"></td></tr>
                                        <tr><td>Максимальная мощность</td><td>Вт</td><td class="calculation-maximum-power"></td></tr>
                                        <tr><td>Вес</td><td>кг</td><td class="calculation-weight"></td></tr>
                                        <!-- <tr><td>Стоимость грунтовки</td><td>руб</td><td class="calculation-price-ground"></td></tr>
                                        <tr><td>Стоимость покраски</td><td>руб</td><td class="calculation-price-painting"></td></tr> -->
                                        <tr><td>Цена</td><td>руб</td><td class="calculation_price"></td></tr>
                                        </tbody>
                                    </table>
                                </noindex>
                                <input type="hidden" name="form_build_id" value="form-bL-xypgwGSo2tO5bdEUVZNFoXFAYyV9FjCc3gqeaMOs">
                                <input type="hidden" name="form_id" value="ajax_calculator_form">
                            </div>
                        </form>*/?>
                        <div class="form-calculator" >
                            <div class="reg-type-select x1d3 x1d1--s">
                                Тип
                                <input name="reg-type" value="a" type="radio" id="reg-type-a" checked>
                                <label for="reg-type-a" class="label-checkbox"><img src="/images/registri_otopleniya/reg-type-a.png" class="responsive" alt=""></label>

                                <input name="reg-type" value="b" type="radio" id="reg-type-b">
                                <label for="reg-type-b" class="label-checkbox"><img src="/images/registri_otopleniya/reg-type-b.png" class="responsive" alt=""></label>
                            </div>
                            <div class="reg-type-select x1d7 x0d1--s"></div>
                            <div class="reg-sizes-select x1d2 x1d1--s">
                                <label for="reg-size-diameter">Диаметр трубы в мм</label>
                                <select name="" id="reg-size-diameter">
                                    <option value="57"  data-price-a="480.7"    data-price-b="437">57</option>
                                    <option value="76"  data-price-a="649"      data-price-b="590">76</option>
                                    <option value="89"  data-price-a="770"      data-price-b="700">89</option>
                                    <option value="108" data-price-a="935"      data-price-b="850">108</option>
                                    <option value="114" data-price-a="1019.7"   data-price-b="927">114</option>
                                    <option value="133" data-price-a="1196.8"   data-price-b="1088">133</option>
                                    <option value="159" data-price-a="1612.6"   data-price-b="1466">159</option>
                                </select>
                            </div>
                            <div class="reg-type-select x1d7 x0d1--s"></div>
                            <div class="reg-params-input x1d2 x1d1--s">
                                Длина регистра в мм
                                <input class="form-control" placeholder="Длина регистров" id="reg-size-length" type="number" min="1">
                                Количество рядов
                                <!--<input class="form-control" placeholder="Количество рядов" id="reg-size-count" type="number" min="1">-->
                                <select id="reg-size-count">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                </select>
                                Краска
                                <select id="reg-color">
                                    <option value="0" selected >Без покраски</option>
                                    <option value="1">Грунт стандартный красный</option>
                                    <option value="1">Грунт стандартный серый</option>
                                    <option value="1">Покраска по каталогу RAL</option>
                                </select>
                            </div>
                            <div class="reg-type-select x1d7 x0d1--s"></div>
                            <div class="reg-result x1d2 x1d1--s">
                                <span>Итого: </span><span id="reg-total-price">0</span>
                            </div>
                            <div><a href="#reg-form" class="btn-mfp-dialog"><button id="reg-submit" class="btn btn--submit">Сформировать заявку</button></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id='reg-form' class="popup-dialog mfp-hide">
        <?
            $APPLICATION->IncludeComponent("bitrix:form.result.new", "registr", Array(
	"COMPONENT_TEMPLATE" => "recall",
		"WEB_FORM_ID" => "8",	// ID веб-формы
		"IGNORE_CUSTOM_TEMPLATE" => "N",	// Игнорировать свой шаблон
		"USE_EXTENDED_ERRORS" => "Y",	// Использовать расширенный вывод сообщений об ошибках
		"SEF_MODE" => "N",	// Включить поддержку ЧПУ
		"CACHE_TYPE" => "N",	// Тип кеширования
		"LIST_URL" => "/ajax/forms/registr_success.php",	// Страница со списком результатов
		"EDIT_URL" => "/ajax/forms/registr_success.php",	// Страница редактирования результата
		"SUCCESS_URL" => "/ajax/forms/registr_success.php",	// Страница с сообщением об успешной отправке
		"CHAIN_ITEM_TEXT" => "",	// Название дополнительного пункта в навигационной цепочке
		"CHAIN_ITEM_LINK" => "",	// Ссылка на дополнительном пункте в навигационной цепочке
		"CACHE_TIME" => "3600",	// Время кеширования (сек.)
		"VARIABLE_ALIASES" => array(
			"WEB_FORM_ID" => "WEB_FORM_ID",
			"RESULT_ID" => "RESULT_ID",
		)
	),
	false
);?>
            <script src="/local/templates/traiv-main/js/sendFormAjax.js"></script>
            </div>

        <style>
            .form-calculator .reg-type-select input[type="radio"]{
                display: none;
            }
            .form-calculator label.label-checkbox{
                display: block;
                cursor: pointer;
            }
            .form-calculator input:checked+label.label-checkbox{
                padding: 0;
                background: #eeeeee;
            }
            .form-calculator {
                background: white;
                padding: 50px 30px;
                margin: 0 auto;
                min-width: 250px;
                overflow: hidden;
            }

            .form-calculator > *,
            .form-calculator .reg-params-input > input,
            .form-calculator #reg-size-count + .selectbox{
                margin-bottom: 30px;
            }
            .form-calculator > *:last-child{
                margin-bottom: 0;
            }
            .form-calculator > *{
                float: left;
            }
            form#reg-form {
                background: white;
            }
            #reg-size-count+.selectbox .selectbox__options,
            #reg-color+.selectbox .selectbox__options{
                max-height: 120px;
            }
        </style>
        <script>
            $('#reg-size-length, #reg-size-count, #reg-color').on('keyup change', calcReg);
            $('#reg-size-diameter').on('change', calcReg);
            $('input[name="reg-type"]').on('change', calcReg);

            function calcReg(){

                var totalPrice = 0;

                var type = $('input[name="reg-type"]:checked').val();
                var length = parseFloat($('#reg-size-length').val());
                var count = parseFloat($('#reg-size-count').val());
                var diameter = $('#reg-size-diameter').val();
                var isColor = parseInt($('#reg-color').val()) > 0 ? 40 : 0;
                var colorText = $( "#reg-color option:selected" ).text();

                var price = $('#reg-size-diameter option:selected').data('price-' + type);

                if((price > 0) && (length > 0) && (count > 0)){
                    totalPrice = ((price + isColor) * length/1000 * count).toFixed(2);
                }

                $('#reg-textarea').val('Мне необходимы регистры типа "'+type+'", размер '+diameter+', длина '+
                    length+'мм, в количестве '+count+' шт ' + (isColor ? 'c окрашиванием (' + colorText + ')' : 'без окраски') );

                $('#reg-total-price').html(totalPrice);
            }
        </script>
        <?/*
        <link href="/local/templates/traiv-main/css/jquery-ui.css" rel="stylesheet" type="text/css">
        <link href="/local/templates/traiv-main/css/calc_radiator.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="/local/templates/traiv-main/js/calc_radiator.js"></script>
        */?>

    <div class="social_share_2020" style="margin-top: 2%"><div data-mobile-view="true" data-share-size="30" data-like-text-enable="false" data-background-alpha="0.0" data-pid="1889365" data-mode="share" data-background-color="#ffffff" data-hover-effect="scale" data-share-shape="round-rectangle" data-share-counter-size="12" data-icon-color="#ffffff" data-mobile-sn-ids="vk.mr.fb.ok.tw.wh.tm.vb." data-text-color="#000000" data-buttons-color="#ffffff" data-counter-background-color="#ffffff" data-share-counter-type="disable" data-orientation="horizontal" data-following-enable="false" data-sn-ids="vk.mr.ok.fb.tw.wh.tm.vb." data-preview-mobile="false" data-selection-enable="true" data-exclude-show-more="true" data-share-style="2" data-counter-background-alpha="1.0" data-top-button="true" class="uptolike-buttons" ></div>
    </div>

    </div>
    </div>
    </section><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>