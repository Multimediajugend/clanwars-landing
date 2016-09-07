<?php
session_start();
require_once dirname(dirname(__FILE__)) . "/backend/mail.php";
require_once dirname(dirname(__FILE__)) . "/securimage/securimage.php";

$method = filter_input(INPUT_GET, 'method');
$result = (object)array('status' => 'error', 'message' => 'Beim Senden der Nachricht ist leider ein Fehler aufgetreten.');

switch($method) {
    case 'contact':
        //Params: name, email, message, captcha
        $payload = json_decode(file_get_contents('php://input'));
        if(!isset($payload) || !isset($payload->name) || !isset($payload->mail) || !isset($payload->message) || !isset($payload->captcha)) {
            die(json_encode($result));
        }

        $captcha = filter_var($payload->captcha);
        $securimage = new Securimage();
        if(!$securimage->check($captcha)) {
            $result->message = 'Das Captcha war nicht korrekt.';
            die(json_encode($result));
        }

        $_mail = new Mail();

        $name = filter_var($payload->name);
        $mail = filter_var($payload->mail);
        $message = nl2br(filter_var($payload->message));
        $hidden = '';
        if(isset($payload->hidden) && filter_var($payload->hidden) != null) {
            $hidden += '<br><br>Hidden Data:<br>';
            $hidden += filter_var($payload->hidden);
        }
        echo json_encode($_mail->sendContactMail($name, $mail, $message, $hidden));
        exit();
        break;
}

