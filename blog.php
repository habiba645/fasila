<?php
session_start();
$base_path = ''; // Assuming blog.php is at the root
$page_title = "Planting Blog";

require_once 'custom/header.php'; // Include the header
?>

<main role="main">
    <div class="container mt-5 mb-5">
        <div class="text-center mb-5">
            <h1 class="display-4 lobster-regular" style="color: var(--color-green-dark);">Planting Tips & Tricks</h1>
            <p class="lead text-muted">Watch and learn how to make your garden flourish!</p>
        </div>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <!-- Video Card 1 -->
            <div class="col d-flex align-items-stretch">
                <div class="card h-100 shadow-sm product-card">
                    <div class="ratio ratio-16x9">
                        <iframe src="https://www.youtube.com/embed/8Yswx9gJE5E?si=QgGHbnH96_n7aisp" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">10 Gardening Tips for Beginners</h5>
                        <p class="card-text text-muted small">Essential advice from Epic Gardening for those new to gardening, covering common mistakes and how to succeed.</p>
                        <a href="https://www.youtube.com/embed/8Yswx9gJE5E?si=QgGHbnH96_n7aisp" class="btn btn-outline-success mt-auto" target="_blank">Watch on YouTube</a>
                    </div>
                </div>
            </div>

            <!-- Video Card 2 -->
            <div class="col d-flex align-items-stretch">
                <div class="card h-100 shadow-sm product-card">
                    <div class="ratio ratio-16x9">
                        <iframe src="https://www.youtube.com/embed/1X6KvqPjk6I?si=AoeuGS-jrIsDjfIb" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">How to Start a Vegetable Garden</h5>
                        <p class="card-text text-muted small">Roots and Refuge Farm offers a comprehensive overview and step-by-step guide to starting your own vegetable garden.</p>
                        <a href="https://www.youtube.com/embed/1X6KvqPjk6I?si=AoeuGS-jrIsDjfIb" class="btn btn-outline-success mt-auto" target="_blank">Watch on YouTube</a>
                    </div>
                </div>
            </div>

            <!-- Video Card 3 -->
            <div class="col d-flex align-items-stretch">
                <div class="card h-100 shadow-sm product-card">
                     <div class="ratio ratio-16x9">
                        <iframe src="https://www.youtube.com/embed/mDIVpJgjoXQ?si=U82PARx7ixEhiHwe" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Container Gardening: 10 Easy Steps!</h5>
                        <p class="card-text text-muted small">Next Level Gardening shows 10 easy steps to successful container gardening, perfect for small spaces or balconies.</p>
                        <a href="https://www.youtube.com/embed/mDIVpJgjoXQ?si=U82PARx7ixEhiHwe" class="btn btn-outline-success mt-auto" target="_blank">Watch on YouTube</a>
                    </div>
                </div>
            </div>

            <!-- Video Card 4 -->
            <div class="col d-flex align-items-stretch">
                <div class="card h-100 shadow-sm product-card">
                    <div class="ratio ratio-16x9">
                        <iframe src="https://www.youtube.com/embed/mDIVpJgjoXQ?si=XPhKstwbL_NEnHOP" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">How To Make Compost At Home</h5>
                        <p class="card-text text-muted small">GrowVeg explains a simple and effective method for making nutrient-rich compost at home for your garden.</p>
                        <a href="https://www.youtube.com/embed/mDIVpJgjoXQ?si=XPhKstwbL_NEnHOP" class="btn btn-outline-success mt-auto" target="_blank">Watch on YouTube</a>
                    </div>
                </div>
            </div>

             <!-- Video Card 5 -->
            <div class="col d-flex align-items-stretch">
                <div class="card h-100 shadow-sm product-card">
                    <div class="ratio ratio-16x9">
                        <iframe src="https://www.youtube.com/embed/uHLChW4R5vw?si=CkWkdz_kl3-ahanl" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">How to Grow Herbs Indoors - Guide</h5>
                        <p class="card-text text-muted small">A complete guide by Garden Answer to successfully growing a variety of herbs indoors, year-round.</p>
                        <a href="https://www.youtube.com/embed/uHLChW4R5vw?si=CkWkdz_kl3-ahanl" class="btn btn-outline-success mt-auto" target="_blank">Watch on YouTube</a>
                    </div>
                </div>
            </div>

             <!-- Video Card 6 -->
            <div class="col d-flex align-items-stretch">
                <div class="card h-100 shadow-sm product-card">
                    <div class="ratio ratio-16x9">
                        <iframe src="https://www.youtube.com/embed/BO8yuSTc3fo?si=SUUmOUIQAhseonLE" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Seed Starting 101: Beginner's Guide</h5>
                        <p class="card-text text-muted small">The Millennial Gardener teaches the basics of starting seeds indoors to get a head start on your gardening season.</p>
                        <a href="https://www.youtube.com/embed/BO8yuSTc3fo?si=SUUmOUIQAhseonLE" class="btn btn-outline-success mt-auto" target="_blank">Watch on YouTube</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>

<?php
require_once 'custom/footer.php';
?>