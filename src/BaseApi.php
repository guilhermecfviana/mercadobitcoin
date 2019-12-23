<?php
/**
 * Created by PhpStorm.
 * User: Guilherme Viana <guilhermecfviana@gmail.com>
 * Date: 19/12/2019
 * Time: 18:57
 */

namespace GuilhermeViana\MercadoBitcoin;

use Exception;

/**
 * Class BaseApi
 * @package GuilhermeViana\MercadoBitcoin
 */
class BaseApi
{

    const BASE_URL = 'https://www.mercadobitcoin.net';
    const BASE_URI = '/tapi/v3/';
    const API_URL = self::BASE_URL . self::BASE_URI;

    protected $identificador = null;
    protected $segredo = null;
    protected $params = [];

    /**
     * Send Request
     * @return bool|string
     * @throws Exception
     */
    protected function send(){
        try {

            $requestHeader = [];
            $requestHeader[] = 'Content-Type: application/x-www-form-urlencoded';
            $requestHeader[] = 'TAPI-ID: ' . $this->identificador;
            $requestHeader[] = 'TAPI-MAC: ' . $this->sign();

            $options = [
                CURLOPT_HEADER         => false,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => false
            ];

            $ch = curl_init();
            curl_setopt_array($ch, $options);
            curl_setopt($ch, CURLOPT_URL, self::API_URL);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $requestHeader);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($this->params));
            $response = curl_exec($ch);
            $status = curl_getinfo($ch);
            curl_close($ch);

            return $response;

        } catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Sign params
     * @return string
     * @throws Exception
     */
    private function sign(){
        try {

            $stringSign = self::BASE_URI . '?' . http_build_query($this->params);
            return hash_hmac('sha512', $stringSign, $this->segredo);

        } catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param string $tapiNonce
     * @return int|string
     * @throws Exception
     */
    protected function getTapiNonce($tapiNonce = ''){
        try {

            if($tapiNonce === 'now'){
                $tapiNonce = time();
            }

            return $tapiNonce;

        } catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }

}