<?php
namespace Ipol\Aliexpress\Admin\Table;

class Renderer
{
    /**
     * @var Base
     */
    protected $table;

    /**
     * @var array
     */
    protected $componentParams = [];

    /**
     * @var array
     */
    protected $defaultComponentParams = [];

    /**
     * @param Base $table
     */
    public function __construct(Base $table)
    {
        $this->table = $table;
    }

    /**
     * Возвращает таблицу
     * 
     * @return Table
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * Устанавливает параметры компонентов
     *
     * @param array $params
     * @return self
     */
    public function setDefaultComponentParams(array $params)
    {
        $this->defaultComponentParams = $params;

        return $this;
    }

    /**
     * Возвращает установленные параметры компонентов
     *
     * @return array
     */
    public function getDefaultComponentParams()
    {
        return $this->defaultComponentParams;
    }

    /**
     * Отрисовывает таблицу в месте с фильтром (при наличии)
     *
     * @param array $componentParams
     * @return void
     */
    public function render(array $componentParams = [])
    {
        $componentParams = array_replace_recursive([
            'SHOW_TITLE'   => 'Y',
            'SHOW_BUTTONS' => 'Y',
            'SHOW_FILTER'  => 'Y',
            'BUTTONS'      => [],
            'FILTER'       => [],
            'TABLE'        => [],
        ], $this->getDefaultComponentParams(), $componentParams);

        $ret = '';
        
        if ($componentParams['SHOW_TITLE'] !== 'N') {
            $ret .= $this->renderTitle();
        }
        
        if ($componentParams['SHOW_BUTTONS'] !== 'N') {
            $ret .= $this->renderButtons($componentParams['BUTTONS']);
        }

        if ($componentParams['SHOW_FILTER'] !== 'N') {
            $ret .= $this->renderFilter($componentParams['FILTER']);
        }

        $ret .= $this->renderTable($componentParams['TABLE']);

        return $ret;
    }

    /**
     * Отрисовывает заголовок таблицы
     *
     * @return string
     */
    public function renderTitle()
    {
        return '<h1>'. $this->getTable()->getTitle() .'</h1>';
    }

    /**
     * Отрисовывает кнопки управления таблицей
     *
     * @return void
     */
    public function renderButtons(array $componentParams = [])
    {
        $buttons = $this->getTable()->getButtons();

        if (empty($buttons)) {
            return '';
        }

        $componentParams = array_merge([
            'TEMPLATE_NAME' => '.default',
            'ALIGN'         => 'left',

        ], $componentParams, [

            'BUTTONS' => $buttons
        ]);

        ob_start();

        $GLOBALS['APPLICATION']->IncludeComponent(
            'bitrix:ui.button.panel', 
            $componentParams['TEMPLATE_NAME'], 
            $componentParams
        );

        return ob_get_clean();
    }

    /**
     * Отрисовывает фильтр
     *
     * @param array $componentParams
     * @return void
     */
    public function renderFilter(array $componentParams = [])
    {
        $columns = $this->getTable()->getFilterColumns();

        if (empty($columns)) {
            return '';
        }

        $componentParams = array_merge([
            'TEMPLATE_NAME'      => '.default',
            'ENABLE_LIVE_SEARCH' => false, 
            'ENABLE_LABEL'       => true,
            'VALUE_REQUIRED_MODE'=> false,
            'VALUE_REQUIRED'     => false,

        ], $componentParams, [

            'GRID_ID'            => $this->getTable()->getId(), 
            'FILTER_ID'          => $this->getTable()->getFilterId(), 
            'FILTER'             => $columns, 
        ]);

        ob_start();
        
        $GLOBALS['APPLICATION']->IncludeComponent(
            'bitrix:main.ui.filter', 
            $componentParams['TEMPLATE_NAME'], 
            $componentParams
        );
        
        return ob_get_clean();
    }

    /**
     * Отрисовывает таблицу
     *
     * @param array $componentParams
     * @return void
     */
    public function renderTable(array $componentParams = [])
    {
        $componentParams = array_merge([
            'TEMPLATE_NAME'             => '.default',
            'AJAX_ID'                   => '',
            'AJAX_MODE'                 => false,
            'AJAX_OPTION_HISTORY'       => false,
            'PAGE_SIZES'                => [
                ['VALUE' => '10',   'NAME' => '10'], 
                ['VALUE' => '20',   'NAME' => '20'], 
                ['VALUE' => '30',   'NAME' => '30'], 
                ['VALUE' => '50',   'NAME' => '50'], 
                ['VALUE' => '100',  'NAME' => '100'],
            ],
            'SHOW_ROW_CHECKBOXES'       => false,
            'SHOW_CHECK_ALL_CHECKBOXES' => false,
            'SHOW_ROW_ACTIONS_MENU'     => true,
            'SHOW_GRID_SETTINGS_MENU'   => true,
            'SHOW_NAVIGATION_PANEL'     => true,
            'SHOW_PAGINATION'           => true,
            'SHOW_SELECTED_COUNTER'     => true,
            'SHOW_TOTAL_COUNTER'        => true,
            'SHOW_PAGESIZE'             => true,
            'SHOW_ACTION_PANEL'         => true,
            'ALLOW_SORT'                => true,
            'ALLOW_COLUMNS_SORT'        => true,
            'ALLOW_COLUMNS_RESIZE'      => true,
            'ALLOW_HORIZONTAL_SCROLL'   => true,
            'ALLOW_PIN_HEADER'          => true,
            'EDITABLE'                  => true,

        ], $componentParams, [
            
            'GRID_ID'                   => $this->getTable()->getId(),
            'HEADERS'                   => $this->getTable()->getColumns(),
            'ROWS'                      => $this->getTable()->getRows(),
            'NAV_OBJECT'                => $this->getTable()->getPagination(),
            'MESSAGES'                  => $this->getTable()->getMessages(),
            'ACTION_PANEL'              => [
                'GROUPS' => [ 
                    'TYPE' => [ 
                        'ITEMS' => $this->getTable()->getControls(),
                    ]
                ]
            ],
        ]);

        ob_start();

        $GLOBALS['APPLICATION']->IncludeComponent(
            'bitrix:main.ui.grid', 
            $componentParams['TEMPLATE_NAME'], 
            $componentParams
        );

        return ob_get_clean();
    }

    /**
     * @inheritDoc
     *
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }
}