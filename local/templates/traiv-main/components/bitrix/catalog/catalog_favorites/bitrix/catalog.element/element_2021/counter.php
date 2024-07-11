<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

if (isset ($_POST['counterID'])):
    $counterId = $_POST['counterID'];
    $iblockID = 37;
endif;

$db_list = CIBlockElement::GetProperty(37, $counterId, array("sort" => "asc"), Array("CODE"=>"COUNT"));

while ($res = $db_list->fetch()) {

    $count = $res['VALUE'];

}
$el = new CIBlockElement;

$count++;

$arLoadProductArray = Array(
    "COUNT" => $count
);

// $foo = $el->Update($counterId, $arLoadProductArray);
CIBlockElement::SetPropertyValueCode($counterId, "COUNT", $count);

echo $count;
