<?php
namespace Bitrix\EsolImportxml;

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

class Profile {
	protected static $moduleId = 'esol.importxml';
	protected static $moduleFilePrefix = 'esol_import_xml';
	protected static $dbIsPrepared = false;
	protected static $instance = array();
	private $params = array();
	private $errors = array();
	private $entity = false;
	private $pid = null;
	private $importMode = null;
	private $isMassMode = false;
	private $arElementIds = array();
	private $logger = false;
	
	function __construct($suffix='')
	{
		static::PrepareDB();
		$this->suffix = $suffix;
		$this->pathProfiles = dirname(__FILE__).'/../../profiles'.(strlen($suffix) > 0 ? '_'.$suffix : '').'/';
		$this->CheckStorage();
		
		$upDir = $_SERVER["DOCUMENT_ROOT"].'/upload/';
		$upTmpDir = $upDir.'tmp/';
		$this->tmpdir = $upTmpDir.static::$moduleId.'/';
		$this->tmpcachedir = $this->tmpdir.'cache/';
		$this->uploadDir = $upDir.static::$moduleId.'/';
		
		foreach(array($upDir, $this->uploadDir, $upTmpDir, $this->tmpdir, $this->tmpcachedir) as $k=>$v)
		{
			CheckDirPath($v);
			$i = 0;
			while(++$i < 10 && strlen($v) > 0 && !file_exists($v) && dirname($v)!=$v)
			{
				$v = dirname($v);
			}
			if(strlen($v) > 0 && file_exists($v) && !is_writable($v))
			{
				$this->errors[] = sprintf(Loc::getMessage('ESOL_IX_DIR_NOT_WRITABLE'), $v);
			}
		}
		
		$this->tmpdir = realpath($this->tmpdir).'/';
		$this->uploadDir = realpath($this->uploadDir).'/';
		
		/*if(!is_writable($this->tmpdir)) $this->errors[] = sprintf(Loc::getMessage('ESOL_IX_DIR_NOT_WRITABLE'), $this->tmpdir);
		if(!is_writable($this->uploadDir)) $this->errors[] = sprintf(Loc::getMessage('ESOL_IX_DIR_NOT_WRITABLE'), $this->uploadDir);*/
	}
	
	public static function getInstance($suffix='iblock')
	{
		if (!isset(static::$instance[$suffix]))
			static::$instance[$suffix] = new static($suffix=='iblock' ? '' : $suffix);

		return static::$instance[$suffix];
	}
	
	public static function PrepareDB()
	{
		if(!static::$dbIsPrepared)
		{
			$profileDB = new \Bitrix\EsolImportxml\ProfileTable();
			$conn = $profileDB->getEntity()->getConnection();
			if(is_callable(array($conn, 'queryExecute')))
			{
				$conn->queryExecute('SET wait_timeout=1800');
				$conn->queryExecute('SET sql_mode=""');
			}
			if(is_callable('\Bitrix\Main\Application', 'getInstance') && is_callable('\Bitrix\Main\Application', 'getExceptionHandler'))
			{
				$app = \Bitrix\Main\Application::getInstance();
				$app->getExceptionHandler()->setDebugMode(true);
			}
			if(isset($GLOBALS['DB']) && is_object($GLOBALS['DB']))
			{
				$GLOBALS['DB']->debug = true;
			}
			static::$dbIsPrepared = true;
		}
	}
	
	public function CheckStorage()
	{
		$optionName = 'DB_STRUCT_VERSION_'.(strlen($this->suffix) > 0 ? ToUpper($this->suffix) : 'IBLOCK');
		$moduleVersion = false;
		if(is_callable(array('\Bitrix\Main\ModuleManager', 'getVersion')))
		{
			$moduleVersion = \Bitrix\Main\ModuleManager::getVersion(static::$moduleId);
			if($moduleVersion==\Bitrix\Main\Config\Option::get(static::$moduleId, $optionName)) return;
		}
		
		/*Security filter*/
		if(Loader::includeModule('security') && class_exists('\CSecurityFilterMask'))
		{
			$mask = '/bitrix/admin/'.static::$moduleFilePrefix.'*';
			$findMask = false;
			$arMasks = array();
			$dbRes = \CSecurityFilterMask::GetList();
			while($arr = $dbRes->Fetch())
			{
				$arr['MASK'] = $arr['FILTER_MASK'];
				unset($arr['FILTER_MASK']);
				if($arr['MASK']==$mask) $findMask = true;
				if(strlen($arr['SITE_ID'])==0) $arr['SITE_ID'] = 'NOT_REF';
				$arMasks[] = $arr;
			}
			if(!$findMask)
			{
				$arMasks['n0'] = array('MASK'=>$mask, 'SITE_ID'=>'NOT_REF');
				\CSecurityFilterMask::Update($arMasks);
			}
		}
		/*Security filter*/
		
		$profileEntity = $this->GetEntity();
		$tblName = $profileEntity->getTableName();
		$conn = $profileEntity->getEntity()->getConnection();
		if(!$conn->isTableExists($tblName))
		{
			$profileEntity->getEntity()->createDbTable();
			$conn->query('ALTER TABLE `'.$tblName.'` CHANGE COLUMN `PARAMS` `PARAMS` mediumtext DEFAULT NULL');
			$conn->query('ALTER TABLE `'.$tblName.'` CHANGE COLUMN `DATE_START` `DATE_START` datetime DEFAULT NULL');
			$conn->query('ALTER TABLE `'.$tblName.'` CHANGE COLUMN `DATE_FINISH` `DATE_FINISH` datetime DEFAULT NULL');
			$conn->query('ALTER TABLE `'.$tblName.'` CHANGE COLUMN `SORT` `SORT` int(11) NOT NULL DEFAULT "500"');
			$conn->query('ALTER TABLE `'.$tblName.'` CHANGE COLUMN `FILE_HASH` `FILE_HASH` varchar(255) DEFAULT NULL');
			
			$this->CheckTableEncoding($conn, $tblName);
		}
		else
		{
			$isNewFields = false;
			$arDbFields = array();
			$dbRes = $conn->query("SHOW COLUMNS FROM `" . $tblName . "`");
			while($arr = $dbRes->Fetch())
			{
				$arDbFields[] = $arr['Field'];
			}
			$fields = $profileEntity->getEntity()->getScalarFields();
			$helper = $conn->getSqlHelper();
			$prevField = 'ID';
			foreach($fields as $columnName => $field)
			{
				$realColumnName = $field->getColumnName();
				if(!in_array($realColumnName, $arDbFields))
				{
					$conn->query('ALTER TABLE '.$helper->quote($tblName).' ADD COLUMN '.$helper->quote($realColumnName).' '.$helper->getColumnTypeByField($field).' DEFAULT NULL AFTER '.$helper->quote($prevField));
					if($field->getDefaultValue())
					{
						$conn->query('UPDATE '.$helper->quote($tblName).' SET '.$helper->quote($realColumnName).'="'.$helper->forSql($field->getDefaultValue()).'"');
					}
					$isNewFields = true;
				}
				$prevField = $realColumnName;
			}
			if($isNewFields) $this->CheckTableEncoding($conn, $tblName);
		}
		
		/*profile_element*/
		$peEntity = $this->GetImportEntity();
		$tblName = $peEntity->getTableName();
		$conn = $peEntity->getEntity()->getConnection();
		if(!$conn->isTableExists($tblName))
		{
			$peEntity->getEntity()->createDbTable();
			//$conn->query('ALTER TABLE `'.$tblName.'` CHANGE COLUMN `ID` `ID` int(18) NOT NULL AUTO_INCREMENT');
			$conn->query('ALTER TABLE `'.$tblName.'` CHANGE COLUMN `TYPE` `TYPE` varchar(1) NOT NULL');
			//$conn->createIndex($tblName, 'ix_profile_element', array('PROFILE_ID', 'ELEMENT_ID', 'TYPE'));
			$this->CheckTableEncoding($conn, $tblName);
		}
		else
		{
			$dbRes = $conn->query("SHOW COLUMNS FROM `" . $tblName . "`");
			while($arr = $dbRes->Fetch())
			{
				$arDbFieldTypes[$arr['Field']] = $arr['Type'];
			}
			if(array_key_exists('ID', $arDbFieldTypes))
			{
				$conn->query('ALTER TABLE `'.$tblName.'` DROP COLUMN `ID`');
			}
		}
		/*/profile_element*/
		
		/*profile_exec*/
		$tEntity = new \Bitrix\EsolImportxml\ProfileExecTable();
		$tblName = $tEntity->getTableName();
		$conn = $tEntity->getEntity()->getConnection();
		if(!$conn->isTableExists($tblName))
		{
			$tEntity->getEntity()->createDbTable();
			$conn->query('ALTER TABLE `'.$tblName.'` CHANGE COLUMN `ID` `ID` int(18) NOT NULL AUTO_INCREMENT');
			$conn->query('ALTER TABLE `'.$tblName.'` CHANGE COLUMN `DATE_START` `DATE_START` datetime DEFAULT NULL');
			$conn->query('ALTER TABLE `'.$tblName.'` CHANGE COLUMN `DATE_FINISH` `DATE_FINISH` datetime DEFAULT NULL');
			$conn->query('ALTER TABLE `'.$tblName.'` CHANGE COLUMN `RUNNED_BY` `RUNNED_BY` int(18) DEFAULT NULL');
			$conn->query('ALTER TABLE `'.$tblName.'` CHANGE COLUMN `PARAMS` `PARAMS` longtext DEFAULT NULL');
			$conn->createIndex($tblName, 'ix_profile_id', array('PROFILE_ID'));
			$this->CheckTableEncoding($conn, $tblName);
		}
		else
		{
			$isNewFields = false;
			$arDbFields = array();
			$dbRes = $conn->query("SHOW COLUMNS FROM `" . $tblName . "`");
			while($arr = $dbRes->Fetch())
			{
				$arDbFields[] = $arr['Field'];
			}
			$fields = $tEntity->getEntity()->getScalarFields();
			$helper = $conn->getSqlHelper();
			$prevField = 'ID';
			foreach($fields as $columnName => $field)
			{
				$realColumnName = $field->getColumnName();
				if(!in_array($realColumnName, $arDbFields))
				{
					$conn->query('ALTER TABLE '.$helper->quote($tblName).' ADD COLUMN '.$helper->quote($realColumnName).' '.$helper->getColumnTypeByField($field).' DEFAULT NULL AFTER '.$helper->quote($prevField));
					if($field->getDefaultValue())
					{
						$conn->query('ALTER TABLE '.$helper->quote($tblName).' CHANGE COLUMN '.$helper->quote($realColumnName).' '.$helper->quote($realColumnName).' '.$helper->getColumnTypeByField($field).' DEFAULT "'.$helper->forSql($field->getDefaultValue()).'"');
						$conn->query('UPDATE '.$helper->quote($tblName).' SET '.$helper->quote($realColumnName).'="'.$helper->forSql($field->getDefaultValue()).'"');
					}
					$isNewFields = true;
				}
				$prevField = $realColumnName;
			}
			if($isNewFields)
			{
				$conn->query('ALTER TABLE `'.$tblName.'` CHANGE COLUMN `PARAMS` `PARAMS` longtext DEFAULT NULL');
				$this->CheckTableEncoding($conn, $tblName);
			}
		}
		/*/profile_exec*/
		
		/*profile_exec_stat*/
		$tEntity = new \Bitrix\EsolImportxml\ProfileExecStatTable();
		$tblName = $tEntity->getTableName();
		$conn = $tEntity->getEntity()->getConnection();
		if(!$conn->isTableExists($tblName))
		{
			$tEntity->getEntity()->createDbTable();
			$conn->query('ALTER TABLE `'.$tblName.'` CHANGE COLUMN `ID` `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT');
			$conn->query('ALTER TABLE `'.$tblName.'` CHANGE COLUMN `DATE_EXEC` `DATE_EXEC` datetime DEFAULT NULL');
			$conn->query('ALTER TABLE `'.$tblName.'` CHANGE COLUMN `FIELDS` `FIELDS` longtext DEFAULT NULL');
			$conn->createIndex($tblName, 'ix_entity_id', array('ENTITY_ID'));
			$conn->createIndex($tblName, 'ix_profile_id_profile_exec_id', array('PROFILE_ID', 'PROFILE_EXEC_ID'));
			$this->CheckTableEncoding($conn, $tblName);
		}
		else
		{
			$isNewFields = false;
			$arDbFields = array();
			$dbRes = $conn->query("SHOW COLUMNS FROM `" . $tblName . "`");
			while($arr = $dbRes->Fetch())
			{
				if($arr['Field']=='ID' && $arr['Type'] && mb_stripos($arr['Type'], 'bigint')===false)
				{
					$conn->query('ALTER TABLE `'.$tblName.'` CHANGE COLUMN `ID` `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT');
				}
				$arDbFields[] = $arr['Field'];
			}
			$fields = $tEntity->getEntity()->getScalarFields();
			$helper = $conn->getSqlHelper();
			$prevField = 'ID';
			foreach($fields as $columnName => $field)
			{
				$realColumnName = $field->getColumnName();
				if(!in_array($realColumnName, $arDbFields))
				{
					$conn->query('ALTER TABLE '.$helper->quote($tblName).' ADD COLUMN '.$helper->quote($realColumnName).' '.$helper->getColumnTypeByField($field).' DEFAULT NULL AFTER '.$helper->quote($prevField));
					if($field->getDefaultValue())
					{
						$conn->query('ALTER TABLE '.$helper->quote($tblName).' CHANGE COLUMN '.$helper->quote($realColumnName).' '.$helper->quote($realColumnName).' '.$helper->getColumnTypeByField($field).' DEFAULT "'.$helper->forSql($field->getDefaultValue()).'"');
						$conn->query('UPDATE '.$helper->quote($tblName).' SET '.$helper->quote($realColumnName).'="'.$helper->forSql($field->getDefaultValue()).'"');
					}
					$isNewFields = true;
				}
				$prevField = $realColumnName;
			}
			if($isNewFields)
			{
				$this->CheckTableEncoding($conn, $tblName);
			}
		}
		/*/profile_exec_stat*/
		
		/*profile_changes*/
		$tEntity = new \Bitrix\EsolImportxml\ProfileChangesTable();
		$tblName = $tEntity->getTableName();
		$conn = $tEntity->getEntity()->getConnection();
		if(!$conn->isTableExists($tblName))
		{
			$tEntity->getEntity()->createDbTable();
			$conn->query('ALTER TABLE `'.$tblName.'` CHANGE COLUMN `ID` `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT');
			$conn->query('ALTER TABLE `'.$tblName.'` CHANGE COLUMN `DATE` `DATE` datetime DEFAULT NULL');
			$conn->query('ALTER TABLE `'.$tblName.'` CHANGE COLUMN `PARAMS` `PARAMS` mediumtext DEFAULT NULL');
			$conn->createIndex($tblName, 'ix_profile_id_profile_type', array('PROFILE_ID', 'PROFILE_TYPE'));
			$this->CheckTableEncoding($conn, $tblName);
		}
		/*/profile_changes*/
		
		/*Indexes*/
		if(!$this->suffix && class_exists('\Bitrix\Iblock\ElementTable'))
		{
			$entity =  new \Bitrix\Iblock\ElementTable();
			$tblName = $entity->getTableName();
			$conn = $entity->getEntity()->getConnection();
			if(is_callable(array($conn, 'isIndexExists')) && !$conn->isIndexExists($tblName, array('IBLOCK_ID', 'NAME')))
			{
				if(\Bitrix\Iblock\ElementTable::getCount(array()) < 100000)
				{
					$conn->createIndex($tblName, 'ix_iblock_element_name', array('IBLOCK_ID', 'NAME'));
				}
				/*else
				{
					\CAdminNotify::add(array(
						"MESSAGE" => Loc::getMessage("ESOL_IX_CREATE_ELEMENT_NAME_INDEX", array(
							"#LINK#" => "/bitrix/admin/sql.php?lang=".\Bitrix\Main\Application::getInstance()->getContext()->getLanguage(),
							"#SQL#" => "CREATE INDEX `ix_iblock_element_name` ON `b_iblock_element` (`IBLOCK_ID`,`NAME`)"
						)),
						"TAG" => "iblock_element_name_index",
						"MODULE_ID" => static::$moduleId,
						"ENABLE_CLOSE" => "Y",
						"PUBLIC_SECTION" => "N",
					));
				}*/
			}
		}
		/*/Indexes*/
		
		/*Old iblock files*/
		$arFiles = array(
			array(
				'OLD' => '/bitrix/modules/iblock/lib/element.php',
				'NEW' => '/bitrix/modules/iblock/lib/elementtable.php',
			),
			array(
				'OLD' => '/bitrix/modules/iblock/lib/section.php',
				'NEW' => '/bitrix/modules/iblock/lib/sectiontable.php',
			)
		);

		foreach($arFiles as $arFileGroup)
		{
			$fn1 = $_SERVER['DOCUMENT_ROOT'].$arFileGroup['OLD'];
			$fn2 = $_SERVER['DOCUMENT_ROOT'].$arFileGroup['NEW'];
			if(file_exists($fn1) && is_file($fn1) && file_exists($fn2) && is_file($fn2))
			{
				$arLines = array(
					'namespace Bitrix\Iblock;',
					'class '.str_replace('.php', '', end(explode('/', $arFileGroup['OLD']))).'Table extends'
				);
				$find = true;
				foreach(array($fn1, $fn2) as $fn)
				{
					$c = file_get_contents($fn);
					foreach($arLines as $line)
					{
						if(!preg_match("/[\r\n]".preg_quote($line, '/')."/i", $c)) $find = false;
					}
				}
				if($find) rename($fn1, str_replace('.php', '_.php', $fn1));
			}
		}
		/*/Old iblock files*/
		
		if($moduleVersion)
		{
			\Bitrix\Main\Config\Option::set(static::$moduleId, $optionName, $moduleVersion);
		}
	}
	
