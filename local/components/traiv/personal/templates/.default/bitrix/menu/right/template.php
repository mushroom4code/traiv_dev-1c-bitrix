<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="traiv-personal-menu-right  hide-mobile">
    <?if (!empty($arResult)):?>
    
        <?
        $i = 1;
        ?>
        <table rel="1">
            <tr>
                <? foreach($arResult as $arItem):
                    if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)  continue;
                    ?>
                    <td>
                    <?php if ($arItem["TEXT"] == "Личный счет") {
                        if ( $USER->IsAuthorized() )
                        {
                        if ($USER->GetID() == '3092') {
                            $l = "lk";       
                        }
                        else {
                            $l = $arItem["LINK"];
                        }
                    }
                    else
                    {
                        $l = $arItem["LINK"];
                    }

                        ?>
                        <a <?=$addParams?> href="<?=$l;?>" class='image<?=$i?>'><?=$arItem["TEXT"]?></a>
                        <?php 
                    } else {
                        ?>
                        <a <?=$addParams?> href="<?=$arItem["LINK"]?>" class='image<?=$i?>'><?=$arItem["TEXT"]?></a>
                        <?php 
                    }?>
                    </td>
                    <? 
                    if (($i % 3) == 0) echo "</tr><tr>";?>
                    <? $i++ ?>
                <?endforeach?>
            </tr>
        </table>
    <?endif?>
</div>