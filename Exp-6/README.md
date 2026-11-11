# Computer Science Department - Dynamic Website

A complete, fully functional department webpage built with HTML, CSS, JavaScript, PHP, and MySQL database.

## Project Features

### 1. **Pages Included**
- **Home Page (index.php)** - Welcome page with hero section and feature highlights
- **Login Page (login.php)** - Secure user authentication with session management
- **Registration Page (register.php)** - User registration form with validation
- **About Us Page (about.php)** - Comprehensive department information
- **Logout Page (logout.php)** - Session destruction and redirect

### 2. **Technologies Used**
- **Frontend**: HTML5, CSS3, JavaScript (ES6+)
- **Backend**: PHP 7.0+
- **Database**: MySQL (via phpMyAdmin)
- **Server**: Apache (XAMPP)

### 3. **Key Features**
- ✅ Responsive Design (Mobile, Tablet, Desktop)
- ✅ User Authentication & Session Management
- ✅ Form Validation (Client-side & Server-side)
- ✅ SQL Injection Prevention (Prepared Statements)
- ✅ Professional UI/UX Design
- ✅ Dynamic Navigation (Shows logged-in user)
- ✅ Database Integration with user management
- ✅ Error Handling & User Feedback Messages
- ✅ Modern CSS with Gradients & Animations
- ✅ Secure Password Storage (Basic - can enhance with hashing)

---

## Installation & Setup

### Step 1: Ensure XAMPP is Running
1. Start XAMPP Control Panel
2. Start Apache and MySQL servers

### Step 2: Navigate to the Project Folder
```
C:\xampp\htdocs\program-6\
```

### Step 3: Create the Database
1. Open phpMyAdmin: http://localhost/phpmyadmin
2. Click on "SQL" tab (top menu)
3. Copy the entire content from `database_setup.sql` file
4. Paste it in the SQL editor
5. Click "Go" to execute

**OR use the command line:**
```bash
mysql -u root -p < database_setup.sql
```

### Step 4: Access the Application
Open your browser and navigate to:
```
http://localhost/program-6/
```

---

## File Structure

```
program-6/
│
├── index.php              # Home page
├── login.php              # Login page
├── register.php           # Registration page
├── about.php              # About us page
├── logout.php             # Logout functionality
├── db.php                 # Database connection
│
├── style.css              # Complete stylesheet
├── script.js              # JavaScript validations & functions
│
├── database_setup.sql     # Database creation script
└── README.md              # This file
```

---

## Database Schema

### Users Table
```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL,
    registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login TIMESTAMP NULL,
    is_active BOOLEAN DEFAULT TRUE
);
```

### Sample Credentials (Pre-loaded)
```
Username: admin
Password: admin123

Username: student1
Password: pass1234

Username: student2
Password: pass1234
```

---

## Features Explanation

### 1. **Homepage (index.php)**
- Welcome message with hero section
- Shows different content for logged-in vs. non-logged-in users
- Feature highlights about the department
- Interactive "Learn More" button
- Responsive design with gradient background

### 2. **Registration (register.php)**
- Form with validation for:
  - Full Name (minimum 3 characters)
  - Email (valid email format)
  - Username (minimum 3 characters, must be unique)
  - Password (minimum 4 characters)
  - Confirm Password (must match)
- Server-side validation with prepared statements
- User-friendly error messages
- Redirect to login page after successful registration

### 3. **Login (login.php)**
- Secure authentication system
- Session creation upon successful login
- Display username in navigation bar
- Redirect to home page after login
- Error handling for invalid credentials

### 4. **About Us (about.php)**
- Department mission and vision
- Academic programs overview
- Department information table
- Facilities and resources list
- Contact information
- Professional layout with styling

### 5. **Security Features**
- Prepared statements to prevent SQL injection
- Input validation on both client and server side
- Session management
- HTMLspecialchars() for output encoding
- Password handling (can be enhanced with hashing - use password_hash() in production)

---

## JavaScript Functions

### Form Validations
- `validateLoginForm()` - Validates login form
- `validateRegistrationForm()` - Validates registration form
- `validateEmail(email)` - Email format validation

