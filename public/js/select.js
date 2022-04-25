

function showSelectMenu(event) {
    const selectButton = event.currentTarget;
    if (selectButton.classList.contains('opened')) {
        selectButton.classList.remove('opened');
    } else {
        selectButton.classList.add('opened');
    }

    const selectMenu = selectButton.parentElement.querySelector('.select-menu');
    if (selectMenu.classList.contains('show')) {
        selectMenu.classList.remove('show');
    } else {
        selectMenu.classList.add('show');
    }
}

function selectOption(event) {
    const selected = event.currentTarget;
    const options = selected.parentElement.querySelectorAll('.option');

    options.forEach(option => {
        option.querySelector('.bx').classList.add('hide');
    });

    selected.querySelector('.bx').classList.remove('hide');
    selected.parentElement.classList.remove('show');
    selected.parentElement.parentElement.querySelector('.select-value').innerText = selected.querySelector('label').innerText;
    selected.parentElement.parentElement.querySelector('.select-button').id = selected.id;
    selected.parentElement.parentElement.querySelector('.select-button').classList.remove('opened');
}

function selectCheckbox(event) {
    const selected = event.currentTarget;

    if (selected.querySelector('.bx').classList.contains('hide')) {
        selected.classList.add('selected');
        selected.querySelector('.bx').classList.remove('hide');
    } else {
        selected.querySelector('.bx').classList.add('hide');
        selected.classList.remove('selected');
    }

    const selectMenu = selected.parentElement;
    const checkboxes = selected.parentElement.querySelectorAll('.option');
    checkboxes.forEach(checkbox => {

    });
}