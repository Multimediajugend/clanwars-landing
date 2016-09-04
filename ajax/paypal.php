<?php
require_once('../config/config.php');
require_once('../backend/paypal.php');
require_once('../backend/clan.php');
require_once('../vendor/autoload.php');


$method = filter_input(INPUT_GET, 'method');

$paypal = new PayPal();
$result = (object) ['status' => 'error', 'message' => ''];

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

        $url = $paypal->getApprovalUrl($persons, $clan);

        $result->status = 'ok';
        $result->message = $url;

        echo json_encode($result);

        exit(0);
        break;
}