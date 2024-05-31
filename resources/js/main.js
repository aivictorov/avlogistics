import { gallery } from "./components/gallery";

import { subnavInit } from "./components/subnav";
import { upform } from "./components/upform";
import { modalWindows } from "./components/modals";
import { arrowBar } from "./components/arrowBar";
import { mobileNavInit } from "./components/mobileNav";
import { mainContent } from "./components/mainContent";
import { swipers } from "./components/swipers";
import { captcha } from "./components/grecaptcha"
import { fancybox } from "./components/fancybox"
import { metrika } from "./components/metrika"

document.addEventListener('DOMContentLoaded', () => {
	metrika();
	gallery();
	subnavInit();
	mobileNavInit();
	mainContent();
	upform();
	captcha();
	arrowBar();
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
