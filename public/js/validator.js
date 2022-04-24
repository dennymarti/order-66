let username;
let firstname;
let name;
let password;
let confirmPassword;

// regex-Patterns to validate inputs
const namePattern = '^[a-zA-Z]+$';
const passwordPattern = '^(?=.*[a-z)(?=.*[A-Z)(?=.*[0-9])(?=.*[!@#$%^&*+])(?=.{8,})';

let error;

// check if user is on login or sign up page
if (window.location.href.endsWith('login') || window.location.href.endsWith('signup')) {
    const form = document.getElementById('form');
    const inputs = form.querySelectorAll('.input');

    // add keyup and leave focus event to all inputs of form
    inputs.forEach(input => {
        input.addEventListener('keyup', checkInput);
        input.addEventListener('focusout', checkInput);
    });

    password = document.getElementById('password');

    // to avoid errors of can't read property
    if (form.classList.contains('login')) {
        username = document.getElementById('username');
    } else if (form.classList.contains('signup')) {
        firstname = document.getElementById('firstname');
        name = document.getElementById('name');
        confirmPassword = document.getElementById('confirmPassword');
    }
}

function isValid(input) {
    // input mustn't be blank
    if (input.value.length < 1) {
        error = " can't be blank.";
        return false;
    }

    // the login form just needs data to send it to php which validates the inputs to the database
    if (location.href.endsWith('signup')) {
        // check if input is a text field
        if (input.type.toString() === 'text') {
            // firstname and name must have at least three letters
            if (input.value.length < 3) {
                error = " must have at least 3 characters";
                return false;
            }
            // firstname and name may not have special characters or numbers
            if (!input.value.trim().match(namePattern)) {
                error = " may only contain letters";
                return false;
            }
            // check if input is a password field
        } else if (input.type.toString() === 'password' && input.id !== 'confirmPassword') {
            if (input.value.length < 8) {
                error = " must have at least 8 characters.";
                return false;
            }
            if (!input.value.match(passwordPattern)) {
                error = " must contain one uppercase and downcase, a number and a special character.";
                return false;
            }
            // the confirmPassword field just needs to compare both passwords
        } else if (input.id === 'confirmPassword') {
            if (input.value !== password.value) {
                error = " doesn't match.";
                return false;
            }
        }
    }
    return true;
}

function checkInput(event) {
    const input = event.currentTarget;
    const inputName = input.name.toString();

    if (isValid(input)) {
        setValid(input);
    } else {
        setInvalid(input, inputName);
    }

    // when all inputs are valid the submit button shouldn't be disabled anymore
    if (location.href.endsWith('login')) {
        if (isValid(username) && isValid(password)) {
            document.getElementById('submit').removeAttribute('disabled');
        } else {
            document.getElementById('submit').setAttribute('disabled', '');
        }
    } else if (location.href.endsWith('signup')) {
        if (isValid(firstname) && isValid(name) && isValid(password) && isValid(confirmPassword)) {
            document.getElementById('submit').removeAttribute('disabled');
        } else {
            document.getElementById('submit').setAttribute('disabled', '');
        }
    }
}

// The setValid function visualizes the input with a green check-icon
function setValid(element) {
    element.parentElement.querySelector('.bxs-check-circle').classList.remove('hide');
    element.parentElement.querySelector('.bxs-x-circle').classList.add('hide');

    const row = element.parentElement.parentElement;
    row.querySelector('.error-box').classList.add('hide');
    row.classList.remove('big-alert');
    row.classList.remove('invalid');
}

// The setInvalid function visualizes the input with red x-icon and pop-ups a little red error-message
// to explain the user what has to be supplemented
function setInvalid(element, name) {
    element.parentElement.querySelector('.bxs-check-circle').classList.add('hide');
    element.parentElement.querySelector('.bxs-x-circle').classList.remove('hide');

    const row = element.parentElement.parentElement;
    row.querySelector('.error-box').classList.remove('hide');
    row.querySelector('.error-message').innerHTML = name + error;

    row.classList.add('invalid');
    if (row.querySelector('.error-message').innerHTML.length > 50) {
        row.classList.add('big-alert');
    } else {
        row.classList.remove('big-alert');
    }
}