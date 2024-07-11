<?php
/**
 * Created by PhpStorm.
 * User: gasparyan
 * Date: 10.01.2018
 * Time: 16:32
 */

echo '<style>
    .marquee-container {
        height: 20px;
        overflow: hidden;
        margin-bottom: 25px;
        position: relative;
    }
    .marquee-text {
        width: 100000%;
        position: absolute;
        left: 0;
    }

</style>
<script>
    function moveTextMarquee(){
        var $text = $(".marquee-text");
        $text.css("left", parseInt($text.css("left")) - 2);
        
        setTimeout(moveTextMarquee, 50);
        
    }
    
    setTimeout(moveTextMarquee, 3000);
    
</script>
';

$template = '<!--<span class="marque-date">{date} </span>--><span class="marque-products">{products}</span>';

if (CModule::IncludeModule("sale")){
    $arFilter = Array(
        'LOGIC' => 'AND',
        "PERSON_TYPE_ID" => "2",//Юридические лица
        "CANCELED" => "N",
    );

    $arSelect = [
        'PRICE',
        'STATUS_ID',
        'USER_ID'
    ];

    $rsSales = (new CSaleOrder())->GetList(
        ["DATE_INSERT" => "DESC"],
        $arFilter,
        false,
        ['nTopCount' => 50]
    );


    $cache = [];

    while ($arSales = $rsSales->Fetch())
    {

        if(!isset($cache['USER'][$arSales["USER_ID"]])){
            $rsUser = CUser::GetByID($arSales["USER_ID"]);
            $arUser = $rsUser->Fetch();
            $cache['USER'][$arSales["USER_ID"]] = $arUser;
        }else{
            $arUser = $cache['USER'][$arSales["USER_ID"]];
        }


        if(!isset($cache['STATUS'][$arSales["STATUS_ID"]])){
            $arStatus = CSaleStatus::GetByID($arSales['STATUS_ID']);
            $cache['STATUS'][$arSales["STATUS_ID"]] = $arStatus;
        }else{
            $arStatus = $cache['STATUS'][$arSales["STATUS_ID"]];
        }


        $dbBasketItems = (new CSaleBasket)->GetList(
            array(
                "NAME" => "ASC",
                "ID" => "ASC"
            ),
            array(
                "ORDER_ID" => $arSales['ID']
            ),
            false,
            false,
            array("ID", "CALLBACK_FUNC", "MODULE", "PRODUCT_ID", "QUANTITY", "DELAY", "CAN_BUY", "PRICE", "WEIGHT", "PRODUCT_PROVIDER_CLASS", "NAME")
        );

        $products = '';
        while($dbBasketItem = $dbBasketItems->Fetch()){

            $el_res = CIBlockElement::GetByID( $dbBasketItem['PRODUCT_ID'] );
            if ( $el_arr = $el_res->GetNext() ) {
                if($el_arr['ACTIVE'] == 'Y')
                    $products .= '<a target="_blank" href="'.$el_arr[ 'DETAIL_PAGE_URL' ].'">' . $dbBasketItem['NAME'] . '</a> (' . intval($dbBasketItem['QUANTITY']) . ' шт), ';
            }else{
                $products .= $dbBasketItem['NAME'] . ' (' . intval($dbBasketItem['QUANTITY']) . ' шт), ';
            }

        }


        $name = str_replace('  ', ' ', implode(' ', [$arUser['LAST_NAME'], $arUser['NAME'], $arUser['SECOND_NAME']]));


        if(!empty($products)){
            echo str_replace(
                ['{num}', '{products}', '{summ}', '{date}'],
                [$arSales['ID'], $products, number_format($arSales['PRICE'], 2, ',', ' '), $arSales['DATE_INSERT']],
                $template
            );
        }else{
            continue;
        }

    }
}