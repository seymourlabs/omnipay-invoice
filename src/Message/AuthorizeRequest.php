<?php

namespace Omnipay\Invoice\Message;

use Omnipay\Common\Message\AbstractRequest;

/**
 * Invoice Authorize Request
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
class AuthorizeRequest extends AbstractRequest
{
    private $prefix;

    public function getData()
    {
        $this->validate('amount');
        return array('amount' => $this->getAmount());
    }

    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
    }

    public function sendData($data)
    {
        // generate reference
        $data['reference'] = ($this->getTestMode() ? 'TEST:' : '') . (!empty($this->prefix) ? $this->prefix : '');
        $data['reference'] .= date('Ymd', time()) . '-' . substr((string)microtime(), 2, 6) . date('His', time())  . '-' . str_pad(rand(0, 9999), 4, 0, STR_PAD_LEFT);

        // always a success
        $data['success'] = true;
        $data['message'] = 'Success';

        return $this->response = new Response($this, $data);
    }
}
