<?php
require_once 'config.php';

session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(empty($_POST['login']) || empty($_POST['password'])) {
        $_SESSION['error'] = "les données obligatoires.";
        header('Location: authentifier.php');
        exit;
    } else {
        try {
            $sql = "SELECT * FROM compteadministateur WHERE loginAdmin = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$_POST['login']]);
            $admin = $stmt->fetch(PDO::FETCH_ASSOC);

            if($admin && $_POST['password'] ==  $admin['motPasse']) {
                $_SESSION['auth'] = $admin['loginAdmin'];
                header('location: espaceprivee.php');
                exit;
            } else {
                $_SESSION['error'] = "les données d'authentification sont incorrects.";
                header('Location: authentifier.php');
                exit;
            }
        } catch(PDOException $e) {
            echo 'error :' . $e->getMessage();
        }
    }
}