<?php
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
        $query = "SELECT PaymentID, Persons, Clan, CreationTime, SuccessTime FROM payments ORDER BY CreationTime DESC";
        $stmt = $this->db->prepare($query);

        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function paymentIdExists($paymentId) {
        $query = "SELECT COUNT(*) AS count FROM payments WHERE PaymentID = :paymentid";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':paymentid' => $paymentId]);

        $result = $stmt->fetch();

        return($result->count != 0);
    }

    public function addPayment($paymentId, $persons, $clan) {
        if($this->paymentIdExists($paymentId)) {
            return false;
        }

        $query = "INSERT INTO payments (PaymentID, Persons, Clan, CreationTime, SuccessTime) VALUES (:paymentid, :persons, :clan, CURDATE(), NULL)";

        $stmt = $this->db->prepare($query);
        $stmt->execute([':paymentid' => $paymentId, ':persons' => json_encode($persons), ':clan' => json_encode($clan)]);

        $stmt->fetch();

        return true;
    }

    public function paymentSucces($paymentId) {
        if(!$this->paymentIdExists($paymentId)) {
            return false;
        }

        $query = "UPDATE payments SET SuccessTime = CURDATE()";

        $stmt = $this->db->prepare($query);
        $stmt->execute();

        $stmt->fetch();

        return true;
    }

    public function deletePayment($paymentId) {
        if(!$this->paymentIdExists($paymentId)) {
            return false;
        }

        $query = "DELETE FROM payments WHERE PaymentID = :paymentid";
        
        $stmt = $thi->db->prepare($query);
        $stmt->execute([':paymentid' => $paymentId]);

        $stmt->fetch();

        return true;
    }
}