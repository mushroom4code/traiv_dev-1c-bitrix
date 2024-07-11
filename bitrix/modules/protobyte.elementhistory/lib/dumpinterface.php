<?php

namespace Protobyte\ElementHistory;

interface DumpInterface {
	public static function getArray(array $arFields):array;
	public static function restore(array $arElement):array;
}