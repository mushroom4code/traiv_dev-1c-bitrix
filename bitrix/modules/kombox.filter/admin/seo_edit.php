<?
use Bitrix\Main;
use Bitrix\Main\Localization\Loc;
use Kombox\Filter\SeoTable;
use Kombox\Filter\SeoPropertiesTable;

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");

Loc::loadMessages(dirname(__FILE__).'/seo_edit.php');

if (!$USER->CanDoOperation('seo_tools'))
{
	$APPLICATION->AuthForm(Loc::getMessage("ACCESS_DENIED"));
}

if(!Main\Loader::includeModule('kombox.filter'))
{
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");
	ShowError(Loc::getMessage("KOMBOX_MODULE_FILTER_NO_MODULE"));
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin.php");
}

$SECTION_ID = IntVal($SECTION_ID);
$IBLOCK_ID = IntVal($iblock_id);
$arIBlock = CIBlock::GetArrayByID($IBLOCK_ID);

$iblocks_seo = COption::GetOptionString('kombox.filter', "iblocks_seo");
	
if(strlen($iblocks_seo))
	$iblocks_seo = unserialize($iblocks_seo);
	
if(!in_array($IBLOCK_ID, $iblocks_seo)){
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");
	ShowError(Loc::getMessage("KOMBOX_MODULE_FILTER_NO_IBLOCK"));
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin.php");
}

//sections
$arSections = array();
$rsSections = CIBlockSection::GetList(array(), array('IBLOCK_ID' => $IBLOCK_ID), false, array('ID', 'NAME'));
while($arSection = $rsSections->Fetch()){
	$arSections[$arSection['ID']] = $arSection['NAME'];
}

$errors = array();
$arFields = array();

$ID = 0;
if (isset($_REQUEST['ID']))
	$ID = (int)$_REQUEST['ID'];
if ($ID < 0)
	$ID = 0;

$aTabs = array(
	array("DIV" => "edit1", "TAB" => Loc::getMessage("KOMBOX_MODULE_FILTER_SEO_TAB"), "ICON" => "currency"),
);
$tabControl = new CAdminTabControl("tabControl", $aTabs);

