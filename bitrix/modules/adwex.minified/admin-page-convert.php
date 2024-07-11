<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_admin_before.php");

use \Bitrix\Main\Localization\Loc as Loc,
    \Bitrix\Main\Config\Option as Option,
    \Bitrix\Main\Loader,
    \Bitrix\Main\Page\Asset;

Loader::IncludeModule('adwex.minified');
Loc::loadMessages(__DIR__."/admin-page.php");
CJSCore::Init(array("jquery"));

$request = Bitrix\Main\Application::getInstance()->getContext()->getRequest();
$action = $request->get('action');

$POST_RIGHT = $APPLICATION->GetGroupRight('adwex.minified');
if ($POST_RIGHT == 'D')
    $APPLICATION->AuthForm(Loc::getMessage('ACCESS_DENIED'));

$convnotes = array();
if ($request->isPost() && $action == 'convert') {

	if (isset($_FILES['srcfile']) && $_FILES['srcfile']['error'] == UPLOAD_ERR_OK) {

		// Загружаем файл
		$flinfo = $_FILES['srcfile'];
		$srcPath = $flinfo['tmp_name'];

		// Конвертируем
		$resPath = tempnam(sys_get_temp_dir(), 'adwmin_conv_');
		\AdwMinified\WebP::create($srcPath, true, $resPath);
		$resCont = file_get_contents($resPath);
		unlink($resPath);

		// Отдаем
		ob_end_clean();
		header("Content-Type: image/webp");
		header("Content-Disposition: attachment; filename=\"".$flinfo['name'].".webp\"");
		echo $resCont;

		// Всё поделали
		die;

	}
	else {
		$convnotes[] ='Не выбран файл для конвертации или ошибка загрузки файла';
	}

}


$APPLICATION->SetTitle(Loc::getMessage('ADWMINI_MODULE_NAME'));
require($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_admin_after.php"); // prolog 2
?>

<div class="adwex-optiimg">
<form method="post" enctype="multipart/form-data">
<input type="hidden" name="action" value="convert">
    <?
    $aTabs = array(
        array(
            "DIV" => "edit1",
            "TAB" => Loc::getMessage("ADWMINI_MODULE_NAME"),
            "ICON" => "main_user_edit",
            "TITLE" => Loc::getMessage("ADWMINI_MODULE_TITLE"),
        ),
    );
    $tabControl = new CAdminTabControl("tabControl", $aTabs, true, true);
    $tabControl->Begin();
    $tabControl->BeginNextTab();
    ?>
    <tr class="heading">
        <td><?=Loc::getMessage("ADWMINI_CONVERT_BLOCK_TITLE")?></td>
    </tr>
    <tr>
		<td align=center>
			<?=Loc::getMessage("ADWMINI_CONVERT_SELFILE")?><br>
			<input class="my-file-upload-box" type="file" name="srcfile" accept="image/png,image/jpeg">
		</td>
    </tr>
	<tr>
		<td><div id='convnotes'>
<? 
foreach($convnotes as $note) {
	echo "<div style='padding-bottom:12px;'><b style='color:red'>(!)</b><br>$note</div>";
}
?>
		</div></td>
	</tr>
    <tr>
		<td><?=Loc::getMessage("ADWMINI_CONVERT_COMMENT")?></td>
    </tr>
    <?$tabControl->Buttons();?>
    <input type="submit" onclick="getElementById('convnotes').style.display='none'" value="<?= Loc::getMessage("ADWMINI_CONVERT") ?>" class="adm-btn-save">
    <?$tabControl->End();?>
</form>
</div>

<?require($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/epilog_admin.php");?>