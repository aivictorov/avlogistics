import { gallery } from "./components/gallery";
import { subnavInit } from "./components/subnav";
import { arrowBar } from "./components/arrowBar";
import { mobileNavInit } from "./components/mobileNav";
import { mainContent } from "./components/mainContent";
import { swipers } from "./components/swipers";
import { captcha } from "./components/grecaptcha"
import { fancybox } from "./components/fancybox"
import { metrika } from "./components/metrika"
import { inputFile } from "./components/inputFile"
// import { upform } from "./components/upform";
// import { modalWindows } from "./components/modals";

window.addEventListener('load', () => {
	metrika();
	subnavInit();
	mobileNavInit();
	arrowBar();
	mainContent();
	swipers();
	// upform();
	// modalWindows();
});

document.addEventListener('click', function () {
	inputFile();
	captcha();
}, { once: true });

document.addEventListener('scroll', function () {
	gallery();
	fancybox();
}, { once: true });
