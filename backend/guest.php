<?php
class Guest
{
    private $db;

    public function __construct() {
        $dsn      = 'mysql:dbname=' . DATABASE_NAME . ';host=' . DATABASE_HOST;
        $user     = DATABASE_USER;
        $password = DATABASE_PASS;

        $this->db = new PDO($dsn, $user, $password, array(PDO::ATTR_PERSISTENT => true));
        $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    }

    public function listGuests($showDetails) {
        if($showDetails) {
            $query = "SELECT ID, Name, Prename, Mail, Birthday, Registerday, Details FROM guests ORDER BY Name";    
        } else {
            $query = "SELECT ID, Name, Prename, Mail, Birthday, Registerday FROM guests ORDER BY Name";
        }
        $stmt = $this->db->prepare($query);

        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function mailExists($mail) {
        $query = "SELECT COUNT(*) AS count FROM guests WHERE Mail = :mail";
        //$query = "SELECT * FROM guests WHERE Mail = :mail";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':mail' => $mail]);

        $result = $stmt->fetch();

        return ($result->count != 0);
    }

    public function addGuest($name, $prename, $mail, $birthday, $details) {
        if($this->mailExists($mail)) {
            return false;
        }

        $query = "INSERT INTO guests (Name, Prename, Mail, Birthday, Registerday, Details) VALUES (:name, :prename, :mail, :birthday, CURDATE(), :details)";
        
        $stmt = $this->db->prepare($query);
        $stmt->execute([':name' => $name, ':prename' => $prename, ':mail' => $mail,
                        ':details' => $details,
                        ':birthday' => $birthday]);

        $stmt->fetch();

        return true;                        
    }
}