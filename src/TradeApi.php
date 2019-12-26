<?php
/**
 * Created by PhpStorm.
 * User: Guilherme Viana <guilhermecfviana@gmail.com>
 * Date: 18/12/2019
 * Time: 19:05
 */

namespace GuilhermeViana\MercadoBitcoin;

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

    private $tapiNonce;

    /**
     * TradeApi constructor.
     * @param $identificador
     * @param $segredo
     * @param string $tapiNonce
     * @throws TradeApiException
     */
    public function __construct($identificador, $segredo, $tapiNonce = 'now')
    {
        try {

            if($identificador == '' || $segredo == ''){
                throw new TradeApiException('Você deve informar o identificador e o segredo.');
            }

            $this->identificador = $identificador;
            $this->segredo = $segredo;
            $this->tapiNonce = $tapiNonce;

        } catch (TradeApiException $e){
            die($e->showMessageJSON());
        }
    }

    /**
     * Método para comunicação de eventos do sistema relativos à TAPÌ, entre eles bugs, correções, manutenção programada e novas funcionalidades e versões. O conteúdo muda a medida que os eventos ocorrem. A comunicação externa, feita via Twitter e e-mail aos usuários da TAPI, continuará ocorrendo. Entretanto, essa forma permite ao desenvolvedor tratar as informações juntamente ao seus logs ou até mesmo automatizar comportamentos.
     * @param null $level
     * @return bool|string
     * @throws TradeApiException
     */
    public function listSystemMessages($level = null){
        try {

            $this->params['tapi_method'] = 'list_system_messages';
            $this->params['tapi_nonce'] = $this->getTapiNonce($this->tapiNonce);

            if($level != ''){
                $this->params['level'] = $level;
            }

            return $this->send();

        } catch (TradeApiException $e){
            die($e->showErrorMessage());
        }
    }

    /**
     * Retorna dados da conta, como saldos das moedas (Real, BCash, Bitcoin, Ethereum, Litecoin e XRP), saldos considerando retenção em ordens abertas, quantidades de ordens abertas por moeda digital, limites de saque/transferências das moedas.
     * @return bool|string
     * @throws TradeApiException
     */
    public function getAccountInfo(){
        try {

            $this->params['tapi_method'] = 'get_account_info';
            $this->params['tapi_nonce'] = $this->getTapiNonce($this->tapiNonce);

            return $this->send();

        } catch (TradeApiException $e){
            die($e->showErrorMessage());
        }
    }

    /**
     * Retorna os dados da ordem de acordo com o ID informado. Dentre os dados estão as informações das Operações executadas dessa ordem. Apenas ordens que pertencem ao proprietário da chave da TAPI pode ser consultadas. Erros específicos são retornados para os casos onde o order_id informado não seja de uma ordem válida ou pertença a outro usuário.
     * @param $coinPair
     * @param $orderId
     * @return bool|string
     * @throws TradeApiException
     */
    public function getOrder($coinPair, $orderId){
        try {

            $this->params['tapi_method'] = 'get_order';
            $this->params['tapi_nonce'] = $this->getTapiNonce($this->tapiNonce);

            $this->params['coin_pair'] = $coinPair;
            $this->params['order_id'] = $orderId;

            return $this->send();

        } catch (TradeApiException $e){
            die($e->showErrorMessage());
        }
    }

    /**
     * Retorna uma lista de até 200 ordens, de acordo com os filtros informados, ordenadas pela data de última atualização. As operações executadas de cada ordem também são retornadas. Apenas ordens que pertencem ao proprietário da chave da TAPI são retornadas. Caso nenhuma ordem seja encontrada, é retornada uma lista vazia.
     * @param $coinPair
     * @param null $orderType
     * @param null $statusList
     * @param null $hasFills
     * @param null $fromId
     * @param null $toId
     * @param null $fromTimestamp
     * @param null $toTimestamp
     * @return bool|string
     * @throws TradeApiException
     */
    public function listOrders($coinPair, $orderType = null, $statusList = null, $hasFills = null, $fromId = null, $toId = null, $fromTimestamp = null, $toTimestamp = null){
        try {

            $this->params['tapi_method'] = 'list_orders';
            $this->params['tapi_nonce'] = $this->getTapiNonce($this->tapiNonce);

            $this->params['coin_pair'] = $coinPair;

            if(!is_null($orderType)){
                $this->params['order_type'] = $orderType;
            }

            if(!is_null($statusList)){
                $this->params['status_list'] = $statusList;
            }

            if(!is_null($hasFills)){
                $this->params['has_fills'] = $hasFills;
            }

            if(!is_null($fromId)){
                $this->params['from_id'] = $fromId;
            }

            if(!is_null($toId)){
                $this->params['to_id'] = $toId;
            }

            if(!is_null($fromTimestamp)){
                $this->params['from_timestamp'] = $fromTimestamp;
            }

            if(!is_null($toTimestamp)){
                $this->params['to_timestamp'] = $toTimestamp;
            }

            return $this->send();

        } catch (TradeApiException $e){
            die($e->showErrorMessage());
        }
    }

    /**
     * Retorna informações do livro de negociações (orderbook) do Mercado Bitcoin para o par de moedas (coin_pair) informado. Diferente do método orderbook público descrito em /api-doc/#method_trade_api_orderbook, aqui são fornecidas informações importantes para facilitar a tomada de ação de clientes TAPI e sincronia das chamadas. Dentre elas, o número da última ordem contemplada (latest_order_id) e número das ordens do livro (order_id), descritos abaixo. Importante salientar que nesse método ordens de mesmo preço não são agrupadas como feito no método público.
     * @param $coinPair
     * @param null $full
     * @return bool|string
     * @throws TradeApiException
     */
    public function listOrderBook($coinPair, $full = null){
        try {

            $this->params['tapi_method'] = 'list_orderbook';
            $this->params['tapi_nonce'] = $this->getTapiNonce($this->tapiNonce);

            $this->params['coin_pair'] = $coinPair;

            if(!is_null($full)){
                $this->params['full'] = $full;
            }

            return $this->send();

        } catch (TradeApiException $e){
            die($e->showErrorMessage());
        }
    }

    /**
     * Abre uma ordem de compra (buy ou bid) do par de moedas, quantidade de moeda digital e preço unitário limite informados. A criação contempla o processo de confrontamento da ordem com o livro de negociações. Assim, a resposta pode informar se a ordem foi executada (parcialmente ou não) imediatamente após sua criação e, assim, se segue ou não aberta e ativa no livro.
     * @param $coinPair
     * @param $quantity
     * @param $limitPrice
     * @return bool|string
     * @throws TradeApiException
     */
    public function placeBuyOrder($coinPair, $quantity, $limitPrice){
        try {

            $this->params['tapi_method'] = 'place_buy_order';
            $this->params['tapi_nonce'] = $this->getTapiNonce($this->tapiNonce);

            $this->params['coin_pair'] = $coinPair;
            $this->params['quantity'] = $quantity;
            $this->params['limit_price'] = $limitPrice;

            return $this->send();

        } catch (TradeApiException $e){
            die($e->showErrorMessage());
        }
    }

    /**
     * Abre uma ordem de venda (sell ou ask) do par de moedas, quantidade de moeda digital e preço unitário limite informados. A criação contempla o processo de confrontamento da ordem com o livro de negociações. Assim, a resposta pode informar se a ordem foi executada (parcialmente ou não) imediatamente após sua criação e, assim, se segue ou não aberta e ativa no livro.
     * @param $coinPair
     * @param $quantity
     * @param $limitPrice
     * @return bool|string
     * @throws TradeApiException
     */
    public function placeSellOrder($coinPair, $quantity, $limitPrice){
        try {

            $this->params['tapi_method'] = 'place_sell_order';
            $this->params['tapi_nonce'] = $this->getTapiNonce($this->tapiNonce);

            $this->params['coin_pair'] = $coinPair;
            $this->params['quantity'] = $quantity;
            $this->params['limit_price'] = $limitPrice;

            return $this->send();

        } catch (TradeApiException $e){
            die($e->showErrorMessage());
        }
    }

    /**
     * Abre uma ordem de compra (buy ou bid) do par de moedas com volume em reais limite informado. A criação contempla o processo de bloqueio do saldo para execução da ordem e confrontamento da ordem com o livro de negociações. Assim, a resposta pode informar se a ordem foi executada (parcialmente ou não) imediatamente após sua criação. Caso não seja possível executá-la totalmente por restrições no saldo disponível do usuário, o montante não executado é cancelado.
     * @param $coinPair
     * @param $cost
     * @return bool|string
     * @throws TradeApiException
     */
    public function placeMarketBuyOrder($coinPair, $cost){
        try {

            $this->params['tapi_method'] = 'place_market_buy_order';
            $this->params['tapi_nonce'] = $this->getTapiNonce($this->tapiNonce);

            $this->params['coin_pair'] = $coinPair;
            $this->params['cost'] = $cost;

            return $this->send();

        } catch (TradeApiException $e){
            die($e->showErrorMessage());
        }
    }

    /**
     * Abre uma ordem de venda (sell ou ask) do par de moeda com quantidade da moeda digital informado. A criação contempla o processo de confrontamento da ordem com o livro de negociações. Assim, a resposta pode informar se a ordem foi executada (parcialmente ou não) imediatamente após sua criação.
     * @param $coinPair
     * @param $quantity
     * @return bool|string
     * @throws TradeApiException
     */
    public function placeMarketSellOrder($coinPair, $quantity){
        try {

            $this->params['tapi_method'] = 'place_market_sell_order';
            $this->params['tapi_nonce'] = $this->getTapiNonce($this->tapiNonce);

            $this->params['coin_pair'] = $coinPair;
            $this->params['quantity'] = $quantity;

            return $this->send();

        } catch (TradeApiException $e){
            die($e->showErrorMessage());
        }
    }

    /**
     * Cancela uma ordem, de venda ou compra, de acordo com o ID e par de moedas informado. O retorno contempla o sucesso ou não do cancelamento, bem como os dados e status atuais da ordem. Somente ordens pertencentes ao próprio usuário podem ser canceladas.
     * @param $coinPair
     * @param $orderId
     * @return bool|string
     * @throws TradeApiException
     */
    public function cancelOrder($coinPair, $orderId){
        try {

            $this->params['tapi_method'] = 'cancel_order';
            $this->params['tapi_nonce'] = $this->getTapiNonce($this->tapiNonce);

            $this->params['coin_pair'] = $coinPair;
            $this->params['order_id'] = $orderId;

            return $this->send();

        } catch (TradeApiException $e){
            die($e->showErrorMessage());
        }
    }

    /**
     * Retorna os dados de uma transferência de moeda digital ou de um saque de Real (BRL).
     * @param $coin
     * @param $withdrawalId
     * @return bool|string
     * @throws TradeApiException
     */
    public function getWithdrawal($coin, $withdrawalId){
        try {

            $this->params['tapi_method'] = 'get_withdrawal';
            $this->params['tapi_nonce'] = $this->getTapiNonce($this->tapiNonce);

            $this->params['coin'] = $coin;
            $this->params['withdrawal_id'] = $withdrawalId;

            return $this->send();

        } catch (TradeApiException $e){
            die($e->showErrorMessage());
        }
    }

    /**
     * Requisita pedido de transferência de moeda digital ou saque de Real. Assim, caso o valor de coin seja BRL, então realiza um saque para a conta bancária informada. Caso o valor seja uma criptomoeda, realiza uma transação para o endereço de moeda digital informado.
     * @param $coin
     * @param null $description
     * @return bool|string
     * @throws TradeApiException
     */
    public function withdrawCoin($coin, $description = null){
        try {

            $this->params['tapi_method'] = 'withdraw_coin';
            $this->params['tapi_nonce'] = $this->getTapiNonce($this->tapiNonce);

            $this->params['coin'] = $coin;

            if(!is_null($description)){
                $this->params['description'] = $description;
            }

            return $this->send();

        } catch (TradeApiException $e){
            die($e->showErrorMessage());
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
                $tapiNonce = time() + 1;
            } else {
                $tapiNonce += 1;
            }

            $this->tapiNonce = $tapiNonce;

            return $tapiNonce;

        } catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }

}