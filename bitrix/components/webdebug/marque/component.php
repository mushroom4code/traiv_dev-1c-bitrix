<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arParams["EDIT_TEMPLATE"] = strlen($arParams["EDIT_TEMPLATE"]) > 0 ? $arParams["EDIT_TEMPLATE"] : $arParams["AREA_FILE_SHOW"]."_inc.php";

// check params values
$bHasPath = ($arParams["AREA_FILE_SHOW"] == 'file');
$sRealFilePath = $_SERVER["REAL_FILE_PATH"];

$io = CBXVirtualIo::GetInstance();

if (!$bHasPath)
{
	$arParams["AREA_FILE_SHOW"] = $arParams["AREA_FILE_SHOW"] == "sect" ? "sect" : "page";
	$arParams["AREA_FILE_SUFFIX"] = strlen($arParams["AREA_FILE_SUFFIX"]) > 0 ? $arParams["AREA_FILE_SUFFIX"] : "marque";
	$arParams["AREA_FILE_RECURSIVE"] = $arParams["AREA_FILE_RECURSIVE"] == "N" ? "N" : "Y";


	// check file for including
	if ($arParams["AREA_FILE_SHOW"] == "page")
	{
		// if page in SEF mode check real path
		if (strlen($sRealFilePath) > 0)
		{
			$slash_pos = strrpos($sRealFilePath, "/");
			$sFilePath = substr($sRealFilePath, 0, $slash_pos+1);
			$sFileName = substr($sRealFilePath, $slash_pos+1);
			$sFileName = substr($sFileName, 0, strlen($sFileName)-4)."_".$arParams["AREA_FILE_SUFFIX"].".php";
		}
		// otherwise use current
		else
		{
			$sFilePath = $APPLICATION->GetCurDir();
			$sFileName = substr($APPLICATION->GetCurPage(true), 0, strlen($APPLICATION->GetCurPage(true))-4)."_".$arParams["AREA_FILE_SUFFIX"].".php";
			$sFileName = substr($sFileName, strlen($sFilePath));
		}

		$sFilePathTMP = $sFilePath;
		$bFileFound = $io->FileExists($_SERVER['DOCUMENT_ROOT'].$sFilePath.$sFileName);
	}
	else
	{
		// if page is in SEF mode - check real path
		if (strlen($sRealFilePath) > 0)
		{
			$slash_pos = strrpos($sRealFilePath, "/");
			$sFilePath = substr($sRealFilePath, 0, $slash_pos+1);
		}
		// otherwise use current
		else
		{
			$sFilePath = $APPLICATION->GetCurDir();
		}

		$sFilePathTMP = $sFilePath;
		$sFileName = "marque_".$arParams["AREA_FILE_SUFFIX"].".php";

		$bFileFound = $io->FileExists($_SERVER['DOCUMENT_ROOT'].$sFilePath.$sFileName);

		// if file not found and is set recursive check - start it
		if (!$bFileFound && $arParams["AREA_FILE_RECURSIVE"] == "Y" && $sFilePath != "/")
		{
			$finish = false;

			do
			{
				// back one level
				if (substr($sFilePath, -1) == "/") $sFilePath = substr($sFilePath, 0, -1);
				$slash_pos = strrpos($sFilePath, "/");
				$sFilePath = substr($sFilePath, 0, $slash_pos+1);

				$bFileFound = $io->FileExists($_SERVER['DOCUMENT_ROOT'].$sFilePath.$sFileName);

				// if we are on the root - finish
				$finish = $sFilePath == "/";
			}
			while (!$finish && !$bFileFound);
		}
	}
}
else
{
	if (substr($arParams['PATH'], 0, 1) != '/')
	{
		// if page in SEF mode check real path
		if (strlen($sRealFilePath) > 0)
		{
			$slash_pos = strrpos($sRealFilePath, "/");
			$sFilePath = substr($sRealFilePath, 0, $slash_pos+1);
		}
		// otherwise use current
		else
		{
			$sFilePath = $APPLICATION->GetCurDir();
		}

		$arParams['PATH'] = Rel2Abs($sFilePath, $arParams['PATH']);
	}

	$slash_pos = strrpos($arParams['PATH'], "/");
	$sFilePath = substr($arParams['PATH'], 0, $slash_pos+1);
	$sFileName = substr($arParams['PATH'], $slash_pos+1);

	$bFileFound = $io->FileExists($_SERVER['DOCUMENT_ROOT'].$sFilePath.$sFileName);

	$sFilePathTMP = $sFilePath;
}

