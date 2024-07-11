<?
if(!defined('NO_AGENT_CHECK')) define('NO_AGENT_CHECK', true);
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/iblock/prolog.php");
$moduleId = 'esol.importxml';
CModule::IncludeModule('iblock');
CModule::IncludeModule($moduleId);
$bCurrency = CModule::IncludeModule("currency");
IncludeModuleLangFile(__FILE__);

$MODULE_RIGHT = $APPLICATION->GetGroupRight($moduleId);
if($MODULE_RIGHT < "W") $APPLICATION->AuthForm(GetMessage("ACCESS_DENIED"));

if(true /*$_POST['action']!='save'*/) CUtil::JSPostUnescape();

$oProfile = new \Bitrix\EsolImportxml\Profile();
$oProfile->Apply($SETTINGS_DEFAULT, $SETTINGS, $_REQUEST['PROFILE_ID']);
$oProfile->ApplyExtra($PEXTRASETTINGS, $_REQUEST['PROFILE_ID']);

$IBLOCK_ID = $SETTINGS_DEFAULT['IBLOCK_ID'];
$fl = new \Bitrix\EsolImportxml\FieldList($SETTINGS_DEFAULT);

if($_POST['action']=='save' && is_array($_POST['MAP']))
{
	define('PUBLIC_AJAX_MODE', 'Y');
	$APPLICATION->RestartBuffer();
	if(ob_get_contents()) ob_end_clean();
	
	$map = base64_encode(serialize($_POST['MAP']));
	echo '<script>EIXPreview.SetGroupSettings("'.htmlspecialcharsbx($map).'", "OFFPROPERTY")</script>';

	die();
}

$arParams = array();
$arMap = array();
if(isset($_POST['MAP']))
{
	$arParams = unserialize(base64_decode($_POST['MAP']));
	if(!is_array($arParams)) $arParams = array();
	if(isset($arParams['MAP']) && is_array($arParams['MAP'])) $arMap = $arParams['MAP'];
}

/*$xmlViewer = new \Bitrix\EsolImportxml\XMLViewer();
$availableTags=array();
$xmlViewer->GetAvailableTags($availableTags, $xpath, $arStuct);*/

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_popup_admin.php");
//print_r($_POST);
$xmlViewer = new \Bitrix\EsolImportxml\XMLViewer($SETTINGS_DEFAULT['URL_DATA_FILE'], $SETTINGS_DEFAULT);
$arXmlProps = $xmlViewer->GetPropertyList($_POST['XPATH'], $_POST['FIELDS'], true);

$arGroupFields = $fl->GetFieldsForPropMapping($IBLOCK_ID, true);

