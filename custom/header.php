<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$current_page_script = basename($_SERVER['PHP_SELF']);

if (!isset($base_path)) {
    $doc_root = $_SERVER['DOCUMENT_ROOT'];
    $script_filename = $_SERVER['SCRIPT_FILENAME'];
    $doc_root = str_replace('\\', '/', $doc_root);
    $script_filename = str_replace('\\', '/', $script_filename);
    $web_path = str_replace($doc_root, '', $script_filename);
    $path_parts = explode('/', dirname($web_path));
    $depth = count(array_filter($path_parts));
    $base_path = str_repeat('../', $depth);
    if (empty($base_path)) {
        $base_path = './';
    }
    if (in_array($current_page_script, ['index.php', 'shop.php'])) {
        $base_path = './';
    }
}

if (!isset($page_title)) {
    $page_title = "Fasela";
}

$cart_item_count = 0;
if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        if (isset($item['quantity'])) {
            $cart_item_count += $item['quantity'];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($page_title); ?> - Fasela</title>
    <link rel="stylesheet" href="<?php echo $base_path; ?>style/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $base_path; ?>style/all.min.css"> 
    <link rel="stylesheet" href="<?php echo $base_path; ?>style/css.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <?php
    if (isset($page_specific_css) && is_array($page_specific_css)) {
        foreach ($page_specific_css as $css_file) {
            echo '<link rel="stylesheet" href="' . $base_path . htmlspecialchars($css_file) . '">' . "\n";
        }
    }
    ?>
</head>
<body>
    <script src="<?php echo $base_path; ?>js/bootstrap.bundle.js"></script>
    
    <nav class="navbar navbar-expand-lg sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold mb-3 lobster-regular " style="color: var(--color-green-dark) " href="<?php echo $base_path; ?>index.php">fasila</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
               <i class="fa-solid fa-bars-staggered"></i> 
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_page_script == 'index.php' ? 'active' : ''); ?>" href="<?php echo $base_path; ?>index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_page_script == 'shop.php' ? 'active' : ''); ?>" href="<?php echo $base_path; ?>shop.php">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_page_script == 'blog.php' ? 'active' : ''); ?>" href="<?php echo $base_path; ?>blog.php">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled <?php echo ($current_page_script == 'about.php' ? 'active' : ''); ?>" href="#">About Us</a>
                    </li>
                </ul>

                <div class="d-flex align-items-center nav-actions">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle profile-dropdown-toggle p-0" href="#" id="navbarDropdownUserLink" 
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="profile-icon-container">
                                    <i class="fas fa-user-circle fa-2x profile-avatar-icon"></i> 
                                    <span class="cart-badge-on-profile" id="cart-badge-profile" <?php echo $cart_item_count > 0 ? '' : 'style="display: none;"'; ?>>
                                        <?php echo $cart_item_count; ?>
                                    </span>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow-lg mt-2" aria-labelledby="navbarDropdownUserLink">
                                <li class="px-3 pt-2 pb-1">
                                    <div class="fw-bold text-truncate username-dropdown-header"><?php echo htmlspecialchars($_SESSION['username']); ?></div>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item <?php echo ($current_page_script == 'profile.php' ? 'active' : ''); ?>" href="<?php echo $base_path; ?>templates/profile.php">
                                    <i class="fas fa-id-card"></i>My Profile
                                </a></li>
                                
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="<?php echo $base_path; ?>Ath/logout.php">
                                    <i class="fas fa-sign-out-alt"></i>Logout
                                </a></li>
                            </ul>
                        </div>
                    <?php else: ?>
                       
                        <a href="<?php echo $base_path; ?>templates/login_form.php" class="btn btn-outline-dark rounded-pill px-4 py-1 me-2">Login</a>
                        <a href="<?php echo $base_path; ?>templates/signup_form.php" class="btn btn-dark-action">Sign up</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
