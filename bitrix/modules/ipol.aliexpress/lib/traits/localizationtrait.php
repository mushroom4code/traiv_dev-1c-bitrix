<?php
namespace Ipol\Aliexpress\Traits;

use Bitrix\Main\Localization\Loc;

trait LocalizationTrait
{
    /**
     * @var string
     */
    protected static $MODULE_ID = 'ipol.aliexpress';

    /**
     * @var boolean
     */
    protected static $loadLocMessages = false;

    /**
     * Загружает языковые файлы класса
     *
     * @return void
     */
    public static function loadLocMessages()
    {
        if (static::$loadLocMessages === false || 1 == 1) {
            static::$loadLocMessages = true;

            $ref = new \ReflectionClass(static::class);
            $path = $ref->getFileName();

            Loc::loadMessages($path);
        }
    }

    /**
     * Возвращает локализованную строку сообщения
     *
     * @param string $slug
     * 
     * @return string
     */
    protected static function getLocMessage($slug)
    {
        static::loadLocMessages();

        $slug = static::$MODULE_ID .'_'. $slug;
        $mess = Loc::getMessage($slug);

        if (is_null($mess)) {
            return $slug;
        }

        return $mess;
    }
}