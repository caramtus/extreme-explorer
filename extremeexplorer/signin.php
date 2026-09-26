<?php
declare(strict_types=1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Extreme Explorer | Sign In</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Oswald:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- The header will sit on top of the dark forest background -->
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
            <a href="about.php">About</a>
            <a href="contact.php">Contact</a>
        </nav>
        <div class="header-actions">
            <a class="active" class="sign-in-link active" href="signin.php">Sign in</a>
        </div>
    </header>

    <main class="signin-main">
        <div class="signin-card">
            <h2>Welcome Back</h2>
            <p>Sign in to access your outdoor gear history and faster checkout.</p>
            
            <form action="signin.php" method="post" class="auth-form">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="username" id="username" name="username" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <button type="submit" class="button button-dark">Sign In <span aria-hidden="true">→</span></button>
            </form>
            
            <div class="auth-footer">
                <p>Don't have an account? <a href="signup.php" class="text-link">Create one</a></p>
            </div>
        </div>
    </main>

</body>
</html>