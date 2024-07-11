<?php
declare(strict_types=1);
/**
 * ����������� ��������.
 * ��������-��������������� ������������� ������ � ���������.
 * ���� ������ ��������/��������� � ���� ���� ����������� � �������� Field ��� ������
 * �������� ������������������ �� ���������� CompositeInterface.
 * ������� �������� ����� ���� ������������� ��� �������� ������������ � �������� Field.
 * @author: Vadim Lazev
 * @company: BIA-Tech
 * @year: 2021
 */

namespace BiaTech\Base\Composite;


class Container implements CompositeInterface
{
    /**
     * ���� �����.
     * @var array
     */
    private array $fields = [];


    /**
     * ����� ����������� � ���� ���������� ������� ������������������ �� ����������
     * CompositeInterface.
     * @param CompositeInterface $field
     */
    public function add(CompositeInterface $field ){
        $init = $this->fields;
        $this->fields = array_merge($init, $field->toArray());
      //  $this->fields[] = $field->toArray();

    }


    /**
     * ������������ ����� ���������� �������� �� ������� � �������.
     * @return array
     */
    public function toArray(): array
    {
        return (array) $this->fields;
    }
}


