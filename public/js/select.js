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
