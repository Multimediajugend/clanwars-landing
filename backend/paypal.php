<?php

use PayPal\Api\Amount;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

define("SINGLE_TICKET", 25.84);
define("GROUP_TICKET", 20.74);

class PayPal
{
    private $logger;
    private $apiContext;

    public function __construct() {
        $this->logger = new Katzgrau\KLogger\Logger('./logs');

        $clientId = PAYPAL_CLIENT_ID;
        $clientSecret = PAYPAL_CLIENT_SECRET;

        $this->getApiContext($clientId, $clientSecret);
    }

    public function getApprovalUrl($persons, $clan) {
        //TODO: check the clan
        $price = SINGLE_TICKET;

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $itemList = new ItemList();

        foreach($persons as $person)
        {
            $item = new Item();
            $item->setName($person->firstname . ' ' . $person->lastname)
                ->setCurrency('EUR')
                ->setQuantity(1)
                ->setSku($person->email)
                ->setPrice($price);

            $itemList->additem($item);
        }

        $details = new Details();
        $details->setShipping(0);

        $amount = new Amount();
        $amount->setCurrency('EUR')
            ->setTotal(count($persons)*$price)
            ->setDetails($details);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList);

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(PAYPAL_RETURN_URL)
            ->setCancelUrl(PAYPAL_CANCEL_URL);
        
        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));

        try {
            $payment->create($this->apiContext);
        } catch(Exception $ex) {
            $this->logger->error('PayPal-Payment could not be created: ' . $ex->getMessage());
            return null;
        }

        $approvalUrl = $payment->getApprovalLink();

        return $approvalUrl;
    }

    private function getApiContext($clientId, $clientSecret)
    {
        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                $clientId,
                $clientSecret
            )
        );

        $this->apiContext->setConfig(
            array(
                'mode' => 'sandbox',
                'log.LogEnabled' => true,
                'log.FileName' => './logs/PayPal.log',
                'log.LogLevel' => 'DEBUG', // PLEASE USE `INFO` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
                'cache.enabled' => true,
                // 'http.CURLOPT_CONNECTTIMEOUT' => 30
                // 'http.headers.PayPal-Partner-Attribution-Id' => '123123123'
                //'log.AdapterFactory' => '\PayPal\Log\DefaultLogFactory' // Factory class implementing \PayPal\Log\PayPalLogFactory
            )
        );
    }
}