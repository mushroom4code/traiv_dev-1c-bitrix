<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?><?
/*
Скопируйте этот файл в папку /bitrix/admin/reports и измените по своему усмотрению

$ORDER_ID - ID текущего заказа

$arOrder - массив атрибутов заказа (ID, доставка, стоимость, дата создания и т.д.)
Следующий PHP код:
print_r($arOrder);
выведет на экран содержимое массива $arOrder.

$arOrderProps - массив свойств заказа (вводятся покупателями при оформлении заказа) следующей структуры:
array(
	"мнемонический код (или ID если мнемонический код пуст) свойства" => "значение свойства"
	)

$arParams - массив из настроек Печатных форм

$arUser - массив из настроек пользователя, совершившего заказ
*/

$buyer = [];
if(!empty($arParams["BUYER_COMPANY_NAME"])){
    $buyer['name'] =  $arParams["BUYER_COMPANY_NAME"];
}else{
    $buyer['name'] =
        implode(
            ' ',
            array(
                $arParams["BUYER_LAST_NAME"],
                $arParams["BUYER_FIRST_NAME"],
                $arParams["BUYER_SECOND_NAME"]
            )
        );
}

if (!empty(($arParams["BUYER_INN"]))){
    $buyer['INN'] = 'ИНН ' . $arParams["BUYER_INN"];
    $buyer['KPP'] = 'КПП ' . $arParams["BUYER_KPP"];
}

$buyer['ADDRESS'] = implode(',', array_diff(array(
    $arParams["BUYER_COUNTRY"],
    $arParams["BUYER_INDEX"],
    $arParams["BUYER_CITY"],
    $arParams["BUYER_ADDRESS"]
), array('')));

if (!empty($arParams["BUYER_CONTACT"])) {
    $buyer['BUYER_CONTACT'] = $arParams["BUYER_CONTACT"];
}


if (!empty($arParams["BUYER_PHONE"])){
    $buyer['PHONE'] = $arParams["BUYER_PHONE"];
}



?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html xmlns:v="urn:schemas-microsoft-com:vml"
      xmlns:o="urn:schemas-microsoft-com:office:office"
      xmlns:w="urn:schemas-microsoft-com:office:word"
      xmlns="http://www.w3.org/TR/REC-html40">

<head>
    <meta http-equiv=Content-Type content="text/html; charset=<?=LANG_CHARSET?>">
    <title langs="ru">Счет</title>
    <style>
        <!--
        /* Style Definitions */
        p.MsoNormal, li.MsoNormal, div.MsoNormal
        {mso-style-parent:"";
            margin:0cm;
            margin-bottom:.0001pt;
            mso-pagination:widow-orphan;
            font-size:12.0pt;
            font-family:"Times New Roman";
            mso-fareast-font-family:"Times New Roman";}
        p
        {margin-right:0cm;
            mso-margin-top-alt:auto;
            mso-margin-bottom-alt:auto;
            margin-left:0cm;
            mso-pagination:widow-orphan;
            font-size:12.0pt;
            font-family:"Times New Roman";
            mso-fareast-font-family:"Times New Roman";}
        @page Section1
        {size:595.3pt 841.9pt;
            margin:2.0cm 42.5pt 2.0cm 3.0cm;
            mso-header-margin:35.4pt;
            mso-footer-margin:35.4pt;
            mso-paper-source:0;}
        div.Section1
        {page:Section1;}
        -->
    </style>
</head>

