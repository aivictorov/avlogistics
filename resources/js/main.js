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
	// Optional parameters
	direction: 'horizontal',
	loop: true,

	// If we need pagination
	pagination: {
		el: '.swiper-pagination',
	},

	// Navigation arrows
	navigation: {
		nextEl: '.swiper-button-next',
		prevEl: '.swiper-button-prev',
	},

	// And if we need scrollbar
	scrollbar: {
		el: '.swiper-scrollbar',
	},
});

var swiper = new Swiper(".mySwiper", {
	spaceBetween: 10,
	slidesPerView: 4,
	freeMode: true,
	watchSlidesProgress: true,
});
var swiper2 = new Swiper(".mySwiper2", {
	spaceBetween: 10,
	navigation: {
		nextEl: ".swiper-button-next",
		prevEl: ".swiper-button-prev",
	},
	thumbs: {
		swiper: swiper,
	},
});