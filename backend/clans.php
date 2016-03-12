<?php
require_once('../config/config.php');

$dsn      = 'mysql:dbname=' . DATABASE_NAME . ';host=' . DATABASE_HOST;
$user     = DATABASE_USER;
$password = DATABASE_PASS;

try
{
    $db = new PDO($dsn, $user, $password, array(PDO::ATTR_PERSISTENT => true));
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
}
catch(PDOException $e)
{
    die("Database down.");
}

$method = filter_input(INPUT_GET, 'method');

switch($method) {
    case 'list':
        $query = "SELECT ID, Name FROM clans ORDER BY Name";
        $stmt = $db->prepare($query);
        
        $stmt->execute();
        $result = $stmt->fetchAll();
        
        echo json_encode($result);
        break;
    case 'select':
        // Params: ID, Password
        // return: true|false
        $payload = json_decode(file_get_contents('php://input'));
        if(!isset($payload) || !isset($payload->clanId) || !isset($payload->clanPassword)) {
            die('false');
        }
        
        $clanId = filter_var($payload->clanId, FILTER_SANITIZE_NUMBER_INT);
        $password = filter_var($payload->clanPassword);
        
        $query = "SELECT COUNT(*) AS count FROM clans WHERE ID = :id AND Password = :password";
    
        $stmt = $db->prepare($query);
        $stmt->execute([':id' => $clanId, ':password' => md5($password)]);
    
        $result = $stmt->fetch();
    
        echo json_encode($result->count > 0);
        break;
}
