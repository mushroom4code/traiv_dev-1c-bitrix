<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
function month3char($mname){
    
    if ($mname == '01'){
        $mname_true = "янв";
    }
    else if ($mname == '02'){
        $mname_true = "фев";
    }
    else if ($mname == '03'){
        $mname_true = "мар";
    }
    else if ($mname == '04'){
        $mname_true = "апр";
    }
    else if ($mname == '05'){
        $mname_true = "май";
    }
    else if ($mname == '06'){
        $mname_true = "июн";
    }
    else if ($mname == '07'){
        $mname_true = "июл";
    }
    else if ($mname == '08'){
        $mname_true = "авг";
    }
    else if ($mname == '09'){
        $mname_true = "сен";
    }
    else if ($mname == '10'){
        $mname_true = "окт";
    }
    else if ($mname == '11'){
        $mname_true = "ноя";
    }
    else if ($mname == '12'){
        $mname_true = "дек";
    }
    return $mname_true;
}
?>
        <div class="posts-wrap mb-3">
            <div class="row posts-list posts-list-np">

        <?
        
/*        if ( $USER->IsAuthorized() )
        {
            if ($USER->GetID() == '3092') {
        
                echo "<pre>";
                    print_r($arResult['YEAR_LIST']);
                echo "</pre>";
                foreach($arResult['ITEMS'] as $arItem){
                    echo $arItem['PROPERTIES']['TYPE_TEXT']['VALUE']."  ";
                        echo $arItem['NAME'];
                        echo "<br>";
                }
                
            }
        }*/
        
        $check_type = "Пресс-релиз";
        $i = 1;
        foreach($arResult['ITEMS'] as $arItem){
            
            
            if ($check_type != $arItem['PROPERTIES']['TYPE_TEXT']['VALUE']){
                ?>
                        <div class="col-12 col-xl-12 col-lg-12 col-md-12 text-left mb-3">
        <h2>Медиа о компании "Трайв"</h2>

        <div class="row">
            <div class="col-12">
            <div class="press-tags-area">
            <span><a href="#" class="press-tags-area-link" data-pro-tags="all"><div class="active">Все</div></a></span>
            <?php       
                    foreach($arResult['YEAR_LIST'] as $key=>$val){
                        ?>
                        <span><a href="#" class="press-tags-area-link" data-pro-tags="<?php echo $val;?>"><div><?php echo $val;?></div></a></span>
                		<?php
                    }
        ?>
        </div>
        </div> 
        </div> 

        </div>
                <?php 
            }
            
            if ($arItem['PROPERTIES']['TYPE_TEXT']['VALUE'] == 'Пресс-релиз'){
            //Пресс-релиз
                if ($arItem['I'] > 6){
                    $dnone = "d-none";
                } else {
                    $dnone = "";
                }
                ?>
                <div class="col-12 col-xl-4 col-lg-4 col-md-4 posts2-i <?= $dnone;?>" rel="<?= $arItem['I'];?>" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                    <a class="posts-i-img" href="<?=$arItem['DETAIL_PAGE_URL']?>"><span style="background: url(<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>)"></span></a>
                        <time class="posts-i-date" datetime="<?=$arItem['DISPLAY_ACTIVE_FROM'] ?>"><span><?=substr($arItem['DISPLAY_ACTIVE_FROM'],0,2) ?></span>
		<?php 
		echo month3char(substr($arItem['DISPLAY_ACTIVE_FROM'],3,2));
		?>
		</time>
		<div class="posts-i-ttl"><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a></div>
	</div>
            <?
            if ($arItem['I'] == 6){
                ?>
                <div class="press_load_area text-center mt-3 mb-3">
                	<div class="btn-group-blue"><a href="#" class="btn-blue press-more"><span>Показать больше</span></a></div>
                </div>
                <?php 
            }
            
            } else {
                //СМИ о нас
                if ($check_type != $arItem['PROPERTIES']['TYPE_TEXT']['VALUE']){
                    ?>
                    <div class="col-12 col-xl-12 col-lg-12 col-md-12">
                	<ul class="press-list-in mt-1">    
                    <?php 
                }
                ?>
                <li data-pro-tags="<?=$arItem['YEAR'];?>"><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a>
                <?php 
                if (!empty($arItem['PREVIEW_TEXT'])){
                    ?>
                    <div class="preview-text">
                    <?=$arItem['PREVIEW_TEXT']?>
                    </div>
                    <?php 
                }
                ?>
                </li>
                <?php 
                
                if (count($arResult['ITEMS']) == $i){
                    ?>
                	</ul>
                	</div>    
                    <?php 
                }
                ?>
                


<?php                
            }
            
            ?>
        
                	
        <?
        $check_type = $arItem['PROPERTIES']['TYPE_TEXT']['VALUE'];
        $i++;
        }?>

    </div>
</div>