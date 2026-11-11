<?php
require_once __DIR__ . '/includes/auth.php';
require_employee();

$pageTitle = 'Employee Profile';
$rootPath = '';
$assetPath = 'assets/';

$user = current_user();
$stmt = db()->prepare('SELECT * FROM users WHERE id = ? LIMIT 1');
$stmt->execute([$user['id']]);
$profile = $stmt->fetch();

$adminsStmt = db()->query("SELECT full_name, email, phone, department FROM users WHERE role = 'admin' ORDER BY full_name ASC");
$admins = $adminsStmt->fetchAll();

require __DIR__ . '/includes/header.php';
?>
<div class="card profile-card">
    <div>
        <div class="eyebrow">Employee profile</div>
        <h1><?= e($profile['full_name']) ?></h1>
    </div>
    <div class="profile-item"><strong>Email</strong><span><?= e($profile['email']) ?></span></div>
    <div class="profile-item"><strong>Phone</strong><span><?= e($profile['phone']) ?></span></div>
    <div class="profile-item"><strong>Department</strong><span><?= e($profile['department']) ?></span></div>
    <div class="profile-item"><strong>Status</strong><span><span class="status-badge status-<?= e($profile['status']) ?>"><?= e($profile['status']) ?></span></span></div>
</div>

<div class="card">
    <div class="eyebrow">Company admins</div>
    <h2>Admins</h2>

    <?php if (empty($admins)): ?>
        <p class="muted">No admin account is currently available.</p>
    <?php else: ?>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Department</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($admins as $admin): ?>
                        <tr>
                            <td><?= e($admin['full_name']) ?></td>
                            <td><?= e($admin['email']) ?></td>
                            <td><?= e($admin['phone']) ?></td>
                            <td><?= e($admin['department']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
<?php require __DIR__ . '/includes/footer.php'; ?>
