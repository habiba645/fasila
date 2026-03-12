<?php
session_start();
$base_path = './'; 
$page_title = "Shop Our Plants";
require_once 'custom/header.php';
?>

<main role="main" class="container mt-4 mb-5 fade-in-section">
    <div class="row mb-5 text-center">
        <div class="col-12">
            <h1 class="display-4 lobster-regular"style="color: var(--color-green-dark);">Our Plant Collection</h1>
            <p class="lead text-muted">Find the perfect green companion for your space.</p>
        </div>
    </div>

    <div id="product-grid" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        <div class="col-12 text-center" id="loading-indicator">
            <div class="spinner-border text-dark" role="status" style="width: 3.5rem; height: 3.5rem;"></div>
            <p class="mt-3 lead text-muted">Loading plants...</p>
        </div>
    </div>

    <div id="no-products-message" class="row mt-4" style="display: none;">
        <div class="col-12 text-center py-5">
            <p class="lead">No plants available at the moment.</p>
            <img src="<?php echo $base_path; ?>assets/shop1.jpeg" alt="No products found" style="max-width: 180px; opacity: 0.7;">
            <?php if (isset($_SESSION['user_id'])): ?>
            <p class="mt-3">
            <?php else: ?>
            <p class="mt-3 text-muted">Check back soon for new arrivals!</p>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php
$page_specific_js = ['js/products_shop.js']; 
require_once 'custom/footer.php';
?>