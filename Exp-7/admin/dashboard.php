<?php
require_once __DIR__ . '/../includes/auth.php';
require_admin();

$pageTitle = 'Admin Dashboard';
$rootPath = '../';
$assetPath = '../assets/';

$stmt = db()->query("SELECT * FROM users WHERE role = 'employee' ORDER BY created_at DESC");
$users = $stmt->fetchAll();
$totalUsers = count($users);
$approved = count(array_filter($users, fn($user) => $user['status'] === 'approved'));
$pending = count(array_filter($users, fn($user) => $user['status'] === 'pending'));

require __DIR__ . '/../includes/header.php';
?>
<div class="admin-grid">
    <div class="page-header">
        <div class="eyebrow">Overview</div>
        <h1>Employee management dashboard</h1>
    </div>

    <div class="metrics">
        <div class="metric">
            <div class="metric-label">Total employees</div>
            <div class="metric-value"><?= e((string)$totalUsers) ?></div>
        </div>
        <div class="metric">
            <div class="metric-label">Approved</div>
            <div class="metric-value"><?= e((string)$approved) ?></div>
        </div>
        <div class="metric">
            <div class="metric-label">Pending</div>
            <div class="metric-value"><?= e((string)$pending) ?></div>
        </div>
    </div>

    <div class="card table-card">
        <div class="card-header">
            <div class="eyebrow">Employee records</div>
            <h2>Manage registrations</h2>
        </div>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Gender</th>
                        <th>Department</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= e((string)$user['id']) ?></td>
                            <td><?= e($user['full_name']) ?></td>
                            <td><?= e($user['email']) ?></td>
                            <td><?= e($user['phone']) ?></td>
                            <td><?= e($user['gender'] ?? 'Not set') ?></td>
                            <td><?= e($user['department']) ?></td>
                            <td>
                                <span class="status-badge status-<?= e($user['status']) ?>"><?= e($user['status']) ?></span>
                            </td>
                            <td>
                                <div class="action-row">
                                    <form method="post" action="action.php">
                                        <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
                                        <input type="hidden" name="user_id" value="<?= e((string)$user['id']) ?>">
                                        <input type="hidden" name="action" value="approve">
                                        <button type="submit" class="small-btn approve">Approve</button>
                                    </form>
                                    <form method="post" action="action.php">
                                        <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
                                        <input type="hidden" name="user_id" value="<?= e((string)$user['id']) ?>">
                                        <input type="hidden" name="action" value="reject">
                                        <button type="submit" class="small-btn reject">Reject</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php require __DIR__ . '/../includes/footer.php'; ?>
