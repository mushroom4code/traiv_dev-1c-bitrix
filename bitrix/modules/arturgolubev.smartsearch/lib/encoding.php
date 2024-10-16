<?
namespace Arturgolubev\Smartsearch; //2.1.0

class Encoding {
	static function toLower($q){
		return (defined("BX_UTF")) ? mb_strtolower($q) : strtolower($q);
	}
	
	static function exStrlen($s1){
		return (defined("BX_UTF")) ? mb_strlen($s1) : strlen($s1);
	}
	
	static function exStrpos($s1, $s2){
		return (defined("BX_UTF")) ? mb_strpos($s1, $s2) : strpos($s1, $s2);
	}
	
	static function exStripos($s1, $s2){
		return (defined("BX_UTF")) ? mb_stripos($s1, $s2) : stripos($s1, $s2);
	}
	
	static function exStrrpos($s1, $s2){
		return (defined("BX_UTF")) ? mb_strrpos($s1, $s2) : strrpos($s1, $s2);
	}
	
	static function exStrstr($s1, $s2){
		return (defined("BX_UTF")) ? mb_strstr($s1, $s2) : strstr($s1, $s2);
	}
	
	static function exSubstr($s1, $s2, $s3 = null){
		return (defined("BX_UTF")) ? mb_substr($s1, $s2, $s3) : substr($s1, $s2, $s3);
	}
}