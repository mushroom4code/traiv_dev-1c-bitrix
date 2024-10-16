<?php

namespace Yandex\Market\Trading\State;

use Bitrix\Main;
use Yandex\Market;

class OrderData
{
	const JSON_PREFIX = 'json:';
	const DATE_PREFIX = 'date:';
	const DATE_TIME_PREFIX = 'dateTime:';

	protected static $cache = [];

	public static function searchOrders($serviceUniqueKey, $name, $value)
	{
		$result = [];

		$query = Internals\DataTable::getList([
			'filter' => [
				'=SERVICE' => $serviceUniqueKey,
				'=NAME' => $name,
				'=VALUE' => $value,
			],
			'select' => [ 'ENTITY_ID' ],
		]);

		while ($row = $query->fetch())
		{
			$result[] = $row['ENTITY_ID'];
		}

		return $result;
	}

	public static function getValue($serviceUniqueKey, $orderId, $name)
	{
		$rows = static::getRows($serviceUniqueKey, $orderId);
		$value = static::findRowValue($rows, $name, 'VALUE');

		return static::unpackValue($value);
	}

	public static function setValue($serviceUniqueKey, $orderId, $name, $value)
	{
		static::setValues($serviceUniqueKey, $orderId, [
			$name => $value,
		]);
	}

	public static function getValues($serviceUniqueKey, $orderId)
	{
		$rows = static::getRows($serviceUniqueKey, $orderId);
		$values = array_column($rows, 'VALUE', 'NAME');

		return static::unpackValues($values);
	}

	protected static function rawValues($serviceUniqueKey, $orderId)
	{
		$rows = static::getRows($serviceUniqueKey, $orderId);

		return array_column($rows, 'VALUE', 'NAME');
	}

	/**
	 * @param string $serviceUniqueKey
	 * @param int $orderId
	 * @param string $name
	 *
	 * @return Main\Type\DateTime|null
	 */
	public static function getTimestamp($serviceUniqueKey, $orderId, $name)
	{
		$rows = static::getRows($serviceUniqueKey, $orderId);

		return static::findRowValue($rows, $name, 'TIMESTAMP_X');
	}

	/**
	 * @param string $serviceUniqueKey
	 * @param int $orderId
	 *
	 * @return array<string, Main\Type\DateTime>
	 */
	public static function getTimestamps($serviceUniqueKey, $orderId)
	{
		$rows = static::getRows($serviceUniqueKey, $orderId);

		return array_column($rows, 'TIMESTAMP_X', 'NAME');
	}

	protected static function findRowValue($rows, $name, $key)
	{
		$result = null;

		foreach ($rows as $row)
		{
			if ($row['NAME'] !== $name) { continue; }

			$result = $row[$key];
			break;
		}

		return $result;
	}

	protected static function getRows($serviceUniqueKey, $orderId)
	{
		$key = static::makeCachedKey($serviceUniqueKey, $orderId);

		if (!isset(static::$cache[$key]))
		{
			static::$cache[$key] = static::fetchRows($serviceUniqueKey, $orderId);
		}

		return static::$cache[$key];
	}

	protected static function fetchRows($serviceUniqueKey, $orderId)
	{
		$result = [];

		$query = Internals\DataTable::getList([
			'filter' => [
				'=SERVICE' => $serviceUniqueKey,
				'=ENTITY_ID' => $orderId,
			],
			'select' => [
				'NAME',
				'VALUE',
				'TIMESTAMP_X',
			],
		]);

		while ($row = $query->fetch())
		{
			$result[] = $row;
		}

		return $result;
	}

	public static function setValues($serviceUniqueKey, $orderId, $values)
	{
		if (empty($values)) { return; }

		$values = static::packValues($values);
		$stored = static::getValues($serviceUniqueKey, $orderId);
		$exists = array_intersect_key($values, $stored);
		$delete = array_filter($values, static function($value) {
			return $value === null || (is_scalar($value) && (string)$value === '');
		});
		$update = array_diff_key($exists, $delete);
		$new = array_diff_key($values, $stored);
		$new = array_diff_key($new, $delete);
		$delete = array_intersect_key($delete, $stored);

		static::applyAdd($serviceUniqueKey, $orderId, $new);
		static::applyUpdate($serviceUniqueKey, $orderId, $update);
		static::applyDelete($serviceUniqueKey, $orderId, array_keys($delete));
		static::modifyCached($serviceUniqueKey, $orderId, $values);
	}

