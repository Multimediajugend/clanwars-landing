<?php
require_once dirname(__FILE__) . "/backend/mail.php";
require_once dirname(__FILE__) . "/config/config.php";
require_once dirname(__FILE__) . "/vendor/autoload.php";

// read the data send by PayPal
$logger = new Katzgrau\KLogger\Logger(dirname(dirname(__FILE__)) . '/logs/IPN');
$req = 'cmd=_notify-validate';
foreach ($_POST as $key => $value) {
	$value = urlencode(stripslashes($value));
	$req .= "&$key=$value";
}
// post back to PayPal system to validate
$header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
$fp = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30);
if (!$fp) {
	// HTTP ERROR
} else {
	fputs ($fp, $header . $req);
	while (!feof($fp)) {
		$res = fgets ($fp, 1024);

        $_mail = new Mail();
        if (strcmp ($res, "VERIFIED") == 0 || strcmp ($res, "INVALID") == 0) {
            $_mail->sendIPNMail($res, var_dump_ret($_POST));
        }

        $logger->info('PayPal IP - ' . $res . ': ' . json_encode($_POST));
	}
	fclose ($fp);
}
function var_dump_ret($mixed = null) {
	ob_start();
	var_dump($mixed);
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}