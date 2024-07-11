<? if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die(); ?>
<? include_once 'top.php'; ?>

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

<? include_once 'bottom.php'; ?>
