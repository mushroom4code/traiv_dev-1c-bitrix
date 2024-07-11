<?php
namespace Ipol\Aliexpress\Admin\Table\Type;

use Bitrix\Main\ORM\Fields\ExpressionField;
use Ipol\Aliexpress\Admin\Table\Base;

abstract class DB extends Base
{
    /**
     * @var string
     */
    protected $fetchMode;

    /**
     * @var array
     */
    protected $select = ['*'];

    /**
     * Должен вернуть название ORM маппера для выборки данных
     *
     * @return Bitrix\Main\ORM\Data\DataManager
     */
    abstract public function getDataMapper();

    /**
     * Возвращает метод выбора записей
     *
     * @return string
     */
    public function getFetchMode()
    {
        return $this->fetchMode;
    }

    /**
     * Устанавливает метод выбора записей
     * 
     * object  - будет возвращать объекь
     * default - массив
     *
     * @param string $fetchMode
     * 
     * @return self
     */
    public function setFetchMode($fetchMode)
    {
        $this->fetchMode = $fetchMode;

        return $this;
    }

    /**
     * Возвращает выбираемые колонки
     *
     * @return array
     */
    public function getSelect()
    {
        return $this->select;
    } 

    /**
     * Возвращает выбираемые колонки
     *
     * @param array $select
     * @return self
     */
    public function setSelect(array $select)
    {
        return $this->select = $select;
    }
    
    /**
     * Возвращает сырые данные для отображения в таблице
     *
     * @return array
     */
    protected function getRawData()
    {
        $ret        = [];
        $query      = $this->getQuery();
        $result     = $query->exec();

        if ($this->getFetchMode() == 'object') {
            $ret = [];

            while($item = $result->fetchObject()) {
                $ret[] = $item;
            }
        } else {
            $ret = $result->fetchAll();
        }

        $queryCount = $this->getQuery();
        $queryCount->addSelect(new ExpressionField('CNT', 'COUNT(1)'));
        $result = $query->exec()->fetch();

        $pagination = $this->getPagination();
        $pagination->setRecordCount($result['CNT']);   
        
        return $ret;
    }

    /**
     * Возвращает конструктор запроса
     *
     * @return Bitrix\Main\ORM\Query\Query
     */
    protected function getQuery()
    {
        $dataMapper = $this->getDataMapper();

        $query      = $dataMapper::query()
            ->setSelect($this->getSelect())
            ->setFilter($this->getFilterValues())
            ->setOrder($this->getSorting())
        ;
     
        $pagination = $this->getPagination();

        if (!$pagination->allRecordsShown()) {
            $query->setLimit($pagination->getLimit());
            $query->setOffset($pagination->getOffset());
        }

        return $query;
    }
}