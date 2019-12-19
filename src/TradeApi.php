<?php
/**
 * Created by PhpStorm.
 * User: Guilherme Viana <guilhermecfviana@gmail.com>
 * Date: 18/12/2019
 * Time: 18:40
 */

namespace GuilhermeViana\MercadoBitcoin;

use Exception;

class TradeApi
{

    const BASE_URL = 'https://www.mercadobitcoin.net';
    const BASE_URI = '/tapi/v3/';
    const API_URL = self::BASE_URL . self::BASE_URI;

    private $tapiMethod = null;
    private $tapiNonce = null;

    public function __construct($identificador, $segredo)
    {
        try {

            if($identificador == '' || $segredo == ''){
                throw new Exception('Você deve informar o identificador e o segredo.');
            }

            

        } catch (Exception $e){
        }
    }

    public function listSystemMessages($level = null){
        try {



        } catch (Exception $e){

        }
    }

}