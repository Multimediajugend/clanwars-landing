<?php
require_once dirname(dirname(__FILE__)) . "/config/config.php";
require_once dirname(__FILE__) . "/mail.php";
require_once dirname(__FILE__) . "/guestdb.php";

class PaymentDB
{
    private $db;

    public function __construct() {
        $dsn      = 'mysql:dbname=' . DATABASE_NAME . ';host=' . DATABASE_HOST;
        $user     = DATABASE_USER;
        $password = DATABASE_PASS;

        $this->db = new PDO($dsn, $user, $password, array(PDO::ATTR_PERSISTENT => true));
        $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    }

    public function listPayments() {
        $query = "SELECT Token, Persons, ClanID, CreationTime, SuccessTime FROM payments ORDER BY CreationTime DESC";
        $stmt = $this->db->prepare($query);

        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getDetails($token) {
        $query = "SELECT Persons, ClanID FROM payments WHERE Token = :token";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':token' => $token]);

        return $stmt->fetch();
    }

    public function tokenExists($token) {
        $query = "SELECT COUNT(*) AS count FROM payments WHERE Token = :token";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':token' => $token]);

        $result = $stmt->fetch();

        return($result->count != 0);
    }

    public function addPayment($token, $persons, $clanid) {
        if($this->tokenExists($token)) {
            return false;
        }

        $query = "INSERT INTO payments (Token, Persons, ClanID, CreationTime) VALUES (:token, :persons, :clanid, CURRENT_TIME)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':token' => $token, ':persons' => json_encode($persons), ':clanid' => $clanid]);

        $stmt->fetch();

        return true;
    }

    public function paymentSucces($token, $payment) {
        if(!$this->tokenExists($token)) {
            return false;
        }

        $query = "UPDATE payments SET SuccessTime = CURRENT_TIME, SuccessPayment = :payment WHERE Token = :token";

        $stmt = $this->db->prepare($query);
        $stmt->execute([':payment' => $payment, ':token' => $token]);

        $stmt->fetch();

        $guestdb = new GuestDB();
        $details = $this->getDetails($token);
        $persons = json_decode($details->Persons);
        foreach($persons as $key => $person) {
            $guestdb->addGuest($person->firstname,
                            $person->lastname,
                            $person->email,
                            $person->birthday,
                            $token,
                            $details->ClanID);
        }

        $mail = new Mail();
        $mail->sendRegistrationMail($persons);

        return true;
    }

    public function deletePayment($token) {
        if(!$this->tokenExists($token)) {
            return false;
        }

        $query = "DELETE FROM payments WHERE Token = :token";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':token' => $token]);

        $stmt->fetch();

        return true;
    }
}