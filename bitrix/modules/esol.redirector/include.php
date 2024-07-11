<?php
include_once(dirname(__FILE__).'/install/demo.php');

$moduleId = 'esol.redirector';
$moduleJsId = str_replace('.', '_', $moduleId);
$pathJS = '/bitrix/js/'.$moduleId;
$pathCSS = '/bitrix/panel/'.$moduleId;
$pathLang = BX_ROOT.'/modules/'.$moduleId.'/lang/'.LANGUAGE_ID;
CModule::AddAutoloadClasses(
	$moduleId,
	array(
		'\Bitrix\EsolRedirector\DbStructure' => "lib/db_structure.php",
		'\Bitrix\EsolRedirector\RedirectTable' => "lib/redirect_table.php",
		'\Bitrix\EsolRedirector\ErrorsTable' => "lib/errors_table.php",
		'\Bitrix\EsolRedirector\RedirectSiteTable' => "lib/redirect_site_table.php",
		'\Bitrix\EsolRedirector\Events' => "lib/events.php",
		'\Bitrix\EsolRedirector\IblockRedirectWriter' => "lib/iblock_redirect_writer.php",
		'\Bitrix\EsolRedirector\ZipArchive' => "lib/zip_archive.php",
		'\Bitrix\EsolRedirector\Importer' => "lib/importer.php",
	)
);
$dbStruct = new \Bitrix\EsolRedirector\DbStructure();
$dbStruct->CheckDB();

$jqueryExt = (CJSCore::IsExtRegistered('jquery3') ? 'jquery3' : 'jquery2');
$arJSEsolRedirectorConfig = array(
	$moduleJsId => array(
		'js' => $pathJS.'/script.js',
		'css' => $pathCSS.'/styles.css',
		'rel' => array($jqueryExt, $moduleJsId.'_chosen'),
		'lang' => $pathLang.'/js_admin.php',
	),
	$moduleJsId.'_chosen' => array(
		'js' => $pathJS.'/chosen/chosen.jquery.min.js',
		'css' => $pathJS.'/chosen/chosen.min.css',
		'rel' => array($jqueryExt)
	),
);

foreach ($arJSEsolRedirectorConfig as $ext => $arExt) {
	CJSCore::RegisterExt($ext, $arExt);
}
?>