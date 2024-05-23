function swipers() {

    const swiper3 = new Swiper('.swiper', {
        slidesPerView: "auto",
        centeredSlides: true,
        spaceBetween: 0,
        loop: true,

        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        }
    });

    var swiper2 = new Swiper(".mySwiper2", {
        // spaceBetween: 10,
        loop: true,
        watchSlidesProgress: true,

        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },

        thumbs: {
            swiper: swiper,
        },
    });

    var swiper = new Swiper(".mySwiper", {
        // spaceBetween: 10,
        slidesPerView: 5,
        loop: true,
        freeMode: true,
        watchSlidesProgress: true,
    });
}

export { swipers };