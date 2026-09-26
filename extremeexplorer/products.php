<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/db.php';

function escape(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

$search = trim((string) ($_GET['search'] ?? ''));
$categoryID = filter_input(INPUT_GET, 'category', FILTER_VALIDATE_INT);
$priceRange = (string) ($_GET['price'] ?? 'all');
$sort = (string) ($_GET['sort'] ?? 'name-asc');
$view = (string) ($_GET['view'] ?? 'grid');

$view = in_array($view, ['grid', 'list'], true) ? $view : 'grid';

$sortOptions = [
    'name-asc' => 'products.productName ASC',
    'name-desc' => 'products.productName DESC',
    'price-asc' => 'products.price ASC',
    'price-desc' => 'products.price DESC',
];
$orderBy = $sortOptions[$sort] ?? $sortOptions['name-asc'];

$priceOptions = [
    'all' => null,
    'under-50' => [0, 49.99],
    '50-100' => [50, 100],
    'over-100' => [100.01, 999999],
];

$products = [];
$categories = [];
$catalogueMessage = '';

if ($pdo instanceof PDO) {
    try {
        $categoryStatement = $pdo->query(
            'SELECT category.catID, category.catName, COUNT(products.productID) AS productCount
             FROM category
             LEFT JOIN products ON products.catID = category.catID
             GROUP BY category.catID, category.catName
             ORDER BY category.catID'
        );
        $categories = $categoryStatement->fetchAll();

        $conditions = [];
        $parameters = [];

        if ($search !== '') {
            $conditions[] = '(products.productName LIKE :searchName OR products.description LIKE :searchDescription)';
            $parameters['searchName'] = '%' . $search . '%';
            $parameters['searchDescription'] = '%' . $search . '%';
        }

        if ($categoryID !== false && $categoryID !== null && $categoryID > 0) {
            $conditions[] = 'products.catID = :categoryID';
            $parameters['categoryID'] = $categoryID;
        }

        if (isset($priceOptions[$priceRange]) && is_array($priceOptions[$priceRange])) {
            $conditions[] = 'products.price BETWEEN :minimumPrice AND :maximumPrice';
            $parameters['minimumPrice'] = $priceOptions[$priceRange][0];
            $parameters['maximumPrice'] = $priceOptions[$priceRange][1];
        }

        $whereClause = $conditions === [] ? '' : 'WHERE ' . implode(' AND ', $conditions);
        $productStatement = $pdo->prepare(
            "SELECT products.productID, products.productName, products.description,
                    products.size, products.colour, products.price, products.type,
                    category.catID, category.catName
             FROM products
             INNER JOIN category ON products.catID = category.catID
             {$whereClause}
             ORDER BY {$orderBy}"
        );
        $productStatement->execute($parameters);
        $products = $productStatement->fetchAll();
    } catch (PDOException $exception) {
        error_log($exception->getMessage());
        $catalogueMessage = 'The product catalogue is temporarily unavailable.';
    }
} else {
    $catalogueMessage = 'The product catalogue is temporarily unavailable.';
}

$totalProducts = count($products);
$catalogueTotal = array_sum(array_map(
    static fn (array $category): int => (int) $category['productCount'],
    $categories
));

function queryWith(array $changes): string
{
    $query = array_merge($_GET, $changes);

    foreach ($query as $key => $value) {
        if ($value === '' || $value === null || $value === 'all') {
            unset($query[$key]);
        }
    }

    return '?' . http_build_query($query);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Browse all wines and wine accessories available from Extreme Explorer.">
    <title>Products | Extreme Explorer</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Oswald:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="catalogue-page">
    <header class="site-header page-header">
        <a class="logo" href="index.php" aria-label="Extreme Explorer homepage">
            <span class="logo-mark">XE</span>
            <span>Extreme<br>Explorer</span>
        </a>

        <nav class="main-nav" aria-label="Main navigation">
            <a href="index.php">Home</a>
            <a class="active" href="products.php">Products</a>
            <a href="camping.php">Camping</a>
            <a href="fishing.php">Fishing</a>
            <a href="boating.php">Boating</a>
            <a href="blog.php">Blog</a>
            <a href="about.php">About</a>
            <a href="contact.php">Contact</a>
        </nav>

        <div class="header-actions">
            <form class="search-form" action="products.php" method="get" role="search">
                <label class="sr-only" for="header-search">Search products</label>
                <input id="header-search" name="search" type="search" placeholder="Search gear" value="<?= escape($search) ?>" required>
                <button type="submit" aria-label="Submit product search">Search</button>
            </form>
            <a class="sign-in-link" href="signin.php">Sign in</a>
        </div>
    </header>

    <main>
        <section class="catalogue-intro content-width">
            <p class="section-label">Explore the collection</p>
            <div class="catalogue-title-row">
                <h1>Our products</h1>
                <p>Discover red wine, white wine and considered accessories selected from our complete catalogue.</p>
            </div>
        </section>

        <section class="service-strip" aria-label="Shopping benefits">
            <span>Carefully selected products</span>
            <span>Secure and simple shopping</span>
            <span>Based in Sydney, Australia</span>
        </section>

        <form class="catalogue-toolbar" action="products.php" method="get">
            <label class="sr-only" for="catalogue-search">Search catalogue</label>
            <input id="catalogue-search" type="search" name="search" value="<?= escape($search) ?>" placeholder="Search products…">

            <?php if ($categoryID !== false && $categoryID !== null): ?>
                <input type="hidden" name="category" value="<?= (int) $categoryID ?>">
            <?php endif; ?>
            <?php if ($priceRange !== 'all'): ?>
                <input type="hidden" name="price" value="<?= escape($priceRange) ?>">
            <?php endif; ?>

            <label class="sr-only" for="sort-products">Sort products</label>
            <select id="sort-products" name="sort" onchange="this.form.submit()">
                <option value="name-asc" <?= $sort === 'name-asc' ? 'selected' : '' ?>>Name A–Z</option>
                <option value="name-desc" <?= $sort === 'name-desc' ? 'selected' : '' ?>>Name Z–A</option>
                <option value="price-asc" <?= $sort === 'price-asc' ? 'selected' : '' ?>>Price: Low–High</option>
                <option value="price-desc" <?= $sort === 'price-desc' ? 'selected' : '' ?>>Price: High–Low</option>
            </select>
            <button class="toolbar-search-button" type="submit">Search</button>

            <div class="view-switcher" aria-label="Product view">
                <a class="<?= $view === 'grid' ? 'selected' : '' ?>" href="<?= escape(queryWith(['view' => 'grid'])) ?>" aria-label="Grid view">▦</a>
                <a class="<?= $view === 'list' ? 'selected' : '' ?>" href="<?= escape(queryWith(['view' => 'list'])) ?>" aria-label="List view">☰</a>
            </div>
        </form>

        <div class="catalogue-layout">
            <aside class="catalogue-filters">
                <div class="filter-inner">
                    <div class="filter-title-row">
                        <h2>Filters</h2>
                        <a href="products.php">Clear</a>
                    </div>

                    <form action="products.php" method="get" id="filter-form">
                        <?php if ($search !== ''): ?>
                            <input type="hidden" name="search" value="<?= escape($search) ?>">
                        <?php endif; ?>
                        <input type="hidden" name="sort" value="<?= escape($sort) ?>">
                        <input type="hidden" name="view" value="<?= escape($view) ?>">

                        <fieldset class="filter-group">
                            <legend>Price</legend>
                            <select name="price" onchange="this.form.submit()">
                                <option value="all" <?= $priceRange === 'all' ? 'selected' : '' ?>>All prices</option>
                                <option value="under-50" <?= $priceRange === 'under-50' ? 'selected' : '' ?>>Under $50</option>
                                <option value="50-100" <?= $priceRange === '50-100' ? 'selected' : '' ?>>$50–$100</option>
                                <option value="over-100" <?= $priceRange === 'over-100' ? 'selected' : '' ?>>Over $100</option>
                            </select>
                        </fieldset>

                        <fieldset class="filter-group category-filter">
                            <legend>Product type</legend>
                            <label>
                                <input type="radio" name="category" value="" <?= !$categoryID ? 'checked' : '' ?> onchange="this.form.submit()">
                                <span>All products</span>
                                <small><?= $catalogueTotal ?></small>
                            </label>
                            <?php foreach ($categories as $category): ?>
                                <label>
                                    <input
                                        type="radio"
                                        name="category"
                                        value="<?= (int) $category['catID'] ?>"
                                        <?= (int) $categoryID === (int) $category['catID'] ? 'checked' : '' ?>
                                        onchange="this.form.submit()"
                                    >
                                    <span><?= escape((string) $category['catName']) ?></span>
                                    <small><?= (int) $category['productCount'] ?></small>
                                </label>
                            <?php endforeach; ?>
                        </fieldset>
                    </form>

                    <div class="catalogue-note">
                        <p class="section-label">Need help?</p>
                        <h3>Find the right choice.</h3>
                        <p>Contact our Sydney team for product information and recommendations.</p>
                        <a class="text-link" href="contact.php">Contact us <span aria-hidden="true">→</span></a>
                    </div>
                </div>
            </aside>

            <section class="catalogue-results" aria-labelledby="results-title">
                <div class="results-summary">
                    <h2 id="results-title"><?= $search !== '' ? 'Search results' : 'All products' ?></h2>
                    <span><?= $totalProducts ?> <?= $totalProducts === 1 ? 'product' : 'products' ?></span>
                </div>

                <?php if ($products !== []): ?>
                    <div class="catalogue-grid <?= $view === 'list' ? 'list-view' : '' ?>">
                        <?php foreach ($products as $product): ?>
                            <?php
                                $categoryClass = match ((int) $product['catID']) {
                                    1 => 'red-wine',
                                    2 => 'white-wine',
                                    default => 'accessory',
                                };
                            ?>
                            <article class="catalogue-card <?= escape($categoryClass) ?>">
                                <a class="catalogue-visual" href="product.php?id=<?= (int) $product['productID'] ?>" aria-label="View <?= escape((string) $product['productName']) ?>">
                                    <?php if ((int) $product['catID'] !== 3): ?>
                                        <span class="bottle" aria-hidden="true">
                                            <span class="bottle-label"><?= escape((string) $product['productName']) ?></span>
                                        </span>
                                    <?php else: ?>
                                        <span class="accessory-shape" aria-hidden="true">XE</span>
                                    <?php endif; ?>
                                    <span class="quick-arrow" aria-hidden="true">↗</span>
                                </a>

                                <div class="catalogue-card-info">
                                    <div class="card-title-price">
                                        <h3><a href="product.php?id=<?= (int) $product['productID'] ?>"><?= escape((string) $product['productName']) ?></a></h3>
                                        <strong>$<?= number_format((float) $product['price'], 2) ?></strong>
                                    </div>
                                    <p><?= escape((string) $product['catName']) ?><?= $product['colour'] ? ' · ' . escape((string) $product['colour']) : '' ?></p>
                                    <p class="catalogue-description"><?= escape((string) $product['description']) ?></p>
                                    <a class="card-link" href="product.php?id=<?= (int) $product['productID'] ?>">View product</a>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="empty-results">
                        <h3>No products found</h3>
                        <p><?= escape($catalogueMessage !== '' ? $catalogueMessage : 'Try another search or remove a filter.') ?></p>
                        <a class="button button-dark" href="products.php">View all products</a>
                    </div>
                <?php endif; ?>
            </section>
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
