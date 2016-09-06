<?php
require_once('./config/config.php');
require_once('./backend/paypal.php');
require_once('./backend/paymentdb.php');
require_once('./backend/clan.php');
require_once('./vendor/autoload.php');

if(isset($_GET['success']) && $_GET['success'] == 'true') {
    if(isset($_GET['paymentId']) && isset($_GET['PayerID']))
    {
        $paymentId = $_GET['paymentId'];
        $execution->setPayerId($_GET['PayerID']);

        $paypal = new PayPal();

        if($paypal->paymentSuccess($paymentId, $payerId)) {
            // TODO: sent mail to guest and info
        } else {
            // TODO: sent mail to guest and info
        }

        // TODO: redirect to main-page
        exit(0);
    } else {
        echo "Missing Parameters..";
        exit(1);
    }
} else {
    // TODO: redirect to main-page
    echo "User Cancelled the Approval";
    exit;
}