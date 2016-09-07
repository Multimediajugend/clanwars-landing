<?php
require_once dirname(dirname(__FILE__)) . "/backend/clandb.php";

$method = filter_input(INPUT_GET, 'method');

$clan = new ClanDB();

switch($method) {
    case 'list':
        echo json_encode($clan->listClans());
        exit(0);
        break;
    case 'checkPW':
        // Params: clanId, clanPassword
        // return: true|false
        $payload = json_decode(file_get_contents('php://input'));
        if(!isset($payload) || !isset($payload->clanId) || !isset($payload->clanPassword)) {
            die('false');
        }
        
        $clanId = filter_var($payload->clanId, FILTER_SANITIZE_NUMBER_INT);
        $password = filter_var($payload->clanPassword);

        echo json_encode($clan->checkPasswordById($clanId, $password));
        exit(0);
        break;
    case 'checkName':
        // Params: clanName
        // return: true|false
        $payload = json_decode(file_get_contents('php://input'));
        if(!isset($payload) || !isset($payload->clanName)) {
            die('false');
        }
        $clanName = filter_var($payload->clanName);

        echo json_encode(!$clan->clanExists($clanName));
        break;
}
