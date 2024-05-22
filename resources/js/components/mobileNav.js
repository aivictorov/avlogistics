export function mobileNavInit() {
    const btn = document.querySelector('.mobile-nav-icon');
    const blockSubnav = document.querySelector('.js-mobile-subnav');
    const blocks = blockSubnav.querySelectorAll('.js-mobile-subnav-block');

    // const forwardBtns = blockSubnav.querySelectorAll('.js-forward-button');

    // forwardBtns.forEach((button) => {
    // 	button.addEventListener('click', () => {
    // 		button.parentElement.nextElementSibling.classList.toggle('opened');
    // 		// button.closest('.mobile-subnav-column').querySelector('.mobile-subnav-column__list-menu').classList.toggle('opened');
    // 	})
    // });

    btn.addEventListener('click', (event) => {
        event.preventDefault();
        console.log('mobile-nav-icon click')

        blockSubnav.classList.toggle('opened');
        blocks.forEach((block) => {
            block.classList.toggle('opened');
        })
    });
};