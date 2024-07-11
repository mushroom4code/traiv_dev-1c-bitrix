<?php
namespace Ipol\AliExpress\Admin\Form;

use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Result;
use \Ipol\AliExpress\Utils;

Loc::loadMessages(__FILE__);

class Renderer
{
	protected $formName;
	protected $actionUrl  = '';
	protected $fields     = array();
	protected $values     = array();
	protected $validators = array();
	protected $buttons    = array();

	/**
	 * Конструктор класса
	 * 
	 * @param string       $actionUrl
	 * @param array        $fields
	 * @param array        $values
	 * @param array        $validators
	 */
	public function __construct($formName, $actionUrl, array $fields, array $validators = array(), array $buttons = [])
	{
		$this->formName   = $formName;
		$this->actionUrl  = $actionUrl;
		$this->fields     = array_values($fields);
		$this->validators = $validators;
		$this->buttons    = $buttons;
 	}

	/**
	 * Отрисовывает форму
	 * 
	 * @param array|\ArrayAccess  $values массив значений формы
	 * @param \Bitrix\Main\Result $result результат проверки формы
	 * 
	 * @return string
	 */
	public function render($values = [], \Bitrix\Main\Result $result = null)
	{
		$GLOBALS['APPLICATION']->SetAdditionalCss('/bitrix/panel/main/admin-public.css');

		if ($result) {
			$data   = $result->getData();
			$values = array_key_exists('values', $data) ? $data['values'] : $values;
		}

		$this->values = $values;
		
		$ret  = '';
		$ret .= '<form method="POST" action="'. $this->actionUrl .'" name="'. $this->formName .'" id="'. $this->formName .'">';
		$ret .= \bitrix_sessid_post();
		$ret .= $this->renderResultMessage($result);

		if (array_key_exists('TAB', reset($this->fields))) {
			$ret .= $this->renderFormTabs('tabControl'. uniqid(), array_values(array_filter($this->fields)), false);
		} else {
			$ret .= $this->renderFormFields(array_values($this->fields));
		}

		$ret .= '</form>';

		return $ret;
	}

	public function renderResultMessage(Result $result = null)
	{
		if (!$result || (!$result->getData()['submit'] && !($result->getData()['action'] || !$result->isSuccess()))) {
			return '';
		}

		if ($result->isSuccess()) {
			$type    = 'OK';
			$data    = $result->getData();
			$message = array_key_exists('message', $data) ? $data['message'] : Loc::getMessage('IPOL_ALI_FORM_SAVE_OK');
		} else {
			$type    = 'ERROR';
			$message = implode('<br>', $result->getErrorMessages());
		}

		$msg = new \CAdminMessage(array(
			'MESSAGE' => $message,
			'TYPE'    => $type,
			'HTML'    => true,
		));

		return $msg->Show();
	}

	public function renderFormTabs($name, $tabs, $sub = true)
	{
		ob_start();

		$tabs = $this->getListItems($tabs);
		
		$tabControl = $sub 
			? new \CAdminViewTabControl($name, $tabs)
			: new \CAdminTabControl($name, $tabs);

		$tabControl->Begin(array('FORM_ACTION' => 'YY'));

		foreach($tabs as $tabIndex => $tab) {
			$tabControl->BeginNextTab();

			print $this->renderFormFieldComment($tabIndex, $tab);
			print $this->renderFormFields($tab['CONTROLS'], $sub);
		}

		if ($sub) {
			// nothing
		} else {
			if ($tabControl->bPublicMode) {
				$tabControl->ButtonsPublic($this->buttons['buttons']);
			} else {
				$tabControl->Buttons($this->buttons);
			}
		}

		$tabControl->End();

		return ob_get_clean();
	}

	public function renderFormFields($fields, $showWrapper = true)
	{
		$fields = $this->getListItems($fields);
		
		$ret  = '';
		$ret .= $showWrapper ? '<table width="100%" class="adm-detail-content-table edit-table">' : '';

		foreach ($fields as $field => $data) {
			if ($data['TYPE'] == 'HIDDEN') {
				$ret = $this->renderFormFieldHidden($field, $data) . $ret;
			} else {
				$ret = $ret . $this->renderFormField($field, $data);
			}
		}

		$ret .= $showWrapper ? '</table>' : '';

		return $ret;
	}

