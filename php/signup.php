<?php
require_once '../config/db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    try {
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$username, $email, $password]);
        
        $_SESSION['user_id'] = $pdo->lastInsertId(); ////
        $_SESSION['username'] = $username;
        header('Location: ../index.php');
        exit;
    } catch (PDOException $e) {
        $error = "Error creating account: " . $e->getMessage();
    }
}
?>