<?php

namespace Protobyte\ElementHistory;
use Bitrix\Main\Type\DateTime;


class DumpIBlockElement implements DumpInterface {

	public static function getArray( array $arFields ): array {
		\Bitrix\Main\Loader::includeModule('iblock');
		$allFields = self::getAllFields( $arFields );
        self::prepareData($allFields);
        return $allFields;
	}

    public static function restore(array $arElement):array{
	    $arElement = self::processingFields($arElement);

        $el = new \CIBlockElement;
        unset($arElement["DATA"]["PREVIEW_PICTURE"]);
        unset($arElement["DATA"]['DETAIL_PICTURE']);
        if($arElement["DELETED"]=="N"){
            if( !$res = $el->Update($arElement["ELEMENT_ID"], $arElement["DATA"]) ){
	            return ["status"=>"error", "text"=>$el->LAST_ERROR];
            }
        }else{
            $arElement["DATA"]["IBLOCK_ID"]=$arElement["IBLOCK_ID"];
            if( !$ID = $el->Add($arElement["DATA"]) ){
                return ["status"=>"error", "text"=>$el->LAST_ERROR];
            }
        }
	    return ["status"=>"ok"];
    }

	/**
	 * Подготавливаем поле DATA для импорта. Убираем не измененные значения
	 *
	 * @param array $arElement
	 *
	 * @return array
	 */
	private static function processingFields(array $arElement){
		$arCurrent = self::getArray([ "IBLOCK_ID" => $arElement["IBLOCK_ID"], "ID" => $arElement["ELEMENT_ID"]]);
		foreach ( $arElement["DATA"] as $key=>$value){
			if($key!="PROPERTY_VALUES" && $value == $arCurrent["DATA"][$key]) {
				unset( $arElement["DATA"][$key]);
				continue;
			}
		}

        return $arElement;
	}

	private static function getAllFields( array $elementFields ): array{
        $arFilter = [];
        if (isset($elementFields["IBLOCK_ID"])) $arFilter["=IBLOCK_ID"]=$elementFields["IBLOCK_ID"];
        if (isset($elementFields["ID"])) $arFilter["=ID"]=$elementFields["ID"];
		$res = \CIBlockElement::GetList([], $arFilter );
		if ($ob = $res->GetNextElement()){
			$arFields = $ob->GetFields();
			$arProps = $ob->GetProperties();
		}
		$result = array(
			"ELEMENT_ID" => $arFields["~ID"],
			"IBLOCK_ID" => $arFields["~IBLOCK_ID"],
			"TIMESTAMP" => DateTime::createFromTimestamp($arFields["~TIMESTAMP_X_UNIX"]),
			"MODIFIED_BY" => $arFields["~MODIFIED_BY"],
			"TYPE" => "IBLOCK_ELEMENT",
			"DELETED" => "N",
			"NAME" => $arFields["~NAME"],
			"DATA"=> $arFields
		);
		$result["DATA"]["PROPERTY_VALUES"] = $arProps;

        $ar_sections= [];
        $db_sections = \CIBlockElement::GetElementGroups($elementFields["ID"], true);
        while($ar_section = $db_sections->Fetch()) $ar_sections[] = $ar_section["ID"];
        $result["DATA"]["~IBLOCK_SECTION"] = $result["DATA"]["IBLOCK_SECTION"] = $ar_sections;

        return $result;
	}

	private static function prepareData (array &$allFields){
		$fields = array(
			"CODE",
			"XML_ID",
			"NAME",
			"IBLOCK_SECTION_ID",
			"IBLOCK_SECTION",
			"ACTIVE",
			"ACTIVE_FROM",
			"ACTIVE_TO",
			"SORT",
			"PREVIEW_PICTURE",
			"PREVIEW_TEXT",
			"PREVIEW_TEXT_TYPE",
			"DETAIL_PICTURE",
			"DETAIL_TEXT",
			"DETAIL_TEXT_TYPE",
			"DATE_CREATE",
			"CREATED_BY",
			"TIMESTAMP_X",
			"MODIFIED_BY",
			"TAGS",
			"PROPERTY_VALUES",
		);
		if (isset($allFields["DATA"])){
			// оставляем только необходимые поля
			foreach ($allFields["DATA"] as $key => $field){
				if($key == "PROPERTY_VALUES") continue;
				if (!in_array($key, $fields) && !in_array("~" . $key, $fields)) {
					unset($allFields["DATA"][$key]);
					unset($allFields["DATA"]["~".$key]);
				} else {
					$allFields["DATA"][$key] = $allFields["DATA"]["~".$key];
					unset($allFields["DATA"]["~".$key]);
				}
			}
			// пользовательские свойства
			$props = array();
			foreach ($allFields["DATA"]["PROPERTY_VALUES"] as $property){
                switch ($property["PROPERTY_TYPE"]) {
                    case "L":
                        $props[$property["ID"]] = $property["VALUE_ENUM_ID"];
                        break;

                    default:
                        $props[$property["ID"]] = $property["~VALUE"];
                }
			}
			$allFields["DATA"]["PROPERTY_VALUES"] = $props;
		}
	}
}
