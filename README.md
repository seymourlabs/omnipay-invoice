# Omnipay: Invoice
**Generate invoice numbers via the transaction call as a driver for the Omnipay PHP payment processing library**

[![Latest Stable Version](https://poser.pugx.org/seymourlabs/omnipay-invoice/version.png)](https://packagist.org/packages/seymourlabs/omnipay-invoice)
[![Total Downloads](https://poser.pugx.org/seymourlabs/omnipay-invoice/d/total.png)](https://packagist.org/packages/seymourlabs/omnipay-invoice)

[Omnipay](https://github.com/thephpleague/omnipay) is a framework agnostic, multi-gateway payment
processing library for PHP 5.3+. This package implements Sage Pay support for Omnipay.

## Installation

Omnipay is installed via [Composer](http://getcomposer.org/). To install, simply add it
to your `composer.json` file:

```json
{
    "require": {
        "seymourlabs/omnipay-invoice": "~1.0"
    }
}
```

And run composer to update your dependencies:

    $ curl -s http://getcomposer.org/installer | php
    $ php composer.phar update

## Basic Usage

    // Create a gateway for the Invoice Gateway
    // (routes to GatewayFactory::create)
    $gateway = \Omnipay\Omnipay::create('Invoice');
    
    // Initialise the gateway
    $gateway->initialize([
        'testMode' => true, // Test mode prepends "TEST:" into the invoice number
    ]);
    
    
    // Do an authorize transaction on the gateway
    $transaction = $gateway->authorize([
        'amount'                   => '10.00',
        'currency'                 => 'GBP',
    ]);
    
    // optional prefix assignment
    $transaction->setPrefix('ABC');
    
    $response = $transaction->send();
    if ($response->isSuccessful()) {
        echo "Authorize transaction was successful!\n";
        $sale_id = $response->getTransactionReference();
        echo "Transaction reference = " . $sale_id . "\n";
    }