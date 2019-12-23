<?php
/**
 * Created by PhpStorm.
 * User: Guilherme Viana <guilhermecfviana@gmail.com>
 * Date: 20/12/2019
 * Time: 18:53
 */
header('Content-Type: application/json');

require dirname(__DIR__) . '/vendor/autoload.php';

$options = [
    'identificador' => '',
    'segredo' => '',
];

$test = new \GuilhermeViana\MercadoBitcoin\TradeApi($options['identificador'], $options['segredo']);
echo $test->getOrder($test::BRLLTC, 3);