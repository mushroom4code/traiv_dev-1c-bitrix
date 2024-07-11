<?
IncludeModuleLangFile(__FILE__);
$APPLICATION->SetTitle(GetMessage("KOMBOX_MODULE_FILTER_OPTIONS_TAB_1"));		
if ($USER->IsAdmin()):
	
	if ($_POST['Update'] && check_bitrix_sessid()) {
		$paths = $_POST['sef_paths'];
		COption::SetOptionString('kombox.filter', "sef_paths", $paths);
		
		$iblocks = $_POST['iblocks'];
		if(is_array($iblocks))
			COption::SetOptionString('kombox.filter', "iblocks", serialize($iblocks));
			
		$iblocks_seo = $_POST['iblocks_seo'];
		if(is_array($iblocks_seo))
			COption::SetOptionString('kombox.filter', "iblocks_seo", serialize($iblocks_seo));
	}
	
	$paths = COption::GetOptionString('kombox.filter', "sef_paths");
	
	$iblocks = COption::GetOptionString('kombox.filter', "iblocks");
	
	if(strlen($iblocks))
		$iblocks = unserialize($iblocks);
		
	if(!is_array($iblocks))
		$iblocks = array();
		
	$iblocks_seo = COption::GetOptionString('kombox.filter', "iblocks_seo");
	
	if(strlen($iblocks_seo))
		$iblocks_seo = unserialize($iblocks_seo);
		
	if(!is_array($iblocks_seo))
		$iblocks_seo = array();
	
	if(isset($_POST['sef_paths']))
		$paths = $_POST['sef_paths'];
		
	if(isset($_POST['iblocks']))
		$iblocks = $_POST['iblocks'];
		
	if(isset($_POST['iblocks_seo']))
		$iblocks_seo = $_POST['iblocks_seo'];
		
	$aTabs = array();
	$aTabs[] = array("DIV" => "edit1", "TAB" => GetMessage("KOMBOX_MODULE_FILTER_OPTIONS_TAB_1"), "ICON" => "settings", "TITLE" => GetMessage("KOMBOX_MODULE_FILTER_OPTIONS_TAB_1_TITLE"));
	
	$tabControl = new CAdminTabControl("tabControl", $aTabs);
	$tabControl->Begin();?>
	<form name="kombox_filter_options" method="POST" action="<?echo $APPLICATION->GetCurPage()?>?mid=<?=htmlspecialcharsbx($mid)?>&amp;lang=<?echo LANG?>&amp;mid_menu=1">
		<?=bitrix_sessid_post();?>
		<?$tabControl->BeginNextTab();?>
			<tr>
				<td width="40%" class="adm-detail-valign-top adm-detail-content-cell-l"><?=GetMessage('KOMBOX_MODULE_FILTER_OPTIONS_PATHS');?>:</td>
				<td width="60%" class="adm-detail-content-cell-r">
					<textarea rows="5" name="sef_paths" style="width:100%"><?echo htmlspecialcharsbx($paths)?></textarea>
					<?
					echo BeginNote();
					echo GetMessage("KOMBOX_MODULE_FILTER_OPTIONS_PATHS_TIPS");
					echo EndNote();
					?>
				</td>
			</tr>
			<?if(CModule::IncludeModule('iblock')):
			$arIBlocks = array();
			$rsIBlocks = CIBlock::GetList(
				Array(), 
				Array(), 
				false
			);
			while($arIBlock = $rsIBlocks->Fetch())
			{
				$arIBlocks[$arIBlock['ID']] = '['.$arIBlock['ID'].'] '.$arIBlock['NAME'];
			}
			?>
			<?if(count($arIBlocks)):?>
			<tr>
				<td width="40%" class="adm-detail-valign-top adm-detail-content-cell-l"><?=GetMessage('KOMBOX_MODULE_FILTER_OPTIONS_IBLOCKS');?>:</td>
				<td width="60%" class="adm-detail-content-cell-r">
					<select name="iblocks[]" multiple="multiple" size="8">
					<?foreach($arIBlocks as $id => $name):?>
						<option value="<?=$id?>"<?if(in_array($id, $iblocks)):?> selected="selected"<?endif;?>><?=$name?></option>
					<?endforeach;?>
					</select>
				</td>
			</tr>
			<?endif;?>
			<?if(count($arIBlocks)):?>
			<tr>
				<td width="40%" class="adm-detail-valign-top adm-detail-content-cell-l"><?=GetMessage('KOMBOX_MODULE_FILTER_OPTIONS_IBLOCKS_SEO');?>:</td>
				<td width="60%" class="adm-detail-content-cell-r">
					<select name="iblocks_seo[]" multiple="multiple" size="8">
					<?foreach($arIBlocks as $id => $name):?>
						<option value="<?=$id?>"<?if(in_array($id, $iblocks_seo)):?> selected="selected"<?endif;?>><?=$name?></option>
					<?endforeach;?>
					</select>
				</td>
			</tr>
			<?endif;?>
			<?endif;?>
		<?$tabControl->Buttons();?>
		<input type="submit" name="Update" value="<?=GetMessage("MAIN_SAVE")?>">
		<?$tabControl->End();?>
	</form>
<?endif;?>