	private function CheckTableEncoding($conn, $tblName)
	{
		$res = $conn->query('SHOW VARIABLES LIKE "character_set_connection"');
		$f = $res->fetch();
		$charset = trim($f['Value']);

		$res = $conn->query('SHOW VARIABLES LIKE "collation_connection"');
		$f = $res->fetch();
		$collation = trim($f['Value']);
		$charset2 = $this->GetCharsetByCollation($conn, $collation);
		
		$res0 = $conn->query('SHOW CREATE TABLE `' . $tblName . '`');
		$f0 = $res0->fetch();
		
		if (preg_match('/DEFAULT CHARSET=([a-z0-9\-_]+)/i', $f0['Create Table'], $regs))
		{
			$t_charset = $regs[1];
			if (preg_match('/COLLATE=([a-z0-9\-_]+)/i', $f0['Create Table'], $regs))
				$t_collation = $regs[1];
			else
			{
				$res0 = $conn->query('SHOW CHARSET LIKE "' . $t_charset . '"');
				$f0 = $res0->fetch();
				$t_collation = $f0['Default collation'];
			}
		}
		else
		{
			$res0 = $conn->query('SHOW TABLE STATUS LIKE "' . $tblName . '"');
			$f0 = $res0->fetch();
			if (!$t_collation = $f0['Collation'])
				return;
			$t_charset = $this->GetCharsetByCollation($conn, $t_collation);
		}
		
		if ($charset != $t_charset)
		{
			$conn->query('ALTER TABLE `' . $tblName . '` CHARACTER SET ' . $charset);
		}
		if ($t_collation != $collation)
		{	// table collation differs
			$conn->query('ALTER TABLE `' . $tblName . '` COLLATE ' . $collation);
		}
		
		$arFix = array();
		$res0 = $conn->query("SHOW FULL COLUMNS FROM `" . $tblName . "`");
		while($f0 = $res0->fetch())
		{
			$f_collation = $f0['Collation'];
			if ($f_collation === NULL || $f_collation === "NULL")
				continue;

			$f_charset = $this->GetCharsetByCollation($conn, $f_collation);
			if ($charset != $f_charset && $charset2 != $f_charset)
			{
				$arFix[] = ' MODIFY `'.$f0['Field'].'` '.$f0['Type'].' CHARACTER SET '.$charset.($collation != $f_collation ? ' COLLATE '.$collation : '').($f0['Null'] == 'YES' ? ' NULL' : ' NOT NULL').
						($f0['Default'] === NULL ? ($f0['Null'] == 'YES' ? ' DEFAULT NULL ' : '') : ' DEFAULT '.($f0['Type'] == 'timestamp' && $f0['Default'] == 'CURRENT_TIMESTAMP' ? $f0['Default'] : '"'.$conn->getSqlHelper()->forSql($f0['Default']).'"')).' '.$f0['Extra'];
			}
			elseif ($collation != $f_collation)
			{
				$arFix[] = ' MODIFY `'.$f0['Field'].'` '.$f0['Type'].' COLLATE '.$collation.($f0['Null'] == 'YES' ? ' NULL' : ' NOT NULL').
						($f0['Default'] === NULL ? ($f0['Null'] == 'YES' ? ' DEFAULT NULL ' : '') : ' DEFAULT '.($f0['Type'] == 'timestamp' && $f0['Default'] == 'CURRENT_TIMESTAMP' ? $f0['Default'] : '"'.$conn->getSqlHelper()->forSql($f0['Default']).'"')).' '.$f0['Extra'];
			}
		}

		if(count($arFix))
		{
			$conn->query('ALTER TABLE `'.$tblName.'` '.implode(",\n", $arFix));
		}
	}
	
	private function GetCharsetByCollation($conn, $collation)
	{
		static $CACHE;
		if (!$c = &$CACHE[$collation])
		{
			$res0 = $conn->query('SHOW COLLATION LIKE "' . $collation . '"');
			$f0 = $res0->Fetch();
			$c = $f0['Charset'];
		}
		return $c;
	}
	
	private function GetEntity()
	{
		if(!$this->entity)
		{
			if($this->suffix=='highload')
			{
				$this->entity = new \Bitrix\EsolImportxml\ProfileHlTable();
			}
			else
			{
				$this->entity = new \Bitrix\EsolImportxml\ProfileTable();
			}
		}
		return $this->entity;
	}
	
	private function GetImportEntity()
	{
		if(!$this->importEntity)
		{
			if($this->suffix=='highload')
			{
				$this->importEntity = new \Bitrix\EsolImportxml\ProfileElementHlTable();
			}
			else
			{
				$this->importEntity = new \Bitrix\EsolImportxml\ProfileElementTable();
			}
		}
		return $this->importEntity;
	}
	
	public function GetList($arFilter=array())
	{
		if(!is_array($arFilter)) $arFilter = array();
		if(empty($arFilter)) $arFilter = array('ACTIVE'=>'Y');
		$arProfiles = array();
		$profileEntity = $this->GetEntity();
		$dbRes = $profileEntity::getList(array('select'=>array('ID', 'NAME'), 'order'=>array('SORT'=>'ASC', 'ID'=>'ASC'), 'filter'=>$arFilter));
		while($arr = $dbRes->Fetch())
		{
			$arProfiles[$arr['ID'] - 1] = $arr['NAME'];
		}
		
		return $arProfiles;
	}
	
	public function GetByID($ID)
	{
		$profileEntity = $this->GetEntity();
		$arProfile = $profileEntity::getList(array('filter'=>array('ID'=>($ID + 1)), 'select'=>array('PARAMS')))->fetch();
		if($arProfile && $arProfile['PARAMS'])
		{
			$arProfile = self::DecodeProfileParams($arProfile['PARAMS']);
		}
		if(!is_array($arProfile)) $arProfile = array();
		
		return $arProfile;
	}
	
	public function GetFieldsByID($ID)
	{
		if(!is_numeric($ID)) return array();
		$profileEntity = $this->GetEntity();
		$arProfile = $profileEntity::getList(array('filter'=>array('ID'=>($ID + 1))))->fetch();
		unset($arProfile['PARAMS']);
		
		return $arProfile;
	}
	
