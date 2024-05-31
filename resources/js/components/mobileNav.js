export function mobileNavInit() {
    const button = document.querySelector('.js-mobile-nav-opener');
    const subnav = document.querySelector('.js-mobile-subnav');

    if (button && subnav) {
        button.addEventListener('click', function (event) {
            event.preventDefault();

            if (!subnav.classList.contains('opened')) {
                this.classList.add('opened');
                document.body.classList.add('no-scroll');
                subnav.classList.add('opened');
            } else {
                this.classList.remove('opened');
                document.body.classList.remove('no-scroll');
                subnav.classList.remove('opened');
            }
        });
    };

    const lists = document.querySelectorAll('.mobile-subnav-column__list-menu');

    lists.forEach((list) => {
        list.style.display = "none";
    });

    const headers = document.querySelectorAll('.js-subnav-header-opener');

    headers.forEach((header) => {
        header.addEventListener('click', (event) => {
            if (header.closest('.mobile-subnav-column__header').nextElementSibling.classList.contains('mobile-subnav-column__list-menu')) {
                event.preventDefault();

                if (header.closest('.mobile-subnav-column__header').nextElementSibling.style.display === "none") {
                    header.closest('.mobile-subnav-column__header').nextElementSibling.removeAttribute('style');
                } else {
                    header.closest('.mobile-subnav-column__header').nextElementSibling.style.display = "none";
                }
            }
        })
    });
};