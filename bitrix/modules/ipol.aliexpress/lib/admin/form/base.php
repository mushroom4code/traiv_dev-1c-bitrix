<?php
namespace Ipol\AliExpress\Admin\Form;

use \Bitrix\Main\Result;
use \Bitrix\Main\Error;
use \Bitrix\Main\HttpRequest;
use Ipol\AliExpress\Utils;
use Ipol\Aliexpress\Traits\LocalizationTrait;

class Base
{
	use LocalizationTrait;

	/**
	 * action url формы
	 * @var string
	 */
	protected $actionUrl;

	/**
	 * Имя формы
	 * @var string
	 */
	protected $name;

	/**
	 * Массив полей формы
	 * 
	 * @var array
	 */
	protected $fields;

	/**
	 * Отрисовщик формы
	 * 
	 * @var Renderer
	 */
	protected $renderer = null;

	/**
	 * @var \ArrayAccess
	 */
	protected $entity;

	/**
	 * Возвращает сущность данных формы
	 *
	 * @return \ArrayAccess|null
	 */
	public function getEntity()
	{
		return $this->entity = $this->entity ?: [];
	}

	/**
	 * Устанавливает сущность данных формы
	 *
	 * @param \ArrayAccess $entity
	 * 
	 * @return self
	 */
	public function setEntity(\ArrayAccess $entity)
	{
		$this->entity = $entity;

		return $this;
	}
	
	/**
	 * Возвращает url формы
	 * 
	 * @return string
	 */
	public function getActionUrl()
	{
		return $this->actionUrl ?: $GLOBALS['APPLICATION']->GetCurPageParam();
	}

	/**
	 * Устанавливает url формы
	 */
	public function setActionUrl($actionUrl)
	{
		$this->actionUrl = $actionUrl;
		$this->renderer  = null;

		return $this;
	}

	/**
	 * Возвращает имя формы
	 * 
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Устанавливает имя формы
	 * 
	 * @param string $name
	 * 
	 * @return self
	 */
	public function setName($name)
	{
		$this->name = $name;

		return $this;
	}

	/**
	 * Возвращает набор полей формы
	 * 
	 * @return array
	 */
	public function getFields()
	{
		return $this->fields = $this->fields ?: [];
	}

	/**
	 * Устаналивает набор полей формы
	 * 
	 * @return array
	 */
	public function setFields(array $fields)
	{
		$this->fields = $fields;

		return $this;
	}

	/**
	 * Возвращает имена опций
	 * 
	 * @return array
	 */
	public function getFieldNames($items = null)
	{
		return $this->getFieldColumn($this->getFields(), 'NAME');
	}

	/**
	 * Возвращает массив валидаторов, применить которые нужно перед сохранением самостоятельно
	 * 
	 * @return array
	 */
	public function getValidators()
	{
		return $this->getFieldColumn($this->getFields(), 'VALIDATORS');
	}

	/**
	 * Возвращает кнопки формы
	 *
	 * @return void
	 */
	public function getButtons()
	{
		return [];
	}

	/**
	 * Обрабатывает форму
	 * 
	 * @param \Bitrix\Main\HttpRequest $request
	 * 
	 * @return null|\Bitrix\Main\Result
	 */
	public function processRequest(HttpRequest $request)
	{
		if ($request->isAjaxRequest()) {
			$data = Utils::convertEncoding($request->getPost($this->getName()), 'UTF-8', SITE_CHARSET);
		} else {
			$data = $request->getPost($this->getName());
		}

		$result = new Result;
		$action = array_key_exists('action', $_REQUEST)
			? $_REQUEST['action']
			: (array_key_exists('save', $_REQUEST) || array_key_exists('apply', $_REQUEST) ? 'save' : '')
		;
		$submit = array_key_exists('save', $_REQUEST) || array_key_exists('apply', $_REQUEST);
		$fields = $this->getFieldNames();
		$values = &$this->getEntity();

		if ($request->isPost() && check_bitrix_sessid()) {
			foreach($fields as $name) {
				$m = array();

				if ($name == 'ID') {
					continue;
				}

				if (preg_match('~(.*)\[(.+)\]$~', $name, $m)) {
					$name  = $m[1];
					$index = $m[2];
				}

				if (array_key_exists($name, $data)) {
					$values[$name] = $data[$name];
					$errors        = $submit ? $this->validate($name, $values[$name]) : '';
				}

				if (!empty($errors)) {
					$result->addErrors($errors);
				}
			}
		}

		$result->setData([
			'values' => $values,
			'submit' => $submit,
			'action' => $action,
		]);

		if ($action) {
			return $this->save($values, $result);
		}

		return $result;
	}

	/**
	 * Отрисовывает форму
	 * 
	 * @param array|\ArrayAccess  $values массив значений формы
	 * @param \Bitrix\Main\Result $result результат проверки формы
	 * 
	 * @return string
	 */
	public function render($values = [], Result $result = null)
	{
		$renderer = new Renderer(
			$this->getName(), 
			$this->getActionUrl(), 
			$this->getFields(), 
			$this->getValidators(),
			$this->getButtons()
		);

		return $renderer->render($values ?: $this->getEntity(), $result);
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
		return $result;
	}

	/**
	 * Проверяет поле
	 * 
	 * @param  string $fieldName
	 * @param  string $value
	 * @return array
	 */
	protected function validate($fieldName, $value)
	{
		$errors     = [];
		$validators = $this->getValidators();

		if (!isset($validators[$fieldName])) {
			return $errors;
		}

		foreach ($validators[$fieldName] as $name => $callback) {
			if (is_callable($callback)) {
				$error = $callback($fieldName, $value, $this);
			} elseif ($name == 'required' && ((is_array($value) && empty($value)) || trim($value) === '')) {
				$error = $callback;
			}

			if ($error) {
				$errors[] = $error instanceof Error ? $error : new Error($error);
			}
		}

		return $errors;
	}

	/**
	 * Возвращает колонку из описания поля
	 *
	 * @param array        $items
	 * @param array|string $column
	 * 
	 * @return array
	 */
    public function getFieldColumn($items, $column = null)
    {
        if ($column === null) {
            $column = $items;
            $items  = $this->getFields();
        }

        $ret = [];

        foreach ($items as $item) {
            if (empty($item)) {
                continue;
            }

            $controls = is_callable($item['CONTROLS']) ? call_user_func($item['CONTROLS']) : $item['CONTROLS'];

            foreach ($controls as $name => $control) {
                $control['NAME'] = $name;

                if ($control['TYPE'] == 'TABS') {
                    $sub = is_callable($control['ITEMS']) ? call_user_func($control['ITEMS']) : $control['ITEMS'];
                    $ret = array_merge($ret, $this->getFieldColumn($sub, $column));
                } else {
                    if (is_array($column)) {
                        $ret[$name] = array_intersect_key($control, array_flip((array) $column));
                    } else {
                        $ret[$name] = $control[$column];
                    }
                }
            }
        }

        return $ret;
    }
}