	public function Add($name, $fid = false)
	{
		global $APPLICATION;
		$APPLICATION->ResetException();
		
		$name = trim($name);
		if(strlen($name)==0)
		{
			$APPLICATION->throwException(Loc::getMessage("ESOL_IX_NOT_SET_PROFILE_NAME"));
			return false;
		}
		
		$profileEntity = $this->GetEntity();
		
		if($arProfile = $profileEntity::getList(array('filter'=>array('NAME'=>$name), 'select'=>array('ID')))->fetch())
		{
			$APPLICATION->throwException(Loc::getMessage("ESOL_IX_PROFILE_NAME_EXISTS"));
			return false;
		}
		
		$dbRes = $profileEntity::add(array('NAME'=>$name));
		if(!$dbRes->isSuccess())
		{
			$error = '';
			if($dbRes->getErrors())
			{
				foreach($dbRes->getErrors() as $errorObj)
				{
					$error .= $errorObj->getMessage().'. ';
				}
				$APPLICATION->throwException($error);
			}
			return false;
		}
		else
		{
			$ID = $dbRes->getId() - 1;
			if($fid!==false)
			{
				\CFile::UpdateExternalId($fid, 'esol_importxml_'.($this->suffix=='highload' ? 'hl' : '').$ID);
			}
			return $ID;
		}
	}
	
	public static function GetIgnoreChangesParams()
	{
		return array(
			'SETTINGS_DEFAULT' => array(
				'DATA_FILE',
				'URL_DATA_FILE',
				'EMAIL_DATA_FILE',
				'LAST_MODIFIED_FILE',
				'OLD_DATA_FILE',
				'OLD_FILE_SIZE',
				'MAX_EXECUTION_TIME',
				'LAST_COOKIES',
				'LAST_UAGENT',
				'FILE_HASH'
			)
		);
	}
	
	public function IsChangesSetting(&$isChanges, $s1, $s2)
	{
		if($isChanges) return;
		if(!is_array($s1)) $s1 = array();
		if(!is_array($s2)) $s2 = array();
		$arIgnoreParams = self::GetIgnoreChangesParams();
		$arIgnoreKeys = array();
		foreach($arIgnoreParams as $k=>$v)
		{
			foreach($v as $v2)
			{
				$arIgnoreKeys[$v2] = '';
			}
		}
		$s1 = $this->KSortParams(array_diff_key($s1, $arIgnoreKeys));
		$s2 = $this->KSortParams(array_diff_key($s2, $arIgnoreKeys));
		if(serialize($s1)!=serialize($s2)) $isChanges = true;
	}
	
	public function KSortParams($a)
	{
		ksort($a);
		foreach($a as $k=>$v)
		{
			if(is_array($v)) $a[$k] = $this->KSortParams($v);
		}
		return $a;
	}
	
	public function GetChangesClass()
	{
		return '\Bitrix\EsolImportxml\ProfileChangesTable';
	}
	
	public function GetChangesProfileType()
	{
		$changesClass = $this->GetChangesClass();
		$profileType = $changesClass::TYPE_IMPORT_IBLOCK;
		if($this->suffix=='highload') $profileType = $changesClass::TYPE_IMPORT_HLBLOCK;
		return $profileType;
	}
	
	public function SaveChangesSettings($PROFILE_ID, $arParams)
	{
		$changesClass = $this->GetChangesClass();
		$profileType = $this->GetChangesProfileType();
		
		$arIgnoreParams = self::GetIgnoreChangesParams();
		foreach($arIgnoreParams as $k=>$v)
		{
			foreach($v as $v2)
			{
				if(isset($arParams[$k]) && array_key_exists($v2, $arParams[$k])) unset($arParams[$k][$v2]);
			}
		}
		$params = self::EncodeProfileParams($arParams);
		
		$dbRes = $changesClass::getList(array('filter'=>array('=PROFILE_ID'=>$PROFILE_ID, '=PROFILE_TYPE'=>$profileType), 'order'=>array('ID'=>'DESC'), 'select'=>array('ID', 'PARAMS')));
		while($arr = $dbRes->Fetch())
		{
			if($params==$arr['PARAMS']) $changesClass::delete($arr['ID']);
		}
		
		$changesClass::add(array(
			'PROFILE_ID' => $PROFILE_ID,
			'PROFILE_TYPE' => $profileType,
			'USER_ID' => ($GLOBALS['USER']->GetID() ? $GLOBALS['USER']->GetID() : 0),
			'DATE' => new \Bitrix\Main\Type\DateTime(),
			'PARAMS' => $params
		));
		$limit = 10;
		$dbRes = $changesClass::getList(array('filter'=>array('=PROFILE_ID'=>$PROFILE_ID, '=PROFILE_TYPE'=>$profileType), 'order'=>array('ID'=>'DESC'), 'select'=>array('ID'), 'limit'=>$limit, 'offset'=>$limit));
		while($arr = $dbRes->Fetch())
		{
			$changesClass::delete($arr['ID']);
		}
	}
	
	public function GetChangesList($PROFILE_ID)
	{
		$changesClass = $this->GetChangesClass();
		$profileType = $this->GetChangesProfileType();
		$arData = array();
		$dbRes = $changesClass::getList(array('filter'=>array('=PROFILE_ID'=>$PROFILE_ID, '=PROFILE_TYPE'=>$profileType), 'order'=>array('ID'=>'DESC'), 'select'=>array('ID', 'DATE')));
		while($arr = $dbRes->Fetch())
		{
			if(is_object($arr['DATE'])) $arr['DATE'] = $arr['DATE']->toString();
			$arData[] = $arr;
		}
		return $arData;
	}
	
	public function RestoreFromChanges($PROFILE_ID, $POINT_ID)
	{
		$PROFILE_ID = (int)$PROFILE_ID;
		$POINT_ID = (int)$POINT_ID;
		if($POINT_ID<=0 || $PROFILE_ID<=0) return;
		$changesClass = $this->GetChangesClass();
		$profileType = $this->GetChangesProfileType();
		if($arPoint = $changesClass::getList(array('filter'=>array('=ID'=>(int)$POINT_ID)))->Fetch())
		{
			if($PROFILE_ID!=$arPoint['PROFILE_ID'] || $profileType!=$arPoint['PROFILE_TYPE']) return;
			$arCurParams = $this->GetByID($PROFILE_ID - 1);
			$this->SaveChangesSettings($PROFILE_ID, $arCurParams);
			$arParams = self::DecodeProfileParams($arPoint['PARAMS']);
			if(isset($arCurParams['SETTINGS_DEFAULT']['DATA_FILE']))
			{
				$arParams['SETTINGS_DEFAULT']['DATA_FILE'] = $arCurParams['SETTINGS_DEFAULT']['DATA_FILE'];
			}
			$profileEntity = $this->GetEntity();
			$profileEntity::update($PROFILE_ID, array('PARAMS'=>self::EncodeProfileParams($arParams)));
		}
	}
	
	public function Update($ID, $settigs_default, $settings, $extrasettings=null)
	{
		$arProfile = $arOldProfile = $this->GetByID($ID);
		$oldIblockId = $arProfile['SETTINGS_DEFAULT']['IBLOCK_ID'];
		$isChanges = false;
		if(is_array($settigs_default) && !empty($settigs_default) && ($settigs_default['IBLOCK_ID'] > 0 || $settigs_default['HIGHLOADBLOCK_ID'] > 0))
		{
			$this->IsChangesSetting($isChanges, $arProfile['SETTINGS_DEFAULT'], $settigs_default);
			$arProfile['SETTINGS_DEFAULT'] = $settigs_default;
		}
		if(is_array($settings) && !empty($settings))
		{
			$this->IsChangesSetting($isChanges, $arProfile['SETTINGS'], $settings);
			$arProfile['SETTINGS'] = $settings;
		}
		if(isset($extrasettings) && is_array($extrasettings))
		{
			$this->IsChangesSetting($isChanges, $arProfile['EXTRASETTINGS'], $extrasettings);
			$arProfile['EXTRASETTINGS'] = $extrasettings;
		}
		/*Change iblock settings*/
		if(($oldIblockId != $arProfile['SETTINGS_DEFAULT']['IBLOCK_ID'] || isset($arProfile['OLD_IBLOCK_DATA'])) && Loader::includeModule('iblock') && class_exists('\Bitrix\Iblock\PropertyTable'))
		{
			$iblockId = $arProfile['SETTINGS_DEFAULT']['IBLOCK_ID'];
			$arPropsNames = array();
			$arPropsCodes = array();
			$dbRes = \Bitrix\Iblock\PropertyTable::getList(array('filter' => array('=IBLOCK_ID'=>$iblockId, '=ACTIVE'=>'Y'), 'select' => array('ID', 'CODE', 'NAME')));
			while($arr = $dbRes->Fetch())
			{
				$arPropsNames[$arr['NAME']] = $arr['ID'];
				$arPropsCodes[$arr['CODE']] = $arr['ID'];
			}

			$arPropRels = array();
			if(isset($arProfile['OLD_IBLOCK_DATA']))
			{
				if(isset($arProfile['OLD_IBLOCK_DATA']['PROPS']) && isset($arProfile['OLD_IBLOCK_DATA']['PROPS'][$oldIblockId]) && is_array($arProfile['OLD_IBLOCK_DATA']['PROPS'][$oldIblockId]))
				{
					foreach($arProfile['OLD_IBLOCK_DATA']['PROPS'][$oldIblockId] as $k=>$v)
					{
						if(isset($arPropsCodes[$v['CODE']])) $arPropRels[$k] = $arPropsCodes[$v['CODE']];
						elseif(isset($arPropsNames[$v['NAME']])) $arPropRels[$k] = $arPropsNames[$v['NAME']];
					}
				}
				unset($arProfile['OLD_IBLOCK_DATA']);
			}
			else
			{
				$dbRes = \Bitrix\Iblock\PropertyTable::getList(array('filter' => array('=IBLOCK_ID'=>$oldIblockId, '=ACTIVE'=>'Y'), 'select' => array('ID', 'CODE', 'NAME')));
				while($arr = $dbRes->Fetch())
				{
					if(isset($arPropsCodes[$arr['CODE']])) $arPropRels[$arr['ID']] = $arPropsCodes[$arr['CODE']];
					elseif(isset($arPropsNames[$arr['NAME']])) $arPropRels[$arr['ID']] = $arPropsNames[$arr['NAME']];
				}
			}
			
			if(count($arPropRels) > 0)
			{
				if(isset($arProfile['SETTINGS']['FIELDS']) && is_array($arProfile['SETTINGS']['FIELDS']))
				{
					foreach($arProfile['SETTINGS']['FIELDS'] as $k=>$v)
					{
						if(preg_match('/IP_PROP(\d+)/', $v, $m) && isset($arPropRels[$m[1]]))
						{
							$arProfile['SETTINGS']['FIELDS'][$k] = str_replace($m[0], 'IP_PROP'.$arPropRels[$m[1]], $v);
						}
					}
				}
				
				if(isset($arProfile['SETTINGS']['PROPERTY_MAP']) && strlen($arProfile['SETTINGS']['PROPERTY_MAP']) > 0)
				{
					$arMap = unserialize(base64_decode($arProfile['SETTINGS']['PROPERTY_MAP']));
					if(is_array($arMap) && isset($arMap['MAP']) && is_array($arMap['MAP']))
					{
						foreach($arMap['MAP'] as $k=>$v)
						{
							if(preg_match('/IP_PROP(\d+)/', $v['ID'], $m) && isset($arPropRels[$m[1]]))
							{
								$arMap['MAP'][$k]['ID'] = str_replace($m[0], 'IP_PROP'.$arPropRels[$m[1]], $v['ID']);
							}
						}
						$arProfile['SETTINGS']['PROPERTY_MAP'] = base64_encode(serialize($arMap));
					}
				}
			}
		}
		/*/Change iblock settings*/
		$profileEntity = $this->GetEntity();
		$profileEntity::update(($ID+1), array('PARAMS'=>self::EncodeProfileParams($arProfile)));
		if($isChanges) $this->SaveChangesSettings(($ID+1), $arOldProfile);
	}
	
