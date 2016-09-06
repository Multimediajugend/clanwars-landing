<?php
require_once('../config/config.php');
require_once('../backend/paypal.php');
require_once('../backend/paymentdb.php');
require_once('../backend/clan.php');
require_once('../vendor/autoload.php');


$method = filter_input(INPUT_GET, 'method');

$paypal = new PayPal();
$result = (object) ['status' => 'error', 'message' => '', 'url' => '', 'paymentid' => ''];

switch($method) {
    case 'prepare':
        $payload = json_decode(file_get_contents('php://input'));
        if(!isset($payload) || !isset($payload->persons)) {
            $result->message = 'Bitte gib die Daten für mindestens eine Person an.';
            echo json_encode($result);
            exit(1);
        }
        $persons = json_decode(filter_var($payload->persons));
        $clan = null;

        if(isset($payload->clan)) {
            $clan = json_decode(filter_var($payload->clan));
        }

        $app = $paypal->getApproval($persons, $clan);

        $result->status = 'ok';
        $result->url = $app->url;
        $result->paymentid = $app->id;

        echo json_encode($result);

        exit(0);
        break;
    case 'cancel':
        $payload = json_decode(file_get_contents('php://input'));
        if(isset($payload) && isset($payload->paymentid)) {
            $paymentid = filter_var($payload->paymentid);
            echo "paymentID: " . $paymentid;
            $paypal->cancelPayment($paymentid);
        }
        echo "cancelled";
        exit(0);
        break;
}