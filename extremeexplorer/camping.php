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
            <a class="active" href="camping.php">Camping</a>
            <a href="fishing.php">Fishing</a>
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
        <section class="hero camping-card ">
            <div class="hero-overlay"></div>
            <div class="hero-content content-width">
                <p class="hero-copy">Camping</p>
                <h1>Sleep beneath the stars.<br>Live bigger.</h1>
                    <a class="button button-light" href="products.php">Explore all gear <span aria-hidden="true">→</span></a>
            </div>
      
        </section>
<section class="section-about-us">
    <div class="row">
        <div class="column">
            <p class="ab-intro">
                Reliable camping equipment helps you focus on the adventure.
                Whether you’re pitching a tent for a quiet weekend or exploring
                somewhere new, Extreme Explorer has gear to help you feel
                prepared.
                <br><br>
                Our carefully selected range is designed for quality,
                reliability and practicality in the outdoors. Pack your gear,
                gather your mates and enjoy a night beneath the stars.
            </p>
        </div>

        <div class="column">
            <div class="about-us">
                <div class="section-owner">
                    <img
                        class="img-owner"
                        src="https://images.unsplash.com/photo-1532339142463-fd0a8979791a?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        alt="A tent set up at a campsite"
                        loading="lazy"
                    >
                    <p class="eyebrow">Camping with confidence</p>
                    <h2>Adventure starts outside</h2>
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