if($APPLICATION->GetShowIncludeAreas())
{
	//need fm_lpa for every .php file, even with no php code inside
	$bPhpFile = (!$GLOBALS["USER"]->CanDoOperation('edit_php') && in_array(GetFileExtension($sFileName), GetScriptFileExt()));

	$bCanEdit = $USER->CanDoFileOperation('fm_edit_existent_file', array(SITE_ID, $sFilePath.$sFileName)) && (!$bPhpFile || $GLOBALS["USER"]->CanDoFileOperation('fm_lpa', array(SITE_ID, $sFilePath.$sFileName)));
	$bCanAdd = $USER->CanDoFileOperation('fm_create_new_file', array(SITE_ID, $sFilePathTMP.$sFileName)) && (!$bPhpFile || $GLOBALS["USER"]->CanDoFileOperation('fm_lpa', array(SITE_ID, $sFilePathTMP.$sFileName)));

	if($bCanEdit || $bCanAdd)
	{
		$editor = '&site='.SITE_ID.'&back_url='.urlencode($_SERVER['REQUEST_URI']).'&templateID='.urlencode(SITE_TEMPLATE_ID);

		if ($bFileFound)
		{
			if ($bCanEdit)
			{
				$arMenu = array();
				if($USER->CanDoOperation('edit_php'))
				{
					$arMenu[] = array(
						"ACTION" => 'javascript:'.$APPLICATION->GetPopupLink(
							array(
								'URL' => "/bitrix/admin/public_file_edit_src.php?lang=".LANGUAGE_ID."&template=".urlencode($arParams["EDIT_TEMPLATE"])."&path=".urlencode($sFilePath.$sFileName).$editor,
								"PARAMS" => array(
									'width' => 770,
									'height' => 570,
									'resize' => true,
									"dialog_type" => 'EDITOR'
								)
							)
						),
						"ICON" => "panel-edit-php",
						"TEXT"=>GetMessage("WD_MARQUE_COMP_INCLUDE_EDIT_PHP"),
						"TITLE" => GetMessage("WD_MARQUE_INCLUDE_AREA_EDIT_".$arParams["AREA_FILE_SHOW"]."_NOEDITOR"),
					);
				}
				$arIcons = array(
					array(
						"URL" => 'javascript:'.$APPLICATION->GetPopupLink(
							array(
								'URL' => "/bitrix/admin/public_file_edit.php?lang=".LANGUAGE_ID."&from=main.include&template=".urlencode($arParams["EDIT_TEMPLATE"])."&path=".urlencode($sFilePath.$sFileName).$editor,
								"PARAMS" => array(
									'width' => 770,
									'height' => 570,
									'resize' => true
								)
							)
						),
						"DEFAULT" => $APPLICATION->GetPublicShowMode() != 'configure',
						"ICON" => "bx-context-toolbar-edit-icon",
						"TITLE"=>GetMessage("WD_MARQUE_COMP_INCLUDE_EDIT"),
						"ALT" => GetMessage("WD_MARQUE_INCLUDE_AREA_EDIT_".$arParams["AREA_FILE_SHOW"]),
						"MENU" => $arMenu,
					),
				);
			}

			if ($sFilePath != $sFilePathTMP && $bCanAdd)
			{
				$arMenu = array();
				if($USER->CanDoOperation('edit_php'))
				{
					$arMenu[] = array(
						"ACTION" => 'javascript:'.$APPLICATION->GetPopupLink(
							array(
								'URL' => "/bitrix/admin/public_file_edit_src.php?lang=".LANGUAGE_ID."&new=Y&path=".urlencode($sFilePathTMP.$sFileName)."&new=Y&template=".urlencode($arParams["EDIT_TEMPLATE"]).$editor,
								"PARAMS" => array(
									'width' => 770,
									'height' => 570,
									'resize' => true,
									"dialog_type" => 'EDITOR'
								)
							)
						),
						"ICON" => "panel-edit-php",
						"TEXT"	=> GetMessage("WD_MARQUE_COMP_INCLUDE_ADD_PHP"),
						"TITLE" => GetMessage("WD_MARQUE_INCLUDE_AREA_ADD_".$arParams["AREA_FILE_SHOW"]."_NOEDITOR"),
					);
				}
				$arIcons[] = array(
					"URL" => 'javascript:'.$APPLICATION->GetPopupLink(
						array(
							'URL' => "/bitrix/admin/public_file_edit.php?lang=".LANGUAGE_ID."&from=main.include&new=Y&path=".urlencode($sFilePathTMP.$sFileName)."&new=Y&template=".urlencode($arParams["EDIT_TEMPLATE"]).$editor,
							"PARAMS" => array(
								'width' => 770,
								'height' => 570,
								'resize' => true
							)
						)
					),
					"DEFAULT" => $APPLICATION->GetPublicShowMode() != 'configure',
					"ICON" => "bx-context-toolbar-create-icon",
					"TITLE" => GetMessage("WD_MARQUE_COMP_INCLUDE_ADD"),
					"ALT" => GetMessage("WD_MARQUE_INCLUDE_AREA_ADD_".$arParams["AREA_FILE_SHOW"]),
					"MENU" => $arMenu,
				);
			}
		}
		elseif ($bCanAdd)
		{
			$arMenu = array();
			if($USER->CanDoOperation('edit_php'))
			{
				$arMenu[] = array(
					"ACTION" => 'javascript:'.$APPLICATION->GetPopupLink(
						array(
							'URL' => "/bitrix/admin/public_file_edit_src.php?lang=".LANGUAGE_ID."&path=".urlencode($sFilePathTMP)."&filename=".urlencode($sFileName)."&new=Y&template=".urlencode($arParams["EDIT_TEMPLATE"]).$editor,
							"PARAMS" => array(
								'width' => 770,
								'height' => 570,
								'resize' => true,
								"dialog_type" => 'EDITOR'
							)
						)
					),
					"ICON" => "panel-edit-php",
					"TEXT" => GetMessage("WD_MARQUE_COMP_INCLUDE_ADD1_PHP"),
					"TITLE" => GetMessage("WD_MARQUE_INCLUDE_AREA_ADD_".$arParams["AREA_FILE_SHOW"]."_NOEDITOR"),
				);
			}
			$arIcons = array(
				array(
					"URL" => 'javascript:'.$APPLICATION->GetPopupLink(
						array(
							'URL' => "/bitrix/admin/public_file_edit.php?lang=".LANGUAGE_ID."&from=main.include&path=".urlencode($sFilePathTMP.$sFileName)."&new=Y&template=".urlencode($arParams["EDIT_TEMPLATE"]).$editor,
							"PARAMS" => array(
								'width' => 770,
								'height' => 570,
								'resize' => true
							)
						)
					),
					"DEFAULT" => $APPLICATION->GetPublicShowMode() != 'configure',
					"ICON" => "bx-context-toolbar-create-icon",
					"TITLE" => GetMessage("WD_MARQUE_COMP_INCLUDE_ADD1"),
					"ALT" => GetMessage("WD_MARQUE_INCLUDE_AREA_ADD_".$arParams["AREA_FILE_SHOW"]),
					"MENU" => $arMenu,
				),
			);
		}

		if (is_array($arIcons) && count($arIcons) > 0)
		{
			$this->AddIncludeAreaIcons($arIcons);
		}
	}
}

