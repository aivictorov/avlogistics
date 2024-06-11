
export function modalWindows() {
    document.querySelectorAll('[modal-button]').forEach((button) => {
        const modal = document.querySelector(`div[modal-window="${button.getAttribute('modal-button')}"]`);

        if (modal) {
            const content = modal.querySelector('.modal__content');
            const closeBtns = modal.querySelectorAll(`[close-modal-button="${button.getAttribute('modal-button')}"]`);
            // const nav = document.querySelector('.menu');
            // const navIcon = document.querySelector('.nav-icon');
            const header = document.querySelector('.header');


            button.addEventListener('click', (event) => {
                event.preventDefault();
                document.querySelectorAll('[modal-window]').forEach((window) => {
                    window.classList.remove('active');
                });
                // navIcon.classList.remove('nav-icon--active');
                // nav.classList.remove('menu--active');
                modal.classList.add('active');
                document.body.classList.add('noscroll');
                header.classList.add('noscroll');
                modal.scrollTo(0, 0);
            });

            content.addEventListener('mousedown', (event) => {
                event.stopPropagation();
            });

            modal.addEventListener('mousedown', () => {
                modal.classList.remove('active');
                document.body.classList.remove('noscroll');
                header.classList.remove('noscroll');
            });

            if (closeBtns) {
                closeBtns.forEach((closeBtn => {
                    closeBtn.addEventListener('click', () => {
                        modal.classList.remove('active');
                        document.body.classList.remove('noscroll');
                        header.classList.remove('noscroll');
                    });
                }));
            };
        };
    });

    // alignModalWindows();

    // window.addEventListener('resize', alignModalWindows);

    // function alignModalWindows() {
    // 	document.querySelectorAll('div[modal-window]').forEach((modal) => {
    // 		const content = modal.querySelector('.modal__content');
    // 		if (content.clientHeight >= window.innerHeight - 100) {
    // 			content.classList.remove('modal__content--center');
    // 		} else {
    // 			content.classList.add('modal__content--center');
    // 		};
    // 	});
    // };
};
