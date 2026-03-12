<?php
require_once '../config/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price = floatval($_POST['price']);
    $img_url = trim($_POST['img_url']);
    $owner_id = $_SESSION['user_id'];
    
    try {
        $stmt = $pdo->prepare("INSERT INTO products (name, description, price, img_url, owner_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$name, $description, $price, $img_url, $owner_id]);
        
        header('Location: ../index.php');
        exit;
    } catch (PDOException $e) {
        $error = "Error adding product: " . $e->getMessage();
    }
}
?>