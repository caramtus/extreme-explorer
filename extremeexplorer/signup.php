<?php
declare(strict_types=1);
session_start();
require_once __DIR__ . '/includes/db.php'; // Ensure your DB connection is loaded

$signupError = '';
$signupSuccess = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and retrieve inputs matching your database columns
    $customerName = trim($_POST['customerName'] ?? '');
    $street = trim($_POST['street'] ?? '');
    $suburb = trim($_POST['suburb'] ?? '');
    $state = trim($_POST['state'] ?? '');
    $zip = $_POST['zip'] ?? 0;
    $mobile = trim($_POST['mobile'] ?? '');
    $tel = trim($_POST['tel'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $rawPassword = $_POST['password'] ?? '';

    if ($customerName && $email && $username && $rawPassword) {
        // Secure the password before database insertion
        $hashedPassword = password_hash($rawPassword, PASSWORD_DEFAULT);

        try {
            $stmt = $pdo->prepare('
                INSERT INTO customers 
                (customerName, street, suburb, state, zip, mobile, tel, email, username, password) 
                VALUES 
                (:customerName, :street, :suburb, :state, :zip, :mobile, :tel, :email, :username, :password)
            ');
            
            $stmt->execute([
                'customerName' => $customerName,
                'street' => $street,
                'suburb' => $suburb,
                'state' => $state,
                'zip' => $zip,
                'mobile' => $mobile,
                'tel' => $tel,
                'email' => $email,
                'username' => $username,
                'password' => $hashedPassword
            ]);

            $signupSuccess = 'Account created successfully! You can now sign in.';
        } catch (PDOException $e) {
            // In a real app, check if the error is due to a duplicate email/username
            $signupError = 'An error occurred while creating your account. Please try again.';
        }
    } else {
        $signupError = 'Please fill in all required fields (Name, Email, Username, Password).';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Extreme Explorer | Create Account</title>
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
            <a href="contact.php">Contact</a>
        </nav>
        <div class="header-actions">
            <a class="sign-in-link" href="signin.php">Sign in</a>
        </div>
    </header>

    <main class="signin-main">
        <div class="signin-card signup-card">
            <h2>Join the Expedition</h2>
            <p>Create an account to track your gear and speed up checkout.</p>
            
            <?php if ($signupError): ?>
                <div class="message error-message"><?= htmlspecialchars($signupError) ?></div>
            <?php endif; ?>
            
            <?php if ($signupSuccess): ?>
                <div class="message success-message">
                    <?= htmlspecialchars($signupSuccess) ?> <a href="signin.php">Go to login →</a>
                </div>
            <?php else: ?>
                <form action="signup.php" method="post" class="auth-form">
                    
                    <div class="form-grid">
                        <!-- Account Details -->
                        <div class="form-group full-width">
                            <label for="customerName">Full Name *</label>
                            <input type="text" id="customerName" name="customerName" required>
                        </div>

                        <div class="form-group">
                            <label for="username">Username *</label>
                            <input type="text" id="username" name="username" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Email Address *</label>
                            <input type="email" id="email" name="email" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Password *</label>
                            <input type="password" id="password" name="password" required>
                        </div>

                        <div class="form-group">
                            <label for="mobile">Mobile Number</label>
                            <input type="tel" id="mobile" name="mobile">
                        </div>

                        <!-- Address Details -->
                        <div class="form-group full-width">
                            <label for="street">Street Address</label>
                            <input type="text" id="street" name="street">
                        </div>

                        <div class="form-group">
                            <label for="suburb">Suburb</label>
                            <input type="text" id="suburb" name="suburb">
                        </div>

                        <div class="form-group">
                            <label for="state">State</label>
                            <input type="text" id="state" name="state" placeholder="e.g. NSW">
                        </div>

                        <div class="form-group">
                            <label for="zip">Postcode</label>
                            <input type="number" id="zip" name="zip">
                        </div>

                        <div class="form-group">
                            <label for="tel">Home Phone</label>
                            <input type="tel" id="tel" name="tel">
                        </div>
                    </div>
                    
                    <button type="submit" class="button button-dark">Create Account <span aria-hidden="true">→</span></button>
                </form>
            <?php endif; ?>

            <div class="auth-footer">
                <p>Already have an account? <a href="signin.php" class="text-link">Sign in here</a></p>
            </div>
        </div>
    </main>
</body>
</html>