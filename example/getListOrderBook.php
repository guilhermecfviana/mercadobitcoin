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
    'identificador' => 'b82d6ef0cc6ac3f9276c276cb27b7d50',
    'segredo' => '06cefe17e9306a77e6618f2ba44955c0605612905eb8d8d4924e0a7213f9ebc8',
];

$test = new \GuilhermeViana\MercadoBitcoin\TradeApi($options['identificador'], $options['segredo']);
echo $test->listOrderBook($test::BRLLTC, 'false');