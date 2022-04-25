// to validate names
function validateText(event) {
    const input = event.currentTarget;
    const textPattern = '^[a-zA-Z]+$';
    let value = input.value;
    let inputName = input.name;
    let error;

    // should be understandable because all input may not be blank
    if (value.length < 1) {
        error = " can't be blank.";
        setInvalid(input, inputName + error);
        return;
    }

    // of course there are namens which are 2 characters long but we live in Switzerland so the shortest name would be 3 characters like Tim
    if (value.length < 3) {
        error = " must have at least 3 characters";
        setInvalid(input, inputName + error);
        return;
    }

    // names doesn't have special characters and numbers except Elon Musk his new son -> R.I.P
    if (!value.match(textPattern)) {
        error = " may only contain letters";
        setInvalid(input, inputName + error);
        return;
    }
    setValid(input);
}

// to validate for a strong password that prevents brute force attacks
function validatePassword(event) {
    const input = event.currentTarget;
    const passwordPattern = '^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*+-/?])(?=.{8,})';
    let inputName = input.name.toString();
    let value = input.value;
    let error;

    // should be understandable
    if (value.length < 1) {
        error = " can't be blank.";
        setInvalid(input, inputName + error);
        return;
    }

    // while the confirm password input just has to compare the input of the password field,
    // there is no need for a regex validation
    if (input.id !== 'confirmPassword') {
        // strong passwords should be at least 8 characters long to ensure safety
        if (value.length < 8) {
            error = ' must have at least 8 characters.'
            setInvalid(input, inputName + error);
            return;
        }

        // passwords should have special characters and numbers to make it mostly impossible to hack it
        if (!value.match(passwordPattern)) {
            error = ' must contain one uppercase and downcase, a number and a special character.';
            setInvalid(input, inputName + error);
            return;
        }
    } else {
        const password = document.getElementById('password');
        if (password) {
            if (!value.match(password.value)) {
                error = " doesn't match.";
                setInvalid(input, inputName + error);
                return;
            }
        }
    }
    // if everything seems to be fine the input should be visualized as valid with the setValid function
    setValid(input);
}

// To visualize the user that the input is valid
function setValid(element) {
    element.parentElement.querySelector('.bxs-check-circle').classList.remove('hide');
    element.parentElement.querySelector('.bxs-x-circle').classList.add('hide');

    const row = element.parentElement.parentElement;
    row.querySelector('.error-box').classList.add('hide');
    row.classList.remove('big-alert');
    row.classList.remove('invalid');
}

// To visualize the user that the input is invalid and say why
function setInvalid(element, message) {
    element.parentElement.querySelector('.bxs-check-circle').classList.add('hide');
    element.parentElement.querySelector('.bxs-x-circle').classList.remove('hide');

    const row = element.parentElement.parentElement;
    row.querySelector('.error-box').classList.remove('hide');
    row.querySelector('.error-message').innerHTML = message;

    row.classList.add('invalid');
    if (row.querySelector('.error-message').innerHTML.length > 50) {
        row.classList.add('big-alert');
    } else {
        row.classList.remove('big-alert');
    }
}