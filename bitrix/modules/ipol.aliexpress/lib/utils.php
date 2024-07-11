<?php
namespace Ipol\AliExpress;

use Bitrix\Main\Event;
use Bitrix\Main\EventResult;
use Bitrix\Main\Config\Option;

class Utils
{
	/**
	 * ѕереводит строку из under_score в camelCase
	 * 
	 * @param  string  $string                   строка дл€ преобразовани€
	 * @param  boolean $capitalizeFirstCharacter первый символ строчный или прописной
	 * @return string
	 */
	public static function underScoreToCamelCase($string, $capitalizeFirstCharacter = false)
	{
		// символы разного регистра
		if (/*strtolower($string) != $string
			&&*/ strtoupper($string) != $string
		) {
			return $string;
		}

		$string = strtolower($string);
		$string = str_replace(' ', '', ucwords(str_replace('_', ' ', $string)));

		if (!$capitalizeFirstCharacter) {
			$string[0] = strtolower($string[0]);
		}

		return $string;
	}

	/**
	 * ѕереводит строку из camelCase в under_score
	 * 
	 * @param  string  $string    строка дл€ преобразовани€
	 * @param  boolean $uppercase
	 * @return string
	 */
	public static function camelCaseToUnderScore($string, $uppercase = true)
	{
		// символы разного регистра
		if (strtolower($string) != $string
			&& strtoupper($string) != $string
		) {
			$string = ltrim(strtolower(preg_replace('/[A-Z]/', '_$0', $string)), '_');;
		}		

		if ($uppercase) {
			$string = strtoupper($string);
		}

		return $string;
	}

	/**
	 *  онверирует кодировку
	 * ¬ качестве значений может быть как скал€рный тип, так и массив
	 *
	 * @param mixed $data
	 * @param string $fromEncoding
	 * @param string $toEncoding
	 */
	public static function convertEncoding($data, $fromEncoding, $toEncoding)
	{
		if (is_array($data)) {
			foreach ($data as $key => $value) {
				$data[$key] = static::convertEncoding($value, $fromEncoding, $toEncoding);
			}
		} else {
			$data = iconv($fromEncoding, $toEncoding, $data);
		}

		return $data;
	}

	/**
	 * ¬озвращает свойства заказа дл€ типа платильщика
	 * 
	 * @param  int $personeTypeId
	 * @return array
	 */
	public static function getOrderProps($personeTypeId)
	{
		$rsProps = \CSaleOrderProps::GetList(
			$arOrder  = array('SORT' => 'ASC'),
			$arFilter = array('PERSON_TYPE_ID' => $personeTypeId)
		);

		$result = array();
		while($arProp = $rsProps->Fetch()) {
			$result[] = $arProp;
		}

		return $result;
	}

	/**
	 * ¬озвращает значение св-в заказа
	 * 
	 * @param  int $orderId
	 * @param  int $personeTypeId
	 * @return array
	 */
	public static function getOrderPropsValue($orderId, $personeTypeId = false)
	{}

	/**
	 * ¬озвращает местоположение магазина
	 * 
	 * @return int
	 */
	public static function getSaleLocationId()
	{
		$defaultLocation = \Bitrix\Main\Config\Option::get('sale', 'location', '', ADMIN_SECTION ? 's1' : false);
		$currentLocation = \Bitrix\Main\Config\Option::get(IPOL_ALI_MODULE, 'SENDER_LOCATION', $defaultLocation);

		$arBxLocation = \CSaleLocation::GetByID($currentLocation, "ru");
		if (!$arBxLocation) {
			return false;
		}

		return $arBxLocation['ID'];
	}

	public static function isNeedBreak($start_time)
	{
		$max_time = (ini_get('max_execution_time') ?: 60);
		$max_time = max(min($max_time, 60), 10);

		$max_time = 20;

		return time() >= ($start_time + $max_time - 5);
	}

	/**
	 * ¬озвращает идентификатор или номер заказа в зависимости от настроек модул€
	 * 
	 * @param  array $order
	 * 
	 * @return string
	 */
	public static function getOrderId($order)
	{
		$key = \Bitrix\Main\Config\Option::get(IPOL_ALI_MODULE, 'ORDER_ID', 'ID');

		return $order[$key ?: 'ID'];
	}

