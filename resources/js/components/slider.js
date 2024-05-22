function slider2() {
    const sliders = document.querySelectorAll('.js-portfolio-slider');

    if (sliders.length > 0) {
        sliders.forEach((slider) => {
            let sliderWidth = slider.offsetWidth - 2 * 85;
            // const sliderHeight = 260 * sliderWidth / 500 + 3;

            let inslider = slider.querySelector('.inslider');
            let slides = inslider.querySelectorAll('.portfolio-slide');

            inslider.prepend(slides[slides.length - 1].cloneNode(true));
            inslider.append(slides[0].cloneNode(true));

            inslider = slider.querySelector('.inslider');
            slides = inslider.querySelectorAll('.portfolio-slide');

            init(slider, inslider, slides);

            function init(slider, inslider, slides) {
                sliderWidth = slider.offsetWidth - 2 * 85;

                inslider.style.width = (slides.length * sliderWidth) + "px";

                inslider.style.left = (85 - sliderWidth) + "px";

                slides.forEach((slide) => {
                    slide.style.width = sliderWidth + "px";
                })
            }

            const right = slider.querySelector('.js-portfolio-slider-arrow__right');
            const left = slider.querySelector('.js-portfolio-slider-arrow__left');

            right.addEventListener('click', rightHandler);
            left.addEventListener('click', leftHandler);

            function rightHandler() {
                inslider.style.left = (parseInt(inslider.style.left) - sliderWidth) + "px";

                if (Math.abs(parseInt(inslider.style.left)) > (slides.length - 2) * sliderWidth) {
                    inslider.style.left = (85 - sliderWidth) + "px";
                }
            }

            function leftHandler() {
                inslider.style.left = (parseInt(inslider.style.left) + sliderWidth) + "px";

                if (parseInt(inslider.style.left) > 85 - sliderWidth) {
                    inslider.style.left = (85 - sliderWidth * (slides.length - 2)) + "px";
                }
            }

            window.addEventListener('resize', () => {
                right.removeEventListener('click', rightHandler);
                left.removeEventListener('click', leftHandler);
            });
        });

        window.addEventListener('resize', () => {
            sliders.forEach((slider) => {
                let inslider = slider.querySelector('.inslider');
                let slides = inslider.querySelectorAll('.portfolio-slide');

                init(slider, inslider, slides);

                function init(slider, inslider, slides) {
                    sliderWidth = slider.offsetWidth - 2 * 85;

                    inslider.style.width = (slides.length * sliderWidth) + "px";

                    inslider.style.left = (85 - sliderWidth) + "px";

                    slides.forEach((slide) => {
                        slide.style.width = sliderWidth + "px";
                    })
                }
            });
        });
    }
}



export function slider() {
    document.querySelectorAll('.js-portfolio-slider').forEach(function (slider) {
        var slideWidth = slider.offsetWidth - 2 * 85;
        var portfolio_inslider = slider.querySelector('.inslider');
        var slides = portfolio_inslider.querySelectorAll('.portfolio-slide');
        portfolio_inslider.prepend(slides[slides.length - 1].cloneNode(true));
        portfolio_inslider.prepend(slides[slides.length - 1].cloneNode(true));
        portfolio_inslider.append(slides[0].cloneNode(true));
        portfolio_inslider.append(slides[0].cloneNode(true));
        portfolio_inslider.style.width = (slides.length + 4) * slideWidth + "px";
    });

    var rightBtns = document.querySelectorAll('.js-portfolio-slider-arrow__right');

    rightBtns.forEach(function (right) {
        right.addEventListener('click', function () {
            var portfolio_slider = right.closest('.js-portfolio-slider');
            var portfolio_inslider = portfolio_slider.querySelector('.inslider');
            var portfolio_count = portfolio_inslider.querySelectorAll('.portfolio-slide').length;
            slideWidth = portfolio_slider.offsetWidth - 2 * 85;
            slideHeight = 260 * slideWidth / 500 + 3;
            console.log(right, portfolio_slider, portfolio_count);
            if (!portfolio_inslider.style.left) {
                portfolio_inslider.style.left = 85 - slideWidth + "px";
            }
            if (parseInt(portfolio_inslider.style.left) < -(portfolio_count - 4) * slideWidth) {
                portfolio_inslider.style.left = 85 - slideWidth + "px";
            }
            portfolio_inslider.style.left = parseInt(portfolio_inslider.style.left) - slideWidth + "px";
        });
    });

    var leftBtns = document.querySelectorAll('.js-portfolio-slider-arrow__left');

    leftBtns.forEach(function (left) {
        left.addEventListener('click', function () {
            var portfolio_slider = left.closest('.js-portfolio-slider');
            var portfolio_inslider = portfolio_slider.querySelector('.inslider');
            var portfolio_count = portfolio_inslider.querySelectorAll('.portfolio-slide').length;
            slideWidth = portfolio_slider.offsetWidth - 2 * 85;
            console.log(left, portfolio_slider, portfolio_count);
            if (!portfolio_inslider.style.left) {
                portfolio_inslider.style.left = 85 - slideWidth + "px";
            }
            if (parseInt(portfolio_inslider.style.left) > -slideWidth) {
                portfolio_inslider.style.left = '-' + ((portfolio_count - 2) * slideWidth - 85) + 'px';
            }
            portfolio_inslider.style.left = parseInt(portfolio_inslider.style.left) + slideWidth + "px";
        });
    });

    function slidersInit() {
        var pageContent = document.querySelector('.page-content');
        slideWidth = pageContent.offsetWidth - 2 * 85;
        slideHeight = 260 * slideWidth / 500 + 3;
        fullHeight = slideHeight + 80;
        console.log(slideWidth, slideHeight);
        var insliders = document.querySelectorAll('.inslider');
        insliders.forEach(function (inslider) {
            var slides = inslider.querySelectorAll('.portfolio-slide');
            slides.forEach(function (slide) {
                slide.style.width = slideWidth + "px";
            });
            inslider.style.width = (slides.length + 4) * slideWidth + "px";
            inslider.style.left = 85 - slideWidth + "px";
        });
        rightBtns.forEach(function (right) {
            right.style.height = slideHeight + "px";
        });
        leftBtns.forEach(function (left) {
            left.style.height = slideHeight + "px";
        });
        var slideNames = document.querySelectorAll('.portfolio-slide-name');
        slideNames.forEach(function (name) {
            name.style.width = slideWidth + "px";
        });
        var slideMore = document.querySelectorAll('.portfolio-slide-more');
        slideMore.forEach(function (more) {
            more.style.width = slideWidth + "px";
        });
        var sliders = document.querySelectorAll('.portfolio-slider');
        sliders.forEach(function (slider) {
            slider.style.height = fullHeight + "px";
        });
    }
    window.addEventListener('resize', function () {
        slidersInit();
    });
    slidersInit();
}








