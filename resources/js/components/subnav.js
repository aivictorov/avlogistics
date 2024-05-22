export function subnavInit() {
    const subnav = document.querySelector('.js-subnav');
    const buttons = document.querySelectorAll('.js-subnav-opener');
    const blocks = document.querySelectorAll('.js-subnav-block');
    const closeButtons = document.querySelectorAll('.js-subnav-close');

    buttons.forEach((button) => {
        button.addEventListener('click', (event) => {
            if (button.dataset.subnav) {
                event.preventDefault();
                close();

                subnav.classList.add('opened');

                event.target.classList.add('opened');

                blocks.forEach((block) => {
                    if (block.dataset.subnav == event.target.dataset.subnav) {
                        block.classList.add('opened');
                    }
                });
            }
        });
    });

    document.addEventListener('keydown', (event) => {
        if (event.code == "Escape") {
            close();
        }
    });

    document.addEventListener('click', (event) => {
        if (!event.target.closest('.js-subnav-opener') &&
            !event.target.closest('.js-subnav') &&
            subnav.classList.contains('opened')) {
            close();
        }
    });

    closeButtons.forEach((closeButton) => {
        closeButton.addEventListener('click', () => {
            close();
        });
    });

    function close() {
        subnav.classList.remove('opened');

        buttons.forEach((button) => {
            button.classList.remove('opened');
        });

        blocks.forEach((block) => {
            block.classList.remove('opened');
        });
    };
};