<?php

namespace Protobyte\ElementHistory;
use Protobyte\ElementHistory\DataTable;

class Dump {
	private $arDump = array();

	public function __construct($arDump=[]) {
		$this->arDump = $arDump;
	}

	public function save(){
		$rows = DataTable::getList(array(
			"select"=>array("ID"),
			"filter"=>array(
				"ELEMENT_ID"=>$this->arDump["ELEMENT_ID"],
				"IBLOCK_ID"=>$this->arDump["IBLOCK_ID"],
				"TYPE"=>$this->arDump["TYPE"],
			),
			"order"=>array('ID'=>"ASC")
		))->fetchAll();
		if (count($rows)>3) DataTable::delete($rows[0]["ID"]);
		DataTable::add(	$this->arDump );
	}

    public function getById($id){
        $res = DataTable::getById($id);
        if ( $this->arDump = $res->fetch() ) return $this;
        return false;
    }

    public function restore(){
        $arOutput = array();
        if ($this->arDump["TYPE"]=="IBLOCK_ELEMENT"){
            $arOutput = \Protobyte\ElementHistory\DumpIBlockElement::restore($this->arDump);
        }
        // delete old item
        if($arOutput["status"]=="ok") DataTable::delete($this->arDump["ID"]);
        return $arOutput;
    }


}