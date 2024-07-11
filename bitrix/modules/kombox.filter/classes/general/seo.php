<?php
namespace Kombox\Filter;
use Bitrix\Main\Localization\Loc;

IncludeModuleLangFile(__FILE__);

class Seo{
	private $arResult = array();
	
	function __construct($arResult) {
		$this->arResult = $arResult;
	}
	
	public static function showText($default_text = ""){
		global $APPLICATION; 
		$APPLICATION->AddBufferContent(Array("Kombox\Filter\Seo", "getText"), $default_text); 
	}
	
	public static function getText($default_text = ""){
		$text = $GLOBALS['KOMBOX_SEO']['TEXT'];
		$type = $GLOBALS['KOMBOX_SEO']['TEXT_TYPE'];
		
		if(strlen($text))
			$text = FormatText($text, $type);
		else
			$text = $default_text;
		
		return $text;
	}
	
	public function set(){
		global $APPLICATION;
		
		$rsRules = \Kombox\Filter\SeoTable::getList(array(
			'filter' => array('IBLOCK_ID' => $this->arResult['IBLOCK_ID'], '=SECTION_ID' => (int)$this->arResult['SECTION_ID'], 'ACTIVE' => 'Y')
		));

		$arCheckRule = array();
		$ruleScore = 0;
		
		while($arRule = $rsRules->Fetch()){
			$check = self::checkRule($arRule);

			if($check > $ruleScore){
				$arCheckRule = $arRule;
				$ruleScore = $check;
			}
		}
		
		if(empty($arCheckRule)){
			$rsRules = \Kombox\Filter\SeoTable::getList(array(
				'filter' => array('IBLOCK_ID' => $this->arResult['IBLOCK_ID'], '=SECTION_ID' => false, 'ACTIVE' => 'Y')
			));
			
			$ruleScore = 0;
			
			while($arRule = $rsRules->Fetch()){

				$check = self::checkRule($arRule);

				if($check > $ruleScore){
					$arCheckRule = $arRule;
					$ruleScore = $check;
				}
			}
		}

		if(!empty($arCheckRule))
		{
			$seo = self::compile($arCheckRule);

			$APPLICATION->SetTitle($seo['H1']);
			$APPLICATION->SetPageProperty("title", $seo['TITLE']);
			$APPLICATION->SetPageProperty("description", $seo['DESCRIPTION']);
			$APPLICATION->SetPageProperty("keywords", $seo['KEYWORDS']);
			
			$GLOBALS['KOMBOX_SEO'] = $seo;
		}
	}
	
	private function checkRule(&$arRule){
		$score = 0;
		
		$rsRuleProperties = \Kombox\Filter\SeoPropertiesTable::getList(array(
			'filter' => array('=RULE_ID' => $arRule['ID'])
		));
		
		while($arRuleProperties = $rsRuleProperties->Fetch())
		{
			$id = $arRuleProperties['PROPERTY_ID'];
			if(!isset($arProperties[$id]))
				$arProperties[$id] = array();
				
			if(strlen($arRuleProperties['VALUE'])){
				if(!isset($arProperties[$id]['VALUES']))
					$arProperties[$id]['VALUES'] = array();
				
				$arProperties[$id]['VALUES'][] = $arRuleProperties['VALUE'];
			}
			elseif(strlen($arRuleProperties['NUM_FROM']))
				$arProperties[$id]['FROM'] = $arRuleProperties['NUM_FROM'];
			elseif(strlen($arRuleProperties['NUM_TO']))
				$arProperties[$id]['TO'] = $arRuleProperties['NUM_TO'];
				
		}
		
		$arRule['PROPERTIES'] = $arProperties;
		
		foreach($arProperties as $ID => $arProperty){
			if(empty($arProperty))
			{
				if(!isset($this->arResult['CHECKED'][$ID])){
					return 0;
				}
				else
					$score += 1;
			}
			elseif(is_array($arProperty['VALUES']))
			{
				$arValues = array();
				
				foreach($this->arResult['ITEMS'][$ID]['VALUES'] as $key => $arValue){
					if($arValue['CHECKED'] == 1){
						if(isset($arValue['VALUE_ID']))
							$arValues[] = $arValue['VALUE_ID'];
						else
							$arValues[] = $key;
					}
				}
				
				if(count(array_intersect($arValues, $arProperty['VALUES'])) != count($arProperty['VALUES'])){
					return 0;
				}
				else
					$score += 2;
			}
			elseif(isset($arProperty['FROM']) && isset($arProperty['TO'])){
				if(
					$this->arResult['ITEMS'][$ID]['VALUES']['MIN']['VALUE'] <= $arProperty['FROM'] &&
					$this->arResult['ITEMS'][$ID]['VALUES']['MAX']['VALUE'] >= $arProperty['TO']
				)
					$score += 2;
				else{
					return 0;
				}
			}
			elseif(isset($arProperty['FROM'])){
				if(
					$this->arResult['ITEMS'][$ID]['VALUES']['MIN']['VALUE'] <= $arProperty['FROM']
				)
					$score += 2;
				else{
					return 0;
				}
			}
			elseif(isset($arProperty['TO'])){
				if(
					$this->arResult['ITEMS'][$ID]['VALUES']['MAX']['VALUE'] >= $arProperty['TO']
				)
					$score += 2;
				else
					return 0;
			}
		}
		
		return $score;
	}
	
	private function compile($arRule){
		$arTemplates = array();
		foreach($arRule['PROPERTIES'] as $ID => $value){
			$value = '';
			$code = $this->arResult['ITEMS'][$ID]['CODE'];
			if($this->arResult['ITEMS'][$ID]['PROPERTY_TYPE'] == 'N' || $this->arResult['ITEMS'][$ID]['PRICE']){
				if(isset($this->arResult['CHECKED'][$ID][0]))
					$this->arResult['CHECKED'][$ID][0] = Loc::getMessage('KOMBOX_MODULE_FILTER_SEO_TEMPLATE_FROM').' '.$this->arResult['CHECKED'][$ID][0];
					
				if(isset($this->arResult['CHECKED'][$ID][1]))
					$this->arResult['CHECKED'][$ID][1] = Loc::getMessage('KOMBOX_MODULE_FILTER_SEO_TEMPLATE_TO').' '.$this->arResult['CHECKED'][$ID][1];
					
				$value = implode(' ', $this->arResult['CHECKED'][$ID]);
			}
			else{
				$vals = array();
				foreach($this->arResult['ITEMS'][$ID]['VALUES'] as $val){
					if($val['CHECKED'])
						$vals[] = $val['VALUE'];
				}
				$value = implode(', ', $vals);
			}
				
			$arTemplates['#'.$code.'#'] = $value;
		}
		
		$keys = array_keys($arTemplates);
		
		return array(
			'H1' => str_replace($keys, $arTemplates, $arRule['H1']),
			'TITLE' => str_replace($keys, $arTemplates, $arRule['TITLE']),
			'DESCRIPTION' => str_replace($keys, $arTemplates, $arRule['DESCRIPTION']),
			'KEYWORDS' => str_replace($keys, $arTemplates, $arRule['KEYWORDS']),
			'TEXT' => str_replace($keys, $arTemplates, $arRule['TEXT']),
			'TEXT_TYPE' => $arRule['TEXT_TYPE']
		);
	}
}
?>