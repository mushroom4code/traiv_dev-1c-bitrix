<?php
include_once(dirname(__FILE__).'/install/demo.php');

if(!class_exists('CEsolImportXMLRunner'))
{
	class CEsolImportXMLRunner
	{
		protected static $moduleId = 'esol.importxml';
		
		static function GetModuleId()
		{
			return self::$moduleId;
		}
		
		private static function DemoExpired()
		{
			$DemoMode = CModule::IncludeModuleEx(self::$moduleId);
			$cnstPrefix = str_replace('.', '_', self::$moduleId);
			if ($DemoMode==MODULE_DEMO) {
				$now=time();
				if (defined($cnstPrefix."_OLDSITEEXPIREDATE")) {
					if ($now>=constant($cnstPrefix.'_OLDSITEEXPIREDATE') || constant($cnstPrefix.'_OLDSITEEXPIREDATE')>$now+1500000 || $now - filectime(__FILE__)>1500000) {
						return true;
					}
				} else{ 
					return true;
				}
			} elseif ($DemoMode==MODULE_DEMO_EXPIRED) {
				return true;
			}
			return false;
		}
		
		static function ImportIblock($filename, $params, $fparams, $stepparams, $pid = false)
		{
			if(self::DemoExpired()) return array();
			$ie = new \Bitrix\EsolImportxml\Importer($filename, $params, $fparams, $stepparams, $pid);
			return $ie->Import();
		}
		
		static function ImportHighloadblock($filename, $params, $fparams, $stepparams, $pid = false)
		{
			if(self::DemoExpired()) return array();
			$ie = new \Bitrix\EsolImportxml\ImporterHl($filename, $params, $fparams, $stepparams, $pid);
			return $ie->Import();
		}
	}
}

