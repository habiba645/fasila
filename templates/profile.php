<?php
session_start();
$base_path = '../';
$page_title = "My Profile";

if (!isset($_SESSION['user_id'])) {
    $_SESSION['login_redirect_message'] = "Please log in to view your profile.";
    header('Location: ' . $base_path . 'templates/login_form.php');
    exit;
}

require_once '../config/db.php'; 
require_once '../custom/header.php';

$username = $_SESSION['username'];

?>

<main role="main" class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6"> 
            <div class="card shadow-lg profile-card">
                <div class="card-header bg-light text-center">
                    <i class="fas fa-user-circle fa-5x mb-3" style="color: var(--color-green-medium);"></i>
                    <h2 class="lobster-regular mb-1" style="color: var(--color-green-dark);"><?php echo htmlspecialchars($username); ?></h2>
                    <p class="text-muted mb-0">Welcome to your dashboard!</p>
                </div>
                <div class="card-body p-4 text-center"> 
                    
                    <div class="mb-3">
                        <a href="<?php echo $base_path; ?>templates/add_product_form.php" class="btn btn-success rounded-pill px-4 py-2 w-100"> 
                            <i class="fas fa-plus-circle me-2"></i>
                            Add New Plant
                        </a>
                    </div>

                    <div class="mt-3">
                         <a href="<?php echo $base_path; ?>Ath/logout.php" class="btn btn-outline-danger rounded-pill px-4 py-2 w-100"> 
                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
require_once '../custom/footer.php';
?>