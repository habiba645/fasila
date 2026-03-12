<?php
require_once '../config/db.php';

try {
    $stmt = $pdo->query("SELECT p.*, u.username as owner_name FROM products p JOIN users u ON p.owner_id = u.id");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    header('Content-Type: application/json');
    echo json_encode($products);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to fetch products']);
}
?>