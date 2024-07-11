<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");

use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

global $APPLICATION, $DB;

if (\Bitrix\Main\Loader::includeModule("intervolga.tips") && \Intervolga\Tips\Rights::canRead())
{
	$APPLICATION->setTitle(Loc::getMessage("intervolga.tips.PUBLIC_LIST_TITLE"));

	$arMap = \Intervolga\Tips\Orm\TipsTable::getMap();
	$arTips = array();

	// Retrieve tips by their IDs from request
	$dbTips = \Intervolga\Tips\Orm\TipsTable::getList(array(
		"select" => array("ID", "TEXT", "TOOLTIP", "URL", "URL_EQUAL", ),
		"filter" => array("ACTIVE" => "Y", "ID" => $_REQUEST["IDs"], ),
		"order" => array("ID" => "ASC", ),
	));
	while ($arTip = $dbTips->fetch())
	{
		$arTips[] = $arTip;
	}
}

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");
?>
<? if (\Bitrix\Main\Loader::includeModule("intervolga.tips")): ?>
	<? if (\Intervolga\Tips\Rights::canRead()): ?>
		<style type="text/css">
			.intervolga-tips-public-table td {padding: 10px 5px !important;}
			.intervolga-tips-public-table .intervolga-tips-error { text-align: center; font-weight: bold;}
		</style>
		<p><a href="/bitrix/admin/intervolga.tips_list.php?lang=<?=htmlspecialchars($_REQUEST["lang"])?>"><?=Loc::getMessage("intervolga.tips.EDIT_IN_ADMIN")?></a></p>
		<table cellspacing="0" cellpadding="0" border="0" class="bx-width100 intervolga-tips-public-table">
			<thead>
			<tr class="section">
				<td><?=$arMap["ID"]["title"]?></td>
				<td><?=$arMap["TEXT"]["title"]?></td>
				<td><?=$arMap["TOOLTIP"]["title"]?></td>
				<td><?=$arMap["URL"]["title"]?></td>
				<td><?=$arMap["URL_EQUAL"]["title"]?></td>
			</tr>
			</thead>
			<tbody>
			<? if ($arTips): ?>
				<? foreach ($arTips as $arTip): ?>
					<tr>
						<td><?=$arTip["ID"]?></td>
						<td><a href="/bitrix/admin/intervolga.tips_edit.php?lang=<?=htmlspecialchars($_REQUEST["lang"])?>&ID=<?=$arTip["ID"]?>"><?=$arTip["TEXT"]?></a></td>
						<td><?=$arTip["TOOLTIP"]?></td>
						<td><?=$arTip["URL"]?></td>
						<td><?=($arTip["URL_EQUAL"] == "Y" ? Loc::getMessage("MAIN_YES") : Loc::getMessage("MAIN_NO"))?></td>
					</tr>
				<? endforeach ?>
			<? else: ?>
				<tr>
					<td colspan="6" class="intervolga-tips-error"><?=Loc::getMessage("intervolga.tips.NO_TIPS_ON_PAGE")?></td>
				</tr>
			<? endif ?>
			</tbody>
		</table>
	<? else: ?>
		<?=CAdminMessage::ShowMessage(Loc::getMessage("intervolga.tips.MODULE_READ_PERMITTED"))?>
	<? endif ?>
<? else: ?>
	<?=CAdminMessage::ShowMessage(Loc::getMessage("intervolga.tips.MODULE_NOT_INSTALLED"))?>
<? endif ?>
<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin.php");