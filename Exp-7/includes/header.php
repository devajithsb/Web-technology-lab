<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle ?? 'Company Portal') ?></title>
    <link rel="stylesheet" href="<?= e($assetPath ?? 'assets/') ?>style.css">
</head>
<body>
    <header class="site-header">
        <div class="container nav-wrap">
            <?php $homeUrl = ($rootPath ?? '') . 'index.php'; ?>
            <?php $registerUrl = ($rootPath ?? '') . 'register.php'; ?>
            <?php $loginUrl = ($rootPath ?? '') . 'login.php'; ?>
            <?php $dashboardUrl = ($rootPath ?? '') . 'admin/dashboard.php'; ?>
            <?php $employeeUrl = ($rootPath ?? '') . 'employee.php'; ?>
            <?php $logoutUrl = ($rootPath ?? '') . 'logout.php'; ?>

            <a href="<?= e($homeUrl) ?>" class="brand">Dev & Co</a>
            <nav class="nav">
                <a href="<?= e($homeUrl) ?>">Home</a>
                <?php if (empty($_SESSION['user'])): ?>
                    <a href="<?= e($registerUrl) ?>">Register</a>
                    <a href="<?= e($loginUrl) ?>">Login</a>
                <?php else: ?>
                    <?php if ($_SESSION['user']['role'] === 'admin'): ?>
                        <a href="<?= e($dashboardUrl) ?>">Dashboard</a>
                    <?php else: ?>
                        <a href="<?= e($employeeUrl) ?>">My Profile</a>
                    <?php endif; ?>
                    <a href="<?= e($logoutUrl) ?>">Logout</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>
    <main class="container main-content">