### Interactive Functions
- `welcome()` - Welcome alert button
- Smooth scrolling for anchors
- Dynamic footer year update

---

## CSS Features

### Responsive Design
- Mobile-first approach
- Breakpoints: 768px, 480px
- Flexible grid layouts
- Responsive navigation

### UI/UX Enhancements
- Gradient backgrounds
- Smooth transitions and animations
- Box shadows for depth
- Color-coded message alerts
- Hover effects
- Professional color scheme

---

## How to Test the Application

### Test Registration
1. Click "Registration" in navbar
2. Fill in all fields:
   - Name: John Doe
   - Email: john@example.com
   - Username: johndoe
   - Password: pass123
   - Confirm: pass123
3. Click Register
4. Verify success message

### Test Login
1. Click "Login" in navbar
2. Enter credentials:
   - Username: johndoe
   - Password: pass123
3. Click Login
4. Verify redirect to home and username appears in navbar

### Test Logout
1. After logging in, click "Logout (username)" in navbar
2. Session destroyed, redirected to home page
3. Login/Registration links reappear

### Test Form Validations
1. Try submitting empty forms
2. Try invalid email formats
3. Try passwords with < 4 characters
4. Try mismatched passwords in registration

---

## Future Enhancements

### Security Improvements
- Implement password hashing (password_hash, password_verify)
- Add CSRF tokens
- Implement rate limiting
- Add email verification

### Features to Add
- Student dashboard
- Course management
- Grade tracking
- Announcement system
- Assignment submission
- User profile management
- Admin panel
- Email notifications
- Two-factor authentication

### Database Improvements
- Add more tables for courses, assignments, etc.
- Implement proper relationships
- Add transaction support
- Performance optimization with indexes

### Frontend Enhancements
- Dark mode toggle
- Multi-language support
- Advanced search functionality
- File upload feature
- Real-time notifications

---

## Troubleshooting

### Database Connection Error
**Problem**: "Connection failed: Access denied"
**Solution**:
- Check MySQL is running in XAMPP
- Verify username/password in db.php
- Check database exists: `CREATE DATABASE department_db;`

### Table Not Found Error
**Problem**: "Table 'department_db.users' doesn't exist"
**Solution**:
- Run the `database_setup.sql` script again
- Verify all SQL commands executed without errors

### Session Not Persisting
**Problem**: Login works but session lost on page refresh
**Solution**:
- Check `session_start()` is at top of each PHP file
- Verify PHP session directory permissions
- Check browser cookie settings

### Styling Not Loading
**Problem**: CSS not applied
**Solution**:
- Clear browser cache (Ctrl+F5)
- Verify style.css is in same directory
- Check file path in HTML link tag

### JavaScript Errors
**Problem**: Form validation not working
**Solution**:
- Open browser console (F12)
- Check for JavaScript errors
- Verify script.js is loaded
- Check function names in HTML onclick attributes

---

## Production Deployment Checklist

Before deploying to production:

- [ ] Change database credentials
- [ ] Implement password hashing (password_hash)
- [ ] Remove sample data from database_setup.sql
- [ ] Enable HTTPS
- [ ] Set up proper error logging
- [ ] Implement CSRF protection
- [ ] Add rate limiting
- [ ] Implement input sanitization
- [ ] Set up database backups
- [ ] Configure proper permissions
- [ ] Add email verification for registration
- [ ] Implement forgot password feature
- [ ] Set up monitoring and alerts
- [ ] Add comprehensive logging
- [ ] Conduct security audit

---

## Support & Documentation

For more information:
- PHP Documentation: https://www.php.net/manual/
- MySQL Documentation: https://dev.mysql.com/doc/
- HTML/CSS/JavaScript: https://developer.mozilla.org/

---

## License

This project is created for educational purposes. Feel free to modify and use as needed.

---

## Author

Created as a department website demonstration project.
Date: 2024

---

## Version History

### v1.0 (Current)
- Initial release
- Complete frontend and backend
- Database integration
- User authentication
- Responsive design
- Form validations
- Security features

---

## Contact & Questions

For questions or issues, please refer to the About Us page for department contact information.

Happy coding! 🚀
