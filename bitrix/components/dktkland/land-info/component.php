<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();

CModule::IncludeModule('iblock');

if (!empty($arParams['URL'])){
    
    /*get Section*/
    
    $sectionParent = CIBlockSection::GetList(array(), ['IBLOCK_ID' => 57, 'CODE' => $arParams['URL'], 'ACTIVE'=>'Y', 'GLOBAL_ACTIVE'=>'Y'], false,false);

    $checkSection = intval($sectionParent->SelectedRowsCount());
    if ($checkSection > 0){
        while($ar_result = $sectionParent->GetNext())
        {
           /*get items*/
            
            $arItems = Array(/*"ID", "NAME", "DETAIL_PAGE_URL", "DETAIL_PICTURE"*/"*","PROPERTY_TYPEITEM","PROPERTY_TEXTCOLOR","PROPERTY_BACKCOLOR");
            $arSortItems = array('SORT'=>'ASC');
            $arFilteritems = array('IBLOCK_ID'=>"57",'SECTION_ID'=>$ar_result['ID'], 'ACTIVE'=>'Y', 'GLOBAL_ACTIVE'=>'Y'/*, "PROPERTY_POKRYTIE_1" => "15164"*/);
            $listItems = CIBlockElement::GetList($arSortItems, $arFilteritems, false, false, $arItems);
            
            $resItems = intval($listItems->SelectedRowsCount());
            
            if ($resItems > 0) {
                $i = 0;
                while($ar_resultItems = $listItems->GetNext()){
                    
                    if ( $USER->IsAuthorized() )
                    {
                        if ($USER->GetID() == '3092') {
                           /* echo "<pre>";
                            print_r($ar_resultItems);
                            echo "</pre>";*/
                        }
                    }
                    
                    /*echo "<pre>";
                        print_r($ar_resultItems);
                    echo "</pre>";*/
                    
                    /**/
                    $typeitemid = $ar_resultItems['PROPERTY_TYPEITEM_ENUM_ID'];
                    $typeitemvalue = $ar_resultItems['PROPERTY_TYPEITEM_VALUE'];
                    $typeitembackimg = CFile::GetPath($ar_resultItems['PREVIEW_PICTURE']);
                    $typeitemtitle = $ar_resultItems['NAME'];
                    $typeitemsmtitle = $ar_resultItems['PREVIEW_TEXT'];
                    $typeitemtext = $ar_resultItems['DETAIL_TEXT'];
                    $typeitemtextcolor = $ar_resultItems['PROPERTY_TEXTCOLOR_VALUE'];
                    $typeitembackcolor = $ar_resultItems['PROPERTY_BACKCOLOR_VALUE'];
                    if (!empty($ar_resultItems))
                    
                    if (!empty($typeitemid) && !empty($typeitemvalue)){
                        $arResult['ITEMS'][$i]['TYPEITEMID'] = $typeitemid;
                        $arResult['ITEMS'][$i]['TYPEITEMVALUE'] = $typeitemvalue;
                        $arResult['ITEMS'][$i]['TYPEITEMBACKIMG'] = $typeitembackimg;
                        $arResult['ITEMS'][$i]['TYPEITEMTITLE'] = $typeitemtitle;
                        $arResult['ITEMS'][$i]['TYPEITEMTEXT'] = $typeitemtext;
                        $arResult['ITEMS'][$i]['TYPEITEMSMTITLE'] = $typeitemsmtitle;
                        $arResult['ITEMS'][$i]['TYPEITEMTEXTCOLOR'] = $typeitemtextcolor;
                        $arResult['ITEMS'][$i]['TYPEITEMBACKCOLOR'] = $typeitembackcolor;
                        if ($typeitemid == '20618') {
                            $res = CIBlockElement::GetProperty(57, $ar_resultItems['ID'], array("sort" => "asc"), Array("CODE"=>"ICONS"));
                            //echo intval($res->SelectedRowsCount());
                            $j = 0;
                            while ($ob = $res->GetNext()) {
                                $tableName = $ob['USER_TYPE_SETTINGS']['TABLE_NAME'];
                                $XML_ID = $ob['VALUE'];
                               
                                $hlblock = \Bitrix\Highloadblock\HighloadBlockTable::getList(
                                    array("filter" => array(
                                        'TABLE_NAME' => $tableName
                                    ))
                                    )->fetch();
                                
                                    if (isset($hlblock['ID']))
                                    {
                                        $hlblockRes = Bitrix\Highloadblock\HighloadBlockTable::getById($hlblock['ID'])->fetch();
                                        $entity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblockRes);
                                        $entity_data_class = $entity->getDataClass();
                                        
                                        $data_all = $entity_data_class::getList(array(
                                            "select" => array("*"),
                                            "filter" => array(
                                                'LOGIC' => 'AND',
                                                array('=UF_XML_ID' => $XML_ID)
                                            )
                                        ));
                                        
                                        if (intval($data_all->getSelectedRowsCount()) > 0){
                                            
                                            while($arDataAll = $data_all->Fetch()){
                                                $nameIcons = $arDataAll['UF_NAME'];
                                                $imgIcons = CFile::GetPath($arDataAll['UF_FILE']);
                                                $arResult['ITEMS'][$i]['TYPEITEMICONS'][$j]['NAMEICONS'] = $nameIcons;
                                                $arResult['ITEMS'][$i]['TYPEITEMICONS'][$j]['IMGICONS'] = $imgIcons;
                                            }   
                                        }
                                    }
                                    $j++;
                            }
                            
                        }
                        
                        /*HANG*/
                        
                        if ($typeitemid == '20620') {
                            $res = CIBlockElement::GetProperty(57, $ar_resultItems['ID'], array("sort" => "asc"), Array("CODE"=>"HANG"));
                            //echo intval($res->SelectedRowsCount());
                            $j = 0;
                            while ($ob = $res->GetNext()) {
                                $tableName = $ob['USER_TYPE_SETTINGS']['TABLE_NAME'];
                                $XML_ID=$ob['VALUE'];
                                
                                $hlblock = \Bitrix\Highloadblock\HighloadBlockTable::getList(
                                    array("filter" => array(
                                        'TABLE_NAME' => $tableName
                                    ))
                                    )->fetch();
                                    
                                    if (isset($hlblock['ID']))
                                    {
                                        $hlblockRes = Bitrix\Highloadblock\HighloadBlockTable::getById($hlblock['ID'])->fetch();
                                        $entity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblockRes);
                                        $entity_data_class = $entity->getDataClass();
                                        
                                        $data_all = $entity_data_class::getList(array(
                                            "select" => array("*"),
                                            "filter" => array(
                                                'LOGIC' => 'AND',
                                                array('=UF_XML_ID' => $XML_ID)
                                            )
                                        ));
                                        
                                        if (intval($data_all->getSelectedRowsCount()) > 0){
                                            
                                            while($arDataAll = $data_all->Fetch()){
                                                $nameHang = $arDataAll['UF_NAME'];
                                                $noteHang = $arDataAll['UF_FULL_DESCRIPTION'];
                                                $arResult['ITEMS'][$i]['TYPEITEMHANG'][$j]['NAME'] = $nameHang;
                                                $arResult['ITEMS'][$i]['TYPEITEMHANG'][$j]['NOTE'] = $noteHang;
                                            }
                                        }
                                    }
                                    $j++;
                            }
                            
                        }
                        
                        /*end HANG*/
                        
                        /*elements*/
                        
                        if ($typeitemid == '20621') {
                            $res = CIBlockElement::GetProperty(57, $ar_resultItems['ID'], array("sort" => "asc"), Array("CODE"=>"ELEMENTS"));
                            //echo intval($res->SelectedRowsCount());
                            $j = 0;
                            while ($ob = $res->GetNext()) {
                                        
                                        $arSelectEl = Array('*');
                                        $arSortEl = array();
                                        
                                        $arFilterEl = array('IBLOCK_ID'=>'54', 'ID'=>$ob['VALUE'], 'ACTIVE'=>'Y');
                                        $db_list_inEl = CIBlockElement::GetList($arSortEl, $arFilterEl, false, Array( 'nTopCount' => 1), $arSelectEl);
                                        //echo intval($db_list_inEl->SelectedRowsCount());
                                        while($ar_result_inEl = $db_list_inEl->GetNext()){
                                            
                                            $nameEl = $ar_result_inEl['NAME'];
                                            $urlEl = $ar_result_inEl['DETAIL_PAGE_URL'];
                                            $imgEl = CFile::GetPath($ar_result_inEl['DETAIL_PICTURE']);
                                            $arResult['ITEMS'][$i]['TYPEITEMELEMENT'][$j]['NAME'] = $nameEl;
                                            $arResult['ITEMS'][$i]['TYPEITEMELEMENT'][$j]['URL'] = $urlEl;
                                            $arResult['ITEMS'][$i]['TYPEITEMELEMENT'][$j]['IMG'] = $imgEl;
                                            
                                        }
                                $j++;
                            }
                        }
                        
                        /*end elements*/
                        
                        /*ссылки на элементы*/
                        if ($typeitemid == '20622') {
                            $res = CIBlockElement::GetProperty(57, $ar_resultItems['ID'], array("sort" => "asc"), Array("CODE"=>"ITEMLINKS"));
                            //echo intval($res->SelectedRowsCount());
                            $j = 0;
                            while ($ob = $res->GetNext()) {
                                $tableName = $ob['USER_TYPE_SETTINGS']['TABLE_NAME'];
                                $XML_ID=$ob['VALUE'];
                                
                                $hlblock = \Bitrix\Highloadblock\HighloadBlockTable::getList(
                                    array("filter" => array(
                                        'TABLE_NAME' => $tableName
                                    ))
                                    )->fetch();
                                    
                                    if (isset($hlblock['ID']))
                                    {
                                        $hlblockRes = Bitrix\Highloadblock\HighloadBlockTable::getById($hlblock['ID'])->fetch();
                                        $entity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblockRes);
                                        $entity_data_class = $entity->getDataClass();
                                        
                                        $data_all = $entity_data_class::getList(array(
                                            "select" => array("*"),
                                            "filter" => array(
                                                'LOGIC' => 'AND',
                                                array('=UF_XML_ID' => $XML_ID)
                                            )
                                        ));
                                        
                                        if (intval($data_all->getSelectedRowsCount()) > 0){
                                            
                                            while($arDataAll = $data_all->Fetch()){
                                                $nameLinks = $arDataAll['UF_NAME'];
                                                $linkLinks = $arDataAll['UF_LINK'];
                                                $linkImg = CFile::GetPath($arDataAll['UF_FILE']);
                                                
                                                $arResult['ITEMS'][$i]['TYPEITEMLINK'][$j]['NAME'] = $nameLinks;
                                                $arResult['ITEMS'][$i]['TYPEITEMLINK'][$j]['LINK'] = $linkLinks;
                                                $arResult['ITEMS'][$i]['TYPEITEMLINK'][$j]['IMG'] = $linkImg;
                                            }
                                        }
                                    }
                                    $j++;
                            }
                            
                        }
                        
                        /*end ссылки на элементы*/
                        /*элементы из основного каталога*/
                        
                        if ($typeitemid == '20623') {
                            $res = CIBlockElement::GetProperty(57, $ar_resultItems['ID'], array("sort" => "asc"), Array("CODE"=>"KATITEMS"));
                            //echo intval($res->SelectedRowsCount());
                            $j = 0;
                            while ($ob = $res->GetNext()) {
                                
                                $arSelectEl = Array('*');
                                $arSortEl = array();
                                
                                $arFilterEl = array('IBLOCK_ID'=>'18', 'ID'=>$ob['VALUE'], 'ACTIVE'=>'Y');
                                $db_list_inEl = CIBlockSection::GetList($arSortEl, $arFilterEl, false, Array( 'nTopCount' => 1), $arSelectEl);
                                while($ar_result_inEl = $db_list_inEl->GetNext()){
                                    
                                    $nameEl = $ar_result_inEl['NAME'];
                                    $urlEl = $ar_result_inEl['SECTION_PAGE_URL'];
                                    $imgEl = CFile::GetPath($ar_result_inEl['PICTURE']);
                                    $arResult['ITEMS'][$i]['TYPEITEMCATITEMS'][$j]['NAME'] = $nameEl;
                                    $arResult['ITEMS'][$i]['TYPEITEMCATITEMS'][$j]['URL'] = $urlEl;
                                    $arResult['ITEMS'][$i]['TYPEITEMCATITEMS'][$j]['IMG'] = $imgEl;
                                    
                                }
                                $j++;
                            }
                        }
                        
                        /*end элементы из основного каталога*/
                        
                        /*Галерея изображений*/
                        
                        if ($typeitemid == '20626') {
                            $res = CIBlockElement::GetProperty(57, $ar_resultItems['ID'], array("sort" => "asc"), Array("CODE"=>"IMGITEMS"));
                            //echo intval($res->SelectedRowsCount());
                            $j=0;
                            while ($ob = $res->GetNext()) {
                             $imgEl = CFile::GetPath($ob['VALUE']);
                             $arResult['ITEMS'][$i]['TYPEITEMIMGITEMS'][$j]['IMG'] = $imgEl;
                            $j++;                             
                            }
                        }
                        
                        /*end Галерея изображений*/
                    }
                    
                $i++;                    
                }
            }
            
           /*end get items*/
        }
    }
    
    /*end get Section*/
    
}

$this->IncludeComponentTemplate();
?>