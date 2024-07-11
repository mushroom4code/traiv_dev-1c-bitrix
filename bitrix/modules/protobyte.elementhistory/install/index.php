<?php
use Bitrix\Main\Application;
use Bitrix\Main\ModuleManager;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Loader;
use Bitrix\Main\EventManager;
use Bitrix\Main\IO\Directory;

IncludeModuleLangFile(__FILE__);

class protobyte_elementhistory extends CModule
{
    var $MODULE_ID = 'protobyte.elementhistory';
    protected $installPath = '';

    public $requiredModules = [];

    function __construct()
    {
        $arModuleVersion = array();
        $this->installPath = __DIR__;
        include(__DIR__ . '/version.php');
        $this->requiredModules = include(__DIR__.'/require.php');
	    if ( is_array( $arModuleVersion ) && array_key_exists( 'VERSION', $arModuleVersion ) ) {
		    $this->MODULE_VERSION      = $arModuleVersion['VERSION'];
		    $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
		    $this->MODULE_NAME         = Loc::getMessage( 'PROTO_ELEMENT_HISTORY_MODULE_NAME' );
		    $this->MODULE_DESCRIPTION  = Loc::getMessage( 'PROTO_ELEMENT_HISTORY_MODULE_DESCRIPTION' );

		    $this->PARTNER_NAME = Loc::getMessage('PROTO_ELEMENT_HISTORY_PARTNER_NAME');
		    $this->PARTNER_URI = Loc::getMessage('PROTO_ELEMENT_HISTORY_PARTNER_URI');
	    }
    }

    public function DoInstall()
    {
        $this->checkDependencies();
        ModuleManager::registerModule($this->MODULE_ID);
        Loader::includeModule($this->MODULE_ID);

		$this->InstallDB();
		$this->InstallEvents();
        $this->installFiles();
    }

    public function DoUninstall()
    {
        global $USER, $DB, $APPLICATION, $step, $module_id;
        $step = (int)$step;
        $module_id = $this->MODULE_ID;

        if (!$USER->IsAdmin()) {
            return;
        }

	    $this->UnInstallEvents();

        if ($step < 2) {
            $APPLICATION->IncludeAdminFile(
                GetMessage('ESTATE_UNINSTALL_TITLE'),
                $this->installPath . '/uninstall/step1.php'
            );

            return;
        }

        Loader::includeModule($this->MODULE_ID);
        $this->UnInstallDB([
            "delete_tables" => $_REQUEST["delete_tables"],
        ]);

        $this->unInstallFiles();

        ModuleManager::unRegisterModule($this->MODULE_ID);
    }

	public function InstallDB() {
		global $DB;
		$this->errors = false;
		$this->errors = $DB->RunSQLBatch( __DIR__ ."/db/install.sql" );
		if ( ! $this->errors ) {

			return true;
		} else {
			return $this->errors;
		}
	}


    public function UnInstallDB($arParams = [])
    {
	    global $DB;

	    if ($arParams['delete_tables'] == 'Y') {
		    $this->errors = false;
		    $this->errors = $DB->RunSQLBatch( __DIR__ ."/db/unInstall.sql" );
		    if ( ! $this->errors ) {

			    return true;
		    } else {
			    return $this->errors;
		    }
        }
    }

	public function InstallEvents(){
		EventManager::getInstance()->registerEventHandler(
			"iblock",
			"OnBeforeIBlockElementUpdate",
			$this->MODULE_ID,
			"Protobyte\\ElementHistory\\Handlers",
			"OnBeforeIBlockElementUpdate"
		);
        EventManager::getInstance()->registerEventHandler(
            "iblock",
            "OnBeforeIBlockElementDelete",
            $this->MODULE_ID,
            "Protobyte\\ElementHistory\\Handlers",
            "OnBeforeIBlockElementDelete"
        );
		EventManager::getInstance()->registerEventHandler(
			"main",
			"OnAdminIBlockElementEdit",
			$this->MODULE_ID,
			"Protobyte\\ElementHistory\\TabIBlockElement",
			"onInit"
		);
	}

