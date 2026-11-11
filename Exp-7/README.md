# Dev & Co Company Portal

A classic PHP + MySQL employee portal for XAMPP. Employees can register and sign in only after an admin approves their account. Admins can review, approve, reject, and view employee details.

## Run locally

1. Copy this folder to `C:\xampp\htdocs\program-7`.
2. Start Apache and MySQL in XAMPP.
3. Open phpMyAdmin and import `database.sql`.
4. Confirm the credentials in `config/database.php` match your local MySQL setup.
5. Visit `http://localhost/program-7/`.

Demo admin:
- Email: `admin@devandco.test`
- Password: `password`

## Flow

- Employee: register, wait for approval, then sign in and view the profile.
- Admin: sign in, review pending applications, approve/reject accounts, and view all employee details.

Passwords are hashed with PHP `password_hash`, forms use CSRF tokens, and database queries use PDO prepared statements.
