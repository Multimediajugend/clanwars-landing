<?php
require './bootstrap.php';

use PayPal\Api\Amount;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

$logger = new Katzgrau\KLogger\Logger('./logs');

$payer = new Payer();
$payer->setPaymentMethod("paypal");

$single = new Item();
$single->setName(EVENT_NAME . " Einzelkarte")
    ->setCurrency("EUR")
    ->setQuantity(1)
    ->setSku(EVENT_ID . "_single")
    ->setPrice(25);

$group = new Item();
$group->setName(EVENT_NAME . " Gruppenkarte")
    ->setCurrency("EUR")
    ->setQuantity(0)
    ->setSku(EVENT_ID . "_group")
    ->setPrice(20);

$itemList = new ItemList();
$itemList->setItems(array($single));

$details = new Details();
$details->setShipping(0);

$amount = new Amount();
$amount->setCurrency("EUR")
    ->setTotal(25)
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
    $payment->create($apiContext);
} catch(Exception $ex) {
    $logger->error('PayPal-Payment could not created: ' . $ex->getMessage());
}

$approvalUrl = $payment->getApprovalLink();

echo "Continue to <a href=\"" . $approvalUrl . "\">PayPal</a>";

return $payment;