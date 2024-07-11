<?php
namespace Ipol\Aliexpress\DB;

use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Event;
use Bitrix\Main\ORM\EventResult;

use Ipol\Aliexpress\Traits\LocalizationTrait;

class Base extends DataManager
{
    use LocalizationTrait;

    /**
     * @inheritDoc
     */
    public static function onBeforeAdd(Event $event)
    {
        return static::OnBeforeSave($event);
    }

    /**
     * @inheritDoc
     */
    public static function onBeforeUpdate(Event $event)
    {
        return static::OnBeforeSave($event);
    }

    /**
     * Событие перед сохранением сущности
     * 
     * @param  Bitrix\Main\ORM\Event
     * @return Bitrix\Main\ORM\EventResult
     */
    public static function OnBeforeSave(Event $event)
    {
        return new EventResult();
    }
}