if($_SERVER['REQUEST_METHOD'] == 'POST' && check_bitrix_sessid() && (strlen($_POST["save"]) > 0 || strlen($_POST['apply']) > 0 || strlen($_POST['save_and_add']) > 0))
{
	$arFields = array(
		'IBLOCK_ID' => $IBLOCK_ID,
		'SECTION_ID' => (intval($_POST['SECTION_ID']) ? intval($_POST['SECTION_ID']) : 0),
		'INCLUDE_SUBSECTIONS' => (isset($_POST['INCLUDE_SUBSECTIONS']) ? $_POST['INCLUDE_SUBSECTIONS'] : 'Y'),
		'ACTIVE' => (isset($_POST['ACTIVE']) ? 'Y' : 'N'),
		'H1' => (isset($_POST['H1']) ? $_POST['H1'] : ''),
		'TITLE' => (isset($_POST['TITLE']) ? $_POST['TITLE'] : ''),
		'DESCRIPTION' => (isset($_POST['DESCRIPTION']) ? $_POST['DESCRIPTION'] : ''),
		'KEYWORDS' => (isset($_POST['KEYWORDS']) ? $_POST['KEYWORDS'] : ''),
		'TEXT' => (isset($_POST['TEXT']) ? $_POST['TEXT'] : ''),
		'TEXT_TYPE' => (in_array($_POST['TEXT_TYPE'], array('text', 'html')) ? $_POST['TEXT_TYPE'] : 'text'),
	);

	if ($ID > 0)
	{
		$result = SeoTable::update($ID, $arFields);
	}
	else
	{
		$result = SeoTable::add($arFields);
		$ID = $result->getId();
	}

	if(!$result->isSuccess())
	{
		$errors = $result->getErrorMessages();
	}
	else
	{
		SeoPropertiesTable::deleteAll($ID);
		
		if(is_array($_POST['PROPERTIES'])){
			foreach($_POST['PROPERTIES'] as $PROPERTY_ID => $arValues)
			{
				if(is_array($arValues['VALUES']))
				{
					foreach($arValues['VALUES'] as $value)
					{
						$arPropertiesFields = array(
							'RULE_ID' => $ID,
							'PROPERTY_ID' => $PROPERTY_ID,
							'VALUE' => base64_decode($value)
						);
						
						$result = SeoPropertiesTable::add($arPropertiesFields);
						
						if(!$result->isSuccess())
						{
							$errors = $result->getErrorMessages();
							break;
						}
					}
				}
				elseif(!empty($arValues['FROM']) || !empty($arValues['TO'])){
					$arPropertiesFields = array(
						'RULE_ID' => $ID,
						'PROPERTY_ID' => $PROPERTY_ID,
						'NUM_FROM' => $arValues['FROM'],
						'NUM_TO' => $arValues['TO']
					);
					
					$result = SeoPropertiesTable::add($arPropertiesFields);
					
					if(!$result->isSuccess())
					{
						$errors = $result->getErrorMessages();
						break;
					}
				}
				else
				{
					$arPropertiesFields = array(
						'RULE_ID' => $ID,
						'PROPERTY_ID' => $PROPERTY_ID
					);
					
					$result = SeoPropertiesTable::add($arPropertiesFields);
					
					if(!$result->isSuccess())
					{
						$errors = $result->getErrorMessages();
						break;
					}
				}
			}
		}
		
		if (empty($_POST['apply']))
		{
			if (!empty($return_url))
				LocalRedirect($return_url);
			else
				LocalRedirect("/bitrix/admin/kombox_filter_seo.php?iblock_id=".$IBLOCK_ID."&lang=".LANGUAGE_ID.GetFilterParams("filter_", false));
		}
		LocalRedirect("/bitrix/admin/kombox_filter_seo_edit.php?iblock_id=".$IBLOCK_ID."&lang=".LANGUAGE_ID."&ID=".$ID."&".GetFilterParams("filter_", false));
	}
}

$defaultValues = array(
	'SECTION_ID' => '',
	'INCLUDE_SUBSECTIONS' => 'Y',
	'PROPERTIES' => '',
	'ACTIVE' => '',
	'H1' => '',
	'TITLE' => '',
	'DESCRIPTION' => '',
	'KEYWORDS' => '',
	'TEXT' => '',
	'TEXT_TYPE' => 'text',
);

if ($ID > 0)
	$APPLICATION->SetTitle(Loc::getMessage("KOMBOX_MODULE_FILTER_SEO_EDIT_TITLE"));
else
	$APPLICATION->SetTitle(Loc::getMessage("KOMBOX_MODULE_FILTER_SEO_NEW_TITLE"));

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");

$arRule = $defaultValues;

if ($ID > 0)
{
	$rsRule = SeoTable::getList(array(
		'filter' => array('IBLOCK_ID' => $IBLOCK_ID, '=ID' => $ID)
	));
	
	$arRule = $rsRule->Fetch();
	if (empty($arRule))
	{
		$ID = 0;
		$arRule = $defaultValues;
	}
	
	if(!$SECTION_ID)
		$SECTION_ID = $arRule['SECTION_ID'];
}

if (!empty($errors))
{
	$arRule = $arFields;
}

$aContext = array(
	array(
		"ICON" => "btn_list",
		"TEXT" => Loc::getMessage("MAIN_ADMIN_MENU_LIST"),
		"LINK" => "/bitrix/admin/kombox_filter_seo.php?lang=".LANGUAGE_ID.'&iblock_id='.$IBLOCK_ID,
		"TITLE" => Loc::getMessage("MAIN_ADMIN_MENU_LIST")
	),
);

