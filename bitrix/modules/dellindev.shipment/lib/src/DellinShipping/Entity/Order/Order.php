<?php
/**
 * ������� �������� � ������. Domain object
 * �������� ���������� ����� ��������� ������ CMS/CRM/Framework.
 * ��� ������ �������� �������� ��� ��������� ��� ���������.
 * � ���������� �������� ��������� �� ����� ������� ����������.
 * @author: Vadim Lazev
 * @company: BIA-Tech
 * @year: 2021
 */
namespace DellinShipping\Entity\Order;

use DellinShipping\Entity\Order\Person;
use DellinShipping\Entity\Order\Product;
use DellinShipping\Kernel;
use Bitrix\Main\Localization\Loc;


class Order
{

    public $orderData;
    public $products = [];
    public Person $person;

    public $isErrors = false;
    public $errors = [];


    /**
     * OrderPrototype constructor.
     * @param $orderData
     * @param $products
     * @param $person
     */
//    protected function __construct()
//    {
//
//    }


    /**
     *
     * ����� �������� �������� ��������� ������.
     *
     * @param int $order_id - ������������� ������
     * @param int|null $shipment_id - ������������� �������� (���� ����������� �������� ��������, ����������� � ������ ������)
     * @param int|null $shipping_method_id - ����� ��������
     * @param int $payment_id - ������������� ��������� ������.
     * @param bool|null $isCashOnDelivery - ���� ������������ �������� �����.
     * @param float $order_total_price - ��������� ����� ������.
     * @param float $order_shipping_cost - ��������� ��������.
     * @param string $shipping_name - ��� ��������.
     * @param string $create_date - ���� ��������.
     * @param \DellinShipping\Entity\Order\Person $person - ������ � ����������.
     * @param string|null $workTimeStart - ������ ��������� ��� ���������.
     * @param string|null $worktimeEnd - ����� ��������� ��� ���������.
     * @param bool|null $isCash - ���� ������������� ��� ������, ��������� ��� ��� ��������.(��� �������) - ��������! ���������! ������� �������!
     */


    public function setOrderData(?int $order_id, ?int $shipment_id, ?int $shipping_method_id, ?int $payment_id,
                                 ?bool $isCashOnDelivery,  ?float $order_total_price, ?float $order_shipping_cost,
                                 ?string $shipping_name, string $create_date, Person $person,
                                 ?string $workTimeStart, ?string $worktimeEnd, ?bool $isCash): void
    {

        $orderData = new \stdClass();
        $orderData->order_id = $order_id;
        $orderData->shipment_id = $shipment_id;
        $orderData->shipping_method_id = $shipping_method_id; //method
        $orderData->payment_id = $payment_id;
        $orderData->isCashOnDelivery = $isCashOnDelivery;
        $orderData->isCash = $isCash; // if cashondelivery then define card or cash
        $orderData->order_total_price = $order_total_price;
        $orderData->order_shipping_cost = $order_shipping_cost;
        $orderData->shipping_name = $shipping_name;
        $orderData->create_date = $create_date;
        $orderData->worktimeStart = ($workTimeStart == null)? '09:00' : $workTimeStart;
        $orderData->worktimeEnd = ($worktimeEnd == null) ? '18:00': $worktimeEnd;
        $this->setPerson($person);


        $this->orderData = $orderData;

    }

    public function validate(){

        //��������� �������� person
        $poolErrors = [];


        if(!Kernel::validEmail($this->person->getEmail())){
            $this->setIsErrors(true);
            $poolErrors = array_merge($poolErrors,
                [Loc::getMessage("errors-person")] );


        }

        if( !Kernel::validPhone($this->person->getPhone())){

            $this->setIsErrors(true);
           $poolErrors = array_merge($poolErrors,
                [Loc::getMessage("errors-phone")]);
//            $poolErrors=
//                ['��������� ������ ��� ��������� �������� � �������� Person. �������� ���� �������� ���� "�������" � ����������.
//                ������� ������ ��������� 11 �������� � ���������� � "7".'];





        }

        if($this->orderData->order_total_price == '0'){
            $this->setIsErrors(true);
            $messageError = [Loc::getMessage("price_order_is_empty")];
            $poolErrors = array_merge($poolErrors, $messageError);

        }

        if($this->isErrors()){
            $this->setErrors($poolErrors);
        }



    }

    public function setPerson(Person $person)
    {
        $this->person = $person;
    }



    public function addProduct(Product $product): void
    {
        $this->products[] = $product;
    }

    /**
     * ����� ��� �������� ������.
     *
     * @return object
     */

    public function getOrderData(): object
    {

        $data = new \stdClass();

        $data->orderData = $this->orderData;
        $data->person = $this->person;
        $data->products = $this->products;


        return $data;

    }

    /**
     * @return bool
     */
    public function isErrors(): bool
    {
        return $this->isErrors;
    }

    /**
     * @param bool $isErrors
     */
    public function setIsErrors(bool $isErrors): void
    {
        $this->isErrors = $isErrors;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @param array $errors
     */
    public function setErrors(array $errors): void
    {
        $this->errors = $errors;
    }








}