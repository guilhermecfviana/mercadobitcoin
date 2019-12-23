# PHP MercadoBitcoin Trade-API

Cliente da Trade-API do MercadoBitcoin em PHP (Composer)

## Como usar?

Instale usando composer: 

```
composer require guilhermecfviana/mercadobitcoin
```

Crie sua conta e siga os passos em https://www.mercadobitcoin.com.br/trade-api/

## Exemplo de uso

```php
$options = [
    'identificador' => 'seu_identificador',
    'segredo' => 'seu_segredo',
];

$test = new \GuilhermeViana\MercadoBitcoin\TradeApi($options['identificador'], $options['segredo']);
echo $test->getAccountInfo();
```

Todos os métodos estão disponíveis para uso, porém nem todos foram testados:

 * getAccountInfo()
 * getOrder($coinPair, $orderId)
 * listOrders($coinPair, $orderType = null, $statusList = null, $hasFills = null, $fromId = null, $toId = null, $fromTimestamp = null, $toTimestamp = null)
 * listOrderBook($coinPair, $full = null)
 * placeBuyOrder($coinPair, $quantity, $limitPrice)
 * placeSellOrder($coinPair, $quantity, $limitPrice)
 * placeMarketBuyOrder($coinPair, $cost)
 * placeMarketSellOrder($coinPair, $quantity)
 * cancelOrder($coinPair, $orderId)
 * getWithdrawal($coin, $withdrawalId)
 * withdrawCoin($coin, $description = null)

Há dois métodos para atender o nonce especificado no manual:

 * Manual: informe no construtor o nonce atual (último usado + 1)
 * Timestamp: gera um nonce através através do timestamp atual - não atende 
    mais que uma requisição por segundo.

## Requerimentos

PHP >= 7.0

## Docker
Você pode utilizar o docker para criar o ambiente de desenvolvimento, para isto basta executar na raiz do projeto:
```php
    ~/workspace/PHP/mercadobitcoin$ docker-compose up
```

Contribuições são bem vindas.

