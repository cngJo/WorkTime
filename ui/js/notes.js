document.querySelectorAll('.time-head').forEach((element) => {
    element.addEventListener('click', (event) => {
        if (event.srcElement.parentElement.nextElementSibling.style.display === 'none') {
            event.srcElement.parentElement.nextElementSibling.style.display = 'block';
        } else {
            event.srcElement.parentElement.nextElementSibling.style.display = 'none';
        }
    });
});
