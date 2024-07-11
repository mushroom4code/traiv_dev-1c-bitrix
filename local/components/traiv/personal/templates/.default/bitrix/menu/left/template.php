<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="row traiv-personal-menu-left-area">
<div class="col-12 text-center d-none">
	<!--  --><a href="/personal/">
	<div class="profile_photo rounded-circle">
		<i class="fa fa-user"></i>
	</div>
	</a>
	<div class="profile_fio">
	<?php 
	$rsUser = CUser::GetByID($USER->GetID());
	$arUser = $rsUser->Fetch();
	echo $arUser['NAME'];
	
	?>
	</div>
</div>

<div class="col-12 pt-3">
    <?
    if (!empty($arResult)):?>
    
    <?php 
    /*if ( $USER->IsAuthorized() )
    {
        if ($USER->GetID() == '3092' || $USER->GetID() == '7174' || $USER->GetID() == '7621' || $USER->GetID() == '1788' || $USER->GetID() == '2938' || $USER->GetID() == '7649' || $USER->GetID() == '7142' || $USER->GetID() == '7473' || $USER->GetID() == '7634') {
            ?>
            <!-- <div class="lk_left_menu"><a href="/personal/lk/"><i class='fa fa-gift'></i><span>Бонусный счет</span></a></div>-->
            <div class="lk_left_menu"><a href="/personal/decode/"><i class='fa fa-list-alt'></i><span>Номенклатура</span></a></div>
            <?php 
            ?>
            <div class="lk_left_menu"><a href="/personal/subscribe/"><i class='fa fa-envelope'></i><span>Мои подписки</span></a></div>
            <?php 
        }
    }*/
    ?>
    
        <? foreach($arResult as $arItem):
            if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)  continue;
            
            $addParams = "";
            if (!empty($arItem["PARAMS"])) {
                foreach ($arItem["PARAMS"] as $key => $val) {
                    $addParams .= " $key='" .  $val ."'";
                }
            }
            if ($arItem['ITEM_INDEX'] == 2) {
                if ( $USER->IsAuthorized() )
                {
                    if ($USER->GetID() == '3092' || $USER->GetID() == '7174' || $USER->GetID() == '7621' || $USER->GetID() == '1788' || $USER->GetID() == '2938' || $USER->GetID() == '7649' || $USER->GetID() == '7142' || $USER->GetID() == '7473' || $USER->GetID() == '7634' || $USER->GetID() == '7666' || $USER->GetID() == '7703'){
                        ?>
            <div class="lk_left_menu"><a <?=$addParams?> href="<?=$arItem["LINK"]?>" <?if($arItem["SELECTED"]):?>class="selected"<? endif;?>>
            <div class="lk_left_menu_icon"><i class='fa <?php echo $arItem['PARAMS']['fa'];?>'></i></div>
            <span><?=$arItem["TEXT"].$arItem['PARAMS']['ITEM_INDEX']?></span></a></div>
        <?
                }
            }
            } else {
            ?>
            <div class="lk_left_menu"><a <?=$addParams?> href="<?=$arItem["LINK"]?>" <?if($arItem["SELECTED"]):?>class="selected"<? endif;?>>
            <div class="lk_left_menu_icon"><i class='fa <?php echo $arItem['PARAMS']['fa'];?>'></i></div>
            <span><?=$arItem["TEXT"].$arItem['PARAMS']['ITEM_INDEX']?></span></a></div>
        <?
            }
        endforeach?>
    <?endif?>
    <!-- <a href="/personal/" class="back">< Назад</a> -->
    </div>
</div>