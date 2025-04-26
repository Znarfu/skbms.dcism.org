function clearErrorMessages() {
    let emailErrorMessage = document.getElementById("email-error-message");
    let ageErrorMessage = document.getElementById("age-error-message");
    let passwordErrorMessage = document.getElementById("password-error-message");

    if (emailErrorMessage) emailErrorMessage.innerText = "";
    if (ageErrorMessage) ageErrorMessage.innerText = "";
    if (passwordErrorMessage) passwordErrorMessage.innerText = "";
}

function passwordsMatch(password, repeatPassword) {
    return password === repeatPassword;
}

function isAgeNumeric(age) {
    return !isNaN(age);
}

function isAgeValid(age) {
    return age >= 15 && age <= 30;
}

function isFieldEmpty(firstName, lastName, email, age, password, repeatPassword) {
    return !firstName || !lastName || !email || !age || !password || !repeatPassword;
}

function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function validatePassword(password) {
    // At least 8 characters, at least one letter and one number
    const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
    return passwordRegex.test(password);
}

function validateForm(e) {
    let firstName = document.getElementById("first-name").value;
    let lastName = document.getElementById("last-name").value;
    let email = document.getElementById("email").value;
    let age = document.getElementById("age").value;
    let password = document.getElementById("password").value;
    let repeatPassword = document.getElementById("repeat-password").value;

    let emailErrorMessage = document.getElementById("email-error-message");
    let ageErrorMessage = document.getElementById("age-error-message");
    let passwordErrorMessage = document.getElementById("password-error-message");

    let errorRaised = false;

    clearErrorMessages();

    if (isFieldEmpty(firstName, lastName, email, age, password, repeatPassword)) {
        alert("All fields are required. Please complete the form.");
        errorRaised = true;
    }

    if (!isValidEmail(email)) {
        emailErrorMessage.innerText = "Please enter a valid email address.";
        errorRaised = true;
    }

    if (!isAgeNumeric(age)) {
        ageErrorMessage.innerText = "Age must be a number.";
        errorRaised = true;
    } else if (!isAgeValid(age)) {
        ageErrorMessage.innerText = "Age must be between 15 and 30 years.";
        errorRaised = true;
    }

    if (!validatePassword(password)) {
        passwordErrorMessage.innerText = "Password must be at least 8 characters with at least one letter and one number.";
        errorRaised = true;
    } else if (!passwordsMatch(password, repeatPassword)) {
        passwordErrorMessage.innerText = "Passwords do not match.";
        errorRaised = true;
    }

    if (errorRaised) {
        e.preventDefault();
    }
}

function clearForm(e) {
    if (!confirm("Are you sure you want to clear all fields?")) {
        e.preventDefault();
        return;
    }

    clearErrorMessages();

    let firstName = document.getElementById("first-name");
    let lastName = document.getElementById("last-name");
    let email = document.getElementById("email");
    let age = document.getElementById("age");
    let password = document.getElementById("password");
    let repeatPassword = document.getElementById("repeat-password");

    if (firstName) firstName.value = "";
    if (lastName) lastName.value = "";
    if (email) email.value = "";
    if (age) age.value = "";
    if (password) password.value = "";
    if (repeatPassword) repeatPassword.value = "";
}

window.onload = function() {
    let submitButton = document.getElementById("submit-button");
    let clearButton = document.getElementById("clear-button");
    if (submitButton) submitButton.addEventListener("click", validateForm);
    if (clearButton) clearButton.addEventListener("click", clearForm);
}