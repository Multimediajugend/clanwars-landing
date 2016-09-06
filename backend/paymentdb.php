<?php
require_once dirname(dirname(__FILE__)) . "/config/config.php";

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
        $query = "SELECT Token, Persons, Clan, CreationTime, SuccessTime FROM payments ORDER BY CreationTime DESC";
        $stmt = $this->db->prepare($query);

        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getDetails($token) {
        $query = "SELECT Persons, Clan FROM payments WHERE Token = :token";
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

    public function addPayment($token, $persons, $clan) {
        if($this->tokenExists($token)) {
            return false;
        }

        $query = "INSERT INTO payments (Token, Persons, Clan, CreationTime) VALUES (:token, :persons, :clan, NOW())";

        $stmt = $this->db->prepare($query);
        $stmt->execute([':token' => $token, ':persons' => json_encode($persons), ':clan' => json_encode($clan)]);

        $stmt->fetch();

        return true;
    }

    public function paymentSucces($token, $payment) {
        if(!$this->tokenExists($token)) {
            return false;
        }

        $query = "UPDATE payments SET SuccessTime = NOW(), SuccessPayment = :payment WHERE Token = :token";

        $stmt = $this->db->prepare($query);
        $stmt->execute([':payment' => $payment, ':token' => $token]);

        $stmt->fetch();

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