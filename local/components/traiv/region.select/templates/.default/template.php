<? if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die(); ?>

<div class="location-chooser dropdown">



    <a href="#" class="iconed iconed--left2 location-chooser__current dropdown-toggle"><span class="location"><?=$arResult["REGIONS"][$arResult["SELECTED"]]["CITY"]?></span><i class="icon icon--location"></i></a>
    <div class="location-chooser__dropdown dropdown-inner">
        <ul class="u-clear-list">
            <? foreach ($arResult["REGIONS"] as $code => $arItem): ?>
                <li id="loc_<?=$code?>"><a href="#"><?=$arItem["CITY"]?></a></li>
            <? endforeach; ?>
        </ul>
    </div>
    
    <?php 
                             /*if ( $USER->IsAuthorized() )
                             {
                                 if ($USER->GetID() == '3092') {*/
                              ?>
                             <a href="/favorites/" class="prod-favorites-top"><i class="fa fa-heart"></i> <span class='prod-favorites-top-text'> Избранное
                             <?php 
                               $fav_list_array = json_decode($_COOKIE['fav_list']);
                    $array = [];
                    foreach ($fav_list_array as $value) {
                        $array[] = $value->element_id;
                    }

                    $arrFilter=Array("ID" => $array);
                    if (count($array) > 0){
                        echo "(<span id='prod-favorites-top-count'>".count($array)."</span>)";
                    }
                    else {
                        echo "(<span id='prod-favorites-top-count'>0</span>)";
                    }
                    
                    ?></span></a> 
                              <?php        
                              
                               /*  }
                             }*/
                             ?>
    
</div>

<? if (SHOW_PHONE != "1") {?>
<? $this->SetViewTarget('region-select-phone');?>
    <?
    define("SHOW_PHONE", "1");
    ?>
    <? foreach ($arResult["REGIONS"] as $code => $arItem): 
        $style = ($code == $arResult["SELECTED"]) ? 'style="cursor: pointer"' : 'style="display: none; cursor: pointer"'?>
        <a onclick='goPage("tel:<?=$arItem["LINK_PHONE"]?>"); return false;' rel="nofollow" class="header-phone" id="header-phone-<?=$code?>" <?=$style?>><?=$arItem["PHONE"]?></a>
    <? endforeach; ?>
<? $this->EndViewTarget(); ?>
<? }?>