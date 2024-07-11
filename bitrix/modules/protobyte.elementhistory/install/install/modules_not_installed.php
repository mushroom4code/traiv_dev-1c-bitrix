<form action="<?echo $APPLICATION->GetCurPage();?>">
    <?echo bitrix_sessid_post(); ?>
    <p>Ќе установлены следующие зависимости модул€: <b><?= implode(', ', $arVariables['modules'])?></b></p>
    <p>¬ернитесь на страницу установки, установите требуемые зависимости и попробуйте сначала.</p>
</form>