	/**
	 * ¬озвращает суммарный вес и объем товаров в заказе
	 * 
	 * @param  array $items             состав заказа
	 * @param  array $defaultDimensions значени€ по умолчанию, если не переданы берутьс€ из настроек модул€
	 * @return array(weight, volume)
	 */
	public static function calcShipmentDimensions(&$items, $defaultDimensions = array())
	{
		$event = new Event(IPOL_ALI_MODULE, "onBeforeDimensionsCount", array(&$items));
		$event->send();

		foreach($event->getResults() as $eventResult) {
			if ($eventResult->getType() != EventResult::SUCCESS) {
				continue;
			}

			$items = array_replace_recursive($items, (array) $eventResult->getParameters());
		}

		$defaultDimensions = $defaultDimensions ?: array(
			'WEIGHT' => Option::get(IPOL_ALI_MODULE, 'WEIGHT'),
			'LENGTH' => Option::get(IPOL_ALI_MODULE, 'LENGTH'),
			'WIDTH'  => Option::get(IPOL_ALI_MODULE, 'WIDTH'),
			'HEIGHT' => Option::get(IPOL_ALI_MODULE, 'HEIGHT'),
		);

		$defaultDimensions['VOLUME'] = $defaultDimensions['WIDTH'] * $defaultDimensions['HEIGHT'] * $defaultDimensions['LENGTH'];
		$useByItem = Option::get(IPOL_ALI_MODULE, 'USE_MODE', 'ORDER') == 'ITEM';
		$useByItem = true;

		if ($items) {
			// получаем габариты одного вида товара в посылке с учетом кол-ва
			foreach ($items as &$item) {
				$item['DIMENSIONS'] = $item["~DIMENSIONS"] ?: $item['DIMENSIONS'];
				if (!is_array($item['DIMENSIONS'])) {
					$item['DIMENSIONS'] = unserialize($item['DIMENSIONS']);
				}

				$item['DIMENSIONS']['WIDTH']  = floatval($item['DIMENSIONS']['WIDTH'])  ?: ($useByItem ? $defaultDimensions['WIDTH']  : 0);
				$item['DIMENSIONS']['HEIGHT'] = floatval($item['DIMENSIONS']['HEIGHT']) ?: ($useByItem ? $defaultDimensions['HEIGHT'] : 0);
				$item['DIMENSIONS']['LENGTH'] = floatval($item['DIMENSIONS']['LENGTH']) ?: ($useByItem ? $defaultDimensions['LENGTH'] : 0);
				$item['WEIGHT']               = floatval($item['WEIGHT'])               ?: ($useByItem ? $defaultDimensions['WEIGHT'] : 0);

				$needCheckWeight = $needCheckWeight || $item['WEIGHT'] <= 0;
				$needCheckVolume = $needCheckVolume || !($item['DIMENSIONS']['WIDTH'] && $item['DIMENSIONS']['HEIGHT'] && $item['DIMENSIONS']['LENGTH']);	
			}
		} else {
			$needCheckWeight = true;
			$needCheckVolume = true;
		}

		$sumDimensions = static::sumDimensions($items);

		if ($needCheckWeight && $sumDimensions['WEIGHT'] < $defaultDimensions['WEIGHT']) {
			$sumDimensions['WEIGHT'] = $defaultDimensions['WEIGHT'];
		}

		if ($needCheckVolume && $sumDimensions['VOLUME'] < $defaultDimensions['VOLUME']) {
			$sumDimensions['WIDTH']  = $defaultDimensions['WIDTH'];
			$sumDimensions['HEIGHT'] = $defaultDimensions['HEIGHT'];
			$sumDimensions['LENGTH'] = $defaultDimensions['LENGTH'];
		}

		return [
			'WIDTH'  => $sumDimensions['WIDTH'],
			'HEIGHT' => $sumDimensions['HEIGHT'],
			'LENGTH' => $sumDimensions['LENGTH'],
			'WEIGHT' => $sumDimensions['WEIGHT'],
		];
	}