$moduleId = CEsolImportXMLRunner::GetModuleId();
$moduleJsId = str_replace('.', '_', $moduleId);
$pathJS = '/bitrix/js/'.$moduleId;
$pathCSS = '/bitrix/panel/'.$moduleId;
$pathLang = BX_ROOT.'/modules/'.$moduleId.'/lang/'.LANGUAGE_ID;
CModule::AddAutoloadClasses(
	$moduleId,
	array(
		'\Bitrix\EsolImportxml\Profile' => "lib/profile.php",
		'\Bitrix\EsolImportxml\ProfileTable' => "lib/profile_table.php",
		'\Bitrix\EsolImportxml\ProfileHlTable' => "lib/profile_hl_table.php",
		'\Bitrix\EsolImportxml\Utils' => "lib/utils.php",
		'\Bitrix\EsolImportxml\HttpClient' => "lib/httpclient.php",
		'\Bitrix\EsolImportxml\Json2Xml' => "lib/json2xml.php",
		'\Bitrix\EsolImportxml\ProfileElementTable' => "lib/profile_element.php",
		'\Bitrix\EsolImportxml\ProfileElementHlTable' => "lib/profile_element_hl.php",
		'\Bitrix\EsolImportxml\ProfileExecTable' => "lib/profile_exec.php",
		'\Bitrix\EsolImportxml\ProfileExecStatTable' => "lib/profile_exec_stat.php",
		'\Bitrix\EsolImportxml\ProfileChangesTable' => "lib/profile_changes.php",
		'\Bitrix\EsolImportxml\Sftp' => "lib/sftp.php",
		'\Bitrix\EsolImportxml\Conversion' => "lib/conversion.php",
		'\Bitrix\EsolImportxml\Cloud' => "lib/cloud.php",
		'\Bitrix\EsolImportxml\Cloud\MailRu' => "lib/cloud/mail_ru.php",
		'\Bitrix\EsolImportxml\ZipArchive' => "lib/zip_archive.php",
		'\Bitrix\EsolImportxml\XMLViewer' => "lib/xml_viewer.php",
		'\Bitrix\EsolImportxml\FieldList' => "lib/field_list.php",
		'\Bitrix\EsolImportxml\ImporterBase' => "lib/importer_base.php",
		'\Bitrix\EsolImportxml\ImporterData' => "lib/importer_data.php",
		'\Bitrix\EsolImportxml\Importer' => "lib/importer.php",
		'\Bitrix\EsolImportxml\ImporterRollback' => 'lib/importer_rollback.php',
		'\Bitrix\EsolImportxml\ImporterHl' => "lib/importer_hl.php",
		'\Bitrix\EsolImportxml\XMLReader' => "lib/xmlreader.php",
		'\Bitrix\EsolImportxml\Logger' => "lib/logger.php",
		'\Bitrix\EsolImportxml\Extrasettings' => "lib/extrasettings.php",
		'\Bitrix\EsolImportxml\CFileInput' => "lib/file_input.php",
		'\Bitrix\EsolImportxml\Imap' => "lib/mail/imap.php",
		'\Bitrix\EsolImportxml\SMail' => "lib/mail/mail.php",
		'\Bitrix\EsolImportxml\MailHeader' => "lib/mail/mail_header.php",
		'\Bitrix\EsolImportxml\MailMessage' => "lib/mail/mail_message.php",
		'\Bitrix\EsolImportxml\MailUtil' => "lib/mail/mail_util.php",
		'\Bitrix\EsolImportxml\DataManager\Discount' => "lib/datamanager/discount.php",
		'\Bitrix\EsolImportxml\DataManager\DiscountProductTable' => "lib/datamanager/discount_product_table.php",
		'\Bitrix\EsolImportxml\DataManager\Price' => "lib/datamanager/price.php",
		'\Bitrix\EsolImportxml\DataManager\PriceD7' => "lib/datamanager/price_d7.php",
		'\Bitrix\EsolImportxml\DataManager\Product' => "lib/datamanager/product.php",
		'\Bitrix\EsolImportxml\DataManager\ProductD7' => "lib/datamanager/product_d7.php",
		'\Bitrix\EsolImportxml\DataManager\IblockElementTable' => "lib/datamanager/iblockelement.php",
		'\Bitrix\EsolImportxml\DataManager\IblockElementIdTable' => "lib/datamanager/iblockelementid_table.php",
		'\Bitrix\EsolImportxml\DataManager\ElementPropertyTable' => "lib/datamanager/element_property_table.php",
		'\Bitrix\EsolImportxml\DataManager\InterhitedpropertyValues' => "lib/datamanager/inheritedproperty_values.php",
		'\Bitrix\EsolImportxml\ClassManager' => "lib/class_manager.php",
		'\Bitrix\EsolImportxml\Api' => "lib/api.php",
		'\IX\Giftsru' => "lib/vendors/gifts.ru.php",
		'\IX\B2bmerlioncom' => "lib/vendors/b2b.merlion.com.php",
		'\IX\B2bhogartru' => "lib/vendors/b2b.hogart.ru.php",
		'\IX\Apibraincomua' => "lib/vendors/api.brain.com.ua.php",
		'\IX\Apiercua' => "lib/vendors/api.erc.ua.php",
	)
);

$initFile = $_SERVER["DOCUMENT_ROOT"].BX_ROOT.'/php_interface/include/'.$moduleId.'/init.php';
if(file_exists($initFile)) include_once($initFile);

$jqueryExt = (CJSCore::IsExtRegistered('jquery3') ? 'jquery3' : 'jquery2');
$arJSEsolImportXmlConfig = array(
	$moduleJsId => array(
		'js' => $pathJS.'/script.js',
		'css' => $pathCSS.'/styles.css',
		'rel' => array($jqueryExt, $moduleJsId.'_chosen'),
		'lang' => $pathLang.'/js_admin.php',
	),
	$moduleJsId.'_highload' => array(
		'js' => $pathJS.'/script_highload.js',
		'css' => $pathCSS.'/styles.css',
		'rel' => array($jqueryExt, $moduleJsId.'_chosen'),
		'lang' => $pathLang.'/js_admin_hlbl.php',
	),
	$moduleJsId.'_chosen' => array(
		'js' => $pathJS.'/chosen/chosen.jquery.min.js',
		'css' => $pathJS.'/chosen/chosen.min.css',
		'rel' => array($jqueryExt)
	)
);

foreach ($arJSEsolImportXmlConfig as $ext => $arExt) {
	CJSCore::RegisterExt($ext, $arExt);
}
if(class_exists('\Bitrix\EsolImportxml\Utils')) \Bitrix\EsolImportxml\Utils::PrepareJs();
?>