	/**
	 * Отрисовывает один филд
	 * 
	 * @param  string $field
	 * @param  array  $data
	 * @return string
	 */
	public function renderFormField($field, $data)
	{
		$ret = '';
		$showCaption = !in_array($data['TYPE'], array('TABS', 'HEADER', 'COMMENT')) && $data['SHOW_CAPTION'] != 'N';

		$ret .= '<tr>';

		if ($showCaption) {
			$ret .= '<td width="40%" class="adm-detail-content-cell-l">'
					. ($data['HELP'] ? $this->renderFormFieldHelp($field, $data) : '') 
					. ($data['TITLE'] && $this->hasRequiredField($field) ? '<span class="star_required required">*</span>' : '')
					. ($data['TITLE'])
					. ($data['TITLE'] ? ':' : '')
					.'</td>';
		}

			$ret .= '<td'. ($showCaption ? '' : ' colspan="2"') .' class="'. ($data['TYPE'] == 'HEADER' ? 'heading' : 'adm-detail-content-cell-r') .'">';

			$ret .= $this->doRenderFormField($field, $data);

			$ret .= '</td>';

		$ret .= '</tr>';

		return $ret;
	}

	/**
	 * Отрисовывает непосредственный контрол
	 * 
	 * @param  $field
	 * @param  $data
	 * @return string
	 */
	public function doRenderFormField($field, $data)
	{
		if (is_callable($data['TYPE']) && !is_string($data['TYPE'])) {
			$cb = $data['TYPE'];
		} else {
			$method = 'renderFormField'. Utils::underScoreToCamelCase($data['TYPE'], true);
			$method = 'renderFormField'. Utils::underScoreToCamelCase($data['TYPE'], true);
			$method = method_exists($this, $method) ? $method : 'renderFormFieldInput';
			$cb = array($this, $method);
		}

		$ret .= call_user_func($cb, $field, $data);
		$ret .= $data['COMMENT'] ? '<br><small>'. $data['COMMENT'] .'</small>' : '';

		return $ret;
	}

	/**
	 * Отрисовывает вложенные табы
	 * 
	 * @param  string $name
	 * @param  array  $data
	 * @return string
	 */
	public function renderFormFieldTabs($name, $data)
	{
		return $this->renderFormTabs($name, $data['ITEMS'], true);
	}

	/**
	 * Отрисовывает подзаголовок
	 * 
	 * @param  string $name
	 * @param  array  $data
	 * @return string
	 */
	public function renderFormFieldHeader($name, $data)
	{
		return $data['TITLE'];
	}

	/**
	 * Отрисовывает комментарий
	 * 
	 * @param  string $name
	 * @param  array  $data
	 * @return string
	 */
	public function renderFormFieldComment($name, $data)
	{
		if (!$data['HELP']) {
			return '';
		}

		return '<div id="'. $this->getFormFieldId($name) .'" class="adm-info-message" style="width: 100%; box-sizing: border-box;">'. $data['HELP'] .'</div>';
	}

	/**
	 * Отрисовывет просто значение
	 * 
	 * @param  string $name
	 * @param  array  $data
	 * @return string
	 */
	public function renderFormFieldNote($name, $data)
	{
		return '<span id="'. $this->getFormFieldId($name) .'">'. $this->getValue($name, $data) .'</span>';
	}

	/**
	 * Отрисовывает группу контролов
	 * 
	 * @param  $name
	 * @param  $data
	 * @return string
	 */
	public function renderFormFieldControlGroup($name, $data)
	{
		$ret = '';

		$items = $this->getListItems($data['ITEMS']);
		foreach ($items as $name => $subData) {
			$subData['ATTRS'] = array_merge((array) $subData['ATTRS'], (array) $data['ATTRS']);
			$ret .= $this->doRenderFormField($name, $subData) . $data['SPLIT'];
		}

		return rtrim($ret, $data['SPLIT']);
	}

