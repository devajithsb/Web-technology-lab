<?php
require 'db.php';

$message = '';
$editContact = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'save') {
        $id = $_POST['id'] ?? '';
        $firstName = trim($_POST['first_name']);
        $lastName = trim($_POST['last_name']);
        $email = trim($_POST['email']);
        $phone = trim($_POST['phone']);

        if ($firstName === '' || $lastName === '' || $email === '' || $phone === '') {
            $message = 'Please fill in all required fields.';
        } else {
            try {
                if ($id !== '') {
                    $statement = $pdo->prepare('UPDATE contacts SET first_name = ?, last_name = ?, email = ?, phone = ? WHERE id = ?');
                    $statement->execute([$firstName, $lastName, $email, $phone, $id]);
                    $message = 'Contact updated successfully.';
                } else {
                    $statement = $pdo->prepare('INSERT INTO contacts (first_name, last_name, email, phone) VALUES (?, ?, ?, ?)');
                    $statement->execute([$firstName, $lastName, $email, $phone]);
                    $message = 'Contact added successfully.';
                }
            } catch (PDOException $exception) {
                if (($exception->errorInfo[1] ?? null) === 1062) {
                    $message = 'This email address is already saved. Please use another email.';
                } else {
                    $message = 'The contact could not be saved.';
                }
            }
        }
    }

    if ($action === 'delete') {
        $statement = $pdo->prepare('DELETE FROM contacts WHERE id = ?');
        $statement->execute([$_POST['id']]);
        $message = 'Contact deleted successfully.';
    }
}

if (isset($_GET['edit'])) {
    $statement = $pdo->prepare('SELECT * FROM contacts WHERE id = ?');
    $statement->execute([$_GET['edit']]);
    $editContact = $statement->fetch();
}

$search = trim($_GET['search'] ?? '');
if ($search !== '') {
    $statement = $pdo->prepare('SELECT * FROM contacts WHERE first_name LIKE ? OR last_name LIKE ? OR email LIKE ? ORDER BY id DESC');
    $searchValue = '%' . $search . '%';
    $statement->execute([$searchValue, $searchValue, $searchValue]);
    $contacts = $statement->fetchAll();
} else {
    $contacts = $pdo->query('SELECT * FROM contacts ORDER BY id DESC')->fetchAll();
}

function clean($value) {
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Manager</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Contact Manager</h1>
        <p>Save and manage your contacts</p>
    </header>

    <main class="container">
        <?php if ($message !== ''): ?>
            <p class="message"><?php echo clean($message); ?></p>
        <?php endif; ?>

        <section class="card">
            <h2><?php echo $editContact ? 'Edit Contact' : 'Add New Contact'; ?></h2>
            <form method="post" id="contact-form">
                <input type="hidden" name="action" value="save">
                <input type="hidden" name="id" value="<?php echo clean($editContact['id'] ?? ''); ?>">

                <label for="first_name">First Name</label>
                <input id="first_name" type="text" name="first_name" value="<?php echo clean($editContact['first_name'] ?? ''); ?>" required>
                <label for="last_name">Last Name</label>
                <input id="last_name" type="text" name="last_name" value="<?php echo clean($editContact['last_name'] ?? ''); ?>" required>
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="<?php echo clean($editContact['email'] ?? ''); ?>" required>
                <label for="phone">Phone</label>
                <input id="phone" type="text" name="phone" value="<?php echo clean($editContact['phone'] ?? ''); ?>" required>

                <button type="submit"><?php echo $editContact ? 'Update Contact' : 'Add Contact'; ?></button>
                <?php if ($editContact): ?><a class="cancel" href="index.php">Cancel</a><?php endif; ?>
            </form>
        </section>

        <section class="card">
            <div class="list-heading">
                <h2>My Contacts</h2>
                <form method="get" class="search-form">
                    <input type="search" name="search" value="<?php echo clean($search); ?>" placeholder="Search by name or email">
                    <button type="submit">Search</button>
                </form>
            </div>

            <?php if (count($contacts) === 0): ?>
                <p class="empty">No contacts found.</p>
            <?php else: ?>
                <div class="table-wrapper">
                    <table>
                        <thead><tr><th>Name</th><th>Email</th><th>Phone</th><th>Actions</th></tr></thead>
                        <tbody>
                            <?php foreach ($contacts as $contact): ?>
                                <tr>
                                    <td><?php echo clean($contact['first_name'] . ' ' . $contact['last_name']); ?></td>
                                    <td><?php echo clean($contact['email']); ?></td>
                                    <td><?php echo clean($contact['phone']); ?></td>
                                    <td class="actions">
                                        <a href="?edit=<?php echo $contact['id']; ?>">Edit</a>
                                        <form method="post" onsubmit="return confirm('Delete this contact?');">
                                            <input type="hidden" name="action" value="delete">
                                            <input type="hidden" name="id" value="<?php echo $contact['id']; ?>">
                                            <button type="submit" class="delete">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </section>
    </main>
    <script src="script.js"></script>
</body>
</html>
