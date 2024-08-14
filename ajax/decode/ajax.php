<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php"); 
require $_SERVER["DOCUMENT_ROOT"].'/phpspreadsheet/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Bitrix\Main\Loader;
Loader::includeModule("highloadblock");
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;
use PhpOffice\PhpSpreadsheet\Writer\Xls;?>
<?php

if (!empty($_POST['artarr'])){
    //echo $_POST['artarr'];
   $arr = json_decode($_POST['artarr'],true);
   if (count($arr) > 0){
       $i = 1;
       foreach ($arr as $elem){
           if (empty($elem['art'])){
               echo '<div class="row item-decode-file" data-find-res="none" id="item-remove'.$i.'">';
               echo '<div class="col-12 position-relative text-left item-decode-file-truename" data-name="'.$elem['true_name'].'">Позиция в файле - <b>'.$elem['true_name'].' не найдена!</b><div class="item-decode-remove" data-item-decode-id="'.$i.'"><i class="fa fa-remove"></i></div></div>';
               echo '<div class="col-12 pt-2 position-relative text-left"><div class="btn-group-blue-small"><a href="#w-form" class="btn-blue-small"><span>Запросить цену</span></a></div>';
               echo "</div>";
               echo "</div>";
           } else {
               echo '<div class="row item-decode-file" data-find-res="active" id="item-remove'.$i.'">';
               echo '<div class="col-12 position-relative text-left item-decode-file-truename">Позиция в файле - <b>'.$elem['true_name'].'</b><div class="item-decode-remove" data-item-decode-id="'.$i.'" ><i class="fa fa-remove"></i></div></div>';
               echo '<div class="row traiv-catalog-line-default g-0 getArtItem'.$elem['art'].'">';
               
               $db_list_in = CIBlockElement::GetList(array(), ['IBLOCK_ID' => 18, "PROPERTY_CML2_ARTICLE" => $elem['art'], 'ACTIVE'=>'Y' ,  array(), ">CATALOG_PRICE_2" => 0, 'CATALOG_GROUP_ID' => 2], false, false, Array("*","CATALOG_PRICE_2","PROPERTY_624","PROPERTY_610","PROPERTY_611","PROPERTY_613","PROPERTY_612","PROPERTY_453", "PROPERTY_604", "PROPERTY_644","PROPERTY_606", "PROPERTY_417"));
               if ( $db_list_in->SelectedRowsCount() > 0 ){
                   while($item = $db_list_in->GetNext())
                   {
                       $origname = $item["NAME"];
                       $formatedPACKname = preg_replace("/\([^)]+(шт.\)|шт\)|ш\))/","",$origname);
                       $formatedname = preg_replace("/КИТАЙ|Конт|Китай|Россия|Северсталь|РОМЕК|Европа|Евр|Ев|РФ|PU=.*|RU=.*/","",$formatedPACKname);
                       $item['~ADD_URL'] = $item['DETAIL_PAGE_URL']."?action=ADD2BASKET&id=".$item['ID'];
                       
                       $label = '';
                       $buttonLabel = 'Купить';
                       $dlina = $item["PROPERTY_612_VALUE"];
                       $diametr = $item["PROPERTY_613_VALUE"];
                       $material = $item["PROPERTY_610_VALUE"];
                       
                       $printPriceValue = $item['CATALOG_PRICE_2'];
                       $printPriceValue = !empty($printPriceValue) ? $printPriceValue : 'по запросу';
                       
                       ?>

        <div itemscope itemtype="https://schema.org/Product" rel="1">
        <div class="col-12 catalog-list-line pt-1 pb-1" id="<?= $item['ID'] ?>">
        
        <div class="row g-0">
        
        <div class="col-3 col-xl-1 col-lg-1 col-md-1 text-center">
        
        <div class="new-item-line__image overflow-h">
<?$checkUrl = str_replace('https://traiv-komplekt.ru','',$item['CANONICAL_PAGE_URL']);
if ($item['DETAIL_PAGE_URL'] !== $checkUrl)
{
    $item['DETAIL_PAGE_URL'] = $checkUrl;
}?>
<a href="<?= $item['DETAIL_PAGE_URL'] ?>" rel="<?php echo $item["CANONICAL_PAGE_URL"];?>">
<?
if(!empty($item['DETAIL_PICTURE']['SRC']))
{
    $picturl = CFile::ResizeImageGet($item['DETAIL_PICTURE'],array('width'=>35, 'height'=>35), BX_RESIZE_IMAGE_PROPORTIONAL, true);?><img src="<?=$picturl['src']?>" alt="<?=$formatedname?>" id="<?=$item["ID"]?>" itemprop="image"/>
<?
}else{
    $db_groups = CIBlockElement::GetElementGroups($item['ID'], true);
    while($ar_group = $db_groups->Fetch()) 
    {
        $getGroup = CIBlockSection::GetList(array(), array('ID' => $ar_group["ID"],"IBLOCK_ID"=>18, "ACTIVE" => "Y"), false, Array('UF_TAG_SECTION'));
        if($getGroupItem = $getGroup->GetNext()) {
            if ($getGroupItem['UF_TAG_SECTION'] !== '1'){
                $sect_id = $ar_group["ID"];
            }
        }
    }
    $rsElement1 = CIBlockSection::GetList(array(), array('ID' => $sect_id), false, array('ID', 'IBLOCK_SECTION_ID', 'PICTURE'));if($arElement1 = $rsElement1->Fetch()) {$pict = $arElement1['DETAIL_PICTURE']?$arElement['DETAIL_PICTURE']:$arElement1['PICTURE'];}$picturl = CFile::ResizeImageGet($pict,array('width'=>35, 'height'=>35), BX_RESIZE_IMAGE_PROPORTIONAL, true);?><img  src="<?= $picturl['src']?>" alt="<?= $formatedname?>" width="35" height="35" style="padding:0px;" title="<?=$formatedname?>" id="<?=$item["ID"]?>" itemprop="image"/><?}?></a></div>
        
        </div>
        
 <div class="col-7 col-xl-3 col-lg-3 col-md-3" rel="<?php echo $sect_id;?>"><a href="<?= $item['DETAIL_PAGE_URL'] ?>" style="font-size:14px;padding-right:20px;"><!-- <span class="test-quan"><?php echo $item['CATALOG_QUANTITY'];?></span>--></span><span itemprop="name"><?=$formatedname?>
            </span></a></div>
            
            <div class="col-2 col-xl-2 col-lg-2 col-md-2 text-center"><span><?php echo $elem['art'];?></span></div>
                        <div class="col-1 col-xl-1 col-lg-1 col-md-1 text-center d-none d-lg-block"><span><?=$dlina ? '<div style="display: inline-block">M </div> ' . $diametr.' x '.$dlina : $diametr?></span></div>
            <div class="col-1 col-xl-1 col-lg-1 col-md-1 text-center d-none d-lg-block"><span><nobr><?=$material?></nobr></span></div>
            
                        <div class="col-4 col-xl-2 col-lg-2 col-md-2 text-center"><span class="new-item-line__price"><span itemprop="offers" itemscope itemtype="https://schema.org/Offer">
<?if ($printPriceValue !== '0 руб.'){

if ($printPriceValue == 'по запросу') {
    ?>
    <div class="btn-group-blue-small">
                    <a href="#w-form-one-click" class="btn-blue-small">
                        <span>Запросить цену</span>
                    </a>
                </div>
    
<?php 
}
else {
    echo $printPriceValue;
    ?>
    <meta itemprop="price" content="<?php echo floatval($printPriceValue);?>">
    <meta itemprop="priceCurrency" content="RUB">
    <?php 
}

} else {
?>

    <div class="btn-group-blue-small">
                    <a href="#w-form-one-click" class="btn-blue-small">
                        <span>Запросить цену</span>
                    </a>
                </div>

<!-- <a href="#w-form-one-click" class="btn new-item-line-buy opt"><div class="opt-btn-label">Запросить</div></a>--><?
}?></span></span></div>
            
            <div class="col-4 col-xl-1 col-lg-1 col-md-1 text-center">
                <div class="catalog-list-quantity-area">
                <?
                $pack = $item["PROPERTY_604_VALUE"];
                if (empty($pack)){
                    $pack = 1;
                }
                /*!$ymarket ? $pack = $item["PROPERTIES"]["KRATNOST_UPAKOVKI"]["VALUE"] : $pack = 1;!$pack && $pack = 1;*/?>
                <input type="number" name='QUANTITY' class="quantity section_list" id="<?= $item["ID"]?>-item-quantity"  size="5" value="<?=$pack?>" step="<?=$pack?>" min="<?=$pack?>">
                <a href="#" class="quantity_link quantity_link_plus" rel="<?= $item["ID"]?>"><span><i class="fa fa-plus"></i></span></a>
                <a href="#" class="quantity_link quantity_link_minus" rel="<?= $item["ID"]?>"><span><i class="fa fa-minus"></i></span></a>
                </div>
            </div>
            
            <div class="col-4 col-xl-1 col-lg-1 col-md-1 text-center">
            <?php if($item['CATALOG_CAN_BUY_2']) {$item['~ADD_URL'] .= '&QUANTITY=';?>
                <div class="btn-group-blue">
                <a data-href="<?= str_replace("index.php", "", $item['~ADD_URL']); ?>" class="btn-cart-round new-item-line-buy" id = "quan-item-line-<?= $item["ID"]?>" data-ajax-order onclick="ym(18248638,'reachGoal','addToBasketItems'); return true;">
                            <span><i class="fa fa-shopping-cart"></i></span>
                        </a>
                </div>
                <?php 
                }
                ?>
            </div>
            
            </div>
            
</div>
</div>
        <?php 
    }
    }
echo '</div>'; 
               echo "</div>";
           }
           $i++;
       }
   }
}

