<?php

/**
 * ������ ��������� �� PSR-3. ��������� ���������� ������������ �� ������������� RFC 2119.
 * ����������� � ������� ������� ������������, �������� �������� ���������� ������ �������� ���������� ������.
 * � ���������� ��� �������� ������� SDK, �������� ���������� � ������������ ���������� ������.
 * @author: Vadim Lazev
 * @company: BIA-Tech
 * @year: 2021
 */


namespace BiaTech\Base\Log;


interface LoggerInterface
{



    /**
     * ��������� ����������� ��������
     *
     * ��������: ������� ��������, �� ����������, � �.�.
     * ����� ��� ������ �������� ��� ���������� � ��������� ��� � ����������� ���������.
     *
     * @param string $message
     * @param array $context
     * @return void
     */

    public function alert($message, array $context = array());

    /**
     * ����������� ��������.
     *
     * ������: ���������� ��������� ����������, ����������� Exception.
     *
     * @param string $message
     * @param array $context
     * @return void
     */

    public function critical($message, array $context = array());

    /**
     * ������ �� ������ ����������, �� ��������� ����������� ��������,
     * �� ��������� ���� �������������� � ����������� ��������.
     *
     * @param string $message
     * @param array $context
     * @return void
     */


    public function error($message, array $context = array());


    /**
     * �������� �������� �������.
     *
     * ������: ���� �������������, ���� SQL.
     *
     * @param string $message
     * @param array $context
     * @return void
     */

    public function info($message, array $context = array());

    /**
     * ��������� ���������� ����������.
     *
     * @param string $message
     * @param array $context
     * @return void
     */

    public function debug($message, array $context = array());

    /**
     * ���� � ������������ �������.
     * � ���������� $log ���������� ������ ������� �����������.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     * @return void
     */
    // TODO ������������ � ��� ��������������
    public function log($level, $message, array $context = array());


}