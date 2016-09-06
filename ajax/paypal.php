<?php
require_once dirname(dirname(__FILE__)) . "/backend/paypaldb.php";

$method = filter_input(INPUT_GET, 'method');

$paypal = new PayPalDB();
$result = (object) ['status' => 'error', 'message' => '', 'url' => '', 'paymentid' => '', 'token' => ''];

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
        $result->token = $app->token;

        echo json_encode($result);

        exit(0);
        break;
    case 'cancel':
        $payload = json_decode(file_get_contents('php://input'));
        if(isset($payload) && isset($payload->token)) {
            $token = filter_var($payload->token);
            $paypal->cancelPayment($token);
        }
        echo "cancelled";
        exit(0);
        break;
}