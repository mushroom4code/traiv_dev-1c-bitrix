<?php
namespace Yandex\Market\Ui\Trading\ShipmentRequest;

use Yandex\Market;

class BoxCollection extends Market\Api\Reference\Collection
{
	public static function getItemReference()
	{
		return Box::class;
	}
}