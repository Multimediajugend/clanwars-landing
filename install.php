<?php
require_once dirname(__FILE__) . "/config/config.php";

echo "Installation der Datenbank.<br>";
$force = false;
if(isset($_GET['force']) && $_GET['force'] == 'true') {
    $force = true;
    echo "Neuinstallation wird erzwungen.<br>";
}

$dsn      = 'mysql:dbname=' . DATABASE_NAME . ';host=' . DATABASE_HOST;
$user     = DATABASE_USER;
$password = DATABASE_PASS;

$db = new PDO($dsn, $user, $password, array(PDO::ATTR_PERSISTENT => true));
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);


$createClan = false;
$query = "SELECT 1 FROM clans LIMIT 1";
$stmt = $db->prepare($query);
$stmt->execute();
if($stmt->fetch()) {
    echo "Clan-Tabelle existiert bereits.<br>";
    $createClan = false;
} else {
    $createClan = true;
}
if($force) {
    echo "Lösche Clan-Tabelle.<br>";
    $query = "DROP TABLE IF EXISTS clans";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $createClan = true;
}
if($createClan) {
    $query = "CREATE TABLE clans (ID int(11) NOT NULL AUTO_INCREMENT, Name varchar(255) NOT NULL, Hash varchar(60) NOT NULL, CreationTime datetime NOT NULL, PRIMARY KEY(ID), UNIQUE(Name)) ENGINE=InnoDB DEFAULT CHARSET=latin1";
    $stmt = $db->prepare($query);
    $stmt->execute();
    echo "Clan-Tabelle erstellt.<br>";
}

$createPayment = false;
$query = "SELECT 1 FROM payments LIMIT 1";
$stmt = $db->prepare($query);
$stmt->execute();
if($stmt->fetch()) {
    echo "Payments-Tabelle existiert bereits.<br>";
    $createPayment = false;
} else {
    $createPayment = true;
}
if($force) {
    echo "Lösche Payments-Tabelle.<br>";
    $query = "DROP TABLE IF EXISTS payments";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $createPayment = true;
}
if($createPayment) {
    $query = "CREATE TABLE payments (Token varchar(255) NOT NULL, Persons text NOT NULL, ClanID int(11), CreationTime datetime NOT NULL, SuccessTime datetime NOT NULL, SuccessPayment text NOT NULL, PRIMARY KEY(Token)) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
    $stmt = $db->prepare($query);
    $stmt->execute();
    echo "Payments-Tabelle erstellt.<br>";
}

$createGuests = false;
$query = "SELECT 1 FROM guests LIMIT 1";
$stmt = $db->prepare($query);
$stmt->execute();
if($stmt->fetch()) {
    echo "Payments-Tabelle existiert bereits.<br>";
    $createGuests = false;
} else {
    $createGuests = true;
}
if($force) {
    echo "Lösche Payments-Tabelle.<br>";
    $query = "DROP TABLE IF EXISTS guests";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $createGuests = true;
}
if($createGuests) {
    $query = "CREATE TABLE guests (ID int(11) NOT NULL AUTO_INCREMENT, Firstname varchar(255) NOT NULL, Lastname varchar(255) NOT NULL, Mail varchar(255) NOT NULL, Birthday date NOT NULL, PayPalToken varchar(255) NOT NULL, ClanID int(11), PRIMARY KEY (ID)) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
    $stmt = $db->prepare($query);
    $stmt->execute();
    echo "Guests-Tabelle erstellt.<br>";
}