const form = document.getElementById('contact-form');
const emailValid = document.getElementById('email-field');
const checkbox = document.getElementById('check-active');
const message = document.getElementById('validation-message');
const coverContainer = document.getElementById('cover-container');
const showContainer = document.getElementById('show-container');
const filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z]{2,4})+$/;
const valid = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[co]{2,2}$/;
const btn = document.querySelector('.arrow-button');

btn.disabled = true;

form.addEventListener('input', () => {

    if (emailValid.value == "") {
        message.textContent = 'Email address is required';
        btn.disabled = true;
    } else if (valid.test(emailValid.value)) {
        message.textContent = 'We are not accepting subscriptions from Colombia emails';
        btn.disabled = true;
    } else if (!filter.test(emailValid.value)) {
        message.textContent = 'Please provide a valid e-mail address';
        btn.disabled = true;
    } else if (filter.test(emailValid.value) && !checkbox.checked) {
        message.textContent = 'You must accept the terms and conditions';
        btn.disabled = true;
    } else {
        message.textContent = '';
        btn.disabled = false;

        form.addEventListener('submit', (event) => {
            event.preventDefault();
            coverContainer.style.display = 'none';
            showContainer.classList.add('show');
            setTimeout(() => form.submit(), 4000);
        });
    }
});