	protected static function applyAdd($serviceUniqueKey, $orderId, $values)
	{
		foreach ($values as $name => $value)
		{
			$addResult = Internals\DataTable::add([
				'SERVICE' => $serviceUniqueKey,
				'ENTITY_ID' => $orderId,
				'NAME' => $name,
				'VALUE' => $value,
				'TIMESTAMP_X' => new Main\Type\DateTime(),
			]);

			Market\Result\Facade::handleException($addResult);
		}
	}

	protected static function applyUpdate($serviceUniqueKey, $orderId, $values)
	{
		foreach ($values as $name => $value)
		{
			$updateResult = Internals\DataTable::update(
				[
					'SERVICE' => $serviceUniqueKey,
					'ENTITY_ID' => $orderId,
					'NAME' => $name,
				],
				[
					'VALUE' => $value,
					'TIMESTAMP_X' => new Main\Type\DateTime(),
				]
			);

			Market\Result\Facade::handleException($updateResult);
		}
	}

	protected static function applyDelete($serviceUniqueKey, $orderId, $names)
	{
		foreach ($names as $name)
		{
			$deleteResult = Internals\DataTable::delete([
				'SERVICE' => $serviceUniqueKey,
				'ENTITY_ID' => $orderId,
				'NAME' => $name,
			]);

			Market\Result\Facade::handleException($deleteResult);
		}
	}

	protected static function modifyCached($serviceUniqueKey, $orderId, $values)
	{
		$key = static::makeCachedKey($serviceUniqueKey, $orderId);

		if (!isset(static::$cache[$key])) { static::$cache[$key] = []; }

		$timestamp = new Main\Type\DateTime();
		$found = [];

		// exists

		foreach (static::$cache[$key] as &$row)
		{
			$name = $row['NAME'];

			if (!isset($values[$name])) { continue; }

			$row['VALUE'] = $values[$name];
			$row['TIMESTAMP_X'] = $timestamp;
			$found[$name] = true;
		}
		unset($row);

		// new

		foreach ($values as $name => $value)
		{
			if (isset($found[$name])) { continue; }

			static::$cache[$key][] = [
				'NAME' => $name,
				'VALUE' => $value,
				'TIMESTAMP_X' => $timestamp,
			];
		}
	}

	protected static function makeCachedKey($serviceUniqueKey, $orderId)
	{
		return $serviceUniqueKey . ':' . $orderId;
	}

	protected static function unpackValues(array $values)
	{
		foreach ($values as &$value)
		{
			$value = static::unpackValue($value);
		}
		unset($value);

		return $values;
	}

	protected static function unpackValue($value)
	{
		if (!is_string($value)) { return $value; }

		if (mb_strpos($value, self::DATE_TIME_PREFIX) === 0)
		{
			$value = mb_substr($value, mb_strlen(self::DATE_TIME_PREFIX));
			$value = new Main\Type\DateTime($value, Market\Data\DateTime::FORMAT_DEFAULT_FULL);
		}
		else if (mb_strpos($value, self::DATE_PREFIX) === 0)
		{
			$value = mb_substr($value, mb_strlen(self::DATE_PREFIX));
			$value = new Main\Type\Date($value, Market\Data\DateTime::FORMAT_DEFAULT_SHORT);
		}
		else if (mb_strpos($value, self::JSON_PREFIX) === 0)
		{
			$value = mb_substr($value, mb_strlen(self::JSON_PREFIX));
			$value = Main\Web\Json::decode($value);
		}

		return $value;
	}

	protected static function packValues(array $values)
	{
		foreach ($values as &$value)
		{
			if ($value instanceof Main\Type\DateTime)
			{
				$value = self::DATE_TIME_PREFIX . $value->format(Market\Data\DateTime::FORMAT_DEFAULT_FULL);
			}
			else if ($value instanceof Main\Type\Date)
			{
				$value = self::DATE_PREFIX . $value->format(Market\Data\Date::FORMAT_DEFAULT_SHORT);
			}
			else if ($value !== null && !is_scalar($value))
			{
				$value = self::JSON_PREFIX . Main\Web\Json::encode($value);
			}
		}
		unset($value);

		return $values;
	}
}