if ($ID > 0)
{
	$aContext[] = array(
		"TEXT"	=> Loc::getMessage("KOMBOX_MODULE_FILTER_SEO_ADD"),
		"TITLE"	=> Loc::getMessage("KOMBOX_MODULE_FILTER_SEO_ADD_TITLE"),
		"LINK" => "kombox_filter_seo_edit.php?ID=0&lang=".LANGUAGE_ID."&iblock_id=".$IBLOCK_ID,
	);

	if ($CURRENCY_RIGHT == "W")
	{
		$aContext[] = 	array(
			"ICON" => "btn_delete",
			"TEXT" => Loc::getMessage("KOMBOX_MODULE_FILTER_SEO_DELETE_TITLE"),
			"LINK" => "javascript:if(confirm('".Loc::getMessage("KOMBOX_MODULE_FILTER_SEO_DELETE_CONFIRM")."'))window.location='/bitrix/admin/kombox_filter_seo.php?action=delete&ID=".$ID."&iblock_id=".$IBLOCK_ID."&lang=".LANGUAGE_ID."&".bitrix_sessid_get()."';",
		);
	}
}

$context = new CAdminContextMenu($aContext);
$context->Show();

CJSCore::Init(array('jquery'));

if (!empty($errors))
	CAdminMessage::ShowMessage(implode('<br>', $errors));
?>
<form method="POST" action="<?$APPLICATION->GetCurPage()?>" name="kombox_filter_seo_edit">
<? echo bitrix_sessid_post();
echo GetFilterHiddens("filter_");?>
<input type="hidden" name="ID" value="<? echo $ID; ?>">
<input type="hidden" name="Update" value="Y">
<?
$tabControl->Begin();
$tabControl->BeginNextTab();

if ($ID > 0)
{
?>
<tr>
	<td><?=Loc::getMessage("KOMBOX_MODULE_FILTER_SEO_HEADER_ID")?>:</td>
	<td><? echo $ID; ?></td>
</tr><?
}
?>
<tr class="adm-detail-field">
	<td><?echo Loc::getMessage("KOMBOX_MODULE_FILTER_SEO_HEADER_ACTIVE")?>:</td>
	<td><input type="checkbox" name="ACTIVE" value="Y" <?if ($arRule["ACTIVE"]=="Y" || $ID == 0) echo "checked"?>></td>
</tr>
<tr class="adm-detail-required-field">
	<?$l = CIBlockSection::GetTreeList(Array("IBLOCK_ID"=>$IBLOCK_ID), array("ID", "NAME", "DEPTH_LEVEL"));?>
	<td class="adm-detail-valign-top"><?echo Loc::getMessage("KOMBOX_MODULE_FILTER_SEO_HEADER_SECTION_ID")?>:</td>
	<td>
		<select name="SECTION_ID">
			<option value="0"<?if(intval($arRule['SECTION_ID']) == 0 && $SECTION_ID == 0)echo " selected"?>><?echo Loc::getMessage("KOMBOX_MODULE_FILTER_SEO_UPPER_LEVEL")?></option>
		<?
			while($ar_l = $l->GetNext()):
				?><option value="<?echo $ar_l["ID"]?>"<?if(intval($arRule['SECTION_ID']) == $ar_l["ID"] || $SECTION_ID == $ar_l["ID"])echo " selected"?>><?echo str_repeat(" . ", $ar_l["DEPTH_LEVEL"])?><?echo $ar_l["NAME"]?></option><?
			endwhile;
		?>
		</select>
		<script>
			$(function(){
				$('select[name="SECTION_ID"]').on('change', function(){
					$('form[name="kombox_filter_seo_edit"]').submit();
				});
			});
		</script>
	</td>
