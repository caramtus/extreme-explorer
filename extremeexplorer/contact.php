<?php
declare(strict_types=1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Contact Extreme Explorer in Sydney, Australia.">
    <title>Extreme Explorer | Contact Us</title>
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
            <a href="about.php">About</a>
            <a class="active" href="contact.php">Contact</a>
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
        <div class="hero-contact">
            <div class="hero-overlay"></div>
            <div class="hero-content content-width">
                <p class="eyebrow">Contact Us</p>
                <h1>We're here to help.</h1>
            </div>
        </div>

        <!-- Contact Content -->
        <div class="contact-section content-width">
            <div class="contact-grid">
                
                <!-- Left Column: Information -->
                <div class="contact-info">
                    <h2>Get in Touch</h2>
                    <p class="contact-intro">Have a question about our gear or need advice for your next trip? Reach out to our team of outdoor experts.</p>
                    
                    <div class="info-block">
                        <h3>Visit Us</h3>
                        <address>140 Elizabeth Street<br>Sydney NSW 2000<br>Australia</address>
                    </div>
                    
                    <div class="info-block">
                        <h3>Email</h3>
                        <p><a href="mailto:hello@extremeexplorer.com">hello@extremeexplorer.com</a></p>
                    </div>

                    <div class="info-block">
                        <h3>Phone</h3>
                        <p><a href="tel:+61298765432">(02) 9876 5432</a></p>
                    </div>
                </div>

                <!-- Right Column: Form -->
                <div class="contact-form-wrap">
                    <form class="contact-form" action="#" method="post">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" required>
                        </div>

                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <select id="subject" name="subject" required>
                                <option value="" disabled selected>Select a topic...</option>
                                <option value="gear">Gear Advice</option>
                                <option value="order">Online Order Status</option>
                                <option value="returns">Returns & Exchanges</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea id="message" name="message" required></textarea>
                        </div>

                        <button type="submit" class="button button-dark">Send Message <span aria-hidden="true">→</span></button>
                    </form>
                </div>

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