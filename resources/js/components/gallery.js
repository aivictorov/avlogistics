
export function gallery() {
    const gallery = document.querySelector('.js-portfoio-gallerey');
    // const slideWidth = document.querySelector('.aside-page').offsetWidth;
    const portfolio_inslider = gallery.querySelector('.portfolio-gallerey-in');
    const bigimages = portfolio_inslider.querySelectorAll('.portfolio-gallerey-bigimage');
    const miniimages = gallery.querySelectorAll('.js-miniimage');
    const right = gallery.querySelector('.js-portfolio-gallerey-arrow__right');
    const left = gallery.querySelector('.js-portfolio-gallerey-arrow__left');
    let slideWidth, slideHeight;

    let minicounter = 0;
    let cur_counter = 0;
    let inmove = false;

    galleryInit();

    window.addEventListener('resize', () => {
        galleryInit()
    });

    function galleryInit() {
        slideWidth = document.querySelector('.aside-page').offsetWidth;
        slideHeight = Math.floor(350 * slideWidth / 670);

        if (cur_counter) {
            portfolio_inslider.style.left = "-" + (cur_counter * slideWidth) + "px";
        } else {
            portfolio_inslider.style.left = 0 + "px";
        }

        gallery.querySelector('.portfolio-gallerey').style.height = slideHeight + "px";

        portfolio_inslider.querySelectorAll('img').forEach((img) => {
            img.style.width = slideWidth + "px";
        })

        document.querySelectorAll('.portfolio-gallerey-arrow').forEach((arrow) => {
            arrow.style.height = slideHeight + "px";
        })

        miniimages.forEach((image) => {
            const imgWidth = (slideWidth - 3 * 20) / 4
            image.style.width = imgWidth + "px";
        });
    };

    miniimages.forEach((image) => {
        image.dataset.counter = minicounter;
        minicounter = minicounter + 1;
    });

    portfolio_inslider.append(bigimages[0].cloneNode(true));
    let bigcounter = 1;

    bigimages.forEach((image) => {
        image.dataset.counter = bigcounter;
    });

    portfolio_inslider.style.width = (bigimages.length + 1) * slideWidth + "px";

    miniimages.forEach((image) => {
        image.classList.remove('cur');
    });

    miniimages[cur_counter].classList.add('cur');

    right.addEventListener('click', () => {
        if (!inmove) {
            const portfolio_count = bigimages.length;

            if (cur_counter == portfolio_count - 1) {
                cur_counter = 1;
                portfolio_inslider.style.left = 0 + "px";
            } else {
                cur_counter = cur_counter + 1;
            }

            inmove = true;

            if (!portfolio_inslider.style.left) {
                portfolio_inslider.style.left = 0 + "px"
            }

            portfolio_inslider.style.left = (parseInt(portfolio_inslider.style.left) - slideWidth) + "px";

            inmove = false;

            miniimages.forEach((image) => {
                image.classList.remove('cur');
            });

            miniimages[cur_counter % (portfolio_count - 1)].classList.add('cur');
        }
    })

    left.addEventListener('click', () => {
        if (!inmove) {
            const portfolio_count = bigimages.length;

            cur_counter = cur_counter - 1;

            if (cur_counter < 0) {
                cur_counter = portfolio_count - 2;
                portfolio_inslider.style.left = ("-" + (portfolio_count - 1) * slideWidth) + "px";
            }

            inmove = true;

            if (!portfolio_inslider.style.left) {
                portfolio_inslider.style.left = 0 + "px"
            }

            portfolio_inslider.style.left = (parseInt(portfolio_inslider.style.left) + slideWidth) + "px";

            inmove = false;

            miniimages.forEach((image) => {
                image.classList.remove('cur');
            });

            miniimages[cur_counter].classList.add('cur');
        }
    })

    miniimages.forEach((image) => {
        image.addEventListener('click', () => {

            inmove = true;

            portfolio_inslider.style.left = "-" + (parseInt(image.dataset.counter) * slideWidth) + "px";

            cur_counter = image.dataset.counter;

            inmove = false;

            miniimages.forEach((image) => {
                image.classList.remove('cur');
            });

            miniimages[cur_counter].classList.add('cur');
        })
    });
}
