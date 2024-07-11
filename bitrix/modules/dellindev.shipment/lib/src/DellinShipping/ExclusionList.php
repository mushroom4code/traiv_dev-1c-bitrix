<?php


namespace DellinShipping;

use Bitrix\Main\Localization\Loc;
class ExclusionList
{

    public static function listForRegionName(){

    //�� ���������� ������ �������� ������ ��������.

        return [
            Loc::getMessage("SAHA") => '����',
        ];
    }

    public static function listForPlaces(){

    //����� ������������ ��� ������� ������������ ��������, ������� ������ �������� ����������� � ��������,
    //��������, "����������� ����" - ��� ������, ����������� ��� ����� ������������ ��������.

        return array(
            Loc::getMessage("moscow") => array(
                'cityName' => Loc::getMessage("moscow"),
                'regionName' => Loc::getMessage("moscow")
            ),
            Loc::getMessage("sevastopol") => array(
                'cityName' => Loc::getMessage("sevastopol") ,
                'regionName' => Loc::getMessage("sevastopol")
            ),
            Loc::getMessage("SAINT-PETERSBURG") => array(
                'cityName' => Loc::getMessage("SAINT-PETERSBURG"),
                'regionName' => Loc::getMessage("SAINT-PETERSBURG")
            ),
        );
    }

    public static function listForQuery(){
        return [
          Loc::getMessage("DELLINDEV_Q_BELGOROD") => [
              'q'=> Loc::getMessage("DELLINDEV_Q_BELGOROD_CHANGED"),
              'cityName' => Loc::getMessage("DELLINDEV_CITYNAME_BELGOROD"),
              'regionName'=> Loc::getMessage("DELLINDEV_REGIONNAME_BELGORODSKAYA")
          ]
        ];
    }
}