<?
/**
 * @var string $mid module id from GET
 */
global $APPLICATION;
use \Bitrix\Main\Localization\Loc;
/**
 * @var string $module_id must be declared, used in ...group_rights.php
 */
$module_id = "intervolga.tips";

Loc::loadMessages(__FILE__);

\Bitrix\Main\Loader::includeModule("intervolga.tips");
?>
<? if (\Intervolga\Tips\Rights::canWrite()): ?>
	<?
		$arTabs = array();
		$arTabs[] = array('DIV' => 'rights', 'TAB' => Loc::getMessage('intervolga.tips.TAB_RIGHTS'), 'TITLE' => Loc::getMessage('intervolga.tips.TAB_RIGHTS_TITLE'));
		$obTabControl = new CAdminTabControl('tabControl', $arTabs);

		$obTabControl->Begin();
	?>
	<form method="POST" action="<?echo $APPLICATION->GetCurPage()?>?mid=<?=htmlspecialcharsbx($mid)?>&lang=<?=LANGUAGE_ID?>">
		<?$obTabControl->BeginNextTab();?>
		<?require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/admin/group_rights.php');?>
		<?$obTabControl->Buttons();?>
		<script language="JavaScript">
			function RestoreDefaults()
			{
				if(confirm('<?echo AddSlashes(Loc::getMessage('intervolga.tips.RESTORE_DEFAULTS_WARNING'))?>'))
					window.location = "<?echo $APPLICATION->GetCurPage()?>?RestoreDefaults=Y&lang=<?echo LANG?>&mid=<?echo urlencode($mid)."&".bitrix_sessid_get();?>";
			}
		</script>
		<input type="submit" name="Update" value="<?echo Loc::getMessage('intervolga.tips.SAVE')?>" class="adm-btn-save" >
		<input type="reset" name="reset" value="<?echo Loc::getMessage('intervolga.tips.RESET')?>">
		<input type="hidden" name="Update" value="Y">
		<?=bitrix_sessid_post();?>
		<input type="button" title="<?echo Loc::getMessage('intervolga.tips.RESTORE_DEFAULTS')?>" OnClick="RestoreDefaults();" value="<?echo Loc::getMessage('intervolga.tips.RESTORE_DEFAULTS')?>">
		<?$obTabControl->End();?>
	</form>
<? else: ?>
	<?=CAdminMessage::ShowMessage(Loc::getMessage("intervolga.tips.MODULE_WRITE_PERMITTED"))?>
<? endif ?>