	/**
	 * Отрисовывает input или texarea
	 * 
	 * @param  string $name
	 * @param  array  $data
	 * @return string
	 */
	public function renderFormFieldInput($name, $data)
	{
		if ($data['MULTILINE']) {
			return '<textarea '. $this->getFormFieldAttrs($name, $data) .'>'. $this->getValue($name, $data) .'</textarea>';
		}

		return '<input '. $this->getFormFieldAttrs($name, $data, array('value' => $this->getValue($name, $data), 'type' => 'text')) .'>';
	}

	/**
	 * Отрисовывает hidden input
	 * 
	 * @param  string $name
	 * @param  array  $data
	 * @return string
	 */
	public function renderFormFieldHidden($name, $data)
	{
		return '<input '. $this->getFormFieldAttrs($name, $data, array('value' => $this->getValue($name, $data), 'type' => 'hidden')) .'>';
	}

	/**
	 * Отрисовывает checkbox
	 * 
	 * @param  string $name
	 * @param  array  $data
	 * @return string
	 */
	public function renderFormFieldCheckbox($name, $data, $checkValue = 1, $unCheckValue = 0)
	{
		$checkValue   = $data['VALUE']         ?: $checkValue;
		$unCheckValue = $data['UNCHECK_VALUE'] ?: $unCheckValue;

		return ''
			. '<input '. $this->getFormFieldAttrs($name, $data, [
					'type'  => 'hidden',
					'value' => $unCheckValue,
					'id'    => '',
			]) .'>'
			
			. '<input '. $this->getFormFieldAttrs($name, $data, [
					'type'    => 'checkbox',
					'checked' => $this->getValue($name, $data) == $checkValue,
					'value'   => $checkValue,
			]) .'>'
		;
	}

	/**
	 * Отрисовывает select
	 * 
	 * @param  string $name
	 * @param  array  $data
	 * @return string
	 */
	public function renderFormFieldSelect($name, $data)
	{
		$items = $this->getListItems($data['ITEMS']);

		if (isset($data['NULL'])) {
			$items = array('' => $data['NULL']) + $items;
		}

		$options = '';
		foreach ($items as $value => $title) {
			if (is_array($title)) {
				$value = $title['ID'];
				$title = $title['NAME'] ?: $title['TITLE'];
			}

			$attrs = array(
				'value' => $value,
				'selected' => in_array($value, (array) $this->getValue($name, $data)),
			);

			$options .= '<option '. $this->getFormFieldAttrs(null, null, $attrs) .'>'. $title .'</option>';
		}

		$attrs = array(
			'multiple' => ($multiple = (bool) $data['MULTIPLE']),
			'name'     => $multiple ? $this->getFormFieldName($name) . '[]' : $this->getFormFieldName($name),
		);

		return '<select '. $this->getFormFieldAttrs($name, $data, $attrs) .'>'. $options .'</select>';
	}

	public function renderFormFieldHelp($name, $data)
	{
		$ret = '';

		if ($data['HELP']) {
			$ret .= '<img src="/bitrix/js/main/core/images/hint.gif" title="'. $data['HELP'] .'" style="margin: 0 5px">';
		}

		return $ret;
	}

	public function renderFormFieldDate($name, $data)
	{
		if ($data['ATTRS']['disabled']) {
			return $this->renderFormFieldInput($name, $data);
		}

		ob_start();

		$GLOBALS['APPLICATION']->IncludeComponent('bitrix:main.calendar', '.default', array(
			'SHOW_INPUT'   => 'Y',
			'FORM_NAME'    => '',
			'INPUT_NAME'   => $this->getFormFieldName($name),
			'INPUT_VALUE'  => $this->getValue($name, $data),
			'SHOW_TIME'    => $data['SHOW_TIME'],
			'HIDE_TIMEBAR' => $data['HIDE_TIMEBAR'],
		));

		return ob_get_clean();
	}

	public function renderFormFieldButton($name, $data)
	{
		$attrs = array(
			'type'  => 'button',
			'title' => $data['TITLE'],
		);

		return '<input '. $this->getFormFieldAttrs($name, $data, $attrs) .'>';
	}

	public function renderFormFieldLink($name, $data)
	{
		$value = $this->getValue($name, $data);

		if (empty($value)) {
			return '(пусто)';
		}

		$attrs = array(
			'href'   => $value,
			'target' => '_blank',
		);

		return '<a '. $this->getFormFieldAttrs(null, $data, $attrs) .'>'. ($data['CAPTION'] ?: Loc::getMessage('IPOL_ALI_FORM_LINK_LABEL')) .'</a>';
	}

