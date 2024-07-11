<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Онлайн-табло заказов");
?>	<div class="content">
		<div class="container">
<? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "traiv", Array(
                "COMPONENT_TEMPLATE" => ".default",
                "START_FROM" => "0",
                "PATH" => "",
                "SITE_ID" => "s1",
            ),
                false
            );
?>

            <style>
                .content_tb tr td:last-child {
                    text-align: right;
                }
            </style>
            <table class="content_tb" width="90%">
                <thead></thead>
                <tbody>
                    <tr>
                        <th>№ заказа</th>
                        <th>Дата</th>
                        <th>Товары</th>
                        <th>Сумма</th>
                    </tr>
            <?

$template = '<tr><td>{num}<td>{date}<td>{products}<td>{summ}';

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
                    $products .= '<a target="_blank" href="'.$el_arr[ 'DETAIL_PAGE_URL' ].'">' . $dbBasketItem['NAME'] . '</a> (' . intval($dbBasketItem['QUANTITY']) . ' шт)<br>';
            }else{
                $products .= $dbBasketItem['NAME'] . ' (' . intval($dbBasketItem['QUANTITY']) . ' шт)<br>';
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
}	?>
                </tbody>
            </table>
		</div>
	</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");