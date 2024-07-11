<?php require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");?>
<?php

global $USER;
use Bitrix\Main\Application;
$order_id = $request->getPost("ORDER_ID");

use Bitrix\Main,
    Bitrix\Sale\Basket,
    Bitrix\Sale;

CModule::IncludeModule("sale");
CModule::IncludeModule("catalog");


$arResult = array('status' => false);
// проверяем параметр ORDER_ID
if (isset($order_id) && $order_id > 0){

    $ORDER_ID = intval($order_id); // ID текущего заказа

    $order = \Bitrix\Sale\Order::load($ORDER_ID); // объект заказа

    if ($order){
        
       /* $siteId = 's1';
        $fUserId = \Bitrix\Sale\FUser::getId();
        $productId = '271290';
        $productByBasketItem = null;
        $bProductInBasket = false;
        
        $basket = \Bitrix\Sale\Basket::loadItemsForFUser($fUserId, $siteId);
        $basketItems = $basket->getBasketItems();
        
       
        
        if($basketItems) {
            foreach($basketItems as $basketItem) {
               
                if($basketItem->getField('PRODUCT_ID') == $productId) {
                    $basketPropertyCollection = $basketItem->getPropertyCollection();
                    print_r($basketPropertyCollection->getPropertyValues());
                }
            }
        }*/
        
        
        // создание корзины
        $basketNew = Basket::create(SITE_ID);

        // дублируем корзину заказа
        $basket = $order->getBasket();

        foreach ($basket as $key => $basketItem){
            
            $item = $basketNew->getExistsItem($basketItem->getField('MODULE'), $basketItem->getField('PRODUCT_ID'));
            
            $siteId = 's1';
            $fUserId = \Bitrix\Sale\FUser::getId();
            $productId = $basketItem->getField('PRODUCT_ID');
          $productByBasketItem = null;
            $bProductInBasket = false;
              
            /*gt current cart*/
            $basketNew1 = \Bitrix\Sale\Basket::loadItemsForFUser($fUserId, $siteId);
            $basketItems = $basketNew1->getBasketItems();
            
            if($basketItems) {
                foreach($basketItems as $basketItem1) {
                    /*echo $basketItem1->getField('PRODUCT_ID').' /// ';
                    echo $productId;
                    echo "<br>";*/
                    if($basketItem1->getField('PRODUCT_ID') == $productId) {
                        $productByBasketItem = $basketItem1;
                        $bProductInBasket = true;
                        break;
                    }
                }              
            }
            
                //var_dump($bProductInBasket);
            

            if ($bProductInBasket == true)
				{
				    $productByBasketItem->setField('QUANTITY', $productByBasketItem->getQuantity() + $basketItem->getQuantity());
				}
				else
				{
              $item = $basketNew->createItem('catalog', $basketItem->getProductId());

            $item->setFields(
                array(
                    'QUANTITY' => $basketItem->getQuantity(),
                    'CURRENCY' => $order->getCurrency(),
                    'LID' => SITE_ID,
                    'PRODUCT_PROVIDER_CLASS'=>'\CCatalogProductProvider',
                )
            );      
                }

        }
        
        $rs = $basketNew->save();

        // проверяем результат, присваивает статус ответа
        if ($rs->isSuccess()){
            $arResult['status'] = true;
            $arResult['msg'][] = array('type' => true, 'text' => 'Успешно создан новый заказ, №');
        } else {
            $arResult['msg'][] = array('type' => false, 'text' => $rs->getErrorMessages());
        }

    } else {
        $arResult['msg'][] = array('type' => false, 'text' => 'Не удалось получить заказ №'.$ORDER_ID);
    }

} else {
    $arResult['msg'][] = array('type' => false, 'text' => 'Не передан параметр ORDER_ID');
}

if($arResult["status"] == true)
{
   echo "true";
}

?>
