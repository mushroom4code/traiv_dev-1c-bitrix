<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

if (isset ($_POST['counter'])):
$SectId = $_POST['counter'];
endif;
echo $SectId;

echo 'СЧИТААААЙ';

$db_list = CIBlockSection::GetList(array(), ['IBLOCK_ID' => 32, 'ID' => $SectId], false, ["UF_COUNTER"]);
while ($section = $db_list->fetch()) {


    $el = new CIBlockSection;

$count = $section['UF_COUNTER'];

If (!isset($count)){
    $count = 111;
}

$count++;

    $arFields = Array(
        "UF_COUNTER" => $count
    );

    $el->Update($section['ID'], $arFields);
}

