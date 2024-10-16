<?
namespace Arturgolubev\Smartsearch;

use \Arturgolubev\Smartsearch\Unitools as Tools;

class SearchComponent {
	public $options = array(); 
	public $baseQuery = false; 
	public $query = false; 
	public $system_mode = false; 
	
	public function baseInit($q, $type = ''){
		$this->options['debug'] = Tools::getSetting('debug');
		
		$this->options['theme_class'] = Tools::getSetting('color_theme', 'blue');
		$this->options['theme_color'] = Tools::getSetting('my_color_theme');
		
		$this->options['use_clarify'] = (Tools::getSetting('clarify_section') == "Y");
		$this->options['use_guessplus'] = (Tools::getSetting("mode_guessplus") == "Y");
				
		if($type == 'page'){
			$this->options['mode'] = Tools::getSetting("mode_spage");
		}elseif($type == 'title'){
			$this->options['theme_placeholder'] = Tools::getSetting('input_search_placeholder');
			
			$this->options['mode'] = Tools::getSetting("mode_stitle");
		}
		
		if($q){
			$this->baseQuery = $q;
			
			foreach(GetModuleEvents(\CArturgolubevSmartsearch::MODULE_ID, "onBeforePrepareQuery", true) as $arEvent)
				ExecuteModuleEventEx($arEvent, array(&$q));
			
			$q = \CArturgolubevSmartsearch::checkReplaceRules($q);
			$q = \CArturgolubevSmartsearch::prepareQuery($q);
			$q = \CArturgolubevSmartsearch::clearExceptionsWords($q);
			
			$this->query = $q;
		}
	}
	
	
	public $folderPath = '';
	public function searchRowPrepare($ar){
		if(!$this->system_mode){
			global $APPLICATION;
			
			$ar["CHAIN_PATH"] = $APPLICATION->GetNavChain($ar["URL"], 0, $this->folderPath."/chain_template.php", true, false);
			$ar["URL"] = htmlspecialcharsbx($ar["URL"]);
			$ar["TAGS"] = array();
			if (!empty($ar["~TAGS_FORMATED"]))
			{
				foreach ($ar["~TAGS_FORMATED"] as $name => $tag)
				{
					if($arParams["TAGS_INHERIT"] == "Y")
					{
						$arTags = $arResult["REQUEST"]["~TAGS_ARRAY"];
						$arTags[$tag] = $tag;
						$tags = implode("," , $arTags);
					}
					else
					{
						$tags = $tag;
					}
					$ar["TAGS"][] = array(
						"URL" => $APPLICATION->GetCurPageParam("tags=".urlencode($tags), array("tags")),
						"TAG_NAME" => htmlspecialcharsex($name),
					);
				}
			}
		}
		
		return $ar;
	}
}