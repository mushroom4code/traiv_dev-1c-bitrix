<?php



    $arResult["WEB_FORM_NAME"] = "VACANCY_" . md5(rand());
  /*  $arResult["FORM_HEADER"] = str_replace('name="SIMPLE_FORM_1"', 'name="' . $arResult["WEB_FORM_NAME"] . '"', $arResult["FORM_HEADER"]);*/


   /* $req = CFormValidator::GetListForm($arResult["arForm"]["ID"]);
    while ($ar = $req->Fetch()){
        $arResult["VALIDATORS"][] = $ar;
    }

    foreach ($arResult["VALIDATORS"] as &$item) {
        if ($item["NAME"] == "file_size"){
            if (isset($item["PARAMS"]["SIZE_TO"])){
                $size = fileUploadMaxSize();
                if ($size < $item["PARAMS"]["SIZE_TO"]){
                    $item["PARAMS"]["SIZE_TO"] = $size;
                }
            }

        }
    }*/

    if ($_REQUEST['ajax_mode']=='y') {
        $APPLICATION->RestartBuffer();
    }