	public function UpdateExtra($ID, $extrasettings)
	{
		$arProfile = $arOldProfile = $this->GetByID($ID);
		if(!is_array($extrasettings)) $extrasettings = array();
		$isChanges = false;
		$this->IsChangesSetting($isChanges, $arProfile['EXTRASETTINGS'], $extrasettings);
		$arProfile['EXTRASETTINGS'] = $extrasettings;
		$profileEntity = $this->GetEntity();
		$profileEntity::update(($ID+1), array('PARAMS'=>self::EncodeProfileParams($arProfile)));
		if($isChanges) $this->SaveChangesSettings(($ID+1), $arOldProfile);
	}
	
	public function UpdatePartSettings($ID, $settigs_default=array())
	{
		$arProfile = $this->GetByID($ID);
		$arProfile['SETTINGS_DEFAULT'] = array_merge($arProfile['SETTINGS_DEFAULT'], $settigs_default);
		$profileEntity = $this->GetEntity();
		$profileEntity::update(($ID+1), array('PARAMS'=>self::EncodeProfileParams($arProfile)));
	}
	
	public function Delete($ID)
	{
		$profileEntity = $this->GetEntity();
		$profileEntity::delete($ID+1);
		\Bitrix\EsolImportxml\Utils::DeleteFilesByExtId('esol_importxml_'.($this->suffix=='highload' ? 'hl' : '').$ID);
		\Bitrix\EsolImportxml\ProfileExecTable::deleteByProfile($ID+1);
		\Bitrix\EsolImportxml\ProfileExecStatTable::deleteByProfile($ID+1);
	}
	
	public function Copy($ID)
	{
		$profileEntity = $this->GetEntity();
		$arProfile = $profileEntity::getList(array('filter'=>array('ID'=>($ID + 1)), 'select'=>array('NAME', 'PARAMS')))->fetch();
		if(!$arProfile) return false;
		
		$newName = $arProfile['NAME'].Loc::getMessage("ESOL_IX_PROFILE_COPY");
		$arParams = self::DecodeProfileParams($arProfile['PARAMS']);
		if($arParams['SETTINGS_DEFAULT']['DATA_FILE'] > 0)
		{
			$arParams['SETTINGS_DEFAULT']['DATA_FILE'] = \Bitrix\EsolImportxml\Utils::CopyFile($arParams['SETTINGS_DEFAULT']['DATA_FILE'], true);
			$arProfile['PARAMS'] = self::EncodeProfileParams($arParams);
		}
		$dbRes = $profileEntity::add(array('NAME'=>$newName, 'PARAMS'=>$arProfile['PARAMS']));
		if(!$dbRes->isSuccess())
		{
			$error = '';
			if($dbRes->getErrors())
			{
				foreach($dbRes->getErrors() as $errorObj)
				{
					$error .= $errorObj->getMessage().'. ';
				}
				$APPLICATION->throwException($error);
			}
			return false;
		}
		else
		{
			$newId = $dbRes->getId() - 1;			
			return $newId;
		}
	}
	
	public function Rename($ID, $name)
	{
		global $APPLICATION;
		$APPLICATION->ResetException();
		
		$name = trim($name);
		if(strlen($name)==0)
		{
			$APPLICATION->throwException(Loc::getMessage("ESOL_IX_NOT_SET_PROFILE_NAME"));
			return false;
		}
		$profileEntity = $this->GetEntity();
		$profileEntity::update(($ID+1), array('NAME'=>$name));
	}
	
	public function ProfileExists($ID)
	{
		if(!is_numeric($ID)) return false;
		$profileEntity = $this->GetEntity();
		if($arProfile = $profileEntity::getList(array('filter'=>array('ID'=>($ID + 1)), 'select'=>array('ID')))->fetch()) return true;
		else return false;
	}
	
	public function GetProfilesCronPool()
	{
		$arIds = array();
		$profileEntity = $this->GetEntity();
		$dbRes = $profileEntity::getList(array('filter'=>array('NEED_RUN'=>'Y'), 'select'=>array('ID'), 'order'=>array('DATE_START'=>'ASC')));
		while($arr = $dbRes->Fetch())
		{
			$arIds[] = (int)$arr['ID'] - 1;
		}
		return $arIds;
	}
	
	public function GetLastImportProfiles($arParams = array())
	{
		$arProfiles = array();
		$limit = (int)$arParams["PROFILES_COUNT"];
		if($limit<=0) $limit = 10;
		$profileEntity = $this->GetEntity();
		$arFilter = array('!DATE_START'=>false);
		if($arParams["PROFILES_SHOW_INACTIVE"]!='Y') $arFilter['ACTIVE'] = 'Y';
		$dbRes = $profileEntity::getList(array('filter'=>$arFilter, 'select'=>array('ID', 'NAME', 'DATE_START', 'DATE_FINISH', 'PARAMS'), 'order'=>array('DATE_START'=>'DESC'), 'limit'=>$limit));
		while($arr = $dbRes->Fetch())
		{
			if(isset($arr['PARAMS']))
			{
				$arr['PARAMS'] = self::DecodeProfileParams($arr['PARAMS']);
				$arr['SETTINGS_DEFAULT'] = $arr['PARAMS']['SETTINGS_DEFAULT'];
				unset($arr['PARAMS']);
			}
			$arr['ID'] = (int)$arr['ID'] - 1;
			$arProfiles[] = $arr;
		}
		return $arProfiles;
	}
	
	public function UpdateFields($ID, $arFields)
	{
		if(!is_numeric($ID)) return false;
		$profileEntity = $this->GetEntity();
		$profileEntity::update(($ID+1), $arFields);
	}
	
	public function UpdateFileHash($ID, $file)
	{
		$hash = md5_file($file);
		$this->UpdateFields($ID, array('FILE_HASH'=>$hash));
	}
	
	public function ApplyToLists($ID, $listFrom, $listTo)
	{
		if(!is_numeric($listFrom) || !is_array($listTo) || count($listTo)==0) return;
		$listTo = preg_grep('/^\d+$/', $listTo);
		if(count($listTo)==0) return;
		
		$arParams = $this->GetByID($ID);
		foreach($listTo as $key)
		{
			$arParams['SETTINGS']['FIELDS_LIST'][$key] = $arParams['SETTINGS']['FIELDS_LIST'][$listFrom];
			$arParams['EXTRASETTINGS'][$key] = $arParams['EXTRASETTINGS'][$listFrom];
		}
		$profileEntity = $this->GetEntity();
		$profileEntity::update(($ID+1), array('PARAMS'=>self::EncodeProfileParams($arParams)));
	}
	
	public function GetGadgetStatus($id, $bImported=false)
	{
		$arProfile = array();
		if(is_array($id))
		{
			$arProfile = $id;
			$id = $arProfile['ID'];
		}
		$tmpfile = $this->tmpdir.$id.($this->suffix ? '_'.$this->suffix : '').'.txt';
		if(!file_exists($tmpfile))
		{
			if($bImported)
			{
				if(empty($arProfile) || !empty($arProfile['DATE_FINISH'])) return array('STATUS'=>'OK', 'MESSAGE'=>Loc::getMessage("ESOL_IX_STATUS_COMPLETE"));
				else return array('STATUS'=>'ERROR', 'MESSAGE'=>Loc::getMessage("ESOL_IX_STATUS_FILE_ERROR"));
			}
			else return array('STATUS'=>'OK', 'MESSAGE'=>'');
		}
		$arParams = $this->GetProfileParamsByFile($tmpfile);
		$percent = round(((int)$arParams['total_read_line'] / max((int)$arParams['total_file_line'], 1)) * 100);
		$percent = min($percent, 99);
		$status = 'OK';
		if((time() - filemtime($tmpfile) < 4*60)) $statusText = Loc::getMessage("ESOL_IX_STATUS_PROCCESS");
		else 
		{
			$statusText = Loc::getMessage("ESOL_IX_STATUS_BREAK");
			$status = 'ERROR';
		}
		return array('STATUS'=>'ERROR', 'MESSAGE'=>$statusText.' ('.$percent.'%)');
	}
	
	public function GetStatus($id)
	{
		$tmpfile = $this->tmpdir.$id.($this->suffix ? '_'.$this->suffix : '').'.txt';
		if(!file_exists($tmpfile) || filesize($tmpfile)>500*1024) return '';		
		$arParams = \CUtil::JsObjectToPhp(file_get_contents($tmpfile));
		$percent = round(((int)$arParams['total_read_line'] / max((int)$arParams['total_file_line'], 1)) * 100);
		$percent = min($percent, 99);
		if((time() - filemtime($tmpfile) < 4*60)) $status = Loc::getMessage("ESOL_IX_STATUS_PROCCESS");
		else $status = Loc::getMessage("ESOL_IX_STATUS_BREAK");
		return $status.' ('.$percent.'%)';
	}
	
	public function GetProfileParamsByFile($tmpfile)
	{
		$content = file_get_contents($tmpfile);
		$maxLength = 10*1024;
		if(strlen($content) > $maxLength)
		{
			$arParams = array();
			$content = preg_replace('/(.)\{[^\}]*\}(.)/Uis', '$1$2', $content);
			if(preg_match_all("/'([^']*)':'([^']*)'/", $content, $m))
			{
				foreach($m[1] as $k2=>$v2)
				{
					$arParams[$v2] = $m[2][$k2];
				}
			}
		}
		else
		{
			$arParams = \CUtil::JsObjectToPhp(file_get_contents($tmpfile));
		}
		return $arParams;
	}
	
	public function GetProcessedProfiles()
	{
		$arProfiles = $this->GetList();
		foreach($arProfiles as $k=>$v)
		{
			$tmpfile = $this->tmpdir.$k.($this->suffix ? '_'.$this->suffix : '').'.txt';
			if(!file_exists($tmpfile) || filesize($tmpfile)>500*1024 || (time() - filemtime($tmpfile) < 4*60) || filemtime($tmpfile) < mktime(0, 0, 0, 12, 24, 2015))
			{
				unset($arProfiles[$k]);
				continue;
			}
			
			$arParams = $this->GetProfileParamsByFile($tmpfile);
			$percent = round(((int)$arParams['total_read_line'] / max((int)$arParams['total_file_line'], 1)) * 100);
			$percent = min($percent, 99);
			$arProfiles[$k] = array(
				'key' => $k,
				'name' => $v,
				'percent' => $percent
			);
		}
		if(!is_array($arProfiles)) $arProfiles = array();
		return $arProfiles;
	}
	
	public function RemoveProcessedProfile($id)
	{
		$tmpfile = $this->tmpdir.$id.($this->suffix ? '_'.$this->suffix : '').'.txt';
		if(file_exists($tmpfile))
		{
			$arParams = $this->GetProfileParamsByFile($tmpfile);
			if($arParams['tmpdir'])
			{
				DeleteDirFilesEx(substr($arParams['tmpdir'], strlen($_SERVER['DOCUMENT_ROOT'])));
			}
			unlink($tmpfile);
		}
	}
	
	public function GetProccessParams($id)
	{
		$tmpfile = $this->tmpdir.$id.($this->suffix ? '_'.$this->suffix : '').'.txt';
		if(file_exists($tmpfile))
		{
			$arParams = $this->GetProfileParamsByFile($tmpfile);
			$paramFile = $arParams['tmpdir'].'params.txt';
			if(file_exists($paramFile)) $arParams = unserialize(file_get_contents($paramFile));
			return $arParams;
		}
		return false;
	}
	
	public function GetProccessParamsFromPidFile($id)
	{
		$tmpfile = $this->tmpdir.$id.($this->suffix ? '_'.$this->suffix : '').'.txt';
		if(file_exists($tmpfile))
		{
			if(time() - filemtime($tmpfile) < 3*60)
			{
				return false;
			}
			$arParams = $this->GetProfileParamsByFile($tmpfile);
			return $arParams;
		}
		return array();
	}
	
