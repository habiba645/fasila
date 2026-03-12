<?php
// PLANTS/templates/add_product_form.php
session_start();
$base_path = '../'; // Relative path from 'templates/' to root
$page_title = "Add New Product";

// --- Authentication Check ---
// Redirect to login if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    $_SESSION['login_redirect_message'] = "Please log in to add products."; 
    header('Location: ' . $base_path . 'templates/login_form.php');
    exit;
}

require_once '../custom/header.php';
?>

<main role="main" class="container mt-4 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0 lobster-regular">Add a New Plant</h4>
                </div>
                <div class="card-body">
                    <?php
                    // Display any error messages from a previous submission attempt
                    if (isset($_SESSION['add_product_error'])) {
                        echo '<div class="alert alert-danger">' . htmlspecialchars($_SESSION['add_product_error']) . '</div>';
                        unset($_SESSION['add_product_error']);
                    }
                    // Display success message
                    if (isset($_SESSION['add_product_success'])) {
                        echo '<div class="alert alert-success">' . htmlspecialchars($_SESSION['add_product_success']) . '</div>';
                        unset($_SESSION['add_product_success']); // Clear the message
                    }
                    ?>

                    <!-- The form will submit to products/add.php -->
                    <form action="<?php echo $base_path; ?>products/add.php" method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label">Plant Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Price ($) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="price" name="price" step="0.01" min="0" required>
                        </div>

                        <div class="mb-3">
                            <label for="img_url" class="form-label">Image URL <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="img_url" name="img_url"  required>
                            <div class="form-text">
                          
                            </div>
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-lg" style="background-color: var(--color-green-medium); color: var(--colorbg-light);">Add Plant</button>
                        </div>
                    </form>
                </div>
            </div>
            <p class="text-center mt-3">
                <a href="<?php echo $base_path; ?>shop.php" class="text-secondary">Back to Shop</a>
            </p>
        </div>
    </div>
</main>

<?php
require_once '../custom/footer.php'; // Include footer
?>