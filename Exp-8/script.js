const form = document.querySelector('#contact-form');

form.addEventListener('submit', (event) => {
    const firstName = document.querySelector('#first_name').value.trim();
    const lastName = document.querySelector('#last_name').value.trim();
    const email = document.querySelector('#email').value.trim();
    const phone = document.querySelector('#phone').value.trim();
    const namePattern = /^[A-Za-z ]+$/;
    const phonePattern = /^[0-9+() -]+$/;

    if (firstName === '' || lastName === '' || email === '' || phone === '') {
        alert('Please fill in all fields.');
        event.preventDefault();
    } else if (!namePattern.test(firstName) || !namePattern.test(lastName)) {
        alert('Names should contain letters and spaces only.');
        event.preventDefault();
    } else if (!email.includes('@') || !email.includes('.')) {
        alert('Please enter a valid email address.');
        event.preventDefault();
    } else if (!phonePattern.test(phone)) {
        alert('Please enter a valid phone number.');
        event.preventDefault();
    }
});
