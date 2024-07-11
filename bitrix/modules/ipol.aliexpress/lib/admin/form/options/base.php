<?php
namespace Ipol\AliExpress\Admin\Form\Options;

use Bitrix\Main\Result;
use Bitrix\Main\Error;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Localization\Loc;
use Ipol\AliExpress\Admin\Form;

class Base extends Form\Base
{
	protected $moduleId;

	/**
	 * Возвращает ID модуля
	 *
	 * @return string
	 */
	public function getModuleId()
	{
		return $this->moduleId ?: static::$MODULE_ID;
	}

	/**
	 * Устанавливает ID модуля
	 *
	 * @return string
	 */
	public function setModuleId($moduleId)
	{
		$this->moduleId = $moduleId;

		return $this;
	}

	/**
	 * Возвращает сущность данных формы
	 *
	 * @return \ArrayAccess|null
	 */
	public function getEntity()
	{
		return $this->entity = $this->entity ?: new Form\Entity\Options($this->getModuleId(), $this->getFieldColumn(['DEFAULT', 'MULTIPLE']));
	}

	/**
	 * Возвращает url формы
	 * 
	 * @return string
	 */
	public function getActionUrl()
	{
		return parent::getActionUrl() ?: $GLOBALS['APPLICATION']->GetCurPageParam('mid='. $this->getModuleId());
	}

	/**
	 * Выполняет сохранение данных формы
	 *
	 * @param mixed              $entity
	 * @param Bitrix\Main\Result $result
	 * 
	 * @return Bitrix\Main\Result
	 */
	protected function save($entity, $result)
	{
		if (!$result->isSuccess()) {
            return $result;
        }

		$data = $result->getData();

		if (!$data['submit']) {
			return $result;
		}

		$entity->save();

		return $result;
	}
}