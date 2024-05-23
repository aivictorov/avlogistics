import { subnavInit } from "./components/subnav";
import { upform } from "./components/upform";
import { arrowBarInit } from "./components/arrowBar";
import { mobileNavInit } from "./components/mobileNav";
import { mainContent } from "./components/mainContent";
import { swipers } from "./components/swipers";
import { captcha } from "./components/grecaptcha"

document.addEventListener('DOMContentLoaded', () => {
	subnavInit();
	mobileNavInit();
	mainContent();
	upform();
	swipers();
	captcha();
	if (document.querySelector('.arrow-bar__arrow')) setTimeout(arrowBarInit, 2000);
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
