<?php
require_once __DIR__ . '/includes/auth.php';
$pageTitle = 'Join the team';
$rootPath = '';
$assetPath = 'assets/';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $name = trim($_POST['full_name'] ?? '');
    $email = trim(strtolower($_POST['email'] ?? ''));
    $phone = trim($_POST['phone'] ?? '');
    $gender = trim($_POST['gender'] ?? '');
    $department = trim($_POST['department'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($name === '' || $phone === '' || $gender === '' || $department === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please complete all fields with a valid email address and select your gender.';
    }

    if (strlen($password) < 8) {
        $errors[] = 'Password must be at least 8 characters.';
    }

    if (!$errors) {
        try {
            $statement = db()->prepare('INSERT INTO users (full_name, email, phone, gender, department, password_hash) VALUES (?, ?, ?, ?, ?, ?)');
            $statement->execute([$name, $email, $phone, $gender, $department, password_hash($password, PASSWORD_DEFAULT)]);
            header('Location: login.php?registered=1');
            exit;
        } catch (PDOException $exception) {
            $errors[] = $exception->getCode() === '23000' ? 'An account with this email already exists.' : 'Registration could not be completed.';
        }
    }
}
require __DIR__ . '/includes/header.php';
?>
<div class="form-shell">
    <div class="form-intro">
        <div class="eyebrow">Employee registration</div>
        <h1>Start with your story.</h1>
        <p>Your application goes to the Dev&Co admin team for a quick review. You will be able to sign in once it is approved.</p>
        <p class="muted">Already registered? <a href="login.php"><strong>Sign in here.</strong></a></p>
    </div>
    <div class="form-card">
        <h2>Create your account</h2>
        <?php if ($errors): ?><div class="flash error"><?= e(implode(' ', $errors)) ?></div><?php endif; ?>
        <form method="post">
            <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
            <div class="field">
                <label for="full_name">Full name</label>
                <input id="full_name" name="full_name" required value="<?= e($_POST['full_name'] ?? '') ?>">
            </div>
            <div class="form-row">
                <div class="field">
                    <label for="email">Work email</label>
                    <input id="email" type="email" name="email" required value="<?= e($_POST['email'] ?? '') ?>">
                </div>
                <div class="field">
                    <label for="phone">Phone</label>
                    <input id="phone" name="phone" required value="<?= e($_POST['phone'] ?? '') ?>">
                </div>
            </div>
            <div class="field">
                <label for="gender">Gender</label>
                <select id="gender" name="gender" required>
                    <option value="">Choose your gender</option>
                    <?php foreach (['Male', 'Female', 'Other'] as $item): ?>
                        <option value="<?= e($item) ?>" <?= ($_POST['gender'] ?? '') === $item ? 'selected' : '' ?>><?= e($item) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="field">
                <label for="department">Department</label>
                <select id="department" name="department" required>
                    <option value="">Choose a department</option>
                    <?php foreach (['Engineering', 'Design', 'Marketing', 'People Operations', 'Finance', 'Customer Success'] as $item): ?>
                        <option <?= ($_POST['department'] ?? '') === $item ? 'selected' : '' ?>><?= e($item) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="field">
                <label for="password">Password</label>
                <div class="password-wrap">
                    <input id="password" type="password" name="password" minlength="8" required>
                    <button type="button" data-password-toggle="password">Show</button>
                </div>
            </div>
            <button class="button" type="submit">Submit application</button>
        </form>
    </div>
</div>
<?php require __DIR__ . '/includes/footer.php'; ?>
