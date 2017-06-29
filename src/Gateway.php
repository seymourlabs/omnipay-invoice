<?php

namespace Omnipay\Invoice;

use Omnipay\Common\AbstractGateway;

/**
 * Invoice Gateway
 *
 * This gateway is used for producing invoice numbers and allows for some form of
 * flow if you're using Omnipay but want don't want to deviate too much for your
 * existing process.
 *
 * ### Example
 *
 * <code>
 * // Create a gateway for the Invoice Gateway
 * // (routes to GatewayFactory::create)
 * $gateway = Omnipay::create('Invoice');
 *
 * // Initialise the gateway
 * $gateway->initialize([
 *     'testMode' => true, // Test mode prepends "TEST:" into the invoice number
 * ]);
 *
 * // Do an authorize transaction on the gateway
 * $transaction = $gateway->authorize([
 *     'amount'                   => '10.00',
 *     'currency'                 => 'AUD',
 * ]);
 *
 * // optional prefix assignment
 * $transaction->setPrefix('ABC');
 *
 * $response = $transaction->send();
 * if ($response->isSuccessful()) {
 *     echo "Authorize transaction was successful!\n";
 *     $sale_id = $response->getTransactionReference();
 *     echo "Transaction reference = " . $sale_id . "\n";
 * }
 * </code>
 */
class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'Invoice';
    }

    public function getDefaultParameters()
    {
        return array();
    }

    /**
     * Create an authorize request.
     *
     * @param array $parameters
     * @return \Omnipay\Invoice\Message\AuthorizeRequest
     */
    public function authorize(array $parameters = array())
    {
        return $this->createRequest('Omnipay\Invoice\Message\AuthorizeRequest', $parameters);
    }

    /**
     * Create a purchase request.
     *
     * @param array $parameters
     * @return \Omnipay\Invoice\AuthorizeRequest
     */
    public function purchase(array $parameters = array())
    {
        return $this->authorize($parameters);
    }
}
