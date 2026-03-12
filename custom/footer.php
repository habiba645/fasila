<?php
// This $base_path calculation might still be tricky.
// It's generally better if the CALLING SCRIPT (like shop.php, login_form.php)
// defines $base_path correctly relative to ITS OWN location.
// However, for now, let's keep your logic but ensure script inclusion.
if (!isset($base_path)) {
    // This calculates base_path relative to the footer.php file itself
    // If footer.php is in 'custom/', and shop.php is in root,
    // this $base_path for shop.php would become '../' if it wasn't set by shop.php.
    // This is likely NOT what you want for paths inside shop.php's content.
    // It's better if shop.php defines $base_path = './'; and footer.php uses that.
    // For now, we will assume $base_path is correctly set by the calling page.
    $current_script_path = $_SERVER['SCRIPT_NAME'];
    $depth = substr_count(dirname($current_script_path), '/');
    $calculated_base_path_footer = str_repeat('../', $depth);
    if ($calculated_base_path_footer === '') $calculated_base_path_footer = './';
    // If $base_path wasn't set by the calling page, use the one calculated above.
    // This is a fallback, but ideally, the calling page (shop.php) should set it.
    if (!isset($base_path)) {
        $base_path = $calculated_base_path_footer;
    }
}
?>
    <footer class="site-footer pt-5 pb-4" style="background-color: #333833; color: #F5F0E8;">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <a href="<?php echo htmlspecialchars($base_path); ?>index.php" class="lobster-regular fs-4 mb-2 d-block" style="color: #8F9E8B; text-decoration: none;">fasila</a>
                    <p class="text-white-50 small">Bringing the beauty of nature to your doorstep. Explore our curated collection of healthy and vibrant plants.</p>
                </div>
                <div class="col-lg-4 col-md-3 col-6 mb-4 mb-lg-0">
                    <h5 class="mb-3 fw-bold text-white">Quick Links</h5>
                    <ul class="list-unstyled footer-links">
                        <!-- Ensure $base_path is used for links if they are relative to root -->
                        <li class="mb-1"><a href="<?php echo htmlspecialchars($base_path); ?>shop.php" style="color: #8F9E8B; text-decoration: none;">Shop</a></li>
                        <li class="mb-1"><a href="#" style="color: #8F9E8B; text-decoration: none;">About Us</a></li>
                        <li class="mb-1"><a href="<?php echo htmlspecialchars($base_path); ?>blog.php" style="color: #8F9E8B; text-decoration: none;">Blog</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-12 text-center text-lg-start">
                    <h5 class="mb-3 fw-bold text-white">Connect With Us</h5>
                    <div class="social-icons">
                        <a href="https://www.linkedin.com/in/habiba-salah-527620251/" target="_blank" aria-label="LinkedIn Profile" class="me-3" style="color: #8F9E8B; text-decoration: none;">
                            <i class="fab fa-linkedin fa-lg"></i>
                        </a>
                        <a href="https://github.com/" target="_blank" aria-label="GitHub Profile" style="color: #8F9E8B; text-decoration: none;">
                            <i class="fab fa-github fa-lg"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center copyright-text mt-4 pt-4 border-top border-secondary border-opacity-25">
                    <p class="text-white-50 small mb-0">© <?php echo date("Y"); ?> fasila. All Rights Reserved. Designed with <i class="fas fa-heart" style="color: #5A7053;"></i>.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Common JavaScript files can go here if needed, e.g., Bootstrap if not in header -->
    <!-- Example: <script src="<?php echo htmlspecialchars($base_path); ?>js/some-common-script.js"></script> -->

    <?php
    // **** THIS IS THE ADDED SECTION ****
    if (isset($page_specific_js) && is_array($page_specific_js)) {
        foreach ($page_specific_js as $js_file) {
            // $js_file is expected to be like 'js/products_shop.js'
            // $base_path is expected to be like './' (from shop.php)
            // So the src becomes './js/products_shop.js' which resolves to 'js/products_shop.js'
            echo '<script src="' . htmlspecialchars($base_path . $js_file) . '"></script>' . "\n";
        }
    }
    ?>

</body>
</html>