<?php
namespace Ipol\AliExpress\Debug;

use \Bitrix\Main\Config\Option;

class Log
{
    const LEVEL_NONE    = 0;
    const LEVEL_DEBUG   = 2;
    const LEVEL_NOTICE  = 4;
    const LEVEL_WARNING = 8;
    const LEVEL_ERROR   = 16;
    const LEVEL_ALL     = 3838;

    /**
     * @var self
     */
    protected static $instance;

    /**
     * @var boolean
     */
    protected $logPath = '';

    /**
     * @var string
     */
    protected $logLevel = 0;

    /**
     * Возвращает инстанс класса
     *
     * @return self
     */
    public static function getInstance()
    {
        $filePath = Option::get(IPOLH_ALI_MODULE, 'LOG_FILE_PATH', '');
        // $logLevel = array_sum((array) (\unserialize(Option::get(IPOLH_DPD_MODULE, 'LOG_LEVEL')) ?: []));
        $logLevel = Option::get(IPOLH_ALI_MODULE, 'LOG_LEVEL');
        
        return static::$instance = static::$instance ?: new static($filePath, $logLevel);
    }

    public function __construct($path, $level = Log::LEVEL_ERROR)
    {
        $this->path  = $path;
        $this->level = $level;
    }

    /**
     * Устанавливает путь к log-файлу
     *
     * @param string $path
     * 
     * @return self
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Возвращает путь к log-файлу
     *
     * @return string
     */
    public function getPath()
    {
        return \Rel2Abs($_SERVER['DOCUMENT_ROOT'], $this->path);
    }

    /**
     * Устанавливает уровень журналирования
     *
     * @param int $level
     * 
     * @return self
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Возващает текст уровня журналирования
     *
     * @param int $level
     * 
     * @return string
     */
    public function getLevelName($level)
    {
        switch($level)
        {
            case static::LEVEL_DEBUG:   return 'DEBUG';
            case static::LEVEL_NOTICE:  return 'NOTICE';
            case static::LEVEL_WARNING: return 'WARNING';
            case static::LEVEL_ERROR:   return 'ERROR';
        }

        return '--';
    }

    /**
     * Добавляет запись в журнал
     *
     * @param string $message
     * @param int    $level
     * 
     * @return self
     */
    public function write($message, $level = Log::LEVEL_NOTICE)
    {
        if (empty($this->getPath())) {
            return $this;
        }

        if ($this->level & $level) {
            file_put_contents($this->getPath(), ''
                . '['. date('Y-m-d H:i:s') .'] '. $this->getLevelName($level) . PHP_EOL
                . $message . PHP_EOL
                .'-----------------------------'. PHP_EOL
            , FILE_APPEND);
        }

        return $this;
    }
}