</tr><?/*
<tr class="adm-detail-field">
	<td><?echo Loc::getMessage("KOMBOX_MODULE_FILTER_SEO_HEADER_INCLUDE_SUBSECTIONS")?>:</td>
	<td><input type="checkbox" name="INCLUDE_SUBSECTIONS" value="Y" <?if ($arRule["INCLUDE_SUBSECTIONS"]=="Y"  || $ID == 0) echo "checked"?>></td>
</tr>*/?>
<tr class="adm-detail-required-field">
	<td class="adm-detail-valign-top"><?echo Loc::getMessage("KOMBOX_MODULE_FILTER_SEO_HEADER_PROPERTIES")?>:</td>
	<td align="center">
		<?$arProperties = array();?>
		<table class="internal" id="table_PROPERTIES" width="100%">
			<tbody>
				<tr class="heading">
					<td><?echo Loc::getMessage("KOMBOX_MODULE_FILTER_SEO_CHOOSE_PROPERTIES_ID")?></td>
					<td><?echo Loc::getMessage("KOMBOX_MODULE_FILTER_SEO_CHOOSE_PROPERTIES_NAME")?></td>
					<td><?echo Loc::getMessage("KOMBOX_MODULE_FILTER_SEO_CHOOSE_PROPERTIES_CODE")?></td>
					<td><?echo Loc::getMessage("KOMBOX_MODULE_FILTER_SEO_CHOOSE_PROPERTIES_TYPE")?></td>
					<td><?echo Loc::getMessage("KOMBOX_MODULE_FILTER_SEO_CHOOSE_PROPERTIES_VALUES")?></td>
					<td><?echo Loc::getMessage("KOMBOX_MODULE_FILTER_SEO_CHOOSE_PROPERTIES_ACTION")?></td>
				</tr>
			</tbody>
		</table>
		<br />
	<?
		$arIBlockProperties = array();
		foreach(CIBlockSectionPropertyLink::GetArray($IBLOCK_ID, $SECTION_ID) as $PID => $arLink)
		{
			if($arLink['SMART_FILTER'] !== 'Y')
				continue;

			$rsProperty = CIBlockProperty::GetByID($PID);
			$arProperty = $rsProperty->Fetch();
			if($arProperty)
			{
				$arIBlockProperties[$arProperty['ID']] = $arProperty;
			}
		}
		
		$arOffersProperties = array();
		if(Main\Loader::includeModule('catalog'))
		{
			$arCatalog = CCatalogSKU::GetInfoByProductIBlock($IBLOCK_ID);
			if (!empty($arCatalog) && is_array($arCatalog))
			{
				$SKU_IBLOCK_ID = $arCatalog['IBLOCK_ID'];
				foreach(CIBlockSectionPropertyLink::GetArray($SKU_IBLOCK_ID, $SECTION_ID) as $PID => $arLink)
				{
					if($arLink['SMART_FILTER'] !== 'Y')
						continue;

					$rsProperty = CIBlockProperty::GetByID($PID);
					$arProperty = $rsProperty->Fetch();
					if($arProperty)
					{
						$arOffersProperties[$arProperty['ID']] = $arProperty;
					}
				}
			}
		}
	?>
		<select id="PROPERTIES"></select>
		<input type="button" value="<?echo Loc::getMessage("KOMBOX_MODULE_FILTER_SEO_CHOOSE_PROPERTIES_ADD")?>" onclick="kombox_add_property();" />
		<?
			if(!function_exists('getPropertyTypeName'))
			{
				function getPropertyTypeName($arProp)
				{
					if($arProp['PROPERTY_TYPE'] == "S" && !$arProp['USER_TYPE'])
						return Loc::getMessage("IBLOCK_PROP_S");
					elseif($arProp['PROPERTY_TYPE'] == "N" && !$arProp['USER_TYPE'])
						return Loc::getMessage("IBLOCK_PROP_N");
					elseif($arProp['PROPERTY_TYPE'] == "L" && !$arProp['USER_TYPE'])
						return Loc::getMessage("IBLOCK_PROP_L");
					elseif($arProp['PROPERTY_TYPE'] == "F" && !$arProp['USER_TYPE'])
						return Loc::getMessage("IBLOCK_PROP_F");
					elseif($arProp['PROPERTY_TYPE'] == "G" && !$arProp['USER_TYPE'])
						return Loc::getMessage("IBLOCK_PROP_G");
					elseif($arProp['PROPERTY_TYPE'] == "E" && !$arProp['USER_TYPE'])
						return Loc::getMessage("IBLOCK_PROP_E");
					elseif($arProp['USER_TYPE'] && is_array($ar = CIBlockProperty::GetUserType($arProp['USER_TYPE'])))
						return htmlspecialcharsex($ar["DESCRIPTION"]);
					else
						return Loc::getMessage("IBLOCK_PROP_S");
					return '';
				}
			}
			
			$arJsProperties = array();
			foreach($arIBlockProperties as $arProperty)
			{
				$arJsProperties[$arProperty['ID']] = array(
					'ID' => $arProperty['ID'],
					'CODE' => $arProperty['CODE'],
					'NAME' => $arProperty['NAME'],
					'TYPE' => $arProperty['PROPERTY_TYPE'],
					'TYPE_NAME' => getPropertyTypeName($arProperty),
					'CHECKED' => 'N',
					'VALUES' => array()
				);
			}
			
			foreach($arOffersProperties as $arProperty)
			{
				$arJsProperties[$arProperty['ID']] = array(
					'ID' => $arProperty['ID'],
					'CODE' => $arProperty['CODE'],
					'NAME' => $arProperty['NAME'],
					'TYPE' => $arProperty['PROPERTY_TYPE'],
					'TYPE_NAME' => getPropertyTypeName($arProperty),
					'CHECKED' => 'N',
					'OFFERS' => 'Y',
					'VALUES' => array()
				);
			}
			
			if ($ID > 0)
			{
				$rsRuleProperties = SeoPropertiesTable::getList(array(
					'filter' => array('=RULE_ID' => $ID)
				));
				
				while($arRuleProperties = $rsRuleProperties->Fetch())
				{
					if(strlen($arRuleProperties['VALUE'])){
						if(isset($arIBlockProperties[$arRuleProperties['PROPERTY_ID']]))
							$arProperty = $arIBlockProperties[$arRuleProperties['PROPERTY_ID']];
						elseif(isset($arOffersProperties[$arRuleProperties['PROPERTY_ID']]))
							$arProperty = $arOffersProperties[$arRuleProperties['PROPERTY_ID']];
							
						$arJsProperties[$arRuleProperties['PROPERTY_ID']]['VALUES'][base64_encode($arRuleProperties['VALUE'])] = Kombox\Filter\Tools::getFormatValue($arProperty, $arRuleProperties['VALUE']);
					}
					elseif(strlen($arRuleProperties['NUM_FROM']) || strlen($arRuleProperties['NUM_TO']))
					{
						$arJsProperties[$arRuleProperties['PROPERTY_ID']]['FROM'] = $arRuleProperties['NUM_FROM'];
						$arJsProperties[$arRuleProperties['PROPERTY_ID']]['TO'] = $arRuleProperties['NUM_TO'];
					}
					
					$arJsProperties[$arRuleProperties['PROPERTY_ID']]['CHECKED'] = 'Y';
				}
			}
		?>
		<script>
			$(function(){
				var properties = <?echo CUtil::PHPToJSObject($arJsProperties);?>;
				
				var lastFocus = false;
				$('#H1, #TITLE, #DESCRIPTION, #KEYWORDS, #TEXT').on("focus", function(e) {
					lastFocus = $(e.target);
				});
				
				$(document).on("click", "#SEO-NOTE div.templates a", function() {
					if(lastFocus == false)
						alert('<?echo Loc::getMessage("KOMBOX_MODULE_FILTER_SEO_CHOOSE_PROPERTIES")?>');
					else
					{
						lastFocus.val(lastFocus.val() + $(this).text());
					}
				});

				var generateSelect = function(){
					var select = $('select#PROPERTIES');
					select.empty();
					select.append($('<option value="0"><?echo Loc::getMessage("KOMBOX_MODULE_FILTER_SEO_CHOOSE_PROPERTIES")?></option>'));
					
					var table = $('table#table_PROPERTIES tbody');
					$('tr', table).not('.heading').remove();
					
					$('#SEO-NOTE div.templates').empty();
					
					$.each(properties, function(){
						var property = this;
						
						if(property['CHECKED'] == 'N')
						{
							var option = $('<option value="' + property['ID'] + '">[' + property['ID'] + '] ' + property['NAME'] + '</option>');
							if(property['OFFERS'] == 'Y')
							{
								if(!$('optgroup', select).length){
									select.append($('<optgroup label="<?echo Loc::getMessage("KOMBOX_MODULE_FILTER_SEO_CHOOSE_OFFERS_PROPERTIES")?>"></optgroup>'));
								}
								$('optgroup', select).append(option);
							}
							else
							{
								select.append(option);
							}
						}
						else
						{
							var tr = $('<tr id="property_' + property['ID'] + '"> \
								<td valign="top"><input type="hidden" name="PROPERTIES[' + property['ID'] + '][ID]" value="' + property['ID'] + '">' + property['ID'] + '</td> \
								<td valign="top">' + property['NAME'] + '</td> \
								<td valign="top">' + property['CODE'] + '</td> \
								<td valign="top">' + property['TYPE_NAME'] + '</td> \
								<td valign="top" class="values"><span></span><br /><a href="#change" class="bx-action-href" onclick="return kombox_change_property_values(' + property['ID'] + ')"><?echo Loc::getMessage("KOMBOX_MODULE_FILTER_SEO_CHOOSE_PROPERTIES_VALUES_CHANGE")?></a></td> \
								<td valign="top"><a href="#delete" class="bx-action-href" onclick="kombox_delete_property(' + property['ID'] + ')"><?echo Loc::getMessage("KOMBOX_MODULE_FILTER_SEO_CHOOSE_PROPERTIES_ACTION_DELETE")?></a></td> \
							</tr>');
							
							var cnt = 0;
							var result = '';
								
							if(property['TYPE'] == 'N' || property['TYPE'] == 'PRICE'){
								if(typeof property['FROM'] !== 'undefined' && !isNaN(property['FROM']) && property['FROM'] !== '')
								{
									cnt++;
									var hidden = $('<input type="hidden" name="PROPERTIES[' + property['ID'] + '][FROM]" value="' + property['FROM'] + '" />')
									$('td.values', tr).append(hidden);
									
									result += 'от ' + property['FROM'];
								}
								
								if(typeof property['TO'] !== 'undefined' && !isNaN(property['TO']) && property['TO'] !== '')
								{
									cnt++;
									var hidden = $('<input type="hidden" name="PROPERTIES[' + property['ID'] + '][TO]" value="' + property['TO'] + '" />')
									$('td.values', tr).append(hidden);
									
									if(result.length)
										result += ' ';
										
									result += 'до ' + property['TO'];
								}
								
								if(result.length)
									result += '<br />';
							}
							else
							{
								$.each(property['VALUES'], function(val, name){
									cnt++;
									var hidden = $('<input type="hidden" name="PROPERTIES[' + property['ID'] + '][VALUES][]" value="' + val + '" />')
									$('td.values', tr).append(hidden);
									result += name + '<br />';
								});
							}
							
							if(cnt == 0)
								result = '<?echo Loc::getMessage("KOMBOX_MODULE_FILTER_SEO_CHOOSE_PROPERTIES_VALUES_ALL")?> <br />';
								
							$('td.values span', tr).html(result);
							
							table.append(tr);
							
							//note
							var template = $('<a href="javascript:void(0)" data-template="#' + property['CODE'] + '#">#' + property['CODE'] + '#</a> - ' + property['NAME'] + '<br />');
							$('#SEO-NOTE div.templates').append(template);
						}
					});
					
					if(!$('tr', table).not('.heading').length)
					{
						$('#SEO-NOTE').hide();
						table.append($('<tr><td colspan="6" align="center"><?echo Loc::getMessage("KOMBOX_MODULE_FILTER_SEO_CHOOSE_PROPERTIES_EMPTY")?></td></tr>'));
					}
					else{
						$('#SEO-NOTE').show();
					}
				};
				
				window.kombox_add_property = function(){
					var id = $('select#PROPERTIES').val();
					
					if(id > 0)
					{
						var property = properties[id];
						if(property){
							property['CHECKED'] = 'Y';
							
							generateSelect();
						}
					}
				};
				
				window.kombox_delete_property = function(id){
					if(id > 0)
					{
						var property = properties[id];
						if(property){
							property['CHECKED'] = 'N';
							
							generateSelect();
						}
					}
				};
				
				generateSelect();
				
				var propertiesValues = {};
				var getValues = function(property_id, callback){
					if(!propertiesValues[property_id]){
						$.get(
							'/bitrix/admin/kombox_filter_seo_edit_values.php', 
							{'iblock_id': <?=$IBLOCK_ID?>, 'property_id': property_id},
							function(vals){
								propertiesValues[property_id] = BX.parseJSON(vals);
								callback.call(this, propertiesValues[property_id]);
							}
						);
					}
					else
						callback.call(this, propertiesValues[property_id]);
				};
				
				var hint = null;
				window.kombox_change_property_values = function(property_id){
					var property = properties[property_id];
					
					var link = $('table #property_' + property_id + ' td.values a');
					
					if(hint == null) {
						hint = new BX.PopupWindow("kombox-filter-seo-edit-value", BX(link[0]), {
							content: '',
							lightShadow : true,
							autoHide: false,
							closeByEsc: true,
							bindOptions: {position: "bottom"},
							closeIcon : { top : "5px", right : "10px"},
							offsetLeft : 0,
							offsetTop : 2,
							angle : { offset : 14 }
						});
					}
					
					if(property['TYPE'] == 'N' || property['TYPE'] == 'PRICE'){
						//numbers
						var content = $('<div><div class="adm-workarea" style="margin: 30px 20px;"></div></div>');
						var div = $('div', content);
						div.html('<?echo Loc::getMessage("KOMBOX_MODULE_FILTER_SEO_PROPERTY_VALUE_FROM")?> <input type="text" name="from" value="" size="5" /> <?echo Loc::getMessage("KOMBOX_MODULE_FILTER_SEO_PROPERTY_VALUE_TO")?> <input type="text" name="to" value="" size="5" />');
						
						if(typeof property['FROM'] !== 'undefined' && !isNaN(property['FROM']))
							$('input[name="from"]', div).attr('value', property['FROM']);
							
						if(typeof property['TO'] !== 'undefined' && !isNaN(property['TO']))
							$('input[name="to"]', div).attr('value', property['TO']);
							
						var button = $('<br /><input type="button" class="adm-btn-save" value="ok" />');
						div.append(button);
							
						hint.setContent(content.html());
						hint.setBindElement(BX(link[0]));
						hint.show();
						
						$('#kombox-filter-seo-edit-value input[type="button"]').on('click', function(){
							var from = $('#kombox-filter-seo-edit-value input[name="from"]').val();
							if(!isNaN(from)){
								property['FROM'] = from;
							}
							else
							{
								property['FROM'] = '';
							}
							
							var to = $('#kombox-filter-seo-edit-value input[name="to"]').val();
							if(!isNaN(to)){
								property['TO'] = to;
							}
							else
							{
								property['TO'] = '';
							}
							
							hint.close();
							generateSelect();
						});
					}
					else
					{
						getValues(property_id, function(values){

							var content = $('<div><div class="adm-workarea" style="margin: 30px 20px;"></div></div>');
							var div = $('div', content);
							var cnt = 0;
							$.each(values, function(){
								cnt++;
								var val = this;
								var label = $('<label><input type="checkbox" value="' + val['VALUE'] + '" />' + val['NAME'] + '</label><br />');
								if(typeof property['VALUES'][val['VALUE']] !== 'undefined')
									$('input', label).attr('checked', 'checked');
									
								div.append(label);
							});
							
							if(cnt == 0)
							{
								div.text('<?echo Loc::getMessage("KOMBOX_MODULE_FILTER_SEO_PROPERTY_VALUE_EMPTY")?>');
							}
							else
							{
								var button = $('<br /><input type="button" class="adm-btn-save" value="ok" />');
								div.append(button);
							}
							
							hint.setContent(content.html());
							hint.setBindElement(BX(link[0]));
							hint.show();
							
							$('#kombox-filter-seo-edit-value input[type="button"]').on('click', function(){
								var checked = $('#kombox-filter-seo-edit-value input[type="checkbox"]:checked');
								property['VALUES'] = {};
								if(checked.length){
									checked.each(function(){
										var input = $(this);
										property['VALUES'][input.val()] = input.parent().text();
									});
								}
								
								hint.close();
								generateSelect();
							});
						});
					}
					
					return false;
				}
			});
		</script>
	</td>
