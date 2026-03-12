<?php
// --- Strict Error Handling for API Endpoint ---
ini_set('display_errors', 0); // NEVER display errors for an API endpoint
ini_set('log_errors', 1);    // Always log errors
// Optionally, specify a custom log file:
// ini_set('error_log', dirname(__FILE__) . '/_get_php_errors.log');
error_reporting(E_ALL);

// --- Start Output Buffering (to catch any stray output) ---
// This is more of a diagnostic tool or a last resort.
// Ideally, your included files and this script should not produce stray output.
ob_start();

require_once '../config/db.php'; // Correct path from products/ to config/

$response_data = [];
$http_status_code = 200; // Default to 200 OK

try {
    // Ensure $pdo is available from db.php
    if (!isset($pdo) || !$pdo instanceof PDO) {
        // This error won't be caught by the PDOException catch block below
        // so we throw a generic one to be caught by the final catch block.
        throw new \RuntimeException("Database connection is not available in db.php.");
    }

    $stmt = $pdo->query(
        "SELECT p.id, p.name, p.description, p.price, p.img_url, p.owner_id, u.username as owner_name
         FROM products p
         LEFT JOIN users u ON p.owner_id = u.id
         ORDER BY p.name ASC"
    );
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // If products is false (error in query) or null, treat as empty
    $response_data = ($products === false || $products === null) ? [] : $products;

} catch (PDOException $e) {
    error_log("PDO Error in products/get.php: " . $e->getMessage() . " | SQLSTATE: " . $e->getCode());
    $http_status_code = 500; // Internal Server Error
    $response_data = ['error' => 'Database error occurred while fetching products.'];
    // For more detailed debugging, you might temporarily include:
    // $response_data['debug_details'] = $e->getMessage();
} catch (\Throwable $e) { // Catch any other errors/exceptions
    error_log("General Error in products/get.php: " . $e->getMessage());
    $http_status_code = 500; // Internal Server Error
    $response_data = ['error' => 'An unexpected error occurred while fetching products.'];
    // For more detailed debugging, you might temporarily include:
    // $response_data['debug_details'] = $e->getMessage();
}

// --- Clean any output that might have occurred before this point ---
// This is important if any included files or earlier code produced unexpected output.
$stray_output = ob_get_clean();
if (!empty($stray_output)) {
    error_log("Stray output detected in products/get.php: " . $stray_output);
    // If stray output is found, it means something is wrong.
    // For a robust API, you might decide to return an error here
    // if you can't guarantee clean JSON.
    // For now, we'll proceed, hoping the json_encode will be the primary output.
}

// --- Send JSON Response ---
http_response_code($http_status_code);
header('Content-Type: application/json');
header('X-Content-Type-Options: nosniff'); // Security header

echo json_encode($response_data);
exit; // Terminate script execution after sending response
?>