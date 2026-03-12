<?php
// PLANTS/products/add.php
require_once '../config/db.php'; // Correct path from products/ to config/
session_start(); // Start session to access user_id and set messages

// --- Authentication Check ---
// Only logged-in users can add products
if (!isset($_SESSION['user_id'])) {
    // If someone tries to access this script directly without being logged in
    $_SESSION['add_product_error'] = "You must be logged in to add products.";
    header('Location: ../templates/login_form.php'); // Redirect to login
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // --- Sanitize and Validate Inputs ---
    $name = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
    $description = trim(filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING));
    // Validate price: must be a positive float
    $price_input = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
    $price = ($price_input !== false && $price_input >= 0) ? $price_input : null;
    
    // Validate img_url: should be a valid URL or a safe path string
    $img_url_input = trim(filter_input(INPUT_POST, 'img_url', FILTER_SANITIZE_URL)); // Basic sanitization
    // For local paths, you might want more specific validation if needed, but SANITIZE_URL is a good start
    $img_url = $img_url_input;


    $owner_id = $_SESSION['user_id']; // Get owner_id from the logged-in user's session

    // --- Basic Server-Side Validation ---
    $errors = [];
    if (empty($name)) {
        $errors[] = "Plant name is required.";
    }
    if ($price === null) { // Check if price was invalid or not provided
        $errors[] = "A valid, non-negative price is required.";
    }
     if (empty($img_url)) { // Check if img_url was provided
        $errors[] = "Image URL is required.";
    }
    // You could add more validation for img_url format if desired.

    if (!empty($errors)) {
        $_SESSION['add_product_error'] = implode("<br>", $errors);
        // To retain submitted values in the form (more advanced, not implemented here for simplicity)
        // $_SESSION['form_data'] = $_POST; 
        header('Location: ../templates/add_product_form.php'); // Redirect back to the form
        exit;
    }

    // --- Insert into Database ---
    try {
        $stmt = $pdo->prepare(
            "INSERT INTO products (name, description, price, img_url, owner_id) 
             VALUES (:name, :description, :price, :img_url, :owner_id)"
        );
        
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':img_url', $img_url);
        $stmt->bindParam(':owner_id', $owner_id);
        
        $stmt->execute();
        
        $_SESSION['add_product_success'] = "Product '".htmlspecialchars($name)."' added successfully!";
        header('Location: ../templates/add_product_form.php'); // Redirect back to form to add another or see success
        // Or redirect to the shop page:
        // header('Location: ../shop.php');
        exit;

    } catch (PDOException $e) {
        error_log("Error adding product: " . $e->getMessage()); // Log detailed error for admin
        $_SESSION['add_product_error'] = "Error adding product to the database. Please try again. Details: " . $e->getMessage(); // Show some error info for dev
        // $_SESSION['add_product_error'] = "Error adding product to the database. Please try again."; // For production
        header('Location: ../templates/add_product_form.php');
        exit;
    }
} else {
    // If accessed via GET or other methods, redirect to the form or homepage
    header('Location: ../templates/add_product_form.php');
    exit;
}
?>