</tr>
<tr class="heading">
	<td align="center" colspan="2"><?echo Loc::getMessage("KOMBOX_MODULE_FILTER_SEO_SECTION")?></td>
</tr>
<tr class="adm-detail-field">
	<td><?echo Loc::getMessage("KOMBOX_MODULE_FILTER_SEO_HEADER_H1")?>:</td>
	<td><input type="text" id="H1" name="H1" value="<? echo $arRule['H1']; ?>" size="50"></td>
</tr>
<tr class="adm-detail-field">
	<td><?echo Loc::getMessage("KOMBOX_MODULE_FILTER_SEO_HEADER_TITLE")?>:</td>
	<td><input type="text" id="TITLE" name="TITLE" value="<? echo $arRule['TITLE']; ?>" size="50"></td>
</tr>
<tr class="adm-detail-field">
	<td><?echo Loc::getMessage("KOMBOX_MODULE_FILTER_SEO_HEADER_DESCRIPTION")?>:</td>
	<td><textarea id="DESCRIPTION" name="DESCRIPTION" style="width:100%" rows="2"><? echo $arRule['DESCRIPTION']; ?></textarea></td>
</tr>
<tr class="adm-detail-field">
	<td><?echo Loc::getMessage("KOMBOX_MODULE_FILTER_SEO_HEADER_KEYWORDS")?>:</td>
	<td><textarea id="KEYWORDS" name="KEYWORDS" style="width:100%" rows="2"><? echo $arRule['KEYWORDS']; ?></textarea></td>
