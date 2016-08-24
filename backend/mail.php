<?php
session_start();
require_once("../util/sendmail.php");
include_once("../securimage/securimage.php");

$method = filter_input(INPUT_GET, 'method');
$result = (object)array('status' => 'error', 'message' => 'Beim Senden der Nachricht ist leider ein Fehler aufgetreten.');

switch($method) {
    case 'contact':
        //Params: name, email, message, captcha
        $payload = json_decode(file_get_contents('php://input'));
        if(!isset($payload) || !isset($payload->name) || !isset($payload->mail) || !isset($payload->message) || !isset($payload->captcha)) {
            die(json_encode($result));
        }

        $to = CONTACT_MAIL;
        $from = CONTACT_FROM;
        $fromName = CONTACT_FROM_NAME;

        $name = filter_var($payload->name);
        $mail = filter_var($payload->mail);
        $message = nl2br(filter_var($payload->message));
        $captcha = filter_var($payload->captcha);

        $securimage = new Securimage();

        if(!$securimage->check($captcha)) {
            $result->message = 'Das Captcha war nicht korrekt.';
            die(json_encode($result));
        }

        $subject = "Clanwars 2016 - Kontakformular";

        $body = "<h2>Anfrage über das Kontakformular</h2>";
        $body .= "<b>Von</b>: " . $mail;
        $body .= " (" . $mail . ")<br>";
        $body .= "<b>Nachricht</b>:<br>" . $message;

        $Sendmail = new Sendmail();

        $Sendmail->SetFrom($from, $fromName);

        if(!$Sendmail->Send($to, $fromName, $subject, $body))
        {
            // E-Mail was not send.
            $result->message = 'Die E-Mail konnte leider nicht gesendet werden.';
            die(json_encode($result));
        }
        // Send confirmation to user

        $ConfirmMail = new Sendmail();
        
        $ConfirmMail->SetFrom($from, $fromName);

        $confirmSubject = "Deine Kontaktanfrage bei Clanwars 2016";
        $confirmBody = "Hallo " . $name . ",<br>";
        $confirmBody .= "vielen Dank für deine Nachricht. Wir werden uns schnellstmöglich um deine Anfrage kümmern. Bitte beachte, dass wir ehrenamtlich arbeiten, daher kann eine Antwort auch einmal ein paar Tage dauern.<br><br>Vielen Dank, für dein Verständnis,<br>dein Clanwars 2016-Team";
        $confirmBody .= "<br><br>Deine Nachricht:<br><i>" . $message . "</i>";

        $ConfirmMail->Send($mail, $name, $confirmSubject, $confirmBody);

        $result->status = 'ok';
        $result->message = 'Vielen Dank, Deine Nachricht wurde gesendet.';
        die(json_encode($result));
        break;
}

