<?php

$dsn = "mysql:host=localhost;dbname=gestionstagiaire_v1";
$username = "root";
$pswd = "";

try {
    $conn = new PDO($dsn, $username, $pswd);                                
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>