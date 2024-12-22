document.querySelectorAll('.nav-item').forEach(item => {
    item.addEventListener('click', () => {
        const link = item.querySelector('a');
        if (link) {
            window.location.href = link.href;
        }
    });
});