	public function renderFormFieldLocation($name, $data)
	{
		$value        = $this->getValue($name, $data);
		$arBxLocation = \CSaleLocation::GetByID($value, "ru");

		ob_start();

		$GLOBALS['APPLICATION']->IncludeComponent('bitrix:sale.location.selector.search', '', [
			"ID"                     => $arBxLocation['ID'],
			"CODE"                   => "",
			"INPUT_NAME"             => $this->getFormFieldName($name),
			"PROVIDE_LINK_BY"        => "id",
			"SHOW_ADMIN_CONTROLS"    => 'Y',
			"SELECT_WHEN_SINGLE"     => 'N',
			"FILTER_BY_SITE"         => 'N',
			"SHOW_DEFAULT_LOCATIONS" => 'N',
			"SEARCH_BY_PRIMARY"      => 'Y',
			"EXCLUDE_SUBTREE"        => $nodeId,
		], false);

		return ob_get_clean();
	}

	public function renderFormFieldSelector($name, $data)
	{
		$APPLICATION->IncludeComponent('bitrix:main.user.selector', '', [
			"ID"                    => "mail_client_config_queue",
			"API_VERSION"           => 3,
			"LIST"                  => array_keys($crmQueueSelected),
			"INPUT_NAME"            => "fields[crm_queue][]",
			"USE_SYMBOLIC_ID"       => true,
			"BUTTON_SELECT_CAPTION" => Loc::getMessage("MAIL_CLIENT_CONFIG_CRM_QUEUE_ADD"),
			"SELECTOR_OPTIONS"      => [
				"departmentSelectDisable" => "Y",
				"context"                 => "MAIL_CLIENT_CONFIG_QUEUE",
				"contextCode"             => "U",
				"enableAll"               => "N",
				"userSearchArea"          => "I"
			]
		]);
	}

	protected function getListItems($items)
	{
		return is_callable($items) ? call_user_func_array($items, array($this->values)) : $items;
	}

	protected function getFormFieldId($fieldName)
	{
		return trim($this->formName .'_'. preg_replace('~[^a-zA-Z0-9_]~', '_', $fieldName), '_');
	}

	protected function getFormFieldName($fieldName)
	{
		if (preg_match('~\[(.+)\]$~', $fieldName, $m)) {
			return $this->formName .'['. preg_replace('~\[(.+)\]$~', '', $fieldName) .']['. $m[1] .']';
		}

		return $this->formName .'['. $fieldName .']';
	}

	protected function getFormFieldAttrs($name, $data)
	{
		$attrs = array_merge(
			array(array(
				'id'   => $name ? $this->getFormFieldId($name)   : false,
				'name' => $name ? $this->getFormFieldName($name) : false,
			)), 

			$data['ATTRS'] ? array($data['ATTRS']) : array(), 
			
			array_slice(func_get_args(), 2)
		);

		$attrs = call_user_func_array('array_merge', $attrs);

		$ret = '';
		foreach ($attrs as $name => $value) {
			if ($value === false) {
				continue;
			}

			if ($value === true) {
				$value = $name;
			}

			$ret .= $name .'="'. htmlspecialcharsbx($value) .'" ';
		}

		return trim($ret);
	}

	protected function getValue($name, $data)
	{
		$m = array();

		if (preg_match('~(.*)\[(.+)\]$~', $name, $m)) {
			$name  = $m[1];
			$index = $m[2];

			if (isset($this->values[$name][$index])) {
				return $this->values[$name][$index];
			}
		} elseif (isset($this->values[$name])) {
			return $this->values[$name];
		}

		return $data['DEFAULT'] ?: '';
	}

	/**
	 * Возвращает является ли поле обязательным для заполнения
	 * 
	 * @param  string  $fieldName
	 * @return boolean
	 */
	protected function hasRequiredField($fieldName)
	{	
		if (!isset($this->validators[$fieldName])) {
			return false;
		}

		return array_key_exists('required', $this->validators[$fieldName]);
	}
}