if (!empty($_POST['art'])){
    
    $db_list_in = CIBlockElement::GetList(array(), ['IBLOCK_ID' => 18, "PROPERTY_CML2_ARTICLE" => $_POST['art'], 'ACTIVE'=>'Y' ,  array(), 'CATALOG_GROUP_ID' => 2], false, false, Array("*","CATALOG_PRICE_2","PROPERTY_624","PROPERTY_610","PROPERTY_611","PROPERTY_613","PROPERTY_612","PROPERTY_453", "PROPERTY_604", "PROPERTY_644","PROPERTY_606", "PROPERTY_417"));
    if ( $db_list_in->SelectedRowsCount() > 0 ){
    while($item = $db_list_in->GetNext())
    {
        $origname = $item["NAME"];
        $formatedPACKname = preg_replace("/\([^)]+(шт.\)|шт\)|ш\))/","",$origname);
        $formatedname = preg_replace("/КИТАЙ|Конт|Китай|Россия|Северсталь|РОМЕК|Европа|Евр|Ев|РФ|PU=.*|RU=.*/","",$formatedPACKname);
        $item['~ADD_URL'] = $item['DETAIL_PAGE_URL']."?action=ADD2BASKET&id=".$item['ID'];
        
        $label = '';
        $buttonLabel = 'Купить';
        $dlina = $item["PROPERTY_612_VALUE"];
        $diametr = $item["PROPERTY_613_VALUE"];
        $material = $item["PROPERTY_610_VALUE"];
        
        $printPriceValue = $item['CATALOG_PRICE_2'];
        $printPriceValue = !empty($printPriceValue) ? $printPriceValue : 'по запросу';
        
      ?>

        <div itemscope itemtype="https://schema.org/Product" rel="1">
        <div class="col-12 catalog-list-line pt-1 pb-1" id="<?= $item['ID'] ?>">
        
        <div class="row g-0">
        
        <div class="col-3 col-xl-1 col-lg-1 col-md-1 text-center">
        
        <div class="new-item-line__image overflow-h">
<?$checkUrl = str_replace('https://traiv-komplekt.ru','',$item['CANONICAL_PAGE_URL']);
if ($item['DETAIL_PAGE_URL'] !== $checkUrl)
{
    $item['DETAIL_PAGE_URL'] = $checkUrl;
}?>
<a href="<?= $item['DETAIL_PAGE_URL'] ?>" rel="<?php echo $item["CANONICAL_PAGE_URL"];?>">
<?
if(!empty($item['DETAIL_PICTURE']['SRC']))
{
    $picturl = CFile::ResizeImageGet($item['DETAIL_PICTURE'],array('width'=>35, 'height'=>35), BX_RESIZE_IMAGE_PROPORTIONAL, true);?><img src="<?=$picturl['src']?>" alt="<?=$formatedname?>" id="<?=$item["ID"]?>" itemprop="image"/>
<?
}else{
    $db_groups = CIBlockElement::GetElementGroups($item['ID'], true);
    while($ar_group = $db_groups->Fetch()) 
    {
        $getGroup = CIBlockSection::GetList(array(), array('ID' => $ar_group["ID"],"IBLOCK_ID"=>18, "ACTIVE" => "Y"), false, Array('UF_TAG_SECTION'));
        if($getGroupItem = $getGroup->GetNext()) {
            if ($getGroupItem['UF_TAG_SECTION'] !== '1'){
                $sect_id = $ar_group["ID"];
            }
        }
    }
    $rsElement1 = CIBlockSection::GetList(array(), array('ID' => $sect_id), false, array('ID', 'IBLOCK_SECTION_ID', 'PICTURE'));if($arElement1 = $rsElement1->Fetch()) {$pict = $arElement1['DETAIL_PICTURE']?$arElement['DETAIL_PICTURE']:$arElement1['PICTURE'];}$picturl = CFile::ResizeImageGet($pict,array('width'=>35, 'height'=>35), BX_RESIZE_IMAGE_PROPORTIONAL, true);?><img  src="<?= $picturl['src']?>" alt="<?= $formatedname?>" width="35" height="35" style="padding:0px;" title="<?=$formatedname?>" id="<?=$item["ID"]?>" itemprop="image"/><?}?></a></div>
        
        </div>
        
 <div class="col-7 col-xl-3 col-lg-3 col-md-3" rel="<?php echo $sect_id;?>"><a href="<?= $item['DETAIL_PAGE_URL'] ?>" style="font-size:14px;padding-right:20px;"><!-- <span class="test-quan"><?php echo $item['CATALOG_QUANTITY'];?></span>--></span><span itemprop="name"><?=$formatedname?>
            </span></a></div>
            
            <div class="col-2 col-xl-2 col-lg-2 col-md-2 text-center"><span><?php echo $_POST['art'];?></span></div>
                        <div class="col-1 col-xl-1 col-lg-1 col-md-1 text-center d-none d-lg-block"><span><?=$dlina ? '<div style="display: inline-block">M </div> ' . $diametr.' x '.$dlina : $diametr?></span></div>
            <div class="col-1 col-xl-1 col-lg-1 col-md-1 text-center d-none d-lg-block"><span><nobr><?=$material?></nobr></span></div>
            
                        <div class="col-4 col-xl-2 col-lg-2 col-md-2 text-center"><span class="new-item-line__price"><span itemprop="offers" itemscope itemtype="https://schema.org/Offer">
<?if ($printPriceValue !== '0 руб.'){

if ($printPriceValue == 'по запросу') {
    ?>
    <div class="btn-group-blue-small">
                    <a href="#w-form-one-click" class="btn-blue-small">
                        <span>Запросить цену</span>
                    </a>
                </div>
    
<?php 
}
else {
    echo $printPriceValue;
    ?>
    <meta itemprop="price" content="<?php echo floatval($printPriceValue);?>">
    <meta itemprop="priceCurrency" content="RUB">
    <?php 
}

} else {
?>

    <div class="btn-group-blue-small">
                    <a href="#w-form-one-click" class="btn-blue-small">
                        <span>Запросить цену</span>
                    </a>
                </div>

<!-- <a href="#w-form-one-click" class="btn new-item-line-buy opt"><div class="opt-btn-label">Запросить</div></a>--><?
}?></span></span></div>
            
            <div class="col-4 col-xl-1 col-lg-1 col-md-1 text-center">
                <div class="catalog-list-quantity-area">
                <?
                $pack = $item["PROPERTY_604_VALUE"];
                if (empty($pack)){
                    $pack = 1;
                }
                /*!$ymarket ? $pack = $item["PROPERTIES"]["KRATNOST_UPAKOVKI"]["VALUE"] : $pack = 1;!$pack && $pack = 1;*/?>
                <input type="number" name='QUANTITY' class="quantity section_list" id="<?= $item["ID"]?>-item-quantity"  size="5" value="<?=$pack?>" step="<?=$pack?>" min="<?=$pack?>">
                <a href="#" class="quantity_link quantity_link_plus" rel="<?= $item["ID"]?>"><span><i class="fa fa-plus"></i></span></a>
                <a href="#" class="quantity_link quantity_link_minus" rel="<?= $item["ID"]?>"><span><i class="fa fa-minus"></i></span></a>
                </div>
            </div>
            
            <div class="col-4 col-xl-1 col-lg-1 col-md-1 text-center">
            <?php if($item['CATALOG_CAN_BUY_2']) {$item['~ADD_URL'] .= '&QUANTITY=';?>
                <div class="btn-group-blue">
                <a data-href="<?= str_replace("index.php", "", $item['~ADD_URL']); ?>" class="btn-cart-round new-item-line-buy" id = "quan-item-line-<?= $item["ID"]?>" data-ajax-order onclick="ym(18248638,'reachGoal','addToBasketItems'); return true;">
                            <span><i class="fa fa-shopping-cart"></i></span>
                        </a>
                </div>
                <?php 
                }
                ?>
            </div>
            
            </div>
            
</div>
</div>
        <?php 
    }
    }
    /*else {
        
        //под заказ
        ?>
        <div class="col-12 catalog-list-line pt-1 pb-1" id="<?= $strMainID ?>">
        
        <div class="row g-0">
        
        <div class="col-12 col-xl-12 col-lg-12 col-md-12 text-center">
        Под заказ
        </div>
        </div>
        </div>
        <?php 
    }*/
}

