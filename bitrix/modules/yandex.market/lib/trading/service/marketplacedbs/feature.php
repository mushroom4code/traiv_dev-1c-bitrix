<?php
namespace Yandex\Market\Trading\Service\MarketplaceDbs;

use Yandex\Market\Trading\Service as TradingService;

class Feature extends TradingService\Marketplace\Feature
{
	public function supportsDeliveryChoose()
	{
		return true;
	}

	public function supportPaySystemChoose()
	{
		return true;
	}

	public function supportsWarehouses()
	{
		return false;
	}

	public function supportBoxesWithoutItems()
	{
		return true;
	}
}