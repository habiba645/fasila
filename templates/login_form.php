<?php
session_start();
$base_path = '../';
$page_title = "Login";

$form_data_username = $_SESSION['login_form_data']['username'] ?? '';
unset($_SESSION['login_form_data']);

require_once '../custom/header.php';
?>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 70vh;">
    <div class="login-container" style="background-color: white; padding: 2rem; border-radius: 0.5rem; box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15); width: 100%; max-width: 400px;">
        <h2 class="logo-font text-center mb-3">fasila</h2>
        <h4 class="mb-4 text-center">Login to Your Account</h4>

        <?php
        if (isset($_SESSION['login_error'])) {
            echo '<div class="alert alert-danger">' . htmlspecialchars($_SESSION['login_error']) . '</div>';
            unset($_SESSION['login_error']);
        }
        ?>

        <form action="<?php echo $base_path; ?>Ath/login.php" method="POST" novalidate>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username"
                       value="<?php echo htmlspecialchars($form_data_username); ?>"
                       required minlength="3" maxlength="20" pattern="^[a-zA-Z][a-zA-Z0-9_]{2,19}$"
                       title="Username (must start with a letter)">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password"
                       required minlength="8"
                       title="Enter your password (min. 8 characters)">
            </div>
            <button type="submit" class="btn btn-success w-100">Login</button>
        </form>
        <p class="mt-3 text-center">
            Don't have an account? <a href="<?php echo $base_path; ?>templates/signup_form.php">Sign Up</a>
        </p>
        <p class="mt-2 text-center">
            <a href="<?php echo $base_path; ?>index.php">Back to Home</a>
        </p>
    </div>
</div>

<?php
require_once '../custom/footer.php';
?>