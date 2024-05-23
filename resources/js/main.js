import { subnavInit } from "./components/subnav";
import { upform } from "./components/upform";
import { arrowBarInit } from "./components/arrowBar";
import { mobileNavInit } from "./components/mobileNav";
// import { slider } from "./components/slider";
import { gallery } from "./components/gallery";
import { mainContent } from "./components/mainContent";

document.addEventListener('DOMContentLoaded', () => {
	subnavInit();
	mobileNavInit();
	mainContent();
	upform();

	// if (document.querySelector('.js-portfolio-slider')) slider();
	if (document.querySelector('.js-portfoio-gallerey')) gallery();
	if (document.querySelector('.arrow-bar__arrow')) setTimeout(arrowBarInit, 2000);
});

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

