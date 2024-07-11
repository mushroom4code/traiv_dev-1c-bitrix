<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php"); ?>
<?php
\Bitrix\Main\Loader::includeModule('sale');
\Bitrix\Main\Loader::includeModule('catalog');
$basket = \Bitrix\Sale\Basket::LoadItemsForFUser(
    \Bitrix\Sale\Fuser::getId(),
    SITE_ID
    );

if (!empty($_POST['action']) && $_POST['action'] == 'tobsc' && !empty($_POST['data'])){
/*$data = '[{"item_id":"266423","type":"active","name":"none"},{"item_id":"246958","type":"active","name":"none"},{"item_id":"","type":"none","name":"DIN 7990 Болт неполная резьба М20 х 55 8.8 Цинк"},{"item_id":"299455","type":"active","name":"none"},{"item_id":"126049","type":"active","name":"none"},{"item_id":"112850","type":"active","name":"none"},{"item_id":"124317","type":"active","name":"none"},{"item_id":"","type":"none","name":"DIN 7991 Винт с потайной головкой M20 х 70 10.9 черн."},{"item_id":"","type":"none","name":"DIN 7991 Винт с потайной головкой M20 х 70 10.9 черн."},{"item_id":"239953","type":"active","name":"none"},{"item_id":"208956","type":"active","name":"none"}]';*/
    $arrItems = json_decode($_POST['data'], true);
    
    foreach($arrItems as $item){
        if ($item['type'] == 'active'){
            
            if (intval($item['item_id']))
            {
                Add2BasketByProductID(
                    intval($item['item_id']),
                    1,
                    array(),
                    array()
                    );
            }
            
        } else {
            /*$pseudoId = rand(10000000000, 11000000000);
            $arFields = array(
                "PRODUCT_ID" => $pseudoId,
                "PRODUCT_PRICE_ID" => '1',
                "PRICE" =>  '0',
                "CURRENCY" => "RUB",
                "WEIGHT" => '',
                "QUANTITY" => 1,
                "LID" => LANG,
                "DELAY" => "N",
                "CAN_BUY" => "Y",
                "NAME" => $item['name']. $pseudoId,
                "CALLBACK_FUNC" => "",
                "MODULE" => "",
                "NOTES" => "",
                "ORDER_CALLBACK_FUNC" => "",
                "DETAIL_PAGE_URL" => ""
            );
            $arProps = array();
            $arFields["PROPS"] = $arProps;
            CSaleBasket::Add($arFields);*/
        }
    }
}
?>