<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/db.php';

$featuredProducts = [];
$databaseMessage = '';

if ($pdo instanceof PDO) {
    try {
        $statement = $pdo->prepare(
            'SELECT productID, productName, description, price, image, catName
             FROM products
             INNER JOIN category ON products.catID = category.catID
             WHERE isFeatured = :featured
             ORDER BY productID DESC
             LIMIT 4'
        );
        $statement->execute(['featured' => 1]);
        $featuredProducts = $statement->fetchAll();
    } catch (PDOException $exception) {
        error_log($exception->getMessage());
        $databaseMessage = 'Featured products are being updated. Please check back soon.';
    }
} else {
    $databaseMessage = 'Featured products are temporarily unavailable.';
}

function escape(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function shortDescription(string $description, int $length = 105): string
{
    if (mb_strlen($description) <= $length) {
        return $description;
    }

    return mb_substr($description, 0, $length - 1) . '…';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Shop camping, fishing and boating equipment from Extreme Explorer in Sydney, Australia.">
    <title>Extreme Explorer | Gear for the Outdoors</title>
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
            <a href="blog.php">Blog</a>
            <a class="active" href="about.php">About</a>
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
        <section class="hero">
        <div class="hero-about">
            <div class="hero-overlay"></div>
            <div class="hero-content content-width">
                <p class="hero-copy">About Us</p>
                <h1>Sleep beneath the stars.<br>Live bigger.</h1>
                <a class="button button-light" href="products.php">Explore all gear <span aria-hidden="true">→</span></a>
            </div>
</section>
        </div>
         <div class="section-about-us">
         <div class="row">
  <div class="column">
 <p class="ab-intro fontsize-lg">
            Welcome to Extreme Explorer, your trusted, lifelong companion for the great outdoors. We believe that life is best experienced outside, breathing in the fresh air and chasing the next horizon. Whether you are casting a line at dawn, navigating open waters, or setting up camp beneath a canopy of stars, we are here to equip your journey.<br/>

Born from a genuine passion for fishing, camping, and boating, our mission is simple: to provide premium, dependable gear that elevates every adventure. We know that out in the wild, the quality of your equipment matters. That is exactly why we thoughtfully curate our entire collection, ensuring every product we carry is built to withstand the elements and perform when you need it most.<br/>

More than just an outdoor brand, we are a community of passionate explorers. So gear up, step outside today, and let’s make your next adventure your best one yet.
          </p>
  </div>
  <div class="column"> 
    <div class="about-us pad--top-md heading-highlight">
         
           <div class="section-owner">
          <img class="img-owner" src="https://images.unsplash.com/photo-1590456987995-15a2924fa659?q=80&w=987&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Owner of Bryan" />
          <p class="eyebrow">Bryan Smith</p>
          <h1>Founder of Extreme Explorer</h1>
        </div>
    </div>
            </div>
       
        </div>
       
      </div>
 <main>
     
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