if ($bFileFound) {
	if (!CModule::IncludeModule('webdebug.marque')) {
		return;
	}
	require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/webdebug.marque/install/demo.php');
	$Expired = webdebug_marque_demo_expired();
	if ($Expired) {
		webdebug_marque_show_demo(false);
	} else {
		$arResult["FILE"] = $io->GetPhysicalName($_SERVER["DOCUMENT_ROOT"].$sFilePath.$sFileName);
		$arResult['ID'] = trim($arParams['MARQUE_ID']);
		if ($arResult['ID']=='') {
			$arResult['ID'] = $this->randString();
		}
		$arParams['DIRECTION'] = in_array($arParams['DIRECTION'],array('up','right','down','left')) ? $arParams['DIRECTION'] : 'left';
		$arParams['LOOP'] = is_numeric($arParams['LOOP']) && $arParams['LOOP']>=0 ? $arParams['LOOP'] : '-1';
		$arParams['SCROLLDELAY'] = is_numeric($arParams['SCROLLDELAY']) && $arParams['SCROLLDELAY']>=0 ? $arParams['SCROLLDELAY'] : '500';
		$arParams['SCROLLAMOUNT'] = is_numeric($arParams['SCROLLAMOUNT']) && $arParams['SCROLLAMOUNT']>=0 ? $arParams['SCROLLAMOUNT'] : '100';
		$arParams['CIRCULAR'] = $arParams['CIRCULAR']=='Y'?'Y':'N';
		$arParams['DRAG'] = $arParams['DRAG']=='N'?'N':'Y';
		$arParams['RUNSHORT'] = $arParams['RUNSHORT']=='N'?'N':'Y';
		$arParams['HOVERSTOP'] = $arParams['HOVERSTOP']=='N'?'N':'Y';
		$arParams['INVERTHOVER'] = $arParams['INVERTHOVER']=='Y'?'Y':'N';
		$arParams['HIDDEN'] = $arParams['HIDDEN']=='N'?'N':'Y';
		$arParams['STYLES'] = trim($arParams['STYLES']);
		$arResult['MARQUE'] = new CWD_Marque($arResult['ID'], $arParams);
		$APPLICATION->AddHeadScript('/bitrix/js/webdebug.marque/webdebug.marque.js');
		$this->IncludeComponentTemplate();
	}
}
?>