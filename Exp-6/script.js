// Welcome function
function welcome() {
    alert("Welcome to Computer Science Department! We offer excellent programs in Web Development, Mobile Development, Data Science, and Cloud Computing. Join us to become a skilled technology professional!");
}

// Validate Login Form
function validateLoginForm() {
    const username = document.getElementById("username").value.trim();
    const password = document.getElementById("password").value;

    if (username === "") {
        alert("Username cannot be empty");
        return false;
    }

    if (password === "") {
        alert("Password cannot be empty");
        return false;
    }

    if (password.length < 4) {
        alert("Password must contain at least 4 characters");
        return false;
    }

    return true;
}

// Validate Registration Form
function validateRegistrationForm() {
    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();
    const username = document.getElementById("username").value.trim();
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirm_password").value;

    if (name === "") {
        alert("Name cannot be empty");
        return false;
    }

    if (name.length < 3) {
        alert("Name must be at least 3 characters long");
        return false;
    }

    if (email === "") {
        alert("Email cannot be empty");
        return false;
    }

    if (!validateEmail(email)) {
        alert("Please enter a valid email address");
        return false;
    }

    if (username === "") {
        alert("Username cannot be empty");
        return false;
    }

    if (username.length < 3) {
        alert("Username must be at least 3 characters long");
        return false;
    }

    if (password === "") {
        alert("Password cannot be empty");
        return false;
    }

    if (password.length < 4) {
        alert("Password must contain at least 4 characters");
        return false;
    }

    if (confirmPassword === "") {
        alert("Please confirm your password");
        return false;
    }

    if (password !== confirmPassword) {
        alert("Passwords do not match");
        return false;
    }

    return true;
}

// Email validation function
function validateEmail(email) {
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailPattern.test(email);
}

// Add smooth scrolling
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth'
            });
        }
    });
});

// Add dynamic year to footer
document.addEventListener('DOMContentLoaded', function() {
    const footerP = document.querySelector('.footer p');
    if (footerP) {
        const currentYear = new Date().getFullYear();
        if (!footerP.textContent.includes(currentYear)) {
            footerP.textContent = `© ${currentYear} Computer Science Department. All rights reserved.`;
        }
    }
});