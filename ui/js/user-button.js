(() => {

    const userButton = document.querySelector('#user-button');
    const userDropdown = document.querySelector('#user-dropdown');


    userButton.addEventListener('click', (event) => {
        if (userDropdown.style.display === 'none') {
            userDropdown.style.display = 'block';
        } else {
            userDropdown.style.display = 'none';
        }
    });

})();
