<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("test");

if ( $USER->IsAuthorized() )
{
    if ($USER->GetID() == '3092' || $USER->GetID() == '2743' || $USER->GetID() == '1788') {
    ?>
<div class="filex_res">
<?php
/*if (!empty($_POST['standart']) || !empty($_POST['diametr']) || !empty($_POST['material'])){

    $arSelect = Array("ID", "NAME", "DETAIL_PAGE_URL", "DETAIL_PICTURE", "PROPERTY_610","PROPERTY_611","PROPERTY_613","PROPERTY_612","PROPERTY_453", "PROPERTY_604", "PROPERTY_644","PROPERTY_606", "CATALOG_QUANTITY","CATALOG_PRICE_2", "PROPERTY_417", "DATE_CREATE","PROPERTY_CML2_ARTICLE","PROPERTY_EUROPE_STORAGE");
$arSort = array('NAME'=>'ASC'); //"PROPERTY_604" => 'desc'
 
 $arFilter = array('IBLOCK_ID'=>"18",
 'PROPERTY_606_VALUE'=>$_POST['standart'],
 'PROPERTY_613_VALUE'=>$_POST['diametr'],
 'PROPERTY_610_VALUE'=>$_POST['material'],
 'ACTIVE'=>'Y', 'GLOBAL_ACTIVE'=>'Y');
 $res = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);
 echo $res->SelectedRowsCount();
 if ( $res->SelectedRowsCount() > 0 ){
 while($arrob = $res->GetNext()) {
     echo "<pre>";
     print_r($arrob);
     echo "</pre>";
echo "<br>";
     echo "<a href='$arrob[DETAIL_PAGE_URL]' target='_blank'>".$arrob['NAME']."</a>";
     echo $arrob['NAME'];
     echo $arrob['DETAIL_PAGE_URL'];
 }
 }
}*/
?>
</div>

<div class="content">
    <div class="container">
    <?php 
            $file = "/filex_list/test_filex_list.php";
    ?>
<form method="post" action=<?php echo $file;?>>
    
    <!-- <form action="<?php echo $APPLICATION->GetCurPage();?>" method="post">-->
    	        <!-- Filex - start -->
	        <div class="section-sb-filex">
            <div class="section-filter-filex">
                <!-- <button id="section-filter-toggle-filex" class="section-filter-toggle-filex" data-close="Hide Filter" data-open="Show Filter">
                    <span>Show Filter</span> <i class="fa fa-angle-down"></i>
                </button>-->
                <div class="section-filter-cont-filex">
                
                <div class="section-filter-buttons-filex">
                        <input class="btn btn-themes-filex" id="set_filter-filex" name="set_filter-filex" value="Выгрузить Excel" type="submit">
                    </div>
                
                <!-- STANDART -->
                    <div class="section-filter-item-filex opened" id="section-filter-block-606">
                        <p class="section-filter-ttl-filex">Стандарт <i class="fa fa-angle-down" style="display: block !important;"></i></p>
                        <div class="section-filter-fields-filex">
                        <p class="section-filter-ttl-search-filex"><input type="text" class="section-filter-ttl-search-input-filex" rel="606" id="section-filter-ttl-search-input-606"><i class="fa fa-ttl-search fa-ttl-icon-filex"></i></p>
                        <?php
                        $property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>'18', "CODE"=>"STANDART"));
                        while($enum_fields = $property_enums->GetNext())
                        {
                            ?>
                            <p class="section-filter-field-filex" data-filter-val="<?php echo $enum_fields['VALUE'];?>">
                            <input id="section-standart-<?php echo $enum_fields['ID'];?>" name="standart[]" <?php if (in_array($enum_fields['VALUE'], $_POST['standart'])) {
    echo "checked";
}?> value="<?php echo $enum_fields['VALUE'];?>" type="checkbox">
                            <label class="section-filter-checkbox-filex" for="section-standart-<?php echo $enum_fields['ID'];?>"><?php echo $enum_fields['VALUE'];?></label>
                            </p>
<?php                        
                        }
                        
                        ?>
                        </div>
                    </div>
            <!-- end STANDART -->
            
            <!-- DIAMETR -->
                    <div class="section-filter-item-filex opened" id="section-filter-block-613">
                        <p class="section-filter-ttl-filex">Диаметр <i class="fa fa-angle-down" style="display: block !important;"></i></p>
                        <div class="section-filter-fields-filex">
                        <p class="section-filter-ttl-search-filex"><input type="text" class="section-filter-ttl-search-input-filex" rel="613" id="section-filter-ttl-search-input-613"><i class="fa fa-ttl-search fa-ttl-icon-filex"></i></p>
                        <?php
                        $property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>'18', "CODE"=>"DIAMETR_1"));
                        while($enum_fields = $property_enums->GetNext())
                        {
                            if ($enum_fields['VALUE'] != '0'){
                            ?>
                            <p class="section-filter-field-filex" data-filter-val="<?php echo $enum_fields['VALUE'];?>">
                            <input id="section-standart-<?php echo $enum_fields['ID'];?>" name="diametr[]" <?php if (in_array($enum_fields['VALUE'], $_POST['diametr'])) {
    echo "checked";
}?> value="<?php echo $enum_fields['VALUE'];?>" type="checkbox">
                            <label class="section-filter-checkbox-filex" for="section-standart-<?php echo $enum_fields['ID'];?>"><?php echo $enum_fields['VALUE'];?></label>
                            </p>
<?php                            
                            }
                            }
                         
                        
                        ?>
                        
                        
                            
                        </div>
                    </div>
            <!-- DIAMETR -->
            
                        <!-- MATERIAL -->
                    <div class="section-filter-item-filex opened" id="section-filter-block-610">
                        <p class="section-filter-ttl-filex">Материал <i class="fa fa-angle-down" style="display: block !important;"></i></p>
                        <div class="section-filter-fields-filex">
                        <p class="section-filter-ttl-search-filex"><input type="text" class="section-filter-ttl-search-input-filex" rel="610" id="section-filter-ttl-search-input-610"><i class="fa fa-ttl-search fa-ttl-icon-filex"></i></p>
                        <?php
                        $property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>'18', "CODE"=>"MATERIAL_1"));
                        while($enum_fields = $property_enums->GetNext())
                        {
                            if ($enum_fields['VALUE'] != '0'){
                            ?>
                            <p class="section-filter-field-filex" data-filter-val="<?php echo $enum_fields['VALUE'];?>">
                            <input id="section-standart-<?php echo $enum_fields['ID'];?>" name="material[]" <?php if (in_array($enum_fields['VALUE'], $_POST['material'])) {
    echo "checked";
}?> value="<?php echo $enum_fields['VALUE'];?>" type="checkbox">
                            <label class="section-filter-checkbox-filex" for="section-standart-<?php echo $enum_fields['ID'];?>"><?php echo $enum_fields['VALUE'];?></label>
                            </p>
<?php                            
                            }
                            }
                         
                        
                        ?>
                        
                        
                            
                        </div>
                    </div>
                <!-- MATERIAL -->
                
                                        <!-- ПОКРЫТИЕ -->
                    <div class="section-filter-item-filex opened" id="section-filter-block-611">
                        <p class="section-filter-ttl-filex">Покрытие <i class="fa fa-angle-down" style="display: block !important;"></i></p>
                        <div class="section-filter-fields-filex">
                        <p class="section-filter-ttl-search-filex"><input type="text" class="section-filter-ttl-search-input-filex" rel="611" id="section-filter-ttl-search-input-611"><i class="fa fa-ttl-search fa-ttl-icon-filex"></i></p>
                        <?php
                        $property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>'18', "CODE"=>"POKRYTIE_1"));
                        while($enum_fields = $property_enums->GetNext())
                        {
                            if ($enum_fields['VALUE'] != '0'){
                            ?>
                            <p class="section-filter-field-filex" data-filter-val="<?php echo $enum_fields['VALUE'];?>">
                            <input id="section-pokritie-<?php echo $enum_fields['ID'];?>" name="pokritie[]" <?php if (in_array($enum_fields['VALUE'], $_POST['pokritie'])) {
    echo "checked";
}?> value="<?php echo $enum_fields['VALUE'];?>" type="checkbox">
                            <label class="section-filter-checkbox-filex" for="section-pokritie-<?php echo $enum_fields['ID'];?>"><?php echo $enum_fields['VALUE'];?></label>
                            </p>
<?php                            
                            }
                            }
                        ?>
                        </div>
                    </div>
                <!-- ПОКРЫТИЕ -->
                </div>
            </div>
            </div>
            <!-- Filex - end -->
            

   </form>     
    </div>
</div>

     <?php 
    }
}
?>

<script>
$(document).ready(function(){

    /*section filter-filex search*/
    $(".section-filter-ttl-search-input-filex").on('keyup input',function(e) {
	    e.preventDefault();
    	var rel_filter = $(this).attr('rel');
    	var ws_filter = $(this).val().toLowerCase();
    	var len_filter = $(this).val().toLowerCase().length;
	        	if (len_filter > 0) {
    
    		$("#section-filter-block-" + rel_filter + " .section-filter-field-filex").each( function(){
	   		       var $this = $(this);
	   		       var value = $this.attr( "data-filter-val" ).toLowerCase(); //convert attribute value to lowercase
	   		       if (value.length > 0)
	   		    	   {
	   		       if (value.includes( ws_filter ))
	   		    	   {
	   		    	   	$this.css('display','block');
	   		    	   }
	   		       else
	   		    	   {
	   		    	   	$this.css('display','none');
	   		    	   }
	   		    	   }
	   		    });
    		
    	} else {
    		$("#section-filter-block-" + rel_filter + " .section-filter-field-filex").css('display','block');
    	}
	});
    /*end section filter-filex search*/
	
});
</script>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>