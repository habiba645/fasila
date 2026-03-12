<?php
session_start(); 
$base_path = ''; 
$page_title = "Home"; 

require_once 'custom/header.php';
?>

<main role="main">
    <section class="container-fluid plant-hero-section d-flex align-items-end min-vh-hero px-0">
        <div class="container">
            <div class="row align-items-center">
                <!-- Left Side: Text Content -->
                <div class="col-lg-6 col-md-6 mb-4 mt-0 mt-sm-5">
                    <h3 class="fw-bold mb-3 lobster-regular " style="color: var(--color-green-dark);">Start your journey</h3>
                    <p class="lead">Discover a world of beautiful plants and bring nature into your home. Explore our collection and find the perfect green companion for your space.</p>
                </div>
                <!-- Right Side: Image -->
                <div class="col-lg-6 col-md-6 col-12 text-end">
                    <img src="<?php echo $base_path; ?>assets/0fe62fbe-0da9-4de4-8608-2ac66575e7a5-removebg-preview.png" 
                    alt="Decorative plant in a vase" class="img-fluid w-100 rounded">
                </div>
            </div>
        </div>
    </section>

    <div class="features mt-5 mt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 col-sm-12 d-flex justify-content-center mb-4 mb-md-0">
                    <div class="feature-box d-flex flex-column align-items-center justify-content-start w-100 text-center">
                        <i class="fa-solid fa-tree fs-1 mb-4"></i>
                        <h3 class="fw-bold mb-3 lobster-regular">get your favourite plants</h3>
                        <p class="lh-lg">Enjoy free shipping on all orders over $50. Get your plants delivered right to your doorstep.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 d-flex justify-content-center mb-4 mb-lg-0">
                    <div class="feature-box d-flex flex-column align-items-center justify-content-start w-100 text-center">
                        <i class="fa-solid fa-shop fs-1 mb-4"></i>
                        <h3 class="fw-bold mb-3 lobster-regular ">sell plants easily</h3>
                        <p class="lh-lg">We guarantee the quality of our plants. If you're not satisfied, we'll make it right.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 d-flex justify-content-center">
                    <div class="feature-box d-flex flex-column align-items-center justify-content-start w-100 text-center">
                        <i class="fa-solid fa-seedling fs-1 mb-4"></i>
                        <h3 class="fw-bold mb-3 lobster-regular">empower your planting knowledge</h3>
                        <p class="lh-lg">Our customer support team is here to help you with any questions or concerns you may have.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-5">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-12 mb-4 mb-lg-0 text-center text-lg-start">
                    <h2 class="fw-bold lobster-regular" style="color: var(--color-green-dark);">Featured Plants</h2> 
                    <p class="text-muted">Handpicked favorites just for you.</p>
                    <a href="<?php echo $base_path; ?>shop.php" class="btn mt-3" style="background-color: var(--color-green-medium); color: var(--colorbg-light); border-radius: 50px;">
                        Explore All Plants <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>

                <div class="col-lg-9 col-md-12">
                    <div class="row">
                        <!-- Product Card 1:  -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card h-100 product-card">
                                <img src="assets/home1.jpeg" class="card-img-top product-image" alt="Arpen Plant">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title lobster-regular" style="color: var(--color-green-dark);">Arpen</h5>
                                    <p class="card-text text-muted small">A popular choice for its unique foliage.</p>
                                    <p class="product-price mb-0 mt-auto">$11.00</p>
                                    
                                </div>
                            </div>
                        </div>
                        <!-- Product Card 2:  -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card h-100 product-card">
                                <img src="assets/home_plant-removebg-preview.png" class="card-img-top product-image" alt="Bamboo Plant">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title lobster-regular" style="color: var(--color-green-dark);">Bamboo</h5>
                                    <p class="card-text text-muted small">Brings luck and tranquility to any space.</p>
                                    <p class="product-price mb-0 mt-auto">$17.00</p>
                                 
                                </div>
                            </div>
                        </div>
                        <!-- Product Card 3:  -->
                        <div class="col-lg-4 col-md-6 mb-4">
                             <div class="card h-100 product-card">
                                <img src="assets/houseplant.jpg" class="card-img-top product-image" alt="Stem Plant">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title lobster-regular" style="color: var(--color-green-dark);">Stem Wonder</h5>
                                    <p class="card-text text-muted small">Easy to care for and very resilient.</p>
                                    <p class="product-price mb-0 mt-auto">$20.00</p>
                            
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div> 
</main>
<?php
require_once 'custom/footer.php'; 
?>