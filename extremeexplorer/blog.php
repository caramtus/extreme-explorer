<?php
declare(strict_types=1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Read the latest outdoor stories, tips, and field notes from Extreme Explorer.">
    <title>Extreme Explorer | Journal & Blog</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Oswald:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header class="site-header">
        <a class="logo" href="index.php" aria-label="Extreme Explorer homepage">
            <span class="logo-mark">XE</span>
            <span>Extreme<br>Explorer</span>
        </a>

        <nav class="main-nav" aria-label="Main navigation">
            <a href="index.php">Home</a>
            <a href="products.php">Products</a>
            <a href="camping.php">Camping</a>
            <a href="fishing.php">Fishing</a>
            <a href="boating.php">Boating</a>
            <a class="active" href="blog.php">Blog</a>
            <a href="about.php">About</a>
            <a href="contact.php">Contact</a>
        </nav>
        <div class="header-actions">
            <form class="search-form" action="products.php" method="get" role="search">
                <label class="sr-only" for="site-search">Search products</label>
                <input id="site-search" name="search" type="search" placeholder="Search gear" required>
                <button type="submit" aria-label="Submit product search">Search</button>
            </form>
            <a class="sign-in-link" href="signin.php">Sign in</a>
        </div>
    </header>

    <main>
        <!-- Hero Section -->
        <div class="hero-blog">
            <div class="hero-overlay"></div>
            <div class="hero-content content-width">
                <p class="eyebrow">The Journal</p>
                <h1>Stories from the wild.</h1>
            </div>
        </div>

        <!-- Blog Content -->
        <div class="blog-section content-width">
            
            <div class="section-heading">
                <div>
                    <p class="section-label">Latest Articles</p>
                    <h2>Field Notes</h2>
                </div>
                <!-- Add New Blog Button linking to Contact -->
                <a class="button button-dark header-button" href="contact.php">Add New Blog <span aria-hidden="true">+</span></a>
            </div>

            <div class="blog-grid">
                
                <!-- Camping Card -->
                <article class="blog-card">
                    <a href="camping.php" class="blog-image-wrap">
                        <img src="https://images.unsplash.com/photo-1523987355523-c7b5b0dd90a7?auto=format&fit=crop&w=800&q=80" alt="Camping tent in the woods" loading="lazy">
                    </a>
                    <div class="blog-card-content">
                        <p class="product-category">Camping</p>
                        <h3><a href="camping.php">10 Essentials for Your Next Weekend Under the Stars</a></h3>
                        <p class="blog-excerpt">Everything you need to know about setting up the perfect campsite, staying warm, and sleeping comfortably in the wild.</p>
                        <a class="text-link" href="camping.php">Read story <span aria-hidden="true">→</span></a>
                    </div>
                </article>

                <!-- Fishing Card -->
                <article class="blog-card">
                    <a href="fishing.php" class="blog-image-wrap">
                        <img src="https://images.unsplash.com/photo-1574781330855-d0db8cc6a79c?q=80&w=2085&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Man fishing in river" loading="lazy">
                    </a>
                    <div class="blog-card-content">
                        <p class="product-category">Fishing</p>
                        <h3><a href="fishing.php">Finding the Perfect Catch: A Beginner's Guide</a></h3>
                        <p class="blog-excerpt">From choosing the right bait to understanding the tides, learn the fundamental skills required to reel in your first big catch.</p>
                        <a class="text-link" href="fishing.php">Read story <span aria-hidden="true">→</span></a>
                    </div>
                </article>

                <!-- Boating Card -->
                <article class="blog-card">
                    <a href="boating.php" class="blog-image-wrap">
                        <img src="https://images.unsplash.com/photo-1629181509234-9c51db33b92d?q=80&w=2340&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Boat on the water at sunset" loading="lazy">
                    </a>
                    <div class="blog-card-content">
                        <p class="product-category">Boating</p>
                        <h3><a href="boating.php">Navigating Open Waters with Confidence</a></h3>
                        <p class="blog-excerpt">Safety tips, essential boat maintenance, and how to read the weather before you leave the safety of the shoreline.</p>
                        <a class="text-link" href="boating.php">Read story <span aria-hidden="true">→</span></a>
                    </div>
                </article>

            </div>
        </div>
    </main>

    <footer class="site-footer">
        <div class="content-width footer-grid">
            <div>
                <a class="logo footer-logo" href="index.php">
                    <span class="logo-mark">XE</span>
                    <span>Extreme<br>Explorer</span>
                </a>
                <p>Gear for wherever the story takes you.</p>
            </div>
            <div>
                <h2>Visit us</h2>
                <address>140 Elizabeth Street<br>Sydney NSW 2000<br>Australia</address>
            </div>
            <div>
                <h2>Explore</h2>
                <a href="products.php">Products</a>
                <a href="blog.php">Journal</a>
                <a href="contact.php">Contact</a>
            </div>
            <div>
                <h2>Account</h2>
                <a href="signin.php">Sign in</a>
                <a href="signup.php">Create account</a>
            </div>
        </div>
        <div class="content-width footer-bottom">
            <p>&copy; <?= date('Y') ?> Extreme Explorer. All rights reserved.</p>
            <p>Built for adventure.</p>
        </div>
    </footer>
</body>
</html>