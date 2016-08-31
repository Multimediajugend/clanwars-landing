<?php
require './bootstrap.php';

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\ExecutePayment;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

$logger = new Katzgrau\KLogger\Logger('./logs');

if(isset($_GET['success']) && $_GET['success'] == 'true') {
    $paymentId = $_GET['paymentId'];
    $payment = Payment::get($paymentId, $apiContext);

    $execution = new PaymentExecution();
    $execution->setPayerId($_GET['PayerID']);

    $transaction = new Transaction();
    $amount = new Amount();
    $details = new Details();

    $details->setShipping(0);

    $amount->setCurrency('EUR')
        ->setDetails($details)
        ->setTotal(25);
    
    $transaction->setAmount($amount);

    try {
        $result = $payment->execute($execution, $apiContext);

        echo "Executed Payment";

        try {
            $payment = Payment::get($paymentId, $apiContext);
        } catch (Exception $ex) {
            echo "Get Payment:" . $ex->getMessage();
            exit(1);
        }
    } catch (Exception $ex) {
        echo "Executed Payment: " . $ex->getMessage();
        exit(1);
    }

    echo "Get Payment: " . $payment;

    return $payment;
} else {
    echo "User Cancelled the Approval";
    exit;
}