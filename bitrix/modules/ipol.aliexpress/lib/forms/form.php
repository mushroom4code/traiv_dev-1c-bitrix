<?php
namespace My\Forms;

use Bitrix\Main\Result;
use Bitrix\Main\Error;
use Bitrix\Main\HttpRequest;

class Form
{
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
	protected $fields = [];

	/**
	 * Отрисовщик формы
	 * 
	 * @var Renderer
	 */
	protected $renderer = null;

	/**
	 * Сущность с данными формы
	 *
	 * @var array|ArrayAccess
	 */
	protected $entity;

	/**
	 * Конструктор формы
	 */
	public function __construct($entity = null)
	{
		if (!$entity) {
			$fields = $this->getFieldNames();
			$values = array_fill(0, sizeof($fields), '');
			$values = array_merge(array_combine($fields, $values), array_filter($this->getFieldColumn('DEFAULT')));
			$entity = new \ArrayObject($values);
		}

		$this->setEntity($entity);
	}
	
	/**
	 * Возвращает url формы
	 * 
	 * @return string
	 */
	public function getActionUrl()
	{
		return $this->actionUrl = $this->actionUrl ?: $GLOBALS['APPLICATION']->GetCurPage();
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
		$this->name     = $name;
		$this->renderer = null;

		return $this;
	}

	/**
	 * Возвращает набор полей формы
	 * 
	 * @return array
	 */
	public function getFields()
	{
		return $this->fields;
	}

	/**
	 * Устаналивает набор полей формы
	 * 
	 * @return array
	 */
	public function setFields(array $fields)
	{
		$this->fields     = $fields;
		$this->renderer   = null;

		return $this;
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

	/**
	 * Возвращает имена опций
	 * 
	 * @return array
	 */
	public function getFieldNames()
	{
		return $this->getFieldColumn('NAME');
	}

	/**
	 * Возвращает сущность с данными формы
	 *
	 * @return array|\ArrayAccess
	 */
	public function getEntity()
	{
		return $this->entity;
	}

	/**
	 * Устанавливает сущность с данными формы
	 *
	 * @param array|ArrayAccess  $entity
	 * 
	 * @return self
	 */
	public function setEntity($entity)
	{
		if (!is_array($entity) && !($entity instanceof \ArrayAccess)) {
			throw new \Exception('invalid type');
		}

		$this->entity = $entity;

		return $this;
	}

	/**
	 * Возвращает массив валидаторов, применить которые нужно перед сохранением самостоятельно
	 * 
	 * @return array
	 */
	public function getValidators()
	{
		return $this->getFieldColumn('VALIDATORS');
	}

	/**
	 * Обрабатывает форму
	 * 
	 * @param \Bitrix\Main\HttpRequest $request
	 * 
	 * @return null|\Bitrix\Main\Result
	 */
	public function process(HttpRequest $request)
	{
		if (!$request->isPost()) {
			return null;
		}

		if (!check_bitrix_sessid()) {
			return null;
		}

		$data = $request->getPost($this->getName());

		if (empty($data)) {
			return null;
		}

		$entity = $this->getEntity();

		foreach ($data as $field => $value) {
			if (isset($entity[$field])) {
				$entity[$field] = $value;
			}
		}

		$files = $_FILES[$this->getName()];

		if ($files) {
			$values = [];

			foreach ($files as $key => $file) {
				foreach ($file as $field => $value) {
					$values[$field][$key] = $value;
				}
			}

			foreach ($values as $field => $value) {
				$entity[$field] = $value;
			}
		}

		if (isset($data['SUBMIT']) && $data['SUBMIT'] == 'Y') {
			$errors = $this->validate($entity);
			
			if (empty($errors)) {
				$result = $this->processSuccess($entity);
			} else {
				$result = $this->processError($errors, $entity);
			}
		}

		$this->setEntity($entity);

		return $result;
	}	

	/**
	 * Возвращает валидные ли значения у формы
	 *
	 * @return boolean
	 */
	public function isValid()
	{
		$entity = $this->getEntity();
		$errors = $this->validate($entity);

		return empty($errors);
	}

	/**
	 * Выполняет валидацию данных
	 * 
	 * @param  array|\ArrayAccess $entity
	 * 
	 * @return array
	 */
	protected function validate($entity)
	{
		$errors     = [];
		$fields     = $this->getFieldNames();
		$validators = $this->getValidators();

		foreach ($fields as $fieldName) {
			if (!isset($validators[$fieldName])) {
				continue;
			}

			$value = $entity[$fieldName];

			foreach ($validators[$fieldName] as $name => $callback) {
				if (is_callable($callback)) {
					$error = call_user_func_array($callback, [$fieldName, $value, $entity, $this]);
				} elseif ($name == 'required' && trim($value) === '') {
					$error = $callback;
				}

				if ($error) {
					$errors = $error instanceof Error ? $error : new Error($error);
				}
			}
		}

		return $errors;
	}

	/**
	 * Выполняется при успешной обработке формы
	 *
	 * @param array|\ArrayAccess $entity
	 * 
	 * @return \Bitrix\Main\Result
	 */
	protected function processSuccess($entity)
	{
		return new Result();
	}

	/**
	 * Выполняется при не удачной обработке формы
	 *
	 * @param Bitrix\Main\Error[] $errors
	 * @return void
	 */
	protected function processError(array $errors)
	{
		$result = new Result();
		$result->setErrors($errors);

		return $result;
	}
}