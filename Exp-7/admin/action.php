<?php
require_once __DIR__ . '/../includes/auth.php';
require_admin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: dashboard.php');
    exit;
}

verify_csrf();
$userId = (int)($_POST['user_id'] ?? 0);
$action = $_POST['action'] ?? '';

if ($userId <= 0 || !in_array($action, ['approve', 'reject'], true)) {
    header('Location: dashboard.php');
    exit;
}

$status = $action === 'approve' ? 'approved' : 'rejected';
$statement = db()->prepare('UPDATE users SET status = ? WHERE id = ? AND role = ?');
$statement->execute([$status, $userId, 'employee']);

header('Location: dashboard.php');
exit;
