<?php
namespace Ipol\Aliexpress\Admin\Table;

use Bitrix\Main\Grid;
use Bitrix\Main\UI\PageNavigation;
use Ipol\Aliexpress\Traits\LocalizationTrait;

abstract class Base
{
    use LocalizationTrait;

    protected $textTableName    = '';
    protected $textEmptyMessage = 'TABLE_EMPTY_MESSAGE';

    /**
     * @var array
     */
    protected $defaultColumns = [];

    /**
     * @var array;
     */
    protected $columns;

    /**
     * @var array
     */
    protected $defaultButtons = [];

    /**
     * @var array
     */
    protected $buttons;

    /**
     * @var array
     */
    protected $filterColumns;

    /**
     * @var array
     */
    protected $defaultFilterValues = [];
    
    /**
     * @var array
     */
    protected $filterValues;

    /**
     * @var array
     */
    protected $defaultSorting = [];

    /**
     * @var PageNavigation
     */
    protected $pagination;
    
    /**
     * @var integer
     */
    protected $defaultPageSize = 20;

    /**
     * @var boolean
     */
    protected $allowAllRecords = false;

    /**
     * @var Renderer
     */
    protected $renderer;

    /**
     * Возвращает ID таблицы
     *
     * @return string
     */
    public function getId()
    {
        return 'tbl_' . md5(static::class);
    }

    /**
     * Возвращает ID фильтра
     *
     * @return string
     */
    public function getFilterId()
    {
        return $this->getId() .'_filter';
    }

    /**
     * Возвращает заголовок таблицы
     *
     * @return string
     */
    public function getTitle()
    {
        return static::getLocMessage($this->textTableName ?: get_class($this));
    }

    /**
     * Возвращает текст сообщения о пустом списке
     * 
     * @return string
     */
    public function getMessages()
    {
        return [

        ];
    }

    /**
     * Возвращает список кнопок управления таблицой
     *
     * @return void
     */
    public function getDefaultButtons()
    {
        return $this->defaultButtons;
    }

    /**
     * Возвращает список кнопок управления таблицы
     *
     * @see component bitrix:ui.button.panel
     * @return array
     */
    public function getButtons()
    {
        if (is_null($this->buttons)) {
            $this->buttons = [];

            foreach ($this->getDefaultButtons() as $index => $button) {
                $this->buttons[$index] = array_merge($button, [
                    'CAPTION' => static::getLocMessage($button['CAPTION'])
                ]);
            }
        }

        return $this->buttons;
    }

    /**
     * Устанавливает список кнопок
     *
     * @param array $buttons
     * @return self
     */
    public function setButtons(array $buttons)
    {
        $this->buttons = $buttons;

        return $this;
    }

    /**
     * Добавляет кнопку
     *
     * @return self
     */
    public function addButton(array $button)
    {
        $this->getButtons();

        $this->buttons[] = $button;

        return $this;
    }

    /**
     * Возвращает список контролов таблицы
     *
     * @return array
     */
    public function getControls()
    {
        return [];
    }

    /**
     * Список колонок таблицы по умолчанию
     *
     * @return []
     */
    public function getDefaultColumns()
    {
        return $this->defaultColumns;
    }
    
    /**
     * Возвращает список колонок таблицы
     *
     * @return array
     */
    public function getColumns()
    {
        if (is_null($this->columns)) {
            foreach ($this->getDefaultColumns() as $index => $column) {
                $this->columns[$index] = array_merge($column, [
                    'name' => static::getLocMessage($column['name'])
                ]);
            }
        }

        return $this->columns;
    }

    /**
     * Возвращает список полей для фильтра
     *
     * @return array
     */
    public function getFilterColumns()
    {
        $ret = [];

        if (is_null($this->filterColumns)) {
            $this->filterColumns = [];
            
            $items = $this->getColumns();

            foreach ($items as $item) {
                if (!isset($item['filterable']) || $item['filterable'] === false) {
                    continue;
                }

                $this->filterColumns[] = array_merge(
                    $item, 
                    is_array($item['editable'])   ? $item['editable']   : [],
                    is_array($item['filterable']) ? $item['filterable'] : []
                );
            }
        }

        return $ret;
    }

    /**
     * Возвращает предустановку фильтра
     *
     * @return array
     */
    public function getDefaultFilterValues()
    {
        return $this->defaultFilterValues;
    }

    /**
     * Предустанавливает фильтр
     *
     * @param array $filterValues
     * @return self
     */
    public function setDefaultFilterValues(array $filterValues = [])
    {
        $this->defaultFilterValues = $filterValues;

        return $this;
    }

