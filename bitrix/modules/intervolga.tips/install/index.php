<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

IncludeModuleLangFile(__FILE__);

class intervolga_tips extends CModule
{
	var $MODULE_ID = "intervolga.tips"; // for marketplace

	public static function getModuleId()
	{
		return basename(dirname(__DIR__));
	}

	public function __construct()
	{
		$arModuleVersion = array();
		include(dirname(__FILE__) . "/version.php");
		$this->MODULE_ID = self::getModuleId();
		$this->MODULE_VERSION = $arModuleVersion["VERSION"];
		$this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
		$this->MODULE_NAME = GetMessage("INTERVOLGA_TIPS_MODULE_NAME");
		$this->MODULE_DESCRIPTION = GetMessage("INTERVOLGA_TIPS_MODULE_DESC");

		$this->PARTNER_NAME = GetMessage("INTERVOLGA_TIPS_PARTNER_NAME");
		$this->PARTNER_URI = GetMessage("INTERVOLGA_TIPS_PARTNER_URI");
	}

	public function DoInstall()
	{
		$this->InstallDB();
		$this->InstallFiles();
		$this->InstallEvents();
		RegisterModule(self::getModuleId());
	}

	public function DoUninstall()
	{
		UnRegisterModule(self::getModuleId());
		$this->UnInstallEvents();
		$this->UnInstallFiles();
		$this->UnInstallDB();
	}

	public function InstallDB()
	{
		if (is_dir($d = dirname(__FILE__) . "/db/"))
		{
			global $DB;
			$DB->RunSQLBatch($d . strtolower($DB->type) . "/install.sql");
		}

		return TRUE;
	}

	public function UnInstallDB($arParams = array())
	{
		if (is_dir($d = dirname(__FILE__) . "/db/"))
		{
			global $DB;
			$DB->RunSQLBatch($d . strtolower($DB->type) . "/uninstall.sql");
		}

		return TRUE;
	}

	public function InstallFiles($arParams = array())
	{
		// Create admin page include files
		if (is_dir($sAdminPath = $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/' . self::getModuleId() . '/admin'))
		{
			if ($dir = opendir($sAdminPath))
			{
				while (false !== $item = readdir($dir))
				{
					if ($item == '..' || $item == '.' || $item == 'menu.php')
					{
						continue;
					}
					$sFileContent = '<?require $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/' . self::getModuleId() . '/admin/' . $item . '";?>';
					file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/bitrix/admin/' . self::getModuleId() . '_' . $item, $sFileContent);
				}
				closedir($dir);
			}
		}

		// Create tool pages include files
		CheckDirPath($_SERVER["DOCUMENT_ROOT"] . "/bitrix/tools/" . self::getModuleId() . "/");
		if (is_dir($sToolPath = $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/' . self::getModuleId() . '/tools'))
		{
			if ($dir = opendir($sToolPath))
			{
				while (false !== $item = readdir($dir))
				{
					if ($item == '..' || $item == '.' || $item == 'menu.php')
					{
						continue;
					}
					$sFileContent = '<?require $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/' . self::getModuleId() . '/tools/' . $item . '";?>';
					file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/bitrix/tools/' . self::getModuleId() . '/' . $item, $sFileContent);
				}
				closedir($dir);
			}
		}

		CopyDirFiles(__DIR__."/js", $_SERVER["DOCUMENT_ROOT"] . "/bitrix/js/", TRUE, TRUE);

		CopyDirFiles(__DIR__."/components", $_SERVER["DOCUMENT_ROOT"] . "/bitrix/components/", TRUE, TRUE);

		return TRUE;
	}

	public function UnInstallFiles()
	{
		// Remove admin page include files
		if (is_dir($sAdminPath = $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/' . self::getModuleId() . '/admin'))
		{
			if ($dir = opendir($sAdminPath))
			{
				while (false !== $item = readdir($dir))
				{
					if ($item == '..' || $item == '.' || $item == 'menu.php')
					{
						continue;
					}
					unlink($_SERVER['DOCUMENT_ROOT'].'/bitrix/admin/' . self::getModuleId() . '_'.$item);
				}
				closedir($dir);
			}
		}
		// Remove tool pages
		DeleteDirFilesEx($_SERVER["DOCUMENT_ROOT"] . "/bitrix/tools/" . self::getModuleId() . "/");

		DeleteDirFiles(__DIR__."/js", $_SERVER["DOCUMENT_ROOT"] . "/bitrix/js");

		return TRUE;
	}

	public function InstallEvents()
	{
		/**
		 * @see \Intervolga\Tips\EventHandlers\Main::onEndBufferContent()
		 */
		RegisterModuleDependences("main", "OnEndBufferContent", self::getModuleId(), "\\Intervolga\\Tips\\EventHandlers\\Main", "onEndBufferContent");
	}

	public function UnInstallEvents()
	{
		/**
		 * @see \Intervolga\Tips\EventHandlers\Main::onEndBufferContent()
		 */
		UnRegisterModuleDependences("main", "OnEndBufferContent", self::getModuleId(), "\\Intervolga\\Tips\\EventHandlers\\Main", "onEndBufferContent");
	}
}