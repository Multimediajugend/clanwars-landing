<?php
require_once dirname(dirname(__FILE__)) . "/config/config.php";
require_once dirname(dirname(__FILE__)) . "/backend/clandb.php";
require_once dirname(dirname(__FILE__)) . "/vendor/autoload.php";
require_once dirname(__FILE__) . "/paymentdb.php";

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

class PayPalDB
{
    private $logger;
    private $apiContext;
    private $paymentdb;

    public function __construct() {
        $this->logger = new Katzgrau\KLogger\Logger('./logs');

        $clientId = PAYPAL_CLIENT_ID;
        $clientSecret = PAYPAL_CLIENT_SECRET;

        $this->paymentdb = new PaymentDB();

        $this->getApiContext($clientId, $clientSecret);
    }

    public function getApproval($persons, $clan) {
        $_clan = new ClanDB();
        $clanname = null;

        $price = SINGLE_TICKET;

        if($clan != null) {
            if($clan->id < 0) {
                // Add clan
                if($_clan->clanExists($clan->name)) {
                    return null;
                }
                $_clan->addClan($clan->name, $clan->password);
                $clanname = $clan->name;
                $price = GROUP_TICKET;
            } else if($clan != null && $clan->id > 0) {
                // check Password
                if(!$_clan->checkPasswordByName($clan->name, $clan->password)) {
                    return null;
                }
                $price = GROUP_TICKET;
                $clanname = $clan->name;
            }
        }
        

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $itemList = new ItemList();

        for($i = 0; $i < count($persons); $i++)
        {
            $item = new Item();
            $item->setName($persons[$i]->firstname . ' ' . $persons[$i]->lastname)
                ->setCurrency('EUR')
                ->setQuantity(1)
                ->setSku($persons[$i]->email)
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
        $paymentId = $payment->getId();

        $this->paymentdb->addPayment($paymentId, $persons, $clanname);

        return (object) ['id' => $paymentId, 'url' => $approvalUrl];
    }

    public function paymentSuccess($paymentId, $payerId) {
        $payment = Payment::get($paymentId, $this->apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        try {
            $result = $payment->execute($execution, $this->apiContext);

            $this->paymentdb->paymentSucces($paymentId, $result);
        } catch (Exception $ex) {
            $this->logger->error('Exception on execute Payment: ' - $ex->getMessage());
            return false;
        }

        return true;
    }

    public function cancelPayment($paymentId) {
        $this->paymentdb->deletePayment($paymentId);
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