    /**
     * Возвращает значения установленного фильтра
     *
     * @return array
     */
    public function getFilterValues()
    {
        if (is_null($this->filterValues)) {
            $this->filterValues = [];

            $filter = $this->getFilterColumns();
            $option = new \Bitrix\Main\UI\Filter\Options($this->getFilterId());
            $data   = $option->getFilter([]);

            foreach ($filter as $column) {
                $format = false;

                if ($column['type'] == 'date') {
                    $format = 'YYYY-MM-DD';

                    if ($column['id'] == 'DATE_CREATE') {
                        $format = 'DD.MM.YYYY';
                    }

                } elseif ($column['type'] == 'datetime') {
                    $format = 'YYYY-MM-DD HH:MI:SS';

                    if ($column['id'] == 'DATE_CREATE') {
                        $format = 'DD.MM.YYYY HH:MI:SS';
                    }
                }

                $columnName = substr($column['id'], 0, '9') == 'PROPERTY_'
                    ? preg_replace('{(_VALUE|_ENUM_ID)$}', '', $column['id'])
                    : $column['id']
                ;

                if (isset($data[$column['id'] .'_from'])) {
                    $this->filterValues['>='. $columnName] = $format ? ConvertDateTime($data[$column['id'] .'_from'], $format) : $data[$column['id'] .'_from'];

                    if ($column['type'] == 'date') {
                        $this->filterValues['>='. $columnName] .= ' 00:00:00';
                    }
                }

                if (isset($data[$column['id'] .'_to'])) {
                    $this->filterValues['<='. $columnName] = $format ? ConvertDateTime($data[$column['id'] .'_to'], $format) : $data[$column['id'] .'_to'];

                    if ($column['type'] == 'date') {
                        $this->filterValues['<='. $columnName] .= ' 23:59:59';
                    }
                }

                if (isset($data[$column['id']])) {
                    $this->filterValues[$columnName] = $format ? ConvertDateTime($data[$column['id']], $format) : $data[$column['id']];
                }
            }

            if (isset($data['FIND'])) {
                $this->filterValues['FIND'] = $data['FIND'];
            }

            $this->filterValues = array_merge($this->filterValues, $this->getDefaultFilterValues());
        }

        return $this->filterValues;
    }

    /**
     * Возвращает список полей для сортировки
     * 
     * @return array
     */
    public function getDefaultSorting()
    {
        return $this->defaultSorting;
    }

    /**
     * Возвращает значения установленной сортировки
     *
     * @return array
     */
    public function getSorting()
    {
        $options = new Grid\Options($this->getId());
        
        $data = $options->GetSorting([
            'sort' => $this->getDefaultSorting(),
            'vars' => ['by' => 'by', 'order' => 'order'],
        ]);

        return $data['sort'];
    }

    /**
     * Возвращает менеджер пагинации
     *
     * @return Bitrix\Main\UI\PageNavigation
     */
    public function getPagination()
    {
        if (is_null($this->pagination)) {
            $options = new Grid\Options($this->getId());
            $params  = $options->GetNavParams(['nPageSize' => $this->defaultPageSize]);

            $this->pagination = new PageNavigation($this->getId());
            $this->pagination->allowAllRecords($this->allowAllRecords)
                ->setPageSize($params['nPageSize'])
                ->initFromUri()
            ;
        }

        return $this->pagination;
    }

    /**
     * Возвращает список 
     *
     * @return void
     */
    public function getRows()
    {
        $ret   = [];
        $items = $this->getRawData();

        foreach ($items as $key => $item) {
            $ret[ $key ] = $this->getRow($item);
        }

        return $ret;
    }

    /**
     * Отрисовывает таблицу в месте с фильтром (при наличии)
     *
     * @param array $componentParams
     * @return Renderer
     */
    public function render(array $componentParams = [])
    {
        $renderer = new Renderer($this);

        if (!empty($componentParams)) {
            $renderer->setDefaultComponentParams($componentParams);
        }

        return $renderer;
    }

    /**
     * Форматирует одну строку результата в формат пригодный для компонента таблицы
     * 
     * @param array $item
     * 
     * @return array
     */
    protected function getRow($item)
    {
        return [
            'data'            => $item,
            'columns'         => [],
            'actions'         => $this->getRowActions($item),
            'editable'        => true,
            'editableColumns' => [],
            'attrs'           => [],
            'columnClasses'   => [],
            'custom'          => [],
        ];
    }

    /**
     * Возвращает список действий для строки по умолчанию
     * 
     * @return array
     */
    protected function getDefaultRowActions()
    {
        return $this->defaultRowActions;
    }

    /**
     * Возвращает список действия для строки
     *
     * @param array $item
     * 
     * @return array
     */
    protected function getRowActions($item)
    {
        $ret = [];

        $actions = $this->getDefaultRowActions();
        foreach ($actions as $index => $action) {
            $ret[$index] = array_merge($action, [
                'TEXT'    => static::getLocMessage($action['TEXT']),
                'LINK'    => str_replace('#ID#', $item['ID'], $action['LINK']),
                'ONCLICK' => str_replace('#ID#', $item['ID'], $action['ONCLICK']),
            ]);
        }

        return $ret;
    }

    /**
     * Возвращает сырые данные для отображения в таблице
     *
     * @return array
     */
    abstract protected function getRawData();
}