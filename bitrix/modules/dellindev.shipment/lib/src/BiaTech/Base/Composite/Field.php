<?php
/**
 * ����������� ��������.
 * ��������-��������������� ������������� ������ � ���������.
 * ���� ������ ������ ���� ��� ����������� ������������� ������ ���������� ��� ������
 * ��������� ������������������ �� ���������� CompositeInterface.
 * @author: Vadim Lazev
 * @company: BIA-Tech
 * @year: 2021
 */
namespace BiaTech\Base\Composite;

use Bitrix\Main\Localization\Loc;

class Field implements CompositeInterface
{

    private string $key;

    private $value;

    /**
     * ����������� ������.
     * @param array $data
     * @throws \Exception
     */

    public function __construct(array $data)
    {
        $this->key = $data[0];
        (is_object($data[1]))?$this->setValueObj($data[1]):$this->value = $data[1];
    }

    /**
     * ����� �������������� �������� �������� ������.
     * @param $data
     * @throws \Exception
     */
    private function setValueObj($data):void
    {

        if(!method_exists($data, 'toArray'))
            throw new Exception(Loc::getMessage("UNCORRECT_OBJECT"));

        $this->value = $data->toArray();

    }


    /**
     * ������������ ����� ���������� �������� �� ������� � �������.
     * @return array
     */
    public function toArray(): array
    {
        return $this->text = [$this->key => $this->value];
    }
}