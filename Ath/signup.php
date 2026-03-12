<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    $errors = [];

    if (empty($username)) {
        $errors['username'] = "Username is required.";
    } elseif (!preg_match('/^[a-zA-Z][a-zA-Z0-9_]{2,19}$/', $username)) {
        $errors['username'] = "Username must start with a letter, be 3-20 characters long, and contain only letters, numbers, or underscores.";
    } else {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->execute([$username]);
        if ($stmt->fetch()) {
            $errors['username'] = "Username already taken. Please choose another.";
        }
    }

    if (empty($email)) {
        $errors['email'] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
    } else {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $errors['email'] = "Email address already registered. Please use another or login.";
        }
    }

    if (empty($password)) {
        $errors['password'] = "Password is required.";
    } else {
        $minLength = 8;
        $password_detail_errors_messages = [];

        if (strlen($password) < $minLength) {
            $errors['password'] = "Password must be at least {$minLength} characters long.";
        }
        if (!preg_match('/[A-Z]/', $password)) {
            $password_detail_errors_messages[] = "one uppercase letter";
        }
        if (!preg_match('/[a-z]/', $password)) {
            $password_detail_errors_messages[] = "one lowercase letter";
        }
        if (!preg_match('/[0-9]/', $password)) {
            $password_detail_errors_messages[] = "one number";
        }

        if (!empty($password_detail_errors_messages)) {
            $existing_error = $errors['password'] ?? "Password must be at least {$minLength} characters";
            if (strlen($password) >= $minLength) { // If length was okay but complexity failed
                 $errors['password'] = "Password must include " . implode(', ', $password_detail_errors_messages) . ".";
            } else { // If length also failed
                $errors['password'] = $existing_error . " and include " . implode(', ', $password_detail_errors_messages) . ".";
            }
        }

        if ($password !== $confirm_password) {
            $errors['confirm_password'] = "Passwords do not match.";
        }
    }

    if (empty($confirm_password)) {
        if (!isset($errors['confirm_password'])) {
             $errors['confirm_password'] = "Please confirm your password.";
        }
    }

    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        try {
            $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$username, $email, $hashed_password]);

            $_SESSION['user_id'] = $pdo->lastInsertId();
            $_SESSION['username'] = $username;
            unset($_SESSION['signup_errors']);
            unset($_SESSION['form_data']);
            header('Location: ../index.php');
            exit;
        } catch (PDOException $e) {
            error_log("Signup PDOException: " . $e->getMessage());
            $_SESSION['signup_general_error'] = "An error occurred. Please try again later.";
            $_SESSION['form_data'] = ['username' => $username, 'email' => $email];
            header('Location: ../templates/signup_form.php');
            exit;
        }
    } else {
        $_SESSION['signup_errors'] = $errors;
        $_SESSION['form_data'] = ['username' => $username, 'email' => $email];
        header('Location: ../templates/signup_form.php');
        exit;
    }
} else {
    header('Location: ../templates/signup_form.php');
    exit;
}
?>