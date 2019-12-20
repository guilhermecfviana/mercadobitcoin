<?php
/**
 * Created by PhpStorm.
 * User: Guilherme Viana <guilhermecfviana@gmail.com>
 * Date: 18/12/2019
 * Time: 19:05
 */

namespace GuilhermeViana\MercadoBitcoin;

use Exception;

/**
 * Class TradeApi
 * @package GuilhermeViana\MercadoBitcoin
 */
class TradeApi extends BaseApi
{

    const BRLBTC = 'BRLBTC';
    const BRLBCH = 'BRLBCH';
    const BRLETH = 'BRLETH';
    const BRLLTC = 'BRLLTC';
    const BRLXRP = 'BRLXRP';

    /**
     * TradeApi constructor.
     * @param $identificador
     * @param $segredo
     * @throws Exception
     */
    public function __construct($identificador, $segredo, $tapiNonce = 'now')
    {
        try {

            if($identificador == '' || $segredo == ''){
                throw new Exception('Você deve informar o identificador e o segredo.');
            }

            $this->identificador = $identificador;
            $this->segredo = $segredo;

        } catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param null $level
     * @return bool|string
     * @throws Exception
     */
    public function listSystemMessages($level = null){
        try {

            $this->params['tapi_method'] = 'list_system_messages';
            $this->params['tapi_nonce'] = time();

            if($level != ''){
                $this->params['level'] = $level;
            }

            return $this->send();

        } catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @return bool|string
     * @throws Exception
     */
    public function getAccountInfo(){
        try {

            $this->params['tapi_method'] = 'get_account_info';
            $this->params['tapi_nonce'] = time();

            return $this->send();

        } catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @return bool|string
     * @throws Exception
     */
    public function getOrder($coinPair, $orderId){
        try {

            $this->params['tapi_method'] = 'get_order';
            $this->params['tapi_nonce'] = time();

            $this->params['coin_pair'] = $coinPair;
            $this->params['order_id'] = $orderId;

            return $this->send();

        } catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }

}