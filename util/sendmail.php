<?php
require_once("../config/config.php");
require_once("../vendor/autoload.php");

class SendMail {
    private $mail;
    private $logger;

    public function __construct() {
        $this->logger = new Katzgrau\KLogger\Logger('./logs');

        $this->mail = new PHPMailer;
        $this->mail->SMTPDebug = 0;
        $this->mail->Debugoutput = 'html';
        $this->mail->isSMTP();                                      // Set mailer to use SMTP
        $this->mail->CharSet = 'UTF-8';
        $this->mail->Host = MAIL_HOST;                              // Specify SMTP server
        $this->mail->SMTPAuth = true;                               // Enable SMTP authentication
        $this->mail->Username = MAIL_USER;                          // SMTP username
        $this->mail->Password = MAIL_PASS;                          // SMTP password
        $this->mail->SMTPSecure = "tls";                            // Enable TLS encryption, `ssl` also accepted
        $this->mail->Port = 587;                                    // TCP port to connect to
        if(defined ("MAIL_FROM_NAME")) {
            $this->mail->setFrom(MAIL_FROM, MAIL_FROM_NAME);    
        } else {
            $this->mail->setFrom(MAIL_FROM);
        }
        $this->mail->isHTML(true);                                  // Set email format to HTML
    }

    public function SetFrom($Mail, $Name) {
        $this->mail->setFrom($Mail, $Name);
    } 

    public function Send($Address, $Name, $Subject, $Body) {
        try{
            $this->mail->addAddress($Address, $Name);                   // Add a recipient
            $this->mail->Subject = $Subject;
            $this->mail->Body    = $Body;

            if(!$this->mail->send()) {
                $this->logger->error('Send mail failed! ' . $this->mail->ErrorInfo);
            } else {
                $this->logger->info('Message with subject "' . $Subject . '" has been sent to: ' . $Name . '(' . $Address . ')');
            }
            return true;
        } catch(Exception $e) {
            $this->logger->alert('Send mail failed! '.$e->getMessage());
        }
        return false;
    }
}