if (!empty($_POST['action']) && $_POST['action'] == 'uploadFile'){
    
    if (!empty($_FILES['0']["name"])) {
        $temp = explode(".", $_FILES['0']["name"]);
        if (end($temp) === 'xls' || end($temp) === 'xlsx'){
        $newfilename = round(microtime(true)) . '.' . end($temp);
        $target_dir = $_SERVER["DOCUMENT_ROOT"]."/upload/decodefile/";
        $uploadfile  = $target_dir . $newfilename;
        if (move_uploaded_file($_FILES['0']['tmp_name'], $uploadfile) === false) {
            echo '{"error": "Не загружено!"}';
            exit;
        } else {
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($uploadfile);
            
            $worksheet = $spreadsheet->getActiveSheet();
            $rows = $worksheet->toArray();
            if (is_countable($rows) && count($rows) > 0) {
                $rowsCount = count($rows);
            }
            
            if ($rowsCount >= 50){
                echo '{"error": "Количество строк в файле больше 50!"}';
                exit;
            } else {
            
            $arr_new = [];
            
            foreach($rows as $key=>$val)
            {
                if (!is_null($val[0])){
                    $code = $val[0];
                    $arr_new[] = $code;
                }
            }
            
            $apiUrl = 'https://api.traiv-pro.com/v1/decoderum/filelist';
            $postVars = array(
                'data' => json_encode($arr_new,true)
            );
            
            $headers = array(
                'Content-Type:application/json',
                'Authorization: Basic '. base64_encode("ttt@ttt.ru:11111111")
            );
            
            $serve = curl_init();
            
            curl_setopt( $serve, CURLOPT_URL, $apiUrl);
            curl_setopt( $serve, CURLOPT_HTTPHEADER, $headers);
            curl_setopt( $serve, CURLOPT_POST, 1);
            curl_setopt($serve, CURLOPT_POSTFIELDS, json_encode($postVars));
            curl_setopt( $serve, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt( $serve, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt( $serve, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt( $serve, CURLOPT_RETURNTRANSFER, 1);
            curl_exec($serve);
            $parseResponse = curl_exec( $serve );
            
            if (!curl_errno($serve)) {
                switch ($http_code = curl_getinfo($serve, CURLINFO_HTTP_CODE)) {
                    case 200:  echo $data = json_decode($parseResponse, TRUE);
                    if (!empty($data)){
                        $hlbl = 15;
                        $hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch();
                        
                        $entity = HL\HighloadBlockTable::compileEntity($hlblock);
                        $entity_data_class = $entity->getDataClass();
                        
                        $rsData = $entity_data_class::getList(array(
                            "select" => array("ID"),
                            "order" => array("ID" => "ASC"),
                            "filter" => array("UF_USER_ID"=>$USER->GetID())  // Задаем параметры фильтра выборки
                        ));
                        
                        while($arData = $rsData->Fetch()){
                            $id = $arData['ID'];
                            if (!empty($id)){
                                $entity_data_class::Delete($id); 
                            }
                        }
                        
                        $data = array(
                        "UF_USER_ID"=>$USER->GetID(),
                        "UF_DECODE_LIST"=>$data
                        );
                        $result = $entity_data_class::add($data);
                    }
                    break;
                    default:
                        //echo 'Доступ запрещен: ', $http_code, "\n";
                        echo '{"error": "Доступ запрещен1"}';
                }
            }
            curl_close($serve);
            }
            unlink($uploadfile);
        }
        } else {
            echo '{"error": "Допускается загрузка файла только в формате XLS или XLSX!"}';
            exit;
        }
    }
}

if (!empty($_POST['nomen'])){
    $apiUrl = 'https://api.traiv-pro.com/v1/decoderum/name';
    $postVars = array(
        'name' => $_POST['nomen']
    );
    
    if ( $USER->IsAuthorized() )
    {
        if ($USER->GetID() == '3092') {
            $headers = array(
                'Content-Type:application/json',
                'Authorization: Basic '. base64_encode("ttt@ttt.ru:11111111")
            );
        }
        else {
            $headers = array(
                'Content-Type:application/json',
                'Authorization: Basic '. base64_encode("ttt@ttt.ru:11111111")
            );
        }
    }
    else
    {
        $headers = array(
            'Content-Type:application/json',
            'Authorization: Basic '. base64_encode("ttt@ttt.ru:11111111")
        );
    }
    

    $serve = curl_init();
    
    curl_setopt( $serve, CURLOPT_URL, $apiUrl);
    curl_setopt( $serve, CURLOPT_HTTPHEADER, $headers);
    curl_setopt( $serve, CURLOPT_POST, 1);
    curl_setopt($serve, CURLOPT_POSTFIELDS, json_encode($postVars));
    curl_setopt( $serve, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt( $serve, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt( $serve, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt( $serve, CURLOPT_RETURNTRANSFER, 1);
    curl_exec($serve);
    $parseResponse = curl_exec( $serve );
    
    if (!curl_errno($serve)) {
        switch ($http_code = curl_getinfo($serve, CURLINFO_HTTP_CODE)) {
            case 200:  echo $data = json_decode($parseResponse, TRUE);
                break;
            default:
                //echo 'Доступ запрещен: ', $http_code, "\n";
                echo '{"error": "Доступ запрещен"}';
        }
    }
    curl_close($serve);
    
    /*echo "<pre>";
        print_r($parseResponse);
    echo "</pre>";*/
    
    
    /*echo "<pre>";
        print_r($data);
    echo "</pre>";*/
    /*echo $data['result'];*/
}
?>