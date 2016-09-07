<?php
require_once dirname(dirname(__FILE__)) . "/config/config.php";
require_once dirname(dirname(__FILE__)) . "/util/sendmail.php";

class Mail
{
    private $to;
    private $from;
    private $fromName;

    public function __construct() {
        $this->to = CONTACT_MAIL;
        $this->from = CONTACT_FROM;
        $this->fromName = CONTACT_FROM_NAME;
    }

    public function sendContactMail($name, $mail, $message, $hidden) {
        $result = (object)array('status' => 'error', 'message' => 'Beim Senden der Nachricht ist leider ein Fehler aufgetreten.');

        $subject = "Clanwars 2016 - Kontakformular";

        $body = "<h2>Anfrage über das Kontakformular</h2>";
        $body .= "<b>Von</b>: " . $mail;
        $body .= " (" . $mail . ")<br>";
        $body .= "<b>Nachricht</b>:<br>" . $message;
        if($hidden) {
            $body .= "<br><br>Zusatzinfos:<br>" . $hidden;
        }

        $Sendmail = new Sendmail();

        $Sendmail->SetFrom($this->from, $this->fromName);
        
        if(!$Sendmail->Send($this->to, $this->fromName, $subject, $body))
        {
            // E-Mail was not send.
            $result->message = 'Die E-Mail konnte leider nicht gesendet werden.'; 
            return $result;
        }

        // Send confirmation to user

        $ConfirmMail = new Sendmail();
        
        $ConfirmMail->SetFrom($this->from, $this->fromName);

        $confirmSubject = "Deine Kontaktanfrage bei Clanwars 2016";
        $confirmBody = "Hallo " . $name . ",<br>";
        $confirmBody .= "vielen Dank für deine Nachricht. Wir werden uns schnellstmöglich um deine Anfrage kümmern. Bitte beachte, dass wir ehrenamtlich arbeiten, daher kann eine Antwort auch einmal ein paar Tage dauern.<br><br>Vielen Dank, für dein Verständnis,<br>dein Clanwars 2016-Team";
        $confirmBody .= "<br><br>Deine Nachricht:<br><i>" . $message . "</i>";

        $ConfirmMail->Send($mail, $name, $confirmSubject, $confirmBody);

        $result->status = 'ok';
        $result->message = 'Vielen Dank, Deine Nachricht wurde gesendet.';
        return $result;
    }

    public function sendRegistrationMail($persons) {
        $adminSubject = "Clanwars 2016 - Registrierung";
        $userSubject = "Registrierung zur Clanwars 2016";

        $name = $persons[0]->firstname . " " . $persons[0]->lastname;
        $mail = $persons[0]->email;

        $adminBody = "<h2>Registrierung zur Clanwars 2016</h2>";
        $adminBody .= "<b>Von</b>: " . $name . " (" . $mail . ")<br>";
        $adminBody .= "Angemeldete Personen:<br>";
        
        $userBody = "Hallo " . $name . ",<br>";
        $userBody .= "vielen Dank für deine Registrierung zur Clanwars 2016. Hier findest du noch einmal alle Informationen zu deiner Registrierung:<br>";
        $userBody .= "Angemeldete Personen:<br>";

        foreach($persons as $key => $person) {
            $guestLine = $person->firstname . " " . $person->lastname . " (".$person->email.")<br>";
            $userBody .= $guestLine;
            $adminBody .= $guestLine;
        }

        $userBody .= "<br>";
        $userBody .= "Solltest du noch Fragen zu deiner Bestellung haben, schreibe uns einfach eine E-Mail an <a href=\"mailto:info@hsf-clanwars.de\">info@hsf-clanwars.de</a>.<br><br>";
        $userBody .= "Vielen Dank und bis spätestens zur Clanwars 2016,<br>";
        $userBody .= "Dein Clanwars 2016-Team";

        $userMail = new Sendmail();
        $userMail->SetFrom($this->from, $this->fromName);
        $userMail->Send($mail, $name, $userSubject, $userBody);

        $adminMail = new Sendmail();
        $adminMail->SetFrom($this->from, $this->fromName);
        $adminMail->Send($this->to, $this->fromName, $adminSubject, $adminBody);
    }
}