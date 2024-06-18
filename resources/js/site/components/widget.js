export function widgetInit() {
    const widget = document.querySelector('.widget');
    const closeButtons = document.querySelectorAll('.js-widget-close');

    if (widget && closeButtons) {
        closeButtons.forEach((closeBtn) => {
            closeBtn.addEventListener('click', function (event) {
                event.preventDefault();
                widget.remove();
            })
        })
    };
}