	public function SetImportParams($pid, $tmpdir, $arParams, $arImportParams=array())
	{
		$this->pid = $pid;
		$this->importMode = ($arParams['IMPORT_MODE']=='CRON' ? 'CRON' : 'USER');
		$this->importParams = $arImportParams;
	}
	
	public function GetErrors()
	{
		if(!isset($this->errors) || !is_array($this->errors)) $this->errors = array();
		return implode('<br>', array_unique($this->errors));
	}
	
	public function ShowProfileList($fname, $PROFILE_ID='')
	{
		$arProfiles = $this->GetList(is_numeric($PROFILE_ID) && strlen($PROFILE_ID) > 0 ? array('LOGIC'=>'OR', array('ACTIVE'=>'Y'), array('ID'=>$PROFILE_ID+1)) : array());
		?><select name="<?echo $fname;?>" id="<?echo $fname;?>" onchange="EProfile.Choose(this)" style="max-width: 400px; padding-right: 30px;"><?
			?><option value=""><?echo Loc::getMessage("ESOL_IX_NO_PROFILE"); ?></option><?
			?><option value="new" <?if($_REQUEST[$fname]=='new'){echo 'selected';}?>><?echo Loc::getMessage("ESOL_IX_NEW_PROFILE"); ?></option><?
			foreach($arProfiles as $k=>$profile)
			{
				?><option value="<?echo $k;?>" <?if(strlen($_REQUEST[$fname])>0 && strval($_REQUEST[$fname])===strval($k)){echo 'selected';}?>><?echo '['.$k.'] '.$profile; ?></option><?
			}
		?></select><?
	}
	
	public function ShowProfileListAlt($fname, $PROFILE_ID='')
	{
		//$arProfiles = $this->GetList(is_numeric($PROFILE_ID) && strlen($PROFILE_ID) > 0 ? array('LOGIC'=>'OR', array('ACTIVE'=>'Y'), array('ID'=>$PROFILE_ID+1)) : array());
		$arProfiles = $this->GetList();
		?><select name="<?echo $fname;?>" id="<?echo $fname;?>"><?
			?><option value=""><?echo Loc::getMessage("ESOL_IX_NO_PROFILE"); ?></option><?
			foreach($arProfiles as $k=>$profile)
			{
				?><option value="<?echo $k;?>" <?if(is_numeric($PROFILE_ID) && strlen($PROFILE_ID) > 0 && strval($PROFILE_ID)===strval($k)){echo 'selected';}?>><?echo $profile; ?></option><?
			}
		?></select><?
	}
	
	public function SetParams($params=array())
	{
		$this->params = $params;
	}
	
	public function GetParam($name)
	{
		if(isset($this->params[$name])) return $this->params[$name];
		return null;
	}
	
	public static function EncodeProfileParams($arParams)
	{
		return '='.base64_encode(serialize($arParams));
	}
	
	public static function DecodeProfileParams($paramStr)
	{
		$paramStr = trim($paramStr);
		if(substr($paramStr, 0, 1)=='=') $paramStr = base64_decode(substr($paramStr, 1));
		$arParams = unserialize($paramStr);
		if(!is_array($arParams)) $arParams = array();
		return $arParams;
	}
	
	public function Apply(&$settigs_default, &$settings, $ID)
	{
		$arProfile = $this->GetByID($ID);
		if(!is_array($settigs_default) && is_array($arProfile['SETTINGS_DEFAULT']))
		{
			$settigs_default = $arProfile['SETTINGS_DEFAULT'];
		}
		if(!is_array($settings) && is_array($arProfile['SETTINGS']))
		{
			$settings = $arProfile['SETTINGS'];
		}
		if(is_array($settings))
		{
			/*Protect of loss setting*/
			if(!isset($settings['FIELDS']) && !isset($settings['GROUPS']) && is_array($arProfile['SETTINGS']))
			{
				foreach($arProfile['SETTINGS'] as $k=>$v)
				{
					if(!isset($settings[$k])) $settings[$k] = $v;
				}
			}
			/*/Protect of loss setting*/
			if($settings['ADDITIONAL_SETTINGS'])
			{
				foreach($settings['ADDITIONAL_SETTINGS'] as $k=>$v)
				{
					if($v && !is_array($v))
					{
						$v = \CUtil::JsObjectToPhp($v);
					}
					if(!is_array($v)) $v = array();
					$settings['ADDITIONAL_SETTINGS'][$k] = $v;
				}
			}
		}
		if(!is_array($settigs_default)) $settigs_default = array();
		if(!is_array($settings)) $settings = array();
		
		$instance = static::getInstance();
		$instance->SetParams($settigs_default);
	}
	
	public function ApplyExtra(&$extrasettings, $ID)
	{
		$arProfile = $this->GetByID($ID);
		if(!is_array($extrasettings) && is_array($arProfile['EXTRASETTINGS']))
		{
			$extrasettings = $arProfile['EXTRASETTINGS'];
		}
	}
	
	public function SetMassMode($massMode, $arElementIds=array(), $logger=false)
	{
		$this->isMassMode = $massMode;
		$pid = (int)$this->pid;
		if($massMode)
		{
			$this->arElementIds = array();
			if(!empty($arElementIds))
			{
				$entity = $this->GetImportEntity();
				$dbRes = $entity::getList(array('filter'=>array('PROFILE_ID'=>$pid, '=TYPE'=>'E', 'ELEMENT_ID'=>$arElementIds), 'select'=>array('ELEMENT_ID')));
				while($arr = $dbRes->Fetch())
				{
					$this->arElementIds[$arr['ELEMENT_ID']] = $arr['ELEMENT_ID'];
				}
			}
		}
		elseif(!empty($this->arElementIds))
		{
			$arElementIds = $this->arElementIds;
			$entity = $this->GetImportEntity();
			$dbRes = $entity::getList(array('filter'=>array('PROFILE_ID'=>$pid, '=TYPE'=>'E', 'ELEMENT_ID'=>$arElementIds), 'select'=>array('ELEMENT_ID')));
			while($arr = $dbRes->Fetch())
			{
				unset($arElementIds[$arr['ELEMENT_ID']]);
			}
			
			if(!empty($arElementIds))
			{
				$arVals = array();
				foreach($arElementIds as $id)
				{
					$id = (int)$id;
					if($id <= 0) continue;
					$arVals[] = '('.$pid.', "E", '.$id.')';
				}
				if(!empty($arVals))
				{
					$tblName = $entity->getTableName();
					$conn = $entity->getEntity()->getConnection();
					$helper = $conn->getSqlHelper();
					$conn->query('INSERT IGNORE INTO '.$helper->quote($tblName).' ('.$helper->quote('PROFILE_ID').', '.$helper->quote('TYPE').', '.$helper->quote('ELEMENT_ID').') VALUES '.implode(',', $arVals));
				}
			}
			$this->arElementIds = array();
		}
		if($logger!==false) $this->logger = $logger;
		if($this->logger!==false) $this->logger->SetMassMode($massMode);
	}
	
	public function GetMassMode()
	{
		return $this->isMassMode;
	}
	
	public function SaveElementId($ID, $type)
	{
		if($this->isMassMode && $type=='E')
		{
			if(array_key_exists($ID, $this->arElementIds)) return false;
			else 
			{
				$this->arElementIds[$ID] = $ID;
				return true;
			}
		}
		
		$entity = $this->GetImportEntity();
		$arFields = array('PROFILE_ID'=>(int)$this->pid, 'ELEMENT_ID'=>(int)$ID);
		$dbRes = $entity::getList(array('filter'=>array_merge($arFields, array('=TYPE'=>$type)), 'select'=>array('ELEMENT_ID')));
		if($dbRes->Fetch())
		{
			return false;
		}
		else
		{
			//$entity::add(array_merge($arFields, array('TYPE'=>$type)));
			$tblName = $entity->getTableName();
			$conn = $entity->getEntity()->getConnection();
			$helper = $conn->getSqlHelper();
			$conn->query('INSERT IGNORE INTO '.$helper->quote($tblName).' ('.$helper->quote('PROFILE_ID').', '.$helper->quote('TYPE').', '.$helper->quote('ELEMENT_ID').') VALUES ('.$arFields['PROFILE_ID'].', "'.$type.'", '.$arFields['ELEMENT_ID'].')');
			return true;
		}
	}
	
	public function GetLastImportId($type)
	{
		$entity = $this->GetImportEntity();
		$dbRes = $entity::getList(array('filter'=>array('PROFILE_ID'=>$this->pid, '=TYPE'=>$type), 'runtime' => array('MAX_ID' => array('data_type'=>'float', 'expression' => array('max(%s)', 'ELEMENT_ID'))), 'select'=>array('MAX_ID')));
		if($arr = $dbRes->Fetch()) return $arr['MAX_ID'];
		else return 0;
	}
	
	public function GetUpdatedIds($type, $first)
	{
		$entity = $this->GetImportEntity();
		$arIds = array();
		$dbRes = $entity::getList(array('filter'=>array('PROFILE_ID'=>$this->pid, '=TYPE'=>$type, '>ELEMENT_ID'=>(int)$first), 'select'=>array('ELEMENT_ID'), 'order'=>array('ELEMENT_ID'=>'ASC'), 'limit'=>5000));
		while($arr = $dbRes->Fetch())
		{
			$arIds[] = $arr['ELEMENT_ID'];
		}
		return $arIds;
	}
	
	public function IsAlreadyLoaded($ID, $type)
	{
		if($this->GetMassMode())
		{
			return (bool)(array_key_exists($ID, $this->arElementIds));
		}
		
		$entity = $this->GetImportEntity();
		$arFields = array('PROFILE_ID'=>$this->pid, 'ELEMENT_ID'=>$ID, '=TYPE'=>$type);
		$dbRes = $entity::getList(array('filter'=>$arFields, 'select'=>array('ELEMENT_ID')));
		if($dbRes->Fetch())
		{
			return true;
		}
		return false;
	}
	
	public function OnStartImport()
	{
		foreach(GetModuleEvents(static::$moduleId, "OnStartImport", true) as $arEvent)
		{
			$bEventRes = ExecuteModuleEventEx($arEvent, array($this->pid));
			if($bEventRes===false) return false;
		}
		
		$this->UpdateFields($this->pid, array(
			'DATE_START' => new \Bitrix\Main\Type\DateTime(),
			'DATE_FINISH' => false
		));
		$this->DeleteImportTmpData();
		
		\Bitrix\Main\Config\Option::set(static::$moduleId, 'IS_ACTIVE_IMPORT', 'Y');
		
		if((!isset($this->importParams['NOT_SEND_EVENTS']) || $this->importParams['NOT_SEND_EVENTS']!='Y')
			&& \Bitrix\Main\Config\Option::get(static::$moduleId, 'NOTIFY_BEGIN_IMPORT', 'N')=='Y'
			&& (\Bitrix\Main\Config\Option::get(static::$moduleId, 'NOTIFY_MODE', 'NONE')=='ALL'
				|| (\Bitrix\Main\Config\Option::get(static::$moduleId, 'NOTIFY_MODE', 'NONE')=='CRON' && $this->importMode=='CRON')))
		{
			$this->CheckEventOnBeginImport();
			$arEventData = array();
			$arProfile = $this->GetFieldsByID($this->pid);
			$arEventData['PROFILE_NAME'] = $arProfile['NAME'];
			$arEventData['IMPORT_START_DATETIME'] = (is_callable(array($arProfile['DATE_START'], 'toString')) ? $arProfile['DATE_START']->toString() : '');
			$arEventData['EMAIL_TO'] = \Bitrix\Main\Config\Option::get(static::$moduleId, 'NOTIFY_EMAIL');
			\CEvent::Send('ESOL_XMLIMPORT_START', $this->GetDefaultSiteId(), $arEventData);
		}
		return true;
	}
	
