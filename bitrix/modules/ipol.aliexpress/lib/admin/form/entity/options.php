<?php
namespace Ipol\AliExpress\Admin\Form\Entity;

use Bitrix\Main\Config\Option;
use Ipol\AliExpress\Admin\Form\Base;

class Options extends \ArrayObject
{
    /**
     * @var string
     */
    protected $moduleId;

    /**
     * @var array
     */
    protected $values;

    /**
     * @var array
     */
    protected $fields;

    /**
     * Конструктор
     *
     * @param string $moduleId
     * @param Base   $fields
     */
    public function __construct($moduleId, array $fields)
    {
        $this->moduleId = $moduleId;
        $this->fields   = $fields;
    }

    /**
     * Загружает значения сущности
     *
     * @return void
     */
    public function load()
    {
        if ($this->values === null) {
            $this->values = [];

            foreach ($this->fields as $name => $data) {
                if (preg_match('~(.*)\[(.+)\]$~', $name, $m)) {
                    $name  = $m[1];
                    $index = $m[2];
                }

                $value = Option::get($this->moduleId, $name, $data['DEFAULT'] ?? '');

                if (isset($data['MULTIPLE']) && $data['MULTIPLE']) {
                    $value = unserialize($value) ?: [];
                }

                $this->values[$name] = $value;
            }
        }
    }

    /**
     * Заполняет значения сущности из массива
     *
     * @param array $values
     * 
     * @return void
     */
    public function apply(array $values)
    {
        $this->load();
        $this->values = array_intersect_key($values, $this->values);
    }

    /**
     * Сохраняет значение сущности
     *
     * @return void
     */
    public function save()
    {
        if ($this->values === null) {
            return ;
        }

        foreach ($this->fields as $name => $data) {
            if (preg_match('~(.*)\[(.+)\]$~', $name, $m)) {
                $name  = $m[1];
                $index = $m[2];
            }

            $value = $this->values[$name] ?? ($fields[$name]['DEFAULT'] ?? null);

            if (isset($data['MULTIPLE']) && $data['MULTIPLE']) {
                $value = serialize($value);
            }

            Option::set($this->moduleId, $name, $value);
        }
    }

    /**
     * @param mixed $offset
     * 
     * @return boolean
     */
    public function offsetExists($offset)
    {
        $this->load();

        return array_key_exists($offset, $this->values);
    }

    /**
     * @param mixed $offset
     * 
     * @return mixed
     */
    public function offsetGet($offset)
    {
        $this->load();

        return $this->values[$offset];
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     * 
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        $this->load();
        $this->values[$offset] = $value;
    }

    /**
     * @param mixed $offset
     * 
     * @return void
     */
    public function offsetUnset($offset)
    {
        $this->load();
        $this->values[$offset] = null;
    }
}