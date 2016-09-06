<?php
require_once dirname(dirname(__FILE__)) . "/config/config.php";

class ClanDB
{
    private $db;

    public function __construct() {
        $dsn      = 'mysql:dbname=' . DATABASE_NAME . ';host=' . DATABASE_HOST;
        $user     = DATABASE_USER;
        $password = DATABASE_PASS;

        $this->db = new PDO($dsn, $user, $password, array(PDO::ATTR_PERSISTENT => true));
        $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    }

    public function listClans() {
        $query = "SELECT ID AS id, Name AS name FROM clans ORDER BY Name";
        $stmt = $this->db->prepare($query);
        
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getID($clanName) {
        $query = "SELECT ID AS id FROM clans WHERE Name = :name";
        $stmt = $this->db->prepare($query);

        $stmt->execute([':name' => $clanName]);
        $result = $stmt->fetch();

        if(!$result) {
            return null;
        }
        return $result->id;
    }

    public function clanExists($clanName) {
        $query = "SELECT COUNT(*) AS count FROM clans WHERE Name = :name";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':name' => $clanName]);
        
        $result = $stmt->fetch();

        return ($result->count != 0);
    }

    public function checkPasswordById($clanID, $password) {
        $query = "SELECT Hash FROM clans WHERE ID = :id";

        $stmt = $this->db->prepare($query);
        $stmt->execute([':id' => $clanID]);

        $result = $stmt->fetch();

        if(!$result) {
            return false;
        }
        return password_verify($password, $result->Hash);
    }

    public function checkPasswordByName($clanName, $password) {
        $query = "SELECT Hash FROM clans WHERE Name = :name";

        $stmt = $this->db->prepare($query);
        $stmt->execute([':name' => $clanName]);

        $result = $stmt->fetch();

        if(!$result) {
            return false;
        }
        return password_verify($password, $result->Hash);
    }

    public function addClan($clanName, $password) {
        if($this->clanExists($clanName)) {
            return false;
        }

        $hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => HASH_COST]);

        $query = "INSERT INTO clans (Name, Hash, CreationTime) VALUES (:name, :hash, CURDATE())";
        
        $stmt = $this->db->prepare($query);
        $stmt->execute([':name' => $clanName, ':hash' => $hash]);

        $stmt->fetch();

        return true;
    }
}