	public function OnEndImport($file, $arParams, $arErrors=array(), $arProfParams=array())
	{
		$hash = (isset($arProfParams['FILE_HASH']) && strlen($arProfParams['FILE_HASH']) > 0 ? $arProfParams['FILE_HASH'] : md5_file($file));
		$this->UpdateFields($this->pid, array(
			'FILE_HASH'=>$hash,
			'DATE_FINISH'=>new \Bitrix\Main\Type\DateTime()
		));
		$this->DeleteImportTmpData();
		
		if(!$this->IsActiveProcesses())
		{
			\Bitrix\Main\Config\Option::set(static::$moduleId, 'IS_ACTIVE_IMPORT', 'N');
		}
		
		$arEventData = array();
		if(is_array($arParams))
		{
			foreach($arParams as $k=>$v)
			{
				if(!is_array($v)) $arEventData[ToUpper($k)] = $v;
			}
		}
		$arProfile = $this->GetFieldsByID($this->pid);
		$arEventData['PROFILE_NAME'] = $arProfile['NAME'];
		$arEventData['IMPORT_START_DATETIME'] = (is_callable(array($arProfile['DATE_START'], 'toString')) ? $arProfile['DATE_START']->toString() : '');
		$arEventData['IMPORT_FINISH_DATETIME'] = (is_callable(array($arProfile['DATE_FINISH'], 'toString')) ? $arProfile['DATE_FINISH']->toString() : '');
		if($this->importParams['STAT_SAVE']=='Y')
		{
			$arSite = $this->GetDefaultSite();
			$arEventData['STAT_LINK'] = 'http://'.$arSite['SERVER_NAME'].'/bitrix/admin/'.static::$moduleFilePrefix.'_event_log.php?lang='.LANGUAGE_ID.'&find_profile_id='.($this->pid+1).'&find_exec_id='.$arParams['loggerExecId'];
		}
			
		if((!isset($this->importParams['NOT_SEND_EVENTS']) || $this->importParams['NOT_SEND_EVENTS']!='Y')
			&& \Bitrix\Main\Config\Option::get(static::$moduleId, 'NOTIFY_END_IMPORT', 'N')=='Y'
			&& (\Bitrix\Main\Config\Option::get(static::$moduleId, 'NOTIFY_MODE', 'NONE')=='ALL'
				|| (\Bitrix\Main\Config\Option::get(static::$moduleId, 'NOTIFY_MODE', 'NONE')=='CRON' && $this->importMode=='CRON')))
		{
			$this->CheckEventOnEndImport();
			$arEventData['EMAIL_TO'] = \Bitrix\Main\Config\Option::get(static::$moduleId, 'NOTIFY_EMAIL');
			$arEventData['ERRORS'] = implode("\r\n--------\r\n", $arErrors);
			$arEventData['STAT_BLOCK'] = '';
			foreach(array('TOTAL_LINE', 'CORRECT_LINE', 'ERROR_LINE', 'ELEMENT_ADDED_LINE', 'ELEMENT_UPDATED_LINE', 'ELEMENT_CHANGED_LINE', 'ELEMENT_REMOVED_LINE', 'KILLED_LINE', 'ZERO_STOCK_LINE', 'OLD_REMOVED_LINE', 'SKU_ADDED_LINE', 'SKU_UPDATED_LINE', 'SKU_CHANGED_LINE', 'OFFER_KILLED_LINE', 'OFFER_ZERO_STOCK_LINE', 'OFFER_OLD_REMOVED_LINE', 'SECTION_ADDED_LINE', 'SECTION_UPDATED_LINE', 'SECTION_DEACTIVATE_LINE', 'SECTION_REMOVE_LINE', 'ERRORS') as $k=>$v)
			{
				if($k < 3 || $arEventData[$v] > 0 || strlen($arEventData[$v]) > 1)
				{
					$arEventData['STAT_BLOCK'] .= ($v=='ERRORS' ? "\r\n\r\n" : '').Loc::getMessage("ESOL_IX_EVENT_".$v).": ".($v=='ERRORS' ? "\r\n" : '').$arEventData[$v]."\r\n";
				}
			}
				if(array_key_exists('STAT_LINK', $arEventData))
				{
					$arEventData['STAT_BLOCK'] .= "\r\n".Loc::getMessage("ESOL_IX_EVENT_STAT_LINK").$arEventData['STAT_LINK'];
				}
			\CEvent::Send('ESOL_XMLIMPORT_END', $this->GetDefaultSiteId(), $arEventData);
		}
		return $arEventData;
	}
	
	public function OnBreakImport($reason='')
	{
		$reasonOrig = $reason;
		if($this->suffix!='highload')
		{
			$reason = (strlen(Loc::getMessage("ESOL_IX_BREAK_REASON_".ToUpper($reason))) > 0 ? Loc::getMessage("ESOL_IX_BREAK_REASON_".ToUpper($reason)) : $reason);
			$arEventData = array('IMPORT_BREAK_REASON'=>$reason);
			$arProfile = $this->GetFieldsByID($this->pid);
			$curDate = new \Bitrix\Main\Type\DateTime();
			$curTime = $curDate->getTimestamp();
			$importDate = $arProfile['DATE_START'];
			$importTime = (is_callable(array($importDate, 'getTimestamp')) ? $importDate->getTimestamp() : 0);
			$arEventData['PROFILE_NAME'] = $arProfile['NAME'];
			$arEventData['IMPORT_START_DATETIME'] = $curDate->toString();
			//if(in_array($reason, array('FILE_NOT_EXISTS'))) $arEventData['IMPORT_START_DATETIME'] = ConvertTimeStamp(false, "FULL");
			$breakOption = 'NOTIFY_BREAK_IMPORT';
			if($reasonOrig=='FILE_IS_LOADED') $breakOption = 'NOTIFY_BREAK_IMPORT_NC';
			$mode = \Bitrix\Main\Config\Option::get(static::$moduleId, $breakOption, 'N');
			$modeDH = \Bitrix\Main\Config\Option::get(static::$moduleId, $breakOption.'_DH', 0);
			if((!isset($this->importParams['NOT_SEND_EVENTS']) || $this->importParams['NOT_SEND_EVENTS']!='Y')
				&& ($mode=='Y' || (in_array($mode, array('D','H')) && $curTime-$modeDH*60*60*($mode=='D' ? 24 : 1)>$importTime))
				&& (\Bitrix\Main\Config\Option::get(static::$moduleId, 'NOTIFY_MODE', 'NONE')=='ALL'
					|| (\Bitrix\Main\Config\Option::get(static::$moduleId, 'NOTIFY_MODE', 'NONE')=='CRON' && $this->importMode=='CRON')))
			{
				$this->CheckEventOnBreakImport();
				$arEventData['EMAIL_TO'] = \Bitrix\Main\Config\Option::get(static::$moduleId, 'NOTIFY_EMAIL');
				if(\Bitrix\Main\Config\Option::get(static::$moduleId, 'NOTIFY_WITH_FILE', 'N')=='Y')
				{
					\CEvent::Send('ESOL_IMPORT_BREAK', $this->GetDefaultSiteId(), $arEventData, 'Y', '', array($arProfile['DATA_FILE_ID']));
				}
				else
				{
					\CEvent::Send('ESOL_IMPORT_BREAK', $this->GetDefaultSiteId(), $arEventData);
				}
			}
		}
		$this->SetMassMode(false);
		return $arEventData;
	}
	
	public function OnFileNotChanged()
	{
		if($this->suffix!='highload')
		{
			$arEventData = array();
			$arProfile = $this->GetFieldsByID($this->pid);
			$curDate = new \Bitrix\Main\Type\DateTime();
			$curTime = $curDate->getTimestamp();
			$importDate = $arProfile['DATE_START'];
			$importTime = (is_callable(array($importDate, 'getTimestamp')) ? $importDate->getTimestamp() : 0);	
			$arEventData['PROFILE_NAME'] = $arProfile['NAME'];
			$arEventData['IMPORT_START_DATETIME'] = $curDate->toString();
			$breakOption = 'NOTIFY_BREAK_IMPORT_NC';
			$mode = \Bitrix\Main\Config\Option::get(static::$moduleId, $breakOption, 'N');
			$modeDH = \Bitrix\Main\Config\Option::get(static::$moduleId, $breakOption.'_DH', 0);
			if((!isset($this->importParams['NOT_SEND_EVENTS']) || $this->importParams['NOT_SEND_EVENTS']!='Y')
				&& ($mode=='Y' || (in_array($mode, array('D','H')) && $curTime-$modeDH*60*60*($mode=='D' ? 24 : 1)>$importTime))
				&& (\Bitrix\Main\Config\Option::get(static::$moduleId, 'NOTIFY_MODE', 'NONE')=='ALL'
					|| (\Bitrix\Main\Config\Option::get(static::$moduleId, 'NOTIFY_MODE', 'NONE')=='CRON' && $this->importMode=='CRON')))
			{
				$this->CheckEventOnFileNotChanged();
				$arEventData['EMAIL_TO'] = \Bitrix\Main\Config\Option::get(static::$moduleId, 'NOTIFY_EMAIL');
				if(\Bitrix\Main\Config\Option::get(static::$moduleId, 'NOTIFY_WITH_FILE', 'N')=='Y')
				{
					\CEvent::Send('ESOL_IMPORT_FILE_NOT_CHANGED', $this->GetDefaultSiteId(), $arEventData, 'Y', '', array($arProfile['DATA_FILE_ID']));
				}
				else
				{
					\CEvent::Send('ESOL_IMPORT_FILE_NOT_CHANGED', $this->GetDefaultSiteId(), $arEventData);
				}
			}
		}
		return $arEventData;
	}
	
	public function DeleteImportTmpData()
	{
		$entity = $this->GetImportEntity();
		$tblName = $entity->getTableName();
		$conn = $entity->getEntity()->getConnection();
		$helper = $conn->getSqlHelper();
		$conn->queryExecute('DELETE FROM '.$helper->quote($tblName).' WHERE PROFILE_ID='.intval($this->pid));
	}
	
	public function IsActiveProcesses()
	{
		$profileEntity = $this->GetEntity();
		$dbRes = $profileEntity::getList(array('select'=>array('ID'), 'order'=>array('SORT'=>'ASC', 'ID'=>'ASC'), 'filter'=>array('>DATE_START'=>\Bitrix\Main\Type\DateTime::createFromTimestamp(time()-30*24*60*60), 'DATE_FINISH'=>false), 'limit'=>1));
		while($arProfile = $dbRes->Fetch())
		{
			$tmpfile = $this->tmpdir.$arProfile['ID'].($this->suffix ? '_'.$this->suffix : '').'.txt';
			if(file_exists($tmpfile) && (time() - filemtime($tmpfile) < 4*60) && filemtime($tmpfile) > mktime(0, 0, 0, 12, 24, 2015))
			{
				return true;
			}
		}
		return false;
	}
	
	public function GetCacheDataParams($profileId, $file, $arParams)
	{
		return array(
			'FILE' => (string)$file,
			'FILESIZE' => file_exists($file) ? filesize($file) : 0,
			'FILEMTIME' => file_exists($file) ? filemtime($file) : 0,
			'XMLREADER' => (bool)class_exists('\XMLReader'),
			'NOT_USE_XML_READER' => (string)$arParams['NOT_USE_XML_READER'],
			'MAX_READ_FILE_TIME' => (string)$arParams['MAX_READ_FILE_TIME']
		);
	}
	
	public function GetCacheData($profileId, $file, $arParams)
	{
		if(strlen($profileId)==0 || !$file || is_array($file)) return false;
		$fn = $this->tmpcachedir.$profileId.($this->suffix ? '_'.$this->suffix : '').'.txt';
		if(file_exists($fn))
		{
			$arData = array();
			$arFileData = array_map('trim', explode("\n", file_get_contents($fn)));
			foreach($arFileData as $line)
			{
				if(mb_strpos($line, ':') > 0)
				{
					$arLine = explode(':', $line, 2);
					$arData[trim($arLine[0])] = unserialize(base64_decode(trim($arLine[1])));
				}
			}
			$arCheckParams = $this->GetCacheDataParams($profileId, $file, $arParams);
			foreach($arCheckParams as $k=>$v)
			{
				if($v!==$arData[$k]) return false;
			}
			return $arData;
		}
		return false;
	}
	
