<?php
/**
 * Created by PhpStorm.
 * User: Guilherme Viana <guilhermecfviana@gmail.com>
 * Date: 18/12/2019
 * Time: 18:41
 */
header('Content-Type: application/json');

require dirname(__DIR__) . '/vendor/autoload.php';

$options = [
    'identificador' => '',
    'segredo' => '',
];

$test = new \GuilhermeViana\MercadoBitcoin\TradeApi($options['identificador'], $options['segredo']);
echo $test->getAccountInfo();

