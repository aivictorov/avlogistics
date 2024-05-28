import { gallery, gallery2 } from "./components/gallery";

import { subnavInit } from "./components/subnav";
// import { upform } from "./components/upform";
import { modalWindows } from "./components/modals";
import { arrowBarInit } from "./components/arrowBar";
import { mobileNavInit } from "./components/mobileNav";
import { mainContent } from "./components/mainContent";
import { swipers } from "./components/swipers";
import { captcha } from "./components/grecaptcha"
import { fancybox } from "./components/fancybox"

document.addEventListener('DOMContentLoaded', () => {
	// gallery();
	gallery2();


	subnavInit();
	mobileNavInit();
	mainContent();
	// upform();
	captcha();
	if (document.querySelector('.arrow-bar__arrow')) setTimeout(arrowBarInit, 2000);
	modalWindows();
	swipers();
	fancybox();
});


// window.addEventListener('load', () => {
// 	loader();
// 	modalWindows();
// 	mobileNav();
// 	metrika();
// });

// document.addEventListener('click', function () {
// 	callbackForm();
// 	inputFile();
// 	oversizeForm();
// 	captcha();
// }, { once: true });

// document.addEventListener('scroll', function () {
// 	faq();
// 	scrollup();
// }, { once: true });
