if (window.location.href.endsWith('order')) {
    const selectButton = document.getElementById('selectButton');

    selectButton.onclick = function() {
        if (selectButton.classList.contains('opened')) {
            selectButton.classList.remove('opened');
        } else {
            selectButton.classList.add('opened');
        }
        showSelectMenu();
    }
}

function showSelectMenu() {
    const selectMenu = document.getElementById('selectMenu');
    if (selectMenu.classList.contains('show')) {
        selectMenu.classList.remove('show');
    } else {
        selectMenu.classList.add('show');
    }
}
