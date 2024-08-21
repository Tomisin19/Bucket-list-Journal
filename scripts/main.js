"use strict";

const checkEmail = str => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(str);

const FORM = document.getElementById('form')

const show = document.getElementById('show-password-icon')
show.addEventListener("click", (e) =>

{
    const passwordInput = document.getElementById("passwd");
    const showPasswordIcon = document.getElementById("show-password-icon");

    // Toggle the type attribute of the password input
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        showPasswordIcon.classList.remove("fa-eye");
        showPasswordIcon.classList.add("fa-eye-slash");
    } else {
        passwordInput.type = "password";
        showPasswordIcon.classList.remove("fa-eye-slash");
        showPasswordIcon.classList.add("fa-eye");
}
})


if (FORM) {

    // Select all of the elements we'll need in order to perform validation.
    const usernameInput = document.getElementById("username")
    const usernameError = usernameInput.nextElementSibling;

    const nameInput = document.getElementById("name")
    const nameError = nameInput.nextElementSibling;

    const emailInput = document.getElementById("email");
    const emailError = emailInput.nextElementSibling;

    FORM.addEventListener("submit", (ev) => {
        let errors = false;

        //check is name is empty 
        if (nameInput.value.trim() === ""){
            nameError.classList.remove('hidden');
            errors = true;
        }else {
            nameError.classList.add('hidden');
        }
        // check if username is empty and handle appropriately
        if (usernameInput.value.trim() === "") {
            usernameError.classList.remove('hidden');
            errors = true;
        } else {
            usernameError.classList.add('hidden');
        }


        // check if email is valid and handle appropriately
        if (checkEmail(emailInput.value)) {
            emailError.classList.add('hidden');
        } else {
            emailError.classList.remove('hidden');
            errors = true;
        }

        // IF THERE ARE ERRORS, PREVENT FORM SUBMISSION
        if (errors) {
            ev.preventDefault();
        }
    });
}


const passwordInput = document.getElementById("passwd");
const passwordStrength = document.getElementById("password-strength");
const passwordStrengthText = document.getElementById("password-strength-text");

passwordInput.addEventListener("input", () => {
    const password = passwordInput.value;

    // Calculate password strength
    const strength = calculatePasswordStrength(password);

    // Update progress bar
    passwordStrength.value = strength;

    // Update strength text
    const strengthText = getStrengthText(strength);
    passwordStrengthText.innerText = strengthText;
});

function calculatePasswordStrength(password) {
    const hasUpperCase = /[A-Z]/.test(password);
    const hasNumber = /\d/.test(password);
    const hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(password);
    const length = password.length;

    if (hasSpecialChar && hasNumber && hasUpperCase && length > 5) {
        return 100;
    } else if (hasNumber && hasUpperCase && length > 5) {
        return 75;
    } else if (hasUpperCase && hasNumber) {
        return 50;
    } else if (hasUpperCase) {
        return 25;
    } else {
        return 0;
    }
}

function getStrengthText(strength) {
    if (strength === 100) {
        return "Very Strong";
    } else if (strength >= 75) {
        return "Strong";
    } else if (strength >= 50) {
        return "Moderate";
    } else if (strength >= 25) {
        return "Weak";
    } else {
        return "Very Weak";
    }
}

const usernameInput = document.getElementById("username");
const usernameError = usernameInput.nextElementSibling;
usernameInput.addEventListener('input', () => {
    const enteredUsername = usernameInput.value.trim();

    // Make an AJAX request to check if the username exists
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);

            if (response.exists) {
                // Username exists, show an error
                usernameError.classList.remove('hidden');
            } else {
                // Username is available, hide the error
                usernameError.classList.add('hidden');
            }
        }
    };

    // Open and send the AJAX request
    xhr.open('POST', 'check_username.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send('username=' + encodeURIComponent(enteredUsername));
});