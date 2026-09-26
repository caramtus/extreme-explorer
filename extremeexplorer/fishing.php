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
            <a  href="index.php">Home</a>
            <a href="products.php">Products</a>
            <a href="camping.php">Camping</a>
            <a class="active" href="fishing.php">Fishing</a>
            <a href="boating.php">Boating</a>
            <a href="blog.php">Blog</a>
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
        <section class="hero fishing-card ">
            <div class="hero-overlay"></div>
            <div class="hero-content content-width">
                <p class="hero-copy">Fishing</p>
                <h1>Catch more, worry less.</h1>
                    <a class="button button-light" href="products.php">Explore all gear <span aria-hidden="true">→</span></a>
            </div>
      
        </section>
<section class="section-about-us">
    <div class="row">
        <div class="column">
            <p class="ab-intro">
                The right fishing gear helps you focus on the experience, from
                an early start by the water to the moment you land your catch.
                Extreme Explorer has dependable equipment for your next trip.
                <br><br>
                Our range is selected for quality, reliability and practicality.
                Whether you’re heading out for a quiet day or exploring somewhere
                new, gear up and enjoy more time on the water.
                <br><br>
                Adventure further. Explore more. Catch more, worry less.
            </p>
        </div>

        <div class="column">
            <div class="about-us">
                <div class="section-owner">
                    <img
                        class="img-owner"
                        src="https://images.unsplash.com/photo-1541742425281-c1d3fc8aff96?auto=format&fit=crop&w=1000&q=85"
                        alt="Fishing on the water"
                        loading="lazy"
                    >
                    <p class="eyebrow">Fishing with confidence</p>
                    <h2>Make every cast count</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="products-section">
            <div class="content-width">
                <div class="section-heading">
                    <div>
                        <p class="section-label">Selected for you</p>
                        <h2>Highlight products</h2>
                    </div>
                    <a class="text-link" href="products.php">View all products <span aria-hidden="true">→</span></a>
                </div>

                <?php if ($featuredProducts !== []): ?>
                    <div class="product-grid">
                        <?php foreach ($featuredProducts as $product): ?>
                            <article class="product-card">
                                <a class="product-image-wrap" href="product.php?id=<?= (int) $product['productID'] ?>">
                                    <img
                                        src="<?= escape((string) $product['image']) ?>"
                                        alt="<?= escape((string) $product['productName']) ?>"
                                        loading="lazy"
                                    >
                                    <span class="product-arrow" aria-hidden="true">↗</span>
                                </a>
                                <p class="product-category"><?= escape((string) $product['catName']) ?></p>
                                <h3><a href="product.php?id=<?= (int) $product['productID'] ?>"><?= escape((string) $product['productName']) ?></a></h3>
                                <p class="product-description"><?= escape(shortDescription((string) $product['description'])) ?></p>
                                <p class="product-price">$<?= number_format((float) $product['price'], 2) ?> AUD</p>
                            </article>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="database-message"><?= escape($databaseMessage !== '' ? $databaseMessage : 'No featured products have been added yet.') ?></p>
                <?php endif; ?>
            </div>
</section>





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