	public function SetCacheData($profileId, $file, $arParams, $arNewData)
	{
		if(strlen($profileId)==0 || !$file || is_array($file)) return $arData;
		$fn = $this->tmpcachedir.$profileId.($this->suffix ? '_'.$this->suffix : '').'.txt';
		$arData = $this->GetCacheData($profileId, $file, $arParams);
		if(!$arData) $arData = $this->GetCacheDataParams($profileId, $file, $arParams);
		$arData = array_merge($arData, $arNewData);
		$arLines = array();
		foreach($arData as $k=>$v)
		{
			$arLines[] = $k.':'.base64_encode(serialize($v));
		}
		file_put_contents($fn, implode("\r\n", $arLines));
	}
	
	public function GetDefaultSite()
	{
		if(!isset($this->defaultSite) || !is_array($this->defaultSite))
		{
			if(!($arSite = \CSite::GetList(($by='sort'), ($order='asc'), array('DEFAULT'=>'Y'))->Fetch()))
				$arSite = \CSite::GetList(($by='sort'), ($order='asc'), array())->Fetch();
			$this->defaultSite = (is_array($arSite) ? $arSite : array());
		}
		return $this->defaultSite;
	}
	
	public function GetDefaultSiteId()
	{
		if(!($arSite = \CSite::GetList(($by='sort'), ($order='asc'), array('DEFAULT'=>'Y'))->Fetch()))
			$arSite = \CSite::GetList(($by='sort'), ($order='asc'), array())->Fetch();
		return $arSite['ID'];
	}
	
	public function CheckEventOnBeginImport()
	{
		$eventName = 'ESOL_XMLIMPORT_START';
		$dbRes = \CEventType::GetList(array('TYPE_ID'=>$eventName));
		if(!$dbRes->Fetch())
		{
			$et = new \CEventType();
			$et->Add(array(
				"LID"           => "ru",
				"EVENT_NAME"    => $eventName,
				"NAME"          => Loc::getMessage("ESOL_IX_EVENT_IMPORT_START"),
				"DESCRIPTION"   => 
					"#PROFILE_NAME# - ".Loc::getMessage("ESOL_IX_EVENT_PROFILE_NAME")."\r\n".
					"#IMPORT_START_DATETIME# - ".Loc::getMessage("ESOL_IX_EVENT_TIME_BEGIN")
				));
		}
		$dbRes = \CEventMessage::GetList(($by='id'), ($order='desc'), array('TYPE_ID'=>$eventName));
		if(!$dbRes->Fetch())
		{
			$emess = new \CEventMessage();
			$emess->Add(array(
				'ACTIVE' => 'Y',
				'EVENT_NAME' => $eventName,
				'LID' => $this->GetDefaultSiteId(),
				'EMAIL_FROM' => '#DEFAULT_EMAIL_FROM#',
				'EMAIL_TO' => '#EMAIL_TO#',
				'SUBJECT' => '#SITE_NAME#: '.Loc::getMessage("ESOL_IX_EVENT_BEGIN_PROFILE").' "#PROFILE_NAME#"',
				'MESSAGE' => 
					Loc::getMessage("ESOL_IX_EVENT_PROFILE_NAME").": #PROFILE_NAME#\r\n".
					Loc::getMessage("ESOL_IX_EVENT_TIME_BEGIN").": #IMPORT_START_DATETIME#"
			));
		}
	}
	
	public function CheckEventOnEndImport()
	{
		$eventName = 'ESOL_XMLIMPORT_END';
		$dbRes = \CEventType::GetList(array('TYPE_ID'=>$eventName));
		if(!$dbRes->Fetch())
		{
			$et = new \CEventType();
			$et->Add(array(
				"LID"           => "ru",
				"EVENT_NAME"    => $eventName,
				"NAME"          => Loc::getMessage("ESOL_IX_EVENT_IMPORT_END"),
				"DESCRIPTION"   => 
					"#PROFILE_NAME# - ".Loc::getMessage("ESOL_IX_EVENT_PROFILE_NAME")."\r\n".
					"#IMPORT_START_DATETIME# - ".Loc::getMessage("ESOL_IX_EVENT_TIME_BEGIN")."\r\n".
					"#IMPORT_FINISH_DATETIME# - ".Loc::getMessage("ESOL_IX_EVENT_TIME_END")."\r\n".
					"#STAT_BLOCK# - ".Loc::getMessage("ESOL_IX_EVENT_STAT_BLOCK")."\r\n".
					"#TOTAL_LINE# - ".Loc::getMessage("ESOL_IX_EVENT_TOTAL_LINE")."\r\n".
					"#CORRECT_LINE# - ".Loc::getMessage("ESOL_IX_EVENT_CORRECT_LINE")."\r\n".
					"#ERROR_LINE# - ".Loc::getMessage("ESOL_IX_EVENT_ERROR_LINE")."\r\n".
					"#ELEMENT_ADDED_LINE# - ".Loc::getMessage("ESOL_IX_EVENT_ELEMENT_ADDED_LINE")."\r\n".
					"#ELEMENT_UPDATED_LINE# - ".Loc::getMessage("ESOL_IX_EVENT_ELEMENT_UPDATED_LINE")."\r\n".
					"#SECTION_ADDED_LINE# - ".Loc::getMessage("ESOL_IX_EVENT_SECTION_ADDED_LINE")."\r\n".
					"#SECTION_UPDATED_LINE# - ".Loc::getMessage("ESOL_IX_EVENT_SECTION_UPDATED_LINE")."\r\n".
					"#SKU_ADDED_LINE# - ".Loc::getMessage("ESOL_IX_EVENT_SKU_ADDED_LINE")."\r\n".
					"#SKU_UPDATED_LINE# - ".Loc::getMessage("ESOL_IX_EVENT_SKU_UPDATED_LINE")."\r\n".
					"#KILLED_LINE# - ".Loc::getMessage("ESOL_IX_EVENT_KILLED_LINE")."\r\n".
					"#ZERO_STOCK_LINE# - ".Loc::getMessage("ESOL_IX_EVENT_ZERO_STOCK_LINE")."\r\n".
					"#OLD_REMOVED_LINE# - ".Loc::getMessage("ESOL_IX_EVENT_OLD_REMOVED_LINE")."\r\n".
					"#OFFER_KILLED_LINE# - ".Loc::getMessage("ESOL_IX_EVENT_OFFER_KILLED_LINE")."\r\n".
					"#OFFER_ZERO_STOCK_LINE# - ".Loc::getMessage("ESOL_IX_EVENT_OFFER_ZERO_STOCK_LINE")."\r\n".
					"#OFFER_OLD_REMOVED_LINE# - ".Loc::getMessage("ESOL_IX_EVENT_OFFER_OLD_REMOVED_LINE")
				));
		}
		$dbRes = \CEventMessage::GetList(($by='id'), ($order='desc'), array('TYPE_ID'=>$eventName));
		if(!$dbRes->Fetch())
		{
			$emess = new \CEventMessage();
			$emess->Add(array(
				'ACTIVE' => 'Y',
				'EVENT_NAME' => $eventName,
				'LID' => $this->GetDefaultSiteId(),
				'EMAIL_FROM' => '#DEFAULT_EMAIL_FROM#',
				'EMAIL_TO' => '#EMAIL_TO#',
				'SUBJECT' => '#SITE_NAME#: '.Loc::getMessage("ESOL_IX_EVENT_END_PROFILE").' "#PROFILE_NAME#"',
				'MESSAGE' => 
					Loc::getMessage("ESOL_IX_EVENT_PROFILE_NAME").": #PROFILE_NAME#\r\n".
					Loc::getMessage("ESOL_IX_EVENT_TIME_BEGIN").": #IMPORT_START_DATETIME#\r\n".
					Loc::getMessage("ESOL_IX_EVENT_TIME_END").": #IMPORT_FINISH_DATETIME#\r\n".
					"\r\n".
					Loc::getMessage("ESOL_IX_EVENT_STAT_BLOCK").": \r\n#STAT_BLOCK#"
			));
		}
	}
	
	public function CheckEventOnBreakImport()
	{
		$eventName = 'ESOL_IMPORT_BREAK';
		$dbRes = \CEventType::GetList(array('TYPE_ID'=>$eventName));
		if(!$dbRes->Fetch())
		{
			$et = new \CEventType();
			$et->Add(array(
				"LID"           => "ru",
				"EVENT_NAME"    => $eventName,
				"NAME"          => Loc::getMessage("ESOL_IX_EVENT_IMPORT_BREAK"),
				"DESCRIPTION"   => 
					"#PROFILE_NAME# - ".Loc::getMessage("ESOL_IX_EVENT_PROFILE_NAME")."\r\n".
					"#IMPORT_START_DATETIME# - ".Loc::getMessage("ESOL_IX_EVENT_TIME_BEGIN")."\r\n".
					"#IMPORT_BREAK_REASON# - ".Loc::getMessage("ESOL_IX_EVENT_IMPORT_BREAK_REASON")
				));
		}
		$dbRes = \CEventMessage::GetList(($by='id'), ($order='desc'), array('TYPE_ID'=>$eventName));
		if(!$dbRes->Fetch())
		{
			$emess = new \CEventMessage();
			$emess->Add(array(
				'ACTIVE' => 'Y',
				'EVENT_NAME' => $eventName,
				'LID' => $this->GetDefaultSiteId(),
				'EMAIL_FROM' => '#DEFAULT_EMAIL_FROM#',
				'EMAIL_TO' => '#EMAIL_TO#',
				'SUBJECT' => '#SITE_NAME#: '.Loc::getMessage("ESOL_IX_EVENT_BREAK_PROFILE").' "#PROFILE_NAME#"',
				'BODY_TYPE' => 'html',
				'MESSAGE' => 
					Loc::getMessage("ESOL_IX_EVENT_PROFILE_NAME").": #PROFILE_NAME#<br>\r\n".
					Loc::getMessage("ESOL_IX_EVENT_TIME_BEGIN").": #IMPORT_START_DATETIME#<br>\r\n".
					Loc::getMessage("ESOL_IX_EVENT_IMPORT_BREAK_REASON").": #IMPORT_BREAK_REASON#"
			));
		}
	}
	
	public function CheckEventOnFileNotChanged()
	{
		$eventName = 'ESOL_IMPORT_FILE_NOT_CHANGED';
		$dbRes = \CEventType::GetList(array('TYPE_ID'=>$eventName));
		if(!$dbRes->Fetch())
		{
			$et = new \CEventType();
			$et->Add(array(
				"LID"           => "ru",
				"EVENT_NAME"    => $eventName,
				"NAME"          => Loc::getMessage("ESOL_IX_EVENT_IMPORT_FILE_NOT_CHANGED"),
				"DESCRIPTION"   => 
					"#PROFILE_NAME# - ".Loc::getMessage("ESOL_IX_EVENT_PROFILE_NAME")."\r\n".
					"#IMPORT_START_DATETIME# - ".Loc::getMessage("ESOL_IX_EVENT_TIME_BEGIN")
				));
		}
		$dbRes = \CEventMessage::GetList(($by='id'), ($order='desc'), array('TYPE_ID'=>$eventName));
		if(!$dbRes->Fetch())
		{
			$emess = new \CEventMessage();
			$emess->Add(array(
				'ACTIVE' => 'Y',
				'EVENT_NAME' => $eventName,
				'LID' => $this->GetDefaultSiteId(),
				'EMAIL_FROM' => '#DEFAULT_EMAIL_FROM#',
				'EMAIL_TO' => '#EMAIL_TO#',
				'SUBJECT' => '#SITE_NAME#: '.Loc::getMessage("ESOL_IX_EVENT_FILE_NOT_CHANGED_PROFILE"),
				'BODY_TYPE' => 'html',
				'MESSAGE' => 
					Loc::getMessage("ESOL_IX_EVENT_PROFILE_NAME").": #PROFILE_NAME#<br>\r\n".
					Loc::getMessage("ESOL_IX_EVENT_TIME_BEGIN").": #IMPORT_START_DATETIME#"
			));
		}
	}
	
