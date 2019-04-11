document.querySelectorAll('.remove-entry').forEach((element) => {
    element.addEventListener('click', (event) => {
        event.preventDefault();
        let form = event.target.offsetParent.children[0];
        form.submit();
    });
});