</tr>
<tr class="adm-detail-field">
	<td><?echo Loc::getMessage("KOMBOX_MODULE_FILTER_SEO_HEADER_TEXT")?>:</td>
	<td>
		<table>
			<tbody>
				<tr>
					<td colspan="2">
						<?
						echo BeginNote();
						echo Loc::getMessage("KOMBOX_MODULE_FILTER_SEO_HEADER_TEXT_NOTE");
						echo EndNote();
						?>
					</td>
				</tr>
				<tr>
					<td width="10%"><?=Loc::getMessage('KOMBOX_MODULE_FILTER_SEO_HEADER_TEXT_TYPE')?>:</td>
					<td>
						<label>
							<input type="radio" name="TEXT_TYPE" value="text"<?echo $arRule['TEXT_TYPE'] == 'text' ? ' checked="checked"' : ''?> />
							text
						</label>
						<label>
							<input type="radio" name="TEXT_TYPE" value="html"<?echo $arRule['TEXT_TYPE'] == 'html' || $arRule['TEXT_TYPE'] == '' ? ' checked="checked"' : ''?> />
							html
						</label>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<textarea id="TEXT" name="TEXT" rows="10" cols="60" style="width:100%"><?echo $arRule['TEXT']?></textarea>
					</td>
				</tr>
			</tbody>
		</table>
	</td>
</tr>
<tr style="display:none;" id="SEO-NOTE">
	<td></td>
	<td>
		<?
		echo BeginNote();
		echo Loc::getMessage("KOMBOX_MODULE_FILTER_SEO_SECTION_NOTE");
		echo '<br /><div class="templates"></div><br />';
		echo Loc::getMessage("KOMBOX_MODULE_FILTER_SEO_SECTION_NOTE2");
		echo EndNote();
		?>
	</td>
</tr>
<?$tabControl->EndTab();
$tabControl->Buttons(
	array(
		"disabled" => false,
		"back_url" =>"/bitrix/admin/kombox_filter_seo.php?iblock_id=".$IBLOCK_ID."&lang=".LANGUAGE_ID.GetFilterParams("filter_")
	)
);
$tabControl->End();?>
</form>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin.php");?>