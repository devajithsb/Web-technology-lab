<?php
require_once __DIR__ . '/includes/auth.php';
$pageTitle = 'Dev & Co Company Portal';
$rootPath = '';
$assetPath = 'assets/';
?>
<?php require __DIR__ . '/includes/header.php'; ?>
<div class="hero">
    <div>
        <div class="eyebrow">Welcome</div>
        <h1>Dev &amp; Co Company Portal</h1>
        <p>
            A simple place for employees to register and for administrators to manage company records.
        </p>
        <div class="hero-actions">
            <a class="button primary" href="register.php">Register</a>
            <a class="button secondary" href="login.php">Login</a>
        </div>
    </div>
    <div class="hero-panel">
        <div class="eyebrow">Portal features</div>
        <h3>Easy to use</h3>
        <p class="panel-copy">Register, wait for approval, and access your company profile securely.</p>
    </div>
</div>

<section class="info-grid">
    <div class="info-card">
        <div class="info-tag">1</div>
        <h3>Register</h3>
        <p>Submit your employee details through the registration form.</p>
    </div>
    <div class="info-card">
        <div class="info-tag">2</div>
        <h3>Get Approved</h3>
        <p>An administrator reviews your registration before access is granted.</p>
    </div>
    <div class="info-card">
        <div class="info-tag">3</div>
        <h3>Use the Portal</h3>
        <p>Log in to view the information and tools for your role.</p>
    </div>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
