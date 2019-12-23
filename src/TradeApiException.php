<?php
/**
 * Created by PhpStorm.
 * User: Guilherme Viana <guilhermecfviana@gmail.com>
 * Date: 23/12/2019
 * Time: 11:15
 */

namespace GuilhermeViana\MercadoBitcoin;

use Throwable;
use Exception;

class TradeApiException extends Exception implements Throwable
{

    /**
     * TradeApiException constructor.
     * @param $message
     * @param int $code
     * @param Exception|null $previous
     */
    public function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return false|string
     */
    public function showMessageJSON(){
        return json_encode($this->getMessage());
    }

}