<?php
session_start();
$base_path = '../';
$page_title = "Sign Up";

$errors = $_SESSION['signup_errors'] ?? [];
$form_data = $_SESSION['form_data'] ?? [];

unset($_SESSION['signup_errors']);
unset($_SESSION['form_data']);

require_once '../custom/header.php';
?>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="signup-container" style="background-color: white; padding: 2rem; border-radius: 0.5rem; box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15); width: 100%; max-width: 480px;">
        <h2 class="logo-font text-center mb-3">fasila</h2>
        <h4 class="mb-4 text-center">Create Your Account</h4>

        <?php
        if (isset($_SESSION['signup_general_error'])) {
            echo '<div class="alert alert-danger">' . htmlspecialchars($_SESSION['signup_general_error']) . '</div>';
            unset($_SESSION['signup_general_error']);
        }
        ?>

        <form action="<?php echo $base_path; ?>Ath/signup.php" method="POST" novalidate>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control <?php echo isset($errors['username']) ? 'is-invalid' : ''; ?>"
                       id="username" name="username"
                       value="<?php echo htmlspecialchars($form_data['username'] ?? ''); ?>"
                       required minlength="3" maxlength="20" pattern="^[a-zA-Z][a-zA-Z0-9_]{2,19}$"
                       title="Must start with a letter, 3-20 characters. Letters, numbers, underscores allowed.">
                <?php if (isset($errors['username'])): ?>
                    <div class="invalid-feedback"><?php echo htmlspecialchars($errors['username']); ?></div>
                <?php endif; ?>
                 <small class="form-text text-muted">Starts with a letter, 3-20 characters. Letters, numbers, underscores allowed.</small>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control <?php echo isset($errors['email']) ? 'is-invalid' : ''; ?>"
                       id="email" name="email"
                       value="<?php echo htmlspecialchars($form_data['email'] ?? ''); ?>"
                       required>
                <?php if (isset($errors['email'])): ?>
                    <div class="invalid-feedback"><?php echo htmlspecialchars($errors['email']); ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control <?php echo isset($errors['password']) ? 'is-invalid' : ''; ?>"
                       id="password" name="password" required minlength="8"
                       title="Min 8 characters, 1 uppercase, 1 lowercase, 1 number.">
                <?php if (isset($errors['password'])): ?>
                    <div class="invalid-feedback"><?php echo htmlspecialchars($errors['password']); ?></div>
                <?php endif; ?>
                 <small class="form-text text-muted">
                    Min 8 characters. Must include at least one uppercase letter (A-Z), one lowercase letter (a-z), and one number (0-9).
                 </small>
            </div>

            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control <?php echo isset($errors['confirm_password']) ? 'is-invalid' : ''; ?>"
                       id="confirm_password" name="confirm_password" required minlength="8">
                <?php if (isset($errors['confirm_password'])): ?>
                    <div class="invalid-feedback"><?php echo htmlspecialchars($errors['confirm_password']); ?></div>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-success w-100">Sign Up</button>
        </form>
        <p class="mt-3 text-center">
            Already have an account? <a href="<?php echo $base_path; ?>templates/login_form.php">Login</a>
        </p>
         <p class="mt-2 text-center">
            <a href="<?php echo $base_path; ?>index.php">Back to Home</a>
        </p>
    </div>
</div>

<?php
require_once '../custom/footer.php';
?>