	/**
	 * –асчитывает габариты с учетом кол-ва
	 * 
	 * @param  $width
	 * @param  $height
	 * @param  $length
	 * @param  $quantity
	 * 
	 * @return array
	 */
	protected static function calcItemDimensionWithQuantity($width, $height, $length, $quantity)
	{
		$ar = array($width, $height, $length);
		$qty = $quantity;
		sort($ar);

		if ($qty <= 1) {
			return array(
				'X' => $ar[0],
				'Y' => $ar[1],
				'Z' => $ar[2],
			);
		}

		$x1 = 0;
		$y1 = 0;
		$z1 = 0;
		$l  = 0;

		$max1 = floor(Sqrt($qty));
		for ($y = 1; $y <= $max1; $y++) {
			$i = ceil($qty / $y);
			$max2 = floor(Sqrt($i));
			for ($z = 1; $z <= $max2; $z++) {
				$x = ceil($i / $z);
				$l2 = $x*$ar[0] + $y*$ar[1] + $z*$ar[2];
				if ($l == 0 || $l2 < $l) {
					$l = $l2;
					$x1 = $x;
					$y1 = $y;
					$z1 = $z;
				}
			}
		}
		
		return array(
			'X' => $x1 * $ar[0],
			'Y' => $y1 * $ar[1],
			'Z' => $z1 * $ar[2]
		);
	}

	/**
	 * –асчитывает суммарные габариты посылки
	 * 
	 * @param  array $items [description]
	 * @return array
	 */
	protected static function sumDimensions($items)
	{
		$ret = array(
			'WEIGHT' => 0,
			'VOLUME' => 0,
			'LENGTH' => 0,
			'WIDTH'  => 0,
			'HEIGHT' => 0,
		);

		$a = array();
		foreach ($items as $item) {
			$a[] = static::calcItemDimensionWithQuantity(
				$item['DIMENSIONS']['WIDTH'],
				$item['DIMENSIONS']['HEIGHT'],
				$item['DIMENSIONS']['LENGTH'],
				$item['QUANTITY']
			);

			$ret['WEIGHT'] += $item['WEIGHT'] * $item['QUANTITY'];
		}

		$n = count($a);
		if ($n <= 0) { 
			return $ret;
		}

		for ($i3 = 1; $i3 < $n; $i3++) {
			// отсортировать размеры по убыванию
			for ($i2 = $i3-1; $i2 < $n; $i2++) {
				for ($i = 0; $i <= 1; $i++) {
					if ($a[$i2]['X'] < $a[$i2]['Y']) {
						$a1 = $a[$i2]['X'];
						$a[$i2]['X'] = $a[$i2]['Y'];
						$a[$i2]['Y'] = $a1;
					};

					if ($i == 0 && $a[$i2]['Y']<$a[$i2]['Z']) {
						$a1 = $a[$i2]['Y'];
						$a[$i2]['Y'] = $a[$i2]['Z'];
						$a[$i2]['Z'] = $a1;
					}
				}

				$a[$i2]['Sum'] = $a[$i2]['X'] + $a[$i2]['Y'] + $a[$i2]['Z']; // сумма сторон
			}

			// отсортировать грузы по возрастанию
			for ($i2 = $i3; $i2 < $n; $i2++) {
				for ($i = $i3; $i < $n; $i++) {
					if ($a[$i-1]['Sum'] > $a[$i]['Sum']) {
						$a2 = $a[$i];
						$a[$i] = $a[$i-1];
						$a[$i-1] = $a2;
					}
				}
			}

			// расчитать сумму габаритов двух самых маленьких грузов
			if ($a[$i3-1]['X'] > $a[$i3]['X']) {
				$a[$i3]['X'] = $a[$i3-1]['X'];
			}

			if ($a[$i3-1]['Y'] > $a[$i3]['Y']) { 
				$a[$i3]['Y'] = $a[$i3-1]['Y'];
			}

			$a[$i3]['Z'] = $a[$i3]['Z'] + $a[$i3-1]['Z'];
			$a[$i3]['Sum'] = $a[$i3]['X'] + $a[$i3]['Y'] + $a[$i3]['Z']; // сумма сторон
		}

		return array_merge($ret, array(
			'LENGTH' => $length = Round($a[$n-1]['X'], 2),
			'WIDTH'  => $width  = Round($a[$n-1]['Y'], 2),
			'HEIGHT' => $height = Round($a[$n-1]['Z'], 2),
			'VOLUME' => $width * $height * $length,
		));
	}
}