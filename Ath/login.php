<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $login_error = null;

    if (empty($username) || empty($password)) {
        $login_error = "Username and password are required.";
    }
    elseif (!preg_match('/^[a-zA-Z][a-zA-Z0-9_]{2,19}$/', $username)) {
         $login_error = "Invalid username or password."; // Keep generic for security
    }

    if ($login_error) {
        $_SESSION['login_error'] = $login_error;
        $_SESSION['login_form_data'] = ['username' => $username];
        header('Location: ../templates/login_form.php');
        exit;
    }

    try {
        $stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                unset($_SESSION['login_error']);
                unset($_SESSION['login_form_data']);
                header('Location: ../index.php');
                exit;
            } else {
                $_SESSION['login_error'] = "Invalid username or password.";
                error_log("Login attempt failed for user '{$username}': Incorrect password.");
            }
        } else {
            $_SESSION['login_error'] = "Invalid username or password.";
            error_log("Login attempt failed: User '{$username}' not found.");
        }
    } catch (PDOException $e) {
        error_log("Login PDOException: " . $e->getMessage());
        $_SESSION['login_error'] = "An error occurred. Please try again later.";
    }

    $_SESSION['login_form_data'] = ['username' => $username];
    header('Location: ../templates/login_form.php');
    exit;

} else {
    header('Location: ../templates/login_form.php');
    exit;
}
?>