<form action="<?echo $APPLICATION->GetCurPage()?>">
<?=bitrix_sessid_post()?>
	<input type="hidden" name="lang" value="<?echo LANG?>">
	<input type="hidden" name="id" value="scoder.collections">
	<input type="hidden" name="uninstall" value="Y">
	<input type="hidden" name="step" value="2">
	<?echo CAdminMessage::ShowMessage(GetMessage("MOD_UNINST_WARN"))?>
	<p><input type="checkbox" name="savedata" id="savedata" value="1" checked><label for="savedata"><?=GetMessage('MOD_UNINST_SAVE_TABLES'); ?></label></p>
	<input type="submit" name="inst" value="<?echo GetMessage("MOD_UNINST_DEL")?>">
</form>