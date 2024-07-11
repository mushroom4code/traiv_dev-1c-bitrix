<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");

use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

global $APPLICATION;

if (\Bitrix\Main\Loader::includeModule("intervolga.tips"))
{
	if (\Intervolga\Tips\Rights::canRead())
	{
		$arResult["MAP"] = \Intervolga\Tips\Orm\TipsTable::getMap();
		$arResult["TOOLTIP"] = array();

		// Detect ID
		if (intval($_REQUEST["ID"]))
		{
			$arResult["ID"] = intval($_REQUEST["ID"]);
		}

		// Get instance
		if ($arResult["ID"])
		{
			$dbTooltip = \Intervolga\Tips\Orm\TipsTable::getById($_REQUEST["ID"]);
			$arResult["TOOLTIP"] = $dbTooltip->fetch();
		}

		// Get instance from request
		foreach ($arResult["MAP"] as $key => $arValue)
		{
			if (isset($_REQUEST[$key]))
			{
				$arResult["TOOLTIP"][$key] = $_REQUEST[$key];
			}
		}
		unset($arResult["TOOLTIP"]["ID"]);

		if (\Intervolga\Tips\Rights::canWrite())
		{
			// Execute save
			if (($_REQUEST["apply"] || $_REQUEST["save"] || $_REQUEST["save_and_add"]) && check_bitrix_sessid())
			{
				if ($arResult["ID"])
				{
					$obRes = \Intervolga\Tips\Orm\TipsTable::update($arResult["ID"], $arResult["TOOLTIP"]);
				}
				else
				{
					$obRes = \Intervolga\Tips\Orm\TipsTable::add($arResult["TOOLTIP"]);
				}

				if ($obRes->isSuccess())
				{
					if ($_REQUEST["apply"])
					{
						// Redirect to detail page
						$Id = $arResult["ID"] ? $arResult["ID"] : $obRes->getId();
						LocalRedirect($APPLICATION->GetCurPageParam("OK=Y&ID=$Id", array("OK", "ID", "SAVED")));
					}
					elseif ($_REQUEST["save"])
					{
						// Redirect to list page
						LocalRedirect("intervolga.tips_list.php?lang=".LANG);
					}
					elseif ($_REQUEST["save_and_add"])
					{
						// Redirect to new tip add page
						LocalRedirect($APPLICATION->GetCurPageParam("SAVED=Y", array("OK", "ID", "SAVED")));
					}
				}
				else
				{
					$arResult["ERRORS"] = $obRes->getErrorMessages();
				}
			}
		}

		// Get sites
		$dbSites = CSite::GetList($b = "NAME", $o = "asc");
		while ($arSite = $dbSites->Fetch())
		{
			$arResult["SITES"][$arSite["ID"]] = $arSite;
		}
	}
	else
	{
		$APPLICATION->setTitle(Loc::getMessage("intervolga.tips.EDIT_ADD_TITLE"));
	}
}

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");
?>
<? if (\Bitrix\Main\Loader::includeModule("intervolga.tips")): ?>
	<? if (\Intervolga\Tips\Rights::canRead()): ?>
		<?
		if ($arResult["ERRORS"])
		{
			CAdminMessage::ShowMessage(implode("<br>", $arResult["ERRORS"]));
		}
		else
		{
			if ($_REQUEST["OK"] == "Y")
			{
				if ($arResult["ID"])
				{
					CAdminMessage::ShowNote(Loc::getMessage("intervolga.tips.UPDATED"));
				}
				else
				{
					CAdminMessage::ShowNote(Loc::getMessage("intervolga.tips.ADDED"));
				}
			}
			if ($_REQUEST["SAVED"] == "Y")
			{
				CAdminMessage::ShowNote(Loc::getMessage("intervolga.tips.SAVED"));
			}
		}

		// Init tabs
		if ($arResult["ID"])
		{
			$arTabs = array(
				array("DIV" => "edit1", "TAB" => Loc::getMessage("intervolga.tips.PARAMS"), "ICON" => "main_user_edit", ),
			);
			if (\Intervolga\Tips\Rights::canWrite())
			{
				$APPLICATION->setTitle(Loc::getMessage("intervolga.tips.EDIT_TITLE", array("#ID#" => $arResult["ID"])));
			}
			else
			{
				$APPLICATION->setTitle(Loc::getMessage("intervolga.tips.VIEW_TITLE", array("#ID#" => $arResult["ID"])));
			}
		}
		else
		{
			$arTabs = array(
				array("DIV" => "edit1", "TAB" => Loc::getMessage("intervolga.tips.PARAMS"), "ICON" => "main_user_edit", ),
			);
			$APPLICATION->setTitle(Loc::getMessage("intervolga.tips.ADD_TITLE"));
		}
		$obTabControl = new CAdminTabControl("tabControl", $arTabs);
		?>
		<? if ($_REQUEST["bxpublic"] == "Y"): ?>
			<script type="text/javascript">top.BX.WindowManager.Get().SetTitle('<?=$APPLICATION->getTitle()?>');</script>
			<script type="text/javascript">
				function ivTooltipsGetSelectedText() {
					if (window.getSelection) {
						return window.getSelection().toString();
					} else if (document.selection && document.selection.type != "Control") {
						return document.selection.createRange().text;
					}
					return "";
				}
				document.getElementById('iv_tooltip_text').value = ivTooltipsGetSelectedText();
			</script>
		<? endif ?>
		<form method="post" action="<?=$APPLICATION->GetCurPage()?>" enctype="multipart/form-data" name="post_form">
			<? if ($arResult["ID"]): ?>
				<input type="hidden" value="<?=$arResult["ID"]?>" name="ID"/>
			<? endif ?>
			<?echo bitrix_sessid_post();?>
			<input type="hidden" name="lang" value="<?=LANG?>">
			<?
			$obTabControl->Begin();
			$obTabControl->BeginNextTab();
			?>
			<? if (count($arResult["SITES"]) > 0): ?>
				<? if (count($arResult["SITES"]) == 1): ?>
					<input type="hidden" name="SITE" value="<?=array_shift(array_keys($arResult["SITES"]))?>"/>
				<? else: ?>
					<tr class="adm-detail-required-field">
						<td width="40%" class="adm-detail-content-cell-l"><?=$arResult["MAP"]["SITE"]["title"]?>:</td>
						<td width="60%" class="adm-detail-content-cell-r">
							<select name="SITE">
								<? foreach ($arResult["SITES"] as $arSite): ?>
									<?
									$sSelectedAttr = ($arSite["ID"] == $arResult["TOOLTIP"]["SITE"]) ? "selected=\"selected\"" : "";
									?>
									<option value="<?=$arSite["ID"]?>" <?=$sSelectedAttr?>>[<?=$arSite["ID"]?>] <?=$arSite["NAME"]?></option>
								<? endforeach ?>
							</select>
						</td>
					</tr>
				<?endif ?>
			<? endif ?>
			<tr>
				<td width="40%" class="adm-detail-content-cell-l"><?=$arResult["MAP"]["ACTIVE"]["title"]?>:</td>
				<td width="60%" class="adm-detail-content-cell-r">
					<input type="hidden" name="ACTIVE" value="N"/>
					<input type="checkbox" name="ACTIVE" value="Y" <?= ($arResult["TOOLTIP"]["ACTIVE"] == "Y" || !$arResult["TOOLTIP"]) ? "checked=\"checked\"" : ""?>/>
				</td>
			</tr>
			<tr class="adm-detail-required-field">
				<td width="40%" class="adm-detail-content-cell-l"><?=$arResult["MAP"]["URL"]["title"]?>:</td>
				<td width="60%" class="adm-detail-content-cell-r">
					<input type="text" name="URL" value="<?=htmlspecialchars($arResult["TOOLTIP"]["URL"])?>" size="50"/>
				</td>
			</tr>
			<tr>
				<td width="40%" class="adm-detail-content-cell-l"><?=$arResult["MAP"]["URL_EQUAL"]["title"]?>:</td>
				<td width="60%" class="adm-detail-content-cell-r">
					<input type="hidden" name="URL_EQUAL" value="N"/>
					<input type="checkbox" name="URL_EQUAL" value="Y" <?= ($arResult["TOOLTIP"]["URL_EQUAL"] == "Y") ? "checked=\"checked\"" : ""?>/>
				</td>
			</tr>
			<tr>
				<td width="40%" class="adm-detail-content-cell-l"></td>
				<td width="60%" class="adm-detail-content-cell-r">
					<?=BeginNote()?><?=Loc::getMessage("intervolga.tips.URL_HELP")?><?=EndNote()?>
				</td>
			</tr>
			<tr class="adm-detail-required-field">
				<td width="40%" class="adm-detail-content-cell-l"><?=$arResult["MAP"]["TEXT"]["title"]?>:</td>
				<td width="60%" class="adm-detail-content-cell-r">
					<input type="text" name="TEXT" id="iv_tooltip_text" value="<?=htmlspecialchars($arResult["TOOLTIP"]["TEXT"])?>" size="50"/>
				</td>
			</tr>
			<?if(CModule::IncludeModule("fileman")):?>
				<tr>
					<td colspan="2">
						<?CFileMan::AddHTMLEditorFrame(
							"TOOLTIP",
							$arResult["TOOLTIP"]["TOOLTIP"],
							false,
							false,
							array(
								'height' => '200',
								'width' => '100%'
							),
							"N",
							0,
							"",
							"",
							$arResult["TOOLTIP"]["SITE"] ? $arResult["TOOLTIP"]["SITE"]: SITE_ID,
							true,
							false,
							array(
							)
						);?>
					</td>
				</tr>
			<?else:?>
				<tr class="adm-detail-required-field">
					<td width="40%" class="adm-detail-content-cell-l"><?=$arResult["MAP"]["TOOLTIP"]["title"]?>:</td>
					<td width="60%" class="adm-detail-content-cell-r">
						<textarea name="TOOLTIP"><?=htmlspecialchars($arResult["TOOLTIP"]["TOOLTIP"])?></textarea>
					</td>
				</tr>
			<?endif;?>

			<? if (\Intervolga\Tips\Rights::canWrite()): ?>
				<?$obTabControl->Buttons(
					array(
						"back_url"=>"intervolga.tips_list.php?lang=".LANG,
						"btnSaveAndAdd" => true
					)
				);?>
			<? endif ?>
		</form>
		<?
		$obTabControl->End();
		?>
	<? else: ?>
		<?=CAdminMessage::ShowMessage(Loc::getMessage("intervolga.tips.MODULE_READ_PERMITTED"))?>
	<? endif ?>
<? else: ?>
	<?=CAdminMessage::ShowMessage(Loc::getMessage("intervolga.tips.MODULE_NOT_INSTALLED"))?>
<? endif ?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin.php");