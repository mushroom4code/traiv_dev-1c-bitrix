<?php
namespace Ipolh\SDEK\Bitrix;

class Tools{
	private static $MODULE_ID  = IPOLH_SDEK;
	private static $MODULE_LBL = IPOLH_SDEK_LBL;

    // COMMON
    static function getMessage($code,$forseUTF=false)
    {
        $mess = GetMessage('IPOLSDEK_'.$code);
        if($forseUTF){
            $mess = \sdekHelper::zajsonit($mess);
        }
        return $mess;
    }

	static public function placeErrorLabel($content,$header=false)
	{?>
		<tr><td colspan='2'>
			<div class="adm-info-message-wrap adm-info-message-red">
				<div class="adm-info-message">
					<?php if($header){ ?><div class="adm-info-message-title"><?=$header?></div><?php } ?>
					<?=$content?>
					<div class="adm-info-message-icon"></div>
				</div>
			</div>
		</td></tr>
	<?php }

	static public function placeWarningLabel($content,$header=false,$heghtLimit=false,$click=false)
	{?>
		<tr><td colspan='2'>
			<div class="adm-info-message-wrap">
				<div class="adm-info-message" style='color: #000000'>
					<?php if($header){ ?><div class="adm-info-message-title"><?=$header?></div><?php } ?>
					<?php if($click){ ?><input type="button" <?=($click['id'] ? 'id="'.self::$MODULE_LBL.$click['id'].'"' : '')?> onclick='<?=$click['action']?>' value="<?=$click['name']?>"/><?php } ?>
						<div <?php if($heghtLimit){ ?>style="max-height: <?=$heghtLimit?>px; overflow: auto;"<?php } ?>>
						<?=$content?>
					</div>
				</div>
			</div>
		</td></tr>
	<?php }

    static public function isB24()
    {
        return (\COption::GetOptionString('sale','~IS_SALE_CRM_SITE_MASTER_FINISH','N') === 'Y');
    }

    static public function getB24URLs()
    {
        return array (
            'ORDER' => '/shop/orders/details/',
            'SHIPMENT' => '/shop/orders/shipment/details/',
        );
    }

    static public function isConverted()
    {
        return (\COption::GetOptionString("main","~sale_converted_15",'N') == 'Y');
    }


    // OPTIONS
    static function placeFAQ($code){?>
        <a class="ipol_header" onclick="$(this).next().toggle(); return false;"><?=self::getMessage('FAQ_'.$code.'_TITLE')?></a>
        <div class="ipol_inst"><?=self::getMessage('FAQ_'.$code.'_DESCR')?></div>
    <?php }

    static function placeHint($code){?>
        <div id="pop-<?=$code?>" class="<?=self::$MODULE_LBL?>b-popup" style="display: none; ">
            <div class="<?=self::$MODULE_LBL?>pop-text"><?=self::getMessage("HELPER_".$code)?></div>
            <div class="<?=self::$MODULE_LBL?>close" onclick="$(this).closest('.<?=self::$MODULE_LBL?>b-popup').hide();"></div>
        </div>
    <?php }

    /**
     * @param $code
     * makes da heading, FAQ und send command to establish included options
     */
    static function placeOptionBlock($code,$isHidden=false)
    {
        global $arAllOptions;
        ?>
        <tr class="heading"><td colspan="2" valign="top" align="center" <?=($isHidden) ? "class='".self::$MODULE_LBL."headerLink' onclick='".self::$MODULE_LBL."setups.getPage(\"main\").showHidden($(this))'" : ''?>><?=self::getMessage("HDR_".$code)?></td></tr>
        <?php if(self::getMessage('FAQ_' . $code . '_TITLE')) { ?>
            <tr><td colspan="2"><?php self::placeFAQ($code) ?></td></tr>
        <?php }
        /*if(Logger::getLogInfo($code)){
            self::placeWarningLabel(Logger::toOptions($code),self::getMessage("WARNING_".$code),150,array('name'=>Tools::getMessage('LBL_CLEAR'),'action'=>'IPONY_setups.getPage("main").clearLog("'.$code.'")','id'=>'clear'.$code));
        }*/
        if(array_key_exists($code,$arAllOptions)) {
            ShowParamsHTMLByArray($arAllOptions[$code], $isHidden);

            $collection = \Ipolh\SDEK\option::collection();
            foreach ($arAllOptions[$code] as $arOption){
                if(
                    array_key_exists($arOption[0],$collection) &&
                    $collection[$arOption[0]]['hasHint'] == 'Y'
                ){
                    self::placeHint($arOption[0]);
                }
            }
        }
    }

