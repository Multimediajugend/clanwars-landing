<?php
$configFile = './config/config.php';
if(!file_exists($configFile)) {
    echo "The config-file is missing. You must copy config.example.php and change the settings.\n";
    exit(1);
}
require $configFile;

$composerAutoload = './vendor/autoload.php';
if(!file_exists($composerAutoload)) {
    echo "The 'vendor' folder is missing. You must run 'composer update' to resolve application dependencies.\nPlease see the README for more information.\n";
    exit(1);
}
require $composerAutoload;

// Create logs-directory if necessary
if(!is_dir('./logs')) {
    mkdir('./logs');
}

use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

$clientId = PAYPAL_CLIENT_ID;
$clientSecret = PAYPAL_CLIENT_SECRET;

$apiContext = getApiContext($clientId, $clientSecret);

return $apiContext;

function getApiContext($clientId, $clientSecret)
{
    $apiContext = new ApiContext(
        new OAuthTokenCredential(
            $clientId,
            $clientSecret
        )
    );

    $apiContext->setConfig(
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
    return $apiContext;
}