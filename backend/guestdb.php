<?php
class GuestDB
{
    private $db;

    public function __construct() {
        $dsn      = 'mysql:dbname=' . DATABASE_NAME . ';host=' . DATABASE_HOST;
        $user     = DATABASE_USER;
        $password = DATABASE_PASS;

        $this->db = new PDO($dsn, $user, $password, array(PDO::ATTR_PERSISTENT => true));
        $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    }

    public function listGuests() {
        $query = "SELECT ID, Firstname, Lastname, Mail, Birthday, PaymentID, ClanID FROM guests ORDER BY Lastname";
        $stmt = $this->db->prepare($query);

        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function mailExists($mail) {
        $query = "SELECT COUNT(*) AS count FROM guests WHERE Mail = :mail";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':mail' => $mail]);

        $result = $stmt->fetch();

        return ($result->count != 0);
    }

    public function addGuest($firstname, $lastname, $mail, $birthday, $paymentId, $clanId) {
        $query = "INSERT INTO guests (Firstname, Lastname, Mail, Birthday, PaymentID, ClanID) VALUES (:firstname, :lastname, :mail, :birthday, :paymentid, :clanid)";

        $stmt = $this->db->prepare($query);
        $stmt->execute([':firstname' => $firstname,
                        ':lastname' => $lastname,
                        ':mail' => $mail,
                        ':birthday' => $birthday,
                        ':paymentid' => $paymentId,
                        ':clanid' => $clanId]);

        $stmt->fetch();

        return true;
    }
}