	public function UnInstallEvents(){
		EventManager::getInstance()->unRegisterEventHandler(
			"iblock",
			"OnBeforeIBlockElementUpdate",
			$this->MODULE_ID,
			"Protobyte\\ElementHistory\\Handlers",
			"OnBeforeIBlockElementUpdate"
		);
        EventManager::getInstance()->unRegisterEventHandler(
            "iblock",
            "OnBeforeIBlockElementDelete",
            $this->MODULE_ID,
            "Protobyte\\ElementHistory\\Handlers",
            "OnBeforeIBlockElementDelete"
        );
		EventManager::getInstance()->unRegisterEventHandler(
			"main",
			"OnAdminIBlockElementEdit",
			$this->MODULE_ID,
			"Protobyte\\ElementHistory\\TabIBlockElement",
			"onInit"
		);
	}

	public function installFiles() {
		if (is_dir($p = $_SERVER['DOCUMENT_ROOT'].getLocalPath('modules/'.$this->MODULE_ID.'/admin')))
		{
			if ($dir = opendir($p))
			{
				while (false !== $item = readdir($dir))
				{
					if ($item == '..' || $item == '.' || $item == 'menu.php')
						continue;
					file_put_contents($file = $_SERVER['DOCUMENT_ROOT'].'/bitrix/admin/'.$this->MODULE_ID.'_'.$item,
						'<? if(file_exists($_SERVER["DOCUMENT_ROOT"]."/local/modules/'.$this->MODULE_ID.'/admin/'.$item.'")){
	require($_SERVER["DOCUMENT_ROOT"]."/local/modules/'.$this->MODULE_ID.'/admin/'.$item.'");
} else require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/'.$this->MODULE_ID.'/admin/'.$item.'");?>');
				}
				closedir($dir);
			}
		}
		CopyDirFiles($_SERVER["DOCUMENT_ROOT"].getLocalPath("modules/".$this->MODULE_ID."/install/themes"), $_SERVER["DOCUMENT_ROOT"]."/bitrix/themes", true, true);
        CopyDirFiles(__DIR__.'/js', Application::getDocumentRoot().'/bitrix/js/'.$this->MODULE_ID.'/', true, true );
	}

	public function unInstallFiles() {
		if (is_dir($p = $_SERVER['DOCUMENT_ROOT'].getLocalPath('modules/'.$this->MODULE_ID.'/admin')))
		{
			if ($dir = opendir($p))
			{
				while (false !== $item = readdir($dir))
				{
					if ($item == '..' || $item == '.')
						continue;
					unlink($_SERVER['DOCUMENT_ROOT'].'/bitrix/admin/'.$this->MODULE_ID.'_'.$item);
				}
				closedir($dir);
			}
		}
		DeleteDirFiles($_SERVER["DOCUMENT_ROOT"].getLocalPath("modules/".$this->MODULE_ID."/install/themes/.default/"), $_SERVER["DOCUMENT_ROOT"]."/bitrix/themes/.default");
        Directory::deleteDirectory( Application::getDocumentRoot().'/bitrix/themes/.default/icons/'.$this->MODULE_ID );
        Directory::deleteDirectory( Application::getDocumentRoot().'/bitrix/js/'.$this->MODULE_ID );
	}

    protected function checkDependencies(){
        $result = [];
        foreach ($this->requiredModules as $module){
            if (!Loader::includeModule($module)){
                $result[] = $module;
            }
        }
        if (!empty($result)){
            $this->showError($this->installPath . '/install/modules_not_installed.php', ['modules'=>$result]);
        }
        return true;
    }

    protected function showError($file, $arVariables, $strTitle=''){
        //define all global vars
        $keys = array_keys($GLOBALS);
        $keys_count = count($keys);
        for($i=0; $i<$keys_count; $i++)
            if($keys[$i]!="i" && $keys[$i]!="GLOBALS" && $keys[$i]!="strTitle" && $keys[$i]!="filepath")
                global ${$keys[$i]};

        //title
        $APPLICATION->SetTitle($strTitle);
        include($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/include/prolog_admin_after.php");
        include($file);
        include($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/include/epilog_admin.php");
        die();
    }

    /**
     * @return \Bitrix\Main\DB\Connection
     */
    protected function _getConnection()
    {
        return Application::getConnection();
    }
}