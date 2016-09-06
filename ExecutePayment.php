<?php
require_once dirname(__FILE__) . "/backend/paypaldb.php";

$paypal = new PayPalDB();

if(isset($_GET['success'])) {
    if(isset($_GET['token'])) {
        $token = $_GET['token'];
    } else {
        redirect();
    }

    if($_GET['success'] == 'true') {
        if(isset($_GET['paymentId']) && isset($_GET['PayerID']))
        {
            $paymentId = $_GET['paymentId'];
            $execution->setPayerId($_GET['PayerID']);

            $paypal = new PayPalDB();

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
        $paypal->cancelPayment($token);
        redirect('#Anmeldung');
    }
}
redirect();

function redirect($param) {
    header('Location: /'.$param);
    exit();
}