<body bgcolor=white lang=RU style='max-width: 800px'>
<div class=Section1>
    <center style="font-size: 9px;">
        <p style="font-size: 13px;">Внимание! Оплата данного счета означает полное согласие с условиями поставки.
            Срок действия данного счета составляет 3 (три) банковских дня. При превышении указанного срока
            требуется дополнительное согласование актуальной цены. При изменении курса Рубля к Евро, установленного
            ЦБ РФ, более чем на 2%, до поступления денежных средств на расчетный счет поставщика, он оставляет за
            собой право на пересчет цен согласно установленному курсу ЦБ РФ на день поступления оплаты по данному счету.
        </p>
        <img src="/images/print/logotype.png">
        <p>
            <b>Бесплатная единая справочная линия по России: <?=$arParams["PHONE"]?></b>
        </p>
    </center>
    <table  border="1" cellpadding="5" width="800" style="border-collapse: collapse;">
        <tr>
            <td colspan="2" rowspan="2">
                <?=$arParams["RSCH_BANK"]?><br>
                г. <?=$arParams["RSCH_CITY"]?><br>
                Банк получателя
            </td>
            <td>БИК</td>
            <td rowspan="2">
                <?=$arParams["BIK"]?><br>
                <?=$arParams["KSCH"]?>
            </td>
        </tr>
        <tr>
            <td>Сч. №</td>
        </tr>
        <tr>
            <td>ИНН   <?=$arParams["INN"]?></td>
            <td>КПП   <?=$arParams["KPP"]?></td>
            <td rowspan="2">Сч. №</td>
            <td rowspan="2"><?=$arParams["RSCH"]?></td>
        </tr>
        <tr>
            <td colspan="2"><?=$arParams["COMPANY_NAME"]?></td>
        </tr>
    </table>
    <p><b>СЧЕТ N: <?echo $arOrder["ACCOUNT_NUMBER"]?> от <?echo $arOrder["DATE_INSERT_FORMAT"]?></b></p>
    <table>
        <tr>
            <td>Поставщик:</td>
            <td><b><?= implode(
                ', ',
                array(

                    $arParams["COMPANY_NAME"],
                    'ИНН ' . $arParams["INN"],
                    'КПП ' . $arParams["KPP"],
                    $arParams["INDEX"],
                    $arParams["CITY"],
                    $arParams["ADDRESS"],
                    $arParams["PHONE"]
                )
                ) ?></b></td>
        </tr>
        <tr>
            <td>Покупатель:</td>
            <td><b><?= implode(', ',$buyer) ?></b></td>
        </tr>

    </table>
    <?
    $priceTotal = 0;
    $bUseVat = false;
    $arBasketOrder = array();
    for ($i = 0, $max = count($arBasketIDs); $i < $max; $i++)
    {
    $arBasketTmp = CSaleBasket::GetByID($arBasketIDs[$i]);

    if (floatval($arBasketTmp["VAT_RATE"]) > 0 )
    $bUseVat = true;

    $priceTotal += $arBasketTmp["PRICE"]*$arBasketTmp["QUANTITY"];

    $arBasketTmp["PROPS"] = array();
    if (isset($_GET["PROPS_ENABLE"]) && $_GET["PROPS_ENABLE"] == "Y")
    {
    $dbBasketProps = CSaleBasket::GetPropsList(
    array("SORT" => "ASC", "NAME" => "ASC"),
    array("BASKET_ID" => $arBasketTmp["ID"]),
    false,
    false,
    array("ID", "BASKET_ID", "NAME", "VALUE", "CODE", "SORT")
    );
    while ($arBasketProps = $dbBasketProps->GetNext())
    $arBasketTmp["PROPS"][$arBasketProps["ID"]] = $arBasketProps;
    }

    $arBasketOrder[] = $arBasketTmp;
    }

    //разбрасываем скидку на заказ по товарам
    if (floatval($arOrder["DISCOUNT_VALUE"]) > 0)
    {
    $arBasketOrder = GetUniformDestribution($arBasketOrder, $arOrder["DISCOUNT_VALUE"], $priceTotal);
    }

    //налоги
    $arTaxList = array();
    $db_tax_list = CSaleOrderTax::GetList(array("APPLY_ORDER"=>"ASC"), Array("ORDER_ID" => $ORDER_ID));
    $iNds = -1;
    $i = 0;
    while ($ar_tax_list = $db_tax_list->Fetch())
    {
    $arTaxList[$i] = $ar_tax_list;
    // определяем, какой из налогов - НДС
    // НДС должен иметь код NDS, либо необходимо перенести этот шаблон
    // в каталог пользовательских шаблонов и исправить
    if ($arTaxList[$i]["CODE"] == "NDS")
    $iNds = $i;
    $i++;
    }



    //состав заказа
    ClearVars("b_");
    //$db_basket = CSaleBasket::GetList(($b="NAME"), ($o="ASC"), array("ORDER_ID"=>$ORDER_ID));
    //if ($db_basket->ExtractFields("b_")):
    $arCurFormat = CCurrencyLang::GetCurrencyFormat($arOrder["CURRENCY"]);
    $currency = preg_replace('/(^|[^&])#/', '${1}', $arCurFormat['FORMAT_STRING']);
    ?>
    <table border="0" cellspacing="0" cellpadding="2" width="100%">
        <tr bgcolor="#E2E2E2">
            <td align="center" style="border: 1pt solid #000000; border-right:none;">№</td>
            <td align="center" style="border: 1pt solid #000000; border-right:none;">Товары (работы, услуги)</td>
            <td nowrap align="center" style="border: 1pt solid #000000; border-right:none;">Кол-во</td>
            <td nowrap align="center" style="border: 1pt solid #000000; border-right:none;">Цена,<?=$currency;?></td>
            <td nowrap align="center" style="border: 1pt solid #000000;">Сумма,<?=$currency;?></td>
        </tr>
        <?
        $n = 1;
        $sum = 0.00;
        $arTax = array("VAT_RATE" => 0, "TAX_RATE" => 0);
        $mi = 0;
        $total_sum = 0;
        foreach ($arBasketOrder as $arBasket)
        {
        $nds_val = 0;
        $taxRate = 0;

        if (floatval($arQuantities[$mi]) <= 0)
        $arQuantities[$mi] = DoubleVal($arBasket["QUANTITY"]);

        $b_AMOUNT = DoubleVal($arBasket["PRICE"]);

        //определяем начальную цену
        $item_price = $b_AMOUNT;

        if(DoubleVal($arBasket["VAT_RATE"]) > 0)
        {
        $bVat = true;
        $nds_val = ($b_AMOUNT - DoubleVal($b_AMOUNT/(1+$arBasket["VAT_RATE"])));
        $item_price = $b_AMOUNT - $nds_val;
        $taxRate = $arBasket["VAT_RATE"]*100;
        }
        elseif(!$bUseVat)
        {
        $basket_tax = CSaleOrderTax::CountTaxes($b_AMOUNT*$arQuantities[$mi], $arTaxList, $arOrder["CURRENCY"]);

        for ($i = 0, $max = count($arTaxList); $i < $max; $i++)
        {
        if ($arTaxList[$i]["IS_IN_PRICE"] == "Y")
        {
        $item_price -= $arTaxList[$i]["TAX_VAL"];
        }
        $nds_val += DoubleVal($arTaxList[$i]["TAX_VAL"]);
        $taxRate += ($arTaxList[$i]["VALUE"]);
        }
        }
        $total_nds += $nds_val*$arQuantities[$mi];
        ?>
        <tr valign="top">
            <td bgcolor="#ffffff" style="border: 1pt solid #000000; border-right:none; border-top:none;">
                <?echo $n++ ?>
            </td>
            <td bgcolor="#ffffff" style="border: 1pt solid #000000; border-right:none; border-top:none;">
                <?echo $arBasket["NAME"]; ?>
					<?
                if (is_array($arBasket["PROPS"]) && $_GET["PROPS_ENABLE"] == "Y")
                {
                foreach($arBasket["PROPS"] as $vv)
                {
                if(strlen($vv["VALUE"]) > 0 && $vv["CODE"] != "CATALOG.XML_ID" && $vv["CODE"] != "PRODUCT.XML_ID")
                echo "<div style=\"font-size:8pt\">".$vv["NAME"].": ".$vv["VALUE"]."</div>";
                }
                }
                ?>
            </td>
            <td align="right" bgcolor="#ffffff" style="border: 1pt solid #000000; border-right:none; border-top:none;">
                <?echo Bitrix\Sale\BasketItem::formatQuantity($arQuantities[$mi]); ?>
            </td>
            <td align="right" bgcolor="#ffffff" style="border: 1pt solid #000000; border-right:none; border-top:none;">
                <?echo number_format($arBasket["PRICE"], 2, ',', ' ') ?>
            </td>
            <td align="right" bgcolor="#ffffff" style="border: 1pt solid #000000; border-top:none;">
                <?echo number_format(($arBasket["PRICE"])*$arQuantities[$mi], 2, ',', ' ') ?>
            </td>
        </tr>
        <?
        $total_sum += $arBasket["PRICE"]*$arQuantities[$mi];
        $mi++;
        }//endforeach
        ?>

		<?if (False && DoubleVal($arOrder["DISCOUNT_VALUE"])>0):?>
        <tr>
            <td bgcolor="#ffffff" style="border: 1pt solid #000000; border-right:none; border-top:none;">
                <?echo $n++?>
            </td>
            <td bgcolor="#ffffff" style="border: 1pt solid #000000; border-right:none; border-top:none;">
                Скидка
            </td>
            <td valign="top" align="right" bgcolor="#ffffff" style="border: 1pt solid #000000; border-right:none; border-top:none;">1 </td>
            <td align="right" bgcolor="#ffffff" style="border: 1pt solid #000000; border-right:none; border-top:none;">
                <?echo number_format($arOrder["DISCOUNT_VALUE"], 2, ',', ' ') ?>
            </td>
            <td align="right" bgcolor="#ffffff" style="border: 1pt solid #000000; border-top:none;">
                <?echo number_format($arOrder["DISCOUNT_VALUE"], 2, ',', ' ') ?>
            </td>
        </tr>
        <?endif?>



		<?if (DoubleVal($arOrder["PRICE_DELIVERY"])>0):?>
        <tr>
            <td bgcolor="#ffffff" style="border: 1pt solid #000000; border-right:none; border-top:none;">
                <?echo $n?>
            </td>
            <td bgcolor="#ffffff" style="border: 1pt solid #000000; border-right:none; border-top:none;">
                Доставка <?
                $res = \Bitrix\Sale\Delivery\Services\Table::getList(array(
                'filter' => array(
                '=CODE' => $arOrder["DELIVERY_ID"]
                )
                ));

                if ($deliveryService = $res->fetch())
                if(strlen($deliveryService["NAME"]) > 0)
                echo "(".htmlspecialcharsEx($deliveryService["NAME"]).")";

                $basket_tax = CSaleOrderTax::CountTaxes(DoubleVal($arOrder["PRICE_DELIVERY"]), $arTaxList, $arOrder["CURRENCY"]);
                $nds_val = 0;
                $item_price = DoubleVal($arOrder["PRICE_DELIVERY"]);

                for ($i = 0, $max = count($arTaxList); $i < $max; $i++)
                {
                if ($arTaxList[$i]["IS_IN_PRICE"] == "Y")
                {
                $item_price -= $arTaxList[$i]["TAX_VAL"];
                }
                $nds_val += ($arTaxList[$i]["TAX_VAL"]);
                $total_nds += $nds_val;
                }
                $total_sum += $nds_val+$item_price
                ?>
            </td>
            <td valign="top" align="right" bgcolor="#ffffff" style="border: 1pt solid #000000; border-right:none; border-top:none;">1 </td>
            <td align="right" bgcolor="#ffffff" style="border: 1pt solid #000000; border-right:none; border-top:none;">
                <?echo number_format($arOrder["PRICE_DELIVERY"], 2, ',', ' ') ?>
            </td>
            <td align="right" bgcolor="#ffffff" style="border: 1pt solid #000000; border-top:none;">
                <?echo number_format($arOrder["PRICE_DELIVERY"], 2, ',', ' ') ?>
            </td>
        </tr>
        <?endif?>

		<?
        $db_tax_list = CSaleOrderTax::GetList(array("APPLY_ORDER"=>"ASC"), Array("ORDER_ID"=>$ORDER_ID));
        while ($ar_tax_list = $db_tax_list->Fetch())
        {
        ?>
        <tr>
            <td align="right" bgcolor="#ffffff" colspan="4" style="border: 1pt solid #000000; border-right:none; border-top:none;">
                <?
                if ($ar_tax_list["IS_IN_PRICE"]=="Y")
                {
                echo "В том числе ";
                }
                echo htmlspecialcharsbx($ar_tax_list["TAX_NAME"]);
                if ($ar_tax_list["IS_PERCENT"]=="Y")
                {
                echo " (".$ar_tax_list["VALUE"]."%)";
                }
                ?>:
            </td>
            <td align="right" bgcolor="#ffffff" style="border: 1pt solid #000000; border-top:none;">
                <?=number_format($total_nds, 2, ',', ' ')?>
            </td>
        </tr>
        <?
        }
        ?>
        <tr>
            <td align="right" bgcolor="#ffffff" colspan="4" style="border: 1pt solid #000000; border-right:none; border-top:none;">Итого:</td>
            <td align="right" bgcolor="#ffffff" style="border: 1pt solid #000000; border-top:none;"><?echo number_format($total_sum, 2, ',', ' ') ?></td>
        </tr>
    </table>
    Всего наименований <?= $n ?>, на сумму <?= $priceTotal ?> рублей
    <?//endif?>
    <p><b>
        <?
        if ($arOrder["CURRENCY"]=="RUR" || $arOrder["CURRENCY"]=="RUB")
        {
        echo Number2Word_Rus($arOrder["PRICE"]);
        }
        else
        {
        echo SaleFormatCurrency($arOrder["PRICE"], $arOrder["CURRENCY"]);
        }
        ?></b></p>
    <div>
        <p style="font-size: 13px">Уважаемые клиенты, чтобы избежать задержек во время отгрузки товара просим сообщать о своем прибытии ЗАРАНЕЕ!</p>
        <p style="font-size: 13px">Претензии по количеству и качеству принимаются в течение 7 календарных дней с момента получения товара в письменном виде, если иные сроки не указаны в договоре!</p>
        <p style="font-size: 13px">Поставщик оставляет за собой право не рассматривать претензии на сумму менее 3 (трех) %, но не более 300 (трёхсот) рублей, от суммы счета.</p>
    </div>
    <p>&nbsp;</p>
    <table border=0 cellspacing=0 cellpadding=0 width="100%">
        <tr>
            <td width="20%">
                <p class=MsoNormal>Руководитель организации:</p>
            </td>
            <td width="80%">
                <p class=MsoNormal>_______________ <input size="55" style="border:0px solid #000000;font-size:14px;font-style:bold;" type="text" value="/ <?echo ((strlen($arParams["DIRECTOR"]) > 0) ? $arParams["DIRECTOR"] : "______________________________")?> /"></p>
            </td>
        </tr>
        <tr>
            <td>
                <p class=MsoNormal>&nbsp;</p>
            </td>
            <td>
                <p class=MsoNormal>&nbsp;</p>
            </td>
        </tr>
        <tr>
            <td>
                <p class=MsoNormal>&nbsp;</p>
            </td>
            <td>
                <p class=MsoNormal>&nbsp;</p>
            </td>
        </tr>
        <tr>
            <td>
                <p class=MsoNormal>Гл. бухгалтер:</p>
            </td>
            <td>
                <p class=MsoNormal>_______________ <input size="45" style="border:0px solid #000000;font-size:14px;font-style:bold;" type="text" value="/ <?echo ((strlen($arParams["BUHG"]) > 0) ? $arParams["BUHG"] : "______________________________")?> /"></p>
            </td>
        </tr>
    </table>
</div>
</body>
</html>