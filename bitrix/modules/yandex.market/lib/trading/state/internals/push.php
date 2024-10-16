<?php

namespace Yandex\Market\Trading\State\Internals;

use Yandex\Market;
use Bitrix\Main;

class PushTable extends Market\Reference\Storage\Table
{
	public static function getTableName()
	{
		return 'yamarket_trading_state_push';
	}

	public static function getMap()
	{
		return [
			new Main\Entity\IntegerField('SETUP_ID', [
				'required' => true,
				'primary' => true,
			]),
			new Main\Entity\StringField('ENTITY_TYPE', [
				'required' => true,
				'primary' => true,
				'validation' => [__CLASS__, 'getValidationForEntityType'],
			]),
			new Main\Entity\StringField('ENTITY_ID', [
				'required' => true,
				'primary' => true,
				'validation' => [__CLASS__, 'getValidationForEntityId'],
			]),
			new Main\Entity\StringField('VALUE', [
				'required' => true,
			]),
			new Main\Entity\DatetimeField('TIMESTAMP_X', [
				'required' => true,
			]),
			new Main\Entity\DatetimeField('CHECK_STAMP', [
				'required' => true,
			]),
		];
	}

	public static function getValidationForEntityType()
	{
		return [
			new Main\Entity\Validator\Length(null, 8),
		];
	}

	public static function getValidationForEntityId()
	{
		return [
			new Main\Entity\Validator\Length(null, 60),
		];
	}
}