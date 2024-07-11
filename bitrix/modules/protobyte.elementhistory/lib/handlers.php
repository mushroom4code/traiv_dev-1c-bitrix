<?php

namespace Protobyte\ElementHistory;

class Handlers {
	static public function OnBeforeIBlockElementUpdate(&$arFields){
		$arDump = DumpIBlockElement::getArray($arFields);
		$dump = new Dump($arDump);
		$dump->save();
	}
    static public function OnBeforeIBlockElementDelete($id){
        $arFields["ID"] = $id;
        $arDump = DumpIBlockElement::getArray($arFields);
        $arDump["DELETED"]="Y";
        $dump = new Dump($arDump);
        $dump->save();
    }
}