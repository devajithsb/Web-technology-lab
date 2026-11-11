<?php
require_once __DIR__ . '/includes/auth.php';
$pageTitle = 'Sign in';
$rootPath = '';
$assetPath = 'assets/';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $email = trim(strtolower($_POST['email'] ?? ''));
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? 'employee';

    $statement = db()->prepare('SELECT * FROM users WHERE email = ? AND role = ? LIMIT 1');
    $statement->execute([$email, $role]);
    $user = $statement->fetch();

    if (!$user || !password_verify($password, $user['password_hash'])) {
        $errors[] = 'Email or password is incorrect.';
    } elseif ($role === 'employee' && $user['status'] !== 'approved') {
        $errors[] = $user['status'] === 'pending' ? 'Your registration is waiting for admin approval.' : 'This employee account is not active.';
    } else {
        session_regenerate_id(true);
        $_SESSION['user'] = [
            'id' => $user['id'],
            'full_name' => $user['full_name'],
            'email' => $user['email'],
            'role' => $user['role'],
        ];
        $redirectTarget = $role === 'admin' ? 'admin/dashboard.php' : 'employee.php';
        header('Location: ' . $redirectTarget);
        exit;
    }
}
require __DIR__ . '/includes/header.php';
?>
<div class="form-shell">
    <div class="form-intro">
        <div class="eyebrow">Welcome back</div>
        <h1>Pick up where you left off.</h1>
        <p>Choose your access type and sign in to the portal. Employee accounts become available after admin approval.</p>
        <p class="muted">New employee? <a href="register.php"><strong>Register here.</strong></a></p>
    </div>
    <div class="form-card">
        <h2>Sign in</h2>
        <?php if (isset($_GET['registered'])): ?><div class="flash success">Application received. An admin must approve it before you can sign in.</div><?php endif; ?>
        <?php if ($errors): ?><div class="flash error"><?= e(implode(' ', $errors)) ?></div><?php endif; ?>
        <form method="post">
            <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
            <div class="field">
                <label for="role">I am signing in as</label>
                <select id="role" name="role">
                    <option value="employee" <?= ($_GET['role'] ?? '') !== 'admin' ? 'selected' : '' ?>>Employee</option>
                    <option value="admin" <?= ($_GET['role'] ?? '') === 'admin' ? 'selected' : '' ?>>Admin</option>
                </select>
            </div>
            <div class="field">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" required value="<?= e($_POST['email'] ?? '') ?>">
            </div>
            <div class="field">
                <label for="password">Password</label>
                <div class="password-wrap">
                    <input id="password" type="password" name="password" required>
                    <button type="button" data-password-toggle="password">Show</button>
                </div>
            </div>
            <button class="button" type="submit">Continue</button>
        </form>
    </div>
</div>
<?php require __DIR__ . '/includes/footer.php'; ?>
