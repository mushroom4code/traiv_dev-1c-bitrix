<? if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die(); ?>
<? 
if (!$USER->IsAuthorized()) {
    if ($_REQUEST["AJAX_MODE"] != "Y") {
        LocalRedirect("/auth/?backurl=".$APPLICATION->GetCurPage());
    }
}

include_once 'top.php'; ?>

<div class="row lk_right_menu h-100 g-0">

<div class="col-12 col-xl-12 col-lg-12 col-md-12">
	<div class="row row d-flex align-items-center lk-item-block g-0">
		<div class="col-6"><div class="lk-item-block-title">Бонусный счет</div>
		<div><a href="/bonus/" class="lk-item-block-personal-link">Как потратить...</a></div>
		</div>
		
		<div class="col-6">
		
						<?php 
         $APPLICATION->IncludeComponent("bitrix:sale.personal.account","lkbs",Array(
                 "SET_TITLE" => "Y"
             )
         );
         ?>
		
		</div>
	</div>
	
		<div class="row row d-flex align-items-center lk-item-block g-0">
		<div class="col-6"><div class="lk-item-block-title">Ваш прогресс</div></div>
		<div class="col-6 text-right"><a href="/bonus/katalog-prizov/" class="lk-item-block-personal-link">Каталог подарков</a></div>
		
		
		<div class="col-12">
			<div class="lk-progress-gift">
			<div class="row">
			<?php 
$hlblock = Bitrix\Highloadblock\HighloadBlockTable::getById(4)->fetch();

$entity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
$entity_data_class = $entity->getDataClass();

$data = $entity_data_class::getList(array(
    "select" => array("*"),
    "order" => array("UF_BONUS_ITEM_SORT" => "ASC")
));

if (intval($data->getSelectedRowsCount()) > 0){
    while($arData = $data->Fetch()){
        $b_item_name = $arData['UF_BONUS_ITEM_NAME'];
        $b_item_img = CFile::GetPath($arData['UF_BONUS_ITEM_IMG']);
        $b_item_num = $arData['UF_BONUS_ITEM_NUM'];
        ?>
        
        <div class="col text-center bonus-element">
            <div class="lk-item bordered">
            <div class="bonus-item-item">
            <div class="bonus-item-item__image">
           	 <img src="<?php echo $b_item_img;?>" class="img-fluid">
            </div>
            	
            	<div class="bonus-element-name-small">
        							<?php echo $b_item_name;?>
        						</div>
            </div>
            </div>
        </div>
        <?php
    }
}
?>
</div>
			</div>
			<div class="lk-progress-line">
			<div class="lk-progress-line-res">
			</div>
			</div>
		</div>
		</div>
	</div>
	
	 	<div class="row lk-item-block g-0">
		<div class="col-12"><div class="lk-item-block-title">История начислений</div></div>
		<div class="col-12 g-0">
		
    <!-- personal info -->
	<div class="row g-0">
		
		<div class="col-12">
		
		<div class="row g-0 pb-3" id="orders-list-line-res">
		
		<div class="col-12 d-none d-lg-block" id="catalog-list-line-th">
    		<div class="row g-0">
        		<div class="col-2 col-xl-2 col-lg-2 col-md-2 text-center">Дата транзакции</div>
        		<div class="col-3 col-xl-3 col-lg-3 col-md-3 text-center">Сумма</div>
        		<div class="col-7 col-xl-7 col-lg-7 col-md-7 text-left">Описание</div>
    		</div>
		</div>
		
		<div class="row traiv-catalog-line-default g-0">
    		
    	<?php 	
    		    CModule::IncludeModule("sale");
    $res = CSaleUserTransact::GetList(Array("ID" => "DESC"), array("USER_ID" => '3092'));
    while ($arFields = $res->Fetch())
    {
        if ($arFields['CURRENCY'] == 'TRC') {
    ?>
    <div class="col-12 orders-list-line pt-1 pb-1 order-table__item">
    <div class="row g-0">
            		<div class="col-12 col-xl-2 col-lg-2 col-md-2 text-left text-xl-center text-lg-center text-md-center text-sm-center p-1"><b><?=$arFields["TRANSACT_DATE"]?></b></div>
            		<div class="col-12 col-xl-3 col-lg-3 col-md-3 text-left text-xl-center text-lg-center text-md-center text-sm-center p-1"><?=($arFields["DEBIT"]=="Y")?"+":"-"?><?=SaleFormatCurrency($arFields["AMOUNT"], $arFields["CURRENCY"])?> <small>(<?=($arFields["DEBIT"]=="Y")?"на счет":"со счета"?>)</small></div>
            		<div class="col-12 col-xl-7 col-lg-7 col-md-7 text-left text-xl-left text-lg-left text-md-left text-sm-left p-1"><?=$arFields["NOTES"]?></div>
        		</div>
        		</div>
    <?}
    }
    ?>
    		
		</div>
		
		</div>
		
		</div>

	</div>	
	<!-- personal info end -->
	
		
		</div>
	</div>
	
</div>

</div>

<!-- 
<div class="traiv-personal-cart">
    <div class="hide-mobile">
        <div class="header-block">
            Внутренний счет
        </div>
        
         <div class="form">
         <?php 
         $APPLICATION->IncludeComponent("bitrix:sale.personal.account","",Array(
                 "SET_TITLE" => "Y"
             )
         );
         ?>
         
         <table cellpadding="0" cellspacing="0" border="0" class="data-table">
    <thead>
        <tr>
            <td>№</td>
            <td>Дата транзакции</td>
            <td>Сумма</td>
            <td>Описание</td>
        </tr>
    </thead>
    <tbody>
    <?
    CModule::IncludeModule("sale");
    $res = CSaleUserTransact::GetList(Array("ID" => "DESC"), array("USER_ID" => $USER->GetID()));
    while ($arFields = $res->Fetch())
    {?>
        <tr>
            <td><?=$arFields["ID"]?></td>
            <td><?=$arFields["TRANSACT_DATE"]?></td>
            <td><?=($arFields["DEBIT"]=="Y")?"+":"-"?><?=SaleFormatCurrency($arFields["AMOUNT"], $arFields["CURRENCY"])?><br /><small>(<?=($arFields["DEBIT"]=="Y")?"на счет":"со счета"?>)</small></td>
            <td><?=$arFields["NOTES"]?></td>
        </tr>
    <?}?>
    <tbody>
</table>
         
         </div>
        
    </div>

</div>

-->

<? include_once 'bottom.php'; ?>
