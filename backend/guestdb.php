<?php
require_once dirname(dirname(__FILE__)) . "/config/config.php";
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

    public function getGuestNumber() {
        $query = "SELECT COUNT(*) AS count FROM guests";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch();

        return $result->count;
    }

    public function listGuests() {
        $query = "SELECT ID, Firstname, Lastname, Mail, Birthday, PayPalToken, ClanID FROM guests ORDER BY Lastname";
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

    public function addGuest($firstname, $lastname, $mail, $birthday, $token, $clanId) {
        $query = "INSERT INTO guests (Firstname, Lastname, Mail, Birthday, PayPalToken, ClanID) VALUES (:firstname, :lastname, :mail, :birthday, :token, :clanid)";
        $tmpBDay = DateTime::createFromFormat('d.m.Y', $birthday);

        $stmt = $this->db->prepare($query);
        $stmt->execute([':firstname' => $firstname,
                        ':lastname' => $lastname,
                        ':mail' => $mail,
                        ':birthday' => $tmpBDay->format('Y-m-d'),
                        ':token' => $token,
                        ':clanid' => $clanId]);

        $stmt->fetch();

        return true;
    }
}

