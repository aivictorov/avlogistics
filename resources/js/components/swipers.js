import { initial } from "lodash";

function swipers() {

    const portfolioSectionSlider = new Swiper('.portfolio-section__slider .swiper', {
        slidesPerView: 1,
        loop: true,

        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        }
    });

    const portfolioThumbs = new Swiper('.portfolio__thumbs .swiper', {
        loop: true,
        spaceBetween: 20,
        slidesPerView: "auto",
        freeMode: true,
        watchSlidesProgress: true,
    });

    const portfolioSlider = new Swiper('.portfolio__slider .swiper', {
        loop: true,
        slidesPerView: 1,
        spaceBetween: 10,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        thumbs: {
            swiper: portfolioThumbs,
        },
    });
}

export { swipers };