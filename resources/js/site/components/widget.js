export function widgetInit() {
    const widget = document.querySelector('.widget');
    const closeBtn = document.querySelector('.js-widget-close');

    if (widget && closeBtn) {
        closeBtn.addEventListener('click', function (event) {
            event.preventDefault();
            widget.remove();
        })
    };
}