$arFeatures = array();
if(is_callable(array('\Bitrix\Iblock\Model\PropertyFeature', 'isEnabledFeatures')) && \Bitrix\Iblock\Model\PropertyFeature::isEnabledFeatures())
{
	$arFeatures = \Bitrix\Iblock\Model\PropertyFeature::getPropertyFeatureList(array());
}
?>
<form action="" method="post" enctype="multipart/form-data" name="field_settings">
	<input type="hidden" name="action" value="save">
	<div style="display: none;">
		<select name="section">
			<option value=""><?echo GetMessage("ESOL_IX_NOT_CHOOSE");?></option><?
			foreach($arGroupFields as $k2=>$v2)
			{
				?><optgroup label="<?echo $v2['title']?>"><?
				foreach($v2['items'] as $k=>$v)
				{
					$arFields[$k] = ($v2['title'] ? $v2['title'].' - ' : '').$v;
					?><option value="<?echo $k; ?>" <?if($k==$value){echo 'selected';}?>><?echo htmlspecialcharsbx($v); ?></option><?
				}
				?></optgroup><?
			}
			?>
		</select>
	</div>

	<?
	/*echo BeginNote();
	echo GetMessage("ESOL_IX_SECTION_MAPPING_NOTE");
	echo EndNote();*/
	?>

	<table width="100%">
		<col width="50%">
		<col width="50%">
		
		<tr>
			<td class="adm-detail-content-cell-l"><?echo GetMessage("ESOL_IX_PROPERTY_NOT_CREATE");?>:</td>
			<td class="adm-detail-content-cell-r">
				<input type="checkbox" name="MAP[PROPERTY_NOT_CREATE]" value="Y" <?=($arParams['PROPERTY_NOT_CREATE']=='Y' ? 'checked' : '')?>>
			</td>
		</tr>
		
		<tr>
			<td class="adm-detail-content-cell-l"><?echo GetMessage("ESOL_IX_PROPERTY_NOT_LOAD_WO_MAPPED");?>:</td>
			<td class="adm-detail-content-cell-r">
				<input type="checkbox" name="MAP[NOT_LOAD_WO_MAPPED]" value="Y" <?=($arParams['NOT_LOAD_WO_MAPPED']=='Y' ? 'checked' : '')?>>
			</td>
		</tr>
		
		<tr class="heading">
			<td colspan="2">
				<?echo GetMessage("ESOL_IX_PROPERTY_CREATE_TITLE");?>
			</td>
		</tr>
		
		<tr>
			<td class="adm-detail-content-cell-l"><?echo GetMessage("ESOL_IX_NP_TYPE");?>:</td>
			<td class="adm-detail-content-cell-r">
				<select name="MAP[NEW_PROPS][PROPERTY_TYPE]">
					<option value="S" <?if($arParams['NEW_PROPS']['PROPERTY_TYPE']=="S")echo " selected"?>><?echo GetMessage("ESOL_IX_NP_IBLOCK_PROP_S")?></option>
					<option value="N" <?if($arParams['NEW_PROPS']['PROPERTY_TYPE']=="N")echo " selected"?>><?echo GetMessage("ESOL_IX_NP_IBLOCK_PROP_N")?></option>
					<option value="L" <?if($arParams['NEW_PROPS']['PROPERTY_TYPE']=="L")echo " selected"?>><?echo GetMessage("ESOL_IX_NP_IBLOCK_PROP_L")?></option>
				</select>
			</td>
		</tr>
		
		<tr>
			<td class="adm-detail-content-cell-l"><?echo GetMessage("ESOL_IX_NP_SORT");?>:</td>
			<td class="adm-detail-content-cell-r">
				<input type="text" name="MAP[NEW_PROPS][SORT]" value="<?echo ($arParams['NEW_PROPS']['SORT'] ? htmlspecialcharsbx($arParams['NEW_PROPS']['SORT']) : '500')?>">
			</td>
		</tr>
		
		<tr>
			<td class="adm-detail-content-cell-l"><?echo GetMessage("ESOL_IX_NP_CODE_PREFIX");?>:</td>
			<td class="adm-detail-content-cell-r">
				<input type="text" name="MAP[NEW_PROPS][CODE_PREFIX]" value="<?echo ($arParams['NEW_PROPS']['CODE_PREFIX'] ? htmlspecialcharsbx($arParams['NEW_PROPS']['CODE_PREFIX']) : '')?>">
			</td>
		</tr>
		
		<tr>
			<td class="adm-detail-content-cell-l"><?echo GetMessage("ESOL_IX_NP_MULTIPLE");?>:</td>
			<td class="adm-detail-content-cell-r">
				<input type="checkbox" name="MAP[NEW_PROPS][MULTIPLE]" value="Y"<?echo ($arParams['NEW_PROPS']['MULTIPLE']=='Y' ? ' checked' : '')?>>
			</td>
		</tr>
		
		<tr>
			<td class="adm-detail-content-cell-l"><?echo GetMessage("ESOL_IX_NP_SMART_FILTER");?>:</td>
			<td class="adm-detail-content-cell-r">
				<input type="checkbox" name="MAP[NEW_PROPS][SMART_FILTER]" value="Y"<?echo ($arParams['NEW_PROPS']['SMART_FILTER']=='Y' ? ' checked' : '')?>>
			</td>
		</tr>
		
		<tr>
			<td class="adm-detail-content-cell-l"><?echo GetMessage("ESOL_IX_NP_DISPLAY_EXPANDED");?>:</td>
			<td class="adm-detail-content-cell-r">
				<input type="checkbox" name="MAP[NEW_PROPS][DISPLAY_EXPANDED]" value="Y"<?echo ($arParams['NEW_PROPS']['DISPLAY_EXPANDED']=='Y' ? ' checked' : '')?>>
			</td>
		</tr>
		
		<tr>
			<td class="adm-detail-content-cell-l"><?echo GetMessage("ESOL_IX_NP_SHOW_IN_FORM");?>:</td>
			<td class="adm-detail-content-cell-r">
				<input type="hidden" name="MAP[NEW_PROPS][SECTION_PROPERTY]" value="N">
				<input type="checkbox" name="MAP[NEW_PROPS][SECTION_PROPERTY]" value="Y"<?echo ($arParams['NEW_PROPS']['SECTION_PROPERTY']!='N' ? ' checked' : '')?>>
			</td>
		</tr>
		
		<?
		foreach($arFeatures as $arFeature)
		{
		?>
			<tr>
				<td class="adm-detail-content-cell-l"><?echo $arFeature['FEATURE_NAME'];?>:</td>
				<td class="adm-detail-content-cell-r">
					<input type="hidden" name="MAP[NEW_PROPS][<?echo htmlspecialcharsbx($arFeature['MODULE_ID'].':'.$arFeature['FEATURE_ID']);?>]" value="N">
					<input type="checkbox" name="MAP[NEW_PROPS][<?echo htmlspecialcharsbx($arFeature['MODULE_ID'].':'.$arFeature['FEATURE_ID']);?>]" value="Y"<?echo ($arParams['NEW_PROPS'][$arFeature['MODULE_ID'].':'.$arFeature['FEATURE_ID']]=='Y' ? ' checked' : '')?>>
				</td>
			</tr>
		<?
		}
		?>

		<tr class="heading">
			<td colspan="2">
				<?echo GetMessage("ESOL_IX_PROPERTY_MAPPING_TITLE");?>
			</td>
		</tr>
		
	<tr>
	  <td colspan="2">
		<?
		if(!is_array($arXmlProps)) echo GetMessage("ESOL_IX_PROPERTY_NOT_CHOOSE_FIELDS");
		elseif(count($arXmlProps)==0) echo GetMessage("ESOL_IX_PROPERTY_NO_STRUCT");
		else
		{
		?>
		<table width="100%" border="1" cellpadding="5">
		<col width="50%">
		<col width="50%">
		<tr>
			<th><? echo GetMessage("ESOL_IX_PROPERTY_IN_FILE");?></th>
			<th><? echo GetMessage("ESOL_IX_PROPERTY_ON_SITE");?></th>
		</tr>
		<?
		$arMap2 = array();
		foreach($arMap as $k=>$v)
		{
			if(!array_key_exists($v['XML_ID'], $arMap2)) $arMap2[$v['XML_ID']] = array();
			$arMap2[$v['XML_ID']][] = $v;
		}
		$index = 0;
		foreach($arXmlProps as $xmlId=>$arXmlProp){
			$xmlId = trim($xmlId);
		?>
			<tr>
				<td><?echo $arXmlProp['NAME'];?></td>
				<td>
				  <div class="esol-ix-select-mapping-wrap" data-nc-message="<?echo GetMessage("ESOL_IX_NOT_CHOOSE")?>">
					<a href="javascript:void(0)" class="esol-ix-mapping-add-field" title="<?echo GetMessage("ESOL_IX_ADD_FIELD");?>" onclick="ESettings.AddSelectMappingField(this)"></a>
					<?
					$isFields = false;
					if(array_key_exists($xmlId, $arMap2))
					{
						$arTmpVals = array();
						foreach($arMap2[$xmlId] as $val)
						{
							if(array_key_exists($val['ID'], $arFields) && !in_array($val['ID'], $arTmpVals))
							{
								echo '<div class="esol-ix-select-mapping esol-ix-select-mapping-full" data-xml-id="'.htmlspecialcharsbx($xmlId).'">'.
										'<input id="esol_mapping_'.$index.'" type="hidden" name="MAP[MAP]['.$index.'][XML_ID]" value="'.htmlspecialcharsbx($xmlId).'"><input type="hidden" name="MAP[MAP]['.$index.'][ID]" value="'.htmlspecialcharsbx($val['ID']).'">'.
										'<a href="javascript:void(0)" onclick="ESettings.ShowSelectMapping(this, true)">'.$arFields[$val['ID']].'</a>'.
										'<a id="field_settings_0'.$index.'" href="javascript:void(0)" onclick="ESettings.ShowSelectMappingSettings(event, this)" class="esol-ix-select-mapping-settings'.(strlen($val['EXTRA'])==0 ? ' inactive' : '').'" title="'.GetMessage("ESOL_IX_SETTINGS_BTN").'" data-group="offproperty"><input type="hidden" name="MAP[MAP]['.$index.'][EXTRA]" value="'.htmlspecialcharsbx($val['EXTRA']).'"></a>'.
									'</div>';
								$index++;
								$isFields = true;
							}
							$arTmpVals[] = $val['ID'];
						}
					}
					if(!$isFields)
					{
						echo '<div class="esol-ix-select-mapping" data-xml-id="'.htmlspecialcharsbx($xmlId).'">'.
								'<a href="javascript:void(0)" onclick="ESettings.ShowSelectMapping(this, true)">'.GetMessage("ESOL_IX_NOT_CHOOSE").'</a>'.
								'<a href="javascript:void(0)" onclick="ESettings.ShowSelectMappingSettings(event, this)" class="esol-ix-select-mapping-settings inactive" title="'.GetMessage("ESOL_IX_SETTINGS_BTN").'" data-group="offproperty"></a>'.
							'</div>';
					}
					?>
				  </div>
				</td>
			</tr>
		<?}?>
		</table>
		<?}?>
	  </td>
	</tr>
	</table>
</form>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_popup_admin.php");?>