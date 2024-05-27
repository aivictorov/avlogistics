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
        slidesPerView: "auto",
        freeMode: true,
        watchSlidesProgress: true,

        breakpoints: {
            0: {
                slidesPerView: 3,
                spaceBetween: 10,
            },
            600: {
                slidesPerView: 4,
                spaceBetween: 20,
            },
        },
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


    const contentSlider = new Swiper('.content__slider .swiper', {
        loop: true,
        slidesPerView: 1,
        spaceBetween: 10,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });

}

export { swipers };