	public function OutputBackup()
	{
		global $APPLICATION;
		$APPLICATION->RestartBuffer();
		
		$fileName = 'profiles_'.date('Y_m_d_H_i_s');
		$tempPath = \CFile::GetTempName('', bx_basename($fileName.'.zip'));
		$dir = rtrim(\Bitrix\Main\IO\Path::getDirectory($tempPath), '/').'/'.$fileName;
		\Bitrix\Main\IO\Directory::createDirectory($dir);
		
		$arFiles = array(
			'config' => $dir.'/config.txt',
			'data' => $dir.'/data.txt'
		);
		
		file_put_contents($arFiles['config'], base64_encode(serialize(
			array(
				'domain' => $_SERVER['HTTP_HOST'],
				'encoding' => \Bitrix\EsolImportxml\Utils::getSiteEncoding()
			)
		)));
		
		$handle = fopen($arFiles['data'], 'a');
		$profileEntity = $this->GetEntity();
		$dbRes = $profileEntity::getList(array('order'=>array('ID'=>'ASC'), 'select'=>array('ID', 'ACTIVE', 'NAME', 'PARAMS', 'SORT')));
		while($arProfile = $dbRes->Fetch())
		{
			/*Save iblock data*/
			if(Loader::includeModule('iblock') && class_exists('\Bitrix\Iblock\PropertyTable') && isset($arProfile['PARAMS']) && strlen($arProfile['PARAMS']) > 0 && ($arProfileParams = self::DecodeProfileParams($arProfile['PARAMS'])) && is_array($arProfileParams))
			{
				$iblockId = $arProfileParams['SETTINGS_DEFAULT']['IBLOCK_ID'];
				$arPropIds = array();
				if(isset($arProfileParams['SETTINGS']['FIELDS']) && is_array($arProfileParams['SETTINGS']['FIELDS']))
				{
					foreach($arProfileParams['SETTINGS']['FIELDS'] as $k=>$v)
					{
						if(preg_match('/IP_PROP(\d+)/', $v, $m)) $arPropIds[$m[1]] = $m[1];
					}
				}
				if(isset($arProfileParams['SETTINGS']['PROPERTY_MAP']) && strlen($arProfileParams['SETTINGS']['PROPERTY_MAP']) > 0)
				{
					$arMap = unserialize(base64_decode($arProfileParams['SETTINGS']['PROPERTY_MAP']));
					if(is_array($arMap) && isset($arMap['MAP']) && is_array($arMap['MAP']))
					{
						foreach($arMap['MAP'] as $k=>$v)
						{
							if(preg_match('/IP_PROP(\d+)/', $v['ID'], $m)) $arPropIds[$m[1]] = $m[1];
						}
					}
				}
				if(count($arPropIds) > 0)
				{
					$arProps = array($iblockId=>array());
					$dbRes2 = \Bitrix\Iblock\PropertyTable::getList(array('filter' => array('=IBLOCK_ID'=>$iblockId, 'ID'=>$arPropIds), 'select' => array('ID', 'IBLOCK_ID', 'CODE', 'NAME')));
					while($arr = $dbRes2->Fetch())
					{
						$arProps[$arr['IBLOCK_ID']][$arr['ID']] = array('CODE'=>$arr['CODE'], 'NAME'=>$arr['NAME']);
					}
				}
				$arProfileParams['OLD_IBLOCK_DATA'] = array('PROPS'=>$arProps);
				$arProfile['PARAMS'] = self::EncodeProfileParams($arProfileParams);
			}
			/*/Save iblock data*/
			
			foreach($arProfile as $k=>$v)
			{
				$arProfile[$k] = base64_encode($v);
			}
			fwrite($handle, base64_encode(serialize($arProfile))."\r\n");
		}
		fclose($handle);
		
		$zipObj = \CBXArchive::GetArchive($tempPath, 'ZIP');
		$zipObj->SetOptions(array(
			"COMPRESS" =>true,
			"ADD_PATH" => false,
			"REMOVE_PATH" => $dir.'/',
		));
		$zipObj->Pack($dir.'/');
		
		foreach($arFiles as $file) unlink($file);
		rmdir($dir);
		
		header('Content-type: application/zip');
		header('Content-Transfer-Encoding: Binary');
		header('Content-length: '.filesize($tempPath));
		header('Content-disposition: attachment; filename="'.basename($tempPath).'"');
		readfile($tempPath);
		
		die();
	}
	
	public function GetProfilesFromBackup($arPFile)
	{
		if(!isset($arPFile) || !is_array($arPFile) || $arPFile['error'] > 0 || $arPFile['size'] < 1)
		{
			return array('TYPE'=>'ERROR', 'MESSAGE'=>Loc::getMessage("ESOL_IX_RESTORE_NOT_LOAD_FILE"));
		}
		$filename = $arPFile['name'];
		if(ToLower(\Bitrix\EsolImportxml\Utils::GetFileExtension($filename))!=='zip')
		{
			return array('TYPE'=>'ERROR', 'MESSAGE'=>Loc::getMessage("ESOL_IX_RESTORE_FILE_NOT_VALID"));
		}
		
		$tempPath = \CFile::GetTempName('', bx_basename($filename));
		$subdir = current(explode('.', $filename));
		if(strlen($subdir)==0) $subdir = 'backup';
		$dir = rtrim(\Bitrix\Main\IO\Path::getDirectory($tempPath), '/').'/'.$subdir;
		\Bitrix\Main\IO\Directory::createDirectory($dir);
		
		$zipObj = \CBXArchive::GetArchive($arPFile['tmp_name'], 'ZIP');
		$zipObj->Unpack($dir.'/');
		
		$arFiles = array(
			'config' => $dir.'/config.txt',
			'data' => $dir.'/data.txt'
		);
		if(!file_exists($arFiles['config']) || !file_exists($arFiles['data']))
		{
			foreach($arFiles as $file) unlink($file);
			rmdir($dir);
			return array('TYPE'=>'ERROR', 'MESSAGE'=>Loc::getMessage("ESOL_IX_RESTORE_FILE_NOT_VALID"));
		}
		
		$profileEntity = $this->GetEntity();
		$encoding = \Bitrix\EsolImportxml\Utils::getSiteEncoding();
		
		$arProfiles = array();
		$arConfig = unserialize(base64_decode(file_get_contents($arFiles['config'])));
		$handle = fopen($arFiles['data'], "r");
		while(!feof($handle))
		{
			$buffer = trim(fgets($handle, 16777216));
			if(strlen($buffer) == 0) continue;			
			$arProfile = unserialize(base64_decode($buffer));
			if(!is_array($arProfile)) continue;
			foreach($arProfile as $k=>$v)
			{
				if(!in_array($k, array('ID', 'NAME')))
				{
					unset($arProfile[$k]);
					continue;
				}
				$v = base64_decode($v);
				if($encoding != $arConfig['encoding'])
				{
					$v = \Bitrix\Main\Text\Encoding::convertEncoding($v, $arConfig['encoding'], $encoding);
				}
				$arProfile[$k] = $v;
			}
			$arProfiles[] = $arProfile;
		}
		fclose($handle);
		foreach($arFiles as $file) unlink($file);
		rmdir($dir);
		
		return array('TYPE'=>'SUCCESS', 'PROFILES'=>$arProfiles);
	}
	
	public function RestoreBackup($arPFile, $arParams)
	{
		if(!isset($arPFile) || !is_array($arPFile) || $arPFile['error'] > 0 || $arPFile['size'] < 1)
		{
			return array('TYPE'=>'ERROR', 'MESSAGE'=>Loc::getMessage("ESOL_IX_RESTORE_NOT_LOAD_FILE"));
		}
		$filename = $arPFile['name'];
		if(ToLower(\Bitrix\EsolImportxml\Utils::GetFileExtension($filename))!=='zip')
		{
			return array('TYPE'=>'ERROR', 'MESSAGE'=>Loc::getMessage("ESOL_IX_RESTORE_FILE_NOT_VALID"));
		}
		
		$tempPath = \CFile::GetTempName('', bx_basename($filename));
		$subdir = current(explode('.', $filename));
		if(strlen($subdir)==0) $subdir = 'backup';
		$dir = rtrim(\Bitrix\Main\IO\Path::getDirectory($tempPath), '/').'/'.$subdir;
		\Bitrix\Main\IO\Directory::createDirectory($dir);
		
		$zipObj = \CBXArchive::GetArchive($arPFile['tmp_name'], 'ZIP');
		$zipObj->Unpack($dir.'/');
		
		$arFiles = array(
			'config' => $dir.'/config.txt',
			'data' => $dir.'/data.txt'
		);
		if(!file_exists($arFiles['config']) || !file_exists($arFiles['data']))
		{
			foreach($arFiles as $file) unlink($file);
			rmdir($dir);
			return array('TYPE'=>'ERROR', 'MESSAGE'=>Loc::getMessage("ESOL_IX_RESTORE_FILE_NOT_VALID"));
		}
		
		$profileEntity = $this->GetEntity();
		$encoding = \Bitrix\EsolImportxml\Utils::getSiteEncoding();
		
		$arIds = array();
		if(is_array($arParams['IDS']) && !empty($arParams['IDS']) && !in_array('ALL', $arParams['IDS']))
		{
			$arIds = $arParams['IDS'];
		}
		
		if($arParams['RESTORE_TYPE']=='REPLACE' && empty($arIds))
		{
			$dbRes = $profileEntity::getList();
			while($arProfile = $dbRes->Fetch())
			{
				$profileEntity::delete($arProfile['ID']);
			}
		}
		
		$arConfig = unserialize(base64_decode(file_get_contents($arFiles['config'])));
		$handle = fopen($arFiles['data'], "r");
		while(!feof($handle))
		{
			$buffer = trim(fgets($handle, 16777216));
			if(strlen($buffer) == 0) continue;			
			$arProfile = unserialize(base64_decode($buffer));
			if(!is_array($arProfile)) continue;
			foreach($arProfile as $k=>$v)
			{
				$v = base64_decode($v);
				if($encoding != $arConfig['encoding'])
				{
					if($k=='PARAMS')
					{
						$v = self::DecodeProfileParams($v);
						$v = \Bitrix\Main\Text\Encoding::convertEncoding($v, $arConfig['encoding'], $encoding);
						$v = self::EncodeProfileParams($v);
					}
					else
					{
						$v = \Bitrix\Main\Text\Encoding::convertEncoding($v, $arConfig['encoding'], $encoding);
					}
				}
				$arProfile[$k] = $v;
			}
			if(!empty($arIds) && !in_array($arProfile['ID'], $arIds)) continue;
			
			if($arParams['RESTORE_TYPE']=='ADD') unset($arProfile['ID']);
			elseif(!empty($arIds))
			{
				if($arOldProfile = $profileEntity::getList(array('select'=>array('ID'), 'filter'=>array('NAME'=>$arProfile['NAME']), 'limit'=>1))->Fetch())
				{
					$profileEntity::delete($arOldProfile['ID']);
					$arProfile['ID'] = $arOldProfile['ID'];
				}
				else unset($arProfile['ID']);
			}
			$dbRes = $profileEntity::add($arProfile);
			/*if(!$dbRes->isSuccess())
			{
				$error = '';
				if($dbRes->getErrors())
				{
					foreach($dbRes->getErrors() as $errorObj)
					{
						$error .= $errorObj->getMessage().'. ';
					}
					$APPLICATION->throwException($error);
				}
			}
			else
			{
				$ID = $dbRes->getId();
			}*/
		}
		fclose($handle);
		foreach($arFiles as $file) unlink($file);
		rmdir($dir);
		
		return array('TYPE'=>'SUCCESS', 'MESSAGE'=>Loc::getMessage("ESOL_IX_RESTORE_SUCCESS"));
	}
}