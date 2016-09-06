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
        if(isset($_GET['paymentId']) && isset($_GET['PayerID']) && isset($_GET['token']))
        {
            $paymentId = $_GET['paymentId'];
            $payerId = $_GET['PayerID'];
            $token = $_GET['token'];

            $paypal = new PayPalDB();

            $paypal->paymentSuccess($paymentId, $payerId, $token);

            //TODO: redirect to thankyou-page
            redirect();

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