    /**
     * @param $name
     * @param $val
     * Draws tr-td. That's all. Bwahahahaha.
     */
    static function placeOptionRow($name, $val){
        if($name){?>
            <tr>
                <td width='50%' class='adm-detail-content-cell-l'><?=$name?></td>
                <td width='50%' class='adm-detail-content-cell-r'><?=$val?></td>
            </tr>
        <?php } else { ?>
            <tr><td colspan = '2' style='text-align: center'><?=$val?></td></tr>
        <?php } ?>
    <?php }

    static function defaultOptionPath()
    {
        return "/bitrix/modules/".self::$MODULE_ID."/optionsInclude/";
    }

    static function sdekLinkForShipment($shipment, $shipId = false, $anyDelServ = false) //use $anyDelServ = true to add SDEK tracking link to every order that has SDEK tracknumber
    {

        if (isset($shipment['ORDER_ID']) && isset($shipment['DELIVERY_ID']))
        {
            if($anyDelServ || \sdekHelper::defineDelivery($shipment['DELIVERY_ID']))
            {
                if($shipId)
                {
                    $req = \sdekdriver::GetByOI($shipId, 'shipment');
                    if(!isset($req['SDEK_ID'])) return false;
                    else return \Ipolh\SDEK\SDEK\Tools::getTrackLink($req['SDEK_ID']);
                }
                else
                {
                    $req = \sdekdriver::GetByOI($shipment['ORDER_ID']);
                    if(!isset($req['SDEK_ID'])) return false;
                    else return \Ipolh\SDEK\SDEK\Tools::getTrackLink($req['SDEK_ID']);
                }
            }
        }

        return false;
    }

    static function isModuleAjaxRequest()
    {
        return (array_key_exists('isdek_action',$_REQUEST)&& $_REQUEST['isdek_action']);
    }


    /**
     * @param $handle
     * @return mixed
     * ����������� ������ �� ��������� ����� � utf-8
     */
    public static function encodeToUTF8($handle){
        if(LANG_CHARSET !== 'UTF-8') {
            if (is_array($handle)) {
                foreach ($handle as $key => $val) {
                    unset($handle[$key]);
                    $key          = self::encodeToUTF8($key);
                    $handle[$key] = self::encodeToUTF8($val);
                }
            } elseif (is_object($handle)){
                $arCorresponds = array(); // why = because
                foreach($handle as $key => $val){
                    $arCorresponds[$key] = array('utf_key' => self::encodeToUTF8($key), 'utf_val' => self::encodeToUTF8($val));
                }
                foreach($arCorresponds as $key => $new)
                {
                    unset($handle->$key);
                    $utf_key = $new['utf_key'];
                    $handle->$utf_key = $new['utf_val'];
                }
            }else {
                $handle = $GLOBALS['APPLICATION']->ConvertCharset($handle, LANG_CHARSET, 'UTF-8');
            }
        }
        return $handle;
    }

    /**
     * @param $handle
     * @return mixed
     * ����������� ������ �� utf-8 � ��������� �����
     */
    public static function encodeFromUTF8($handle){
        if(LANG_CHARSET !== 'UTF-8'){
            if(is_array($handle)) {
                foreach ($handle as $key => $val) {
                    unset($handle[$key]);
                    $key          = self::encodeFromUTF8($key);
                    $handle[$key] = self::encodeFromUTF8($val);
                }
            } elseif (is_object($handle)){
                $arCorresponds = array();
                foreach($handle as $key => $val){
                    $arCorresponds[$key] = array('site_encode_key' => self::encodeFromUTF8($key), 'site_encode_val' => self::encodeFromUTF8($val));
                }
                foreach($arCorresponds as $key => $new)
                {
                    unset($handle->$key);
                    $site_encode_key = $new['site_encode_key'];
                    $handle->$site_encode_key = $new['site_encode_val'];
                }
            } else {
                $handle = $GLOBALS['APPLICATION']->ConvertCharset($handle, 'UTF-8', LANG_CHARSET);
            }
        }
        return $handle;
    }

    public static function getLogContentMindingSize($path,$maxSize = 1000000000){
        $contents = '';

        if(file_exists($path)) {
            if (filesize($path) > $maxSize) {
                $cont = file_get_contents($path);
                $cont = substr($cont, strlen($cont) / 2);
                file_put_contents($path,$cont);
            }
            $contents = file_get_contents($path);
        }

        return $contents;
    }
}
?>