<?php
namespace Ipol\Aliexpress\Admin\Table\Type;

use \Ipol\Aliexpress\Admin\Table\Base;

/**
 * Класс для таблицы на основе обычного массива
 */
class Raw extends Base
{
    /**
     * @var array
     */
    protected $data = [];

    public function __construct(array $data)
    {
        $this->setData($data);
    }

    /**
     * Возвращает данные
     *
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Устанавливает данные
     *
     * @param array $data
     * 
     * @return array
     */
    public function setData(array $data)
    {
        return $this->data = $data;
    }

    /**
     * Возвращает сырые данные для отображения в таблице
     *
     * @return array
     */
    protected function getRawData()
    {
        $data = $this->getData();
        $data = $this->applyFilters($data, $this->getFilterValues());
        $data = $this->applySorting($data, $this->getSorting());
        $data = $this->applySlice($data, $this->getPagination());

        return $data;
    }

    /**
     * Применяет фильтры к данным
     * 
     * ожидается, что дочерние классы самостоятельно реализуют фильтрацию
     *
     * @param array $data
     * @param array $filters
     * 
     * @return array
     */
    protected function applyFilters($data, $filters)
    {
        return $data;
    }

    /**
     * Применяет сортировку к данным
     * 
     * ожидается, что дочерние классы самостоятельно реализуют сортировку
     *
     * @param array $data
     * @param array $sorting
     * 
     * @return array
     */
    protected function applySorting($data, $sorting)
    {
        return $data;
    }

    /**
     * Обрезает список эл-ов согласно пагинации
     * 
     * @param array          $data
     * @param PageNavigation $pagination
     * 
     * @return array
     */
    protected function applySlice($data, $pagination)
    {
        if (!$pagination->allRecordsShown()) {
            $data = array_slice(
                $data, 
                $pagination->getOffset(), 
                $pagination->getLimit()
            );
        }

        return $data;
    }
}