<form action="<?echo $APPLICATION->GetCurPage();?>">
    <?echo bitrix_sessid_post(); ?>
    <p>�� ����������� ��������� ����������� ������: <b><?= implode(', ', $arVariables['modules'])?></b></p>
    <p>��������� �� �������� ���������, ���������� ��������� ����������� � ���������� �������.</p>
</form>
