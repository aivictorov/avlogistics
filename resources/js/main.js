import { subnavInit } from "./components/subnav";
import { upform } from "./components/upform";
import { arrowBarInit } from "./components/arrowBar";
import { mobileNavInit } from "./components/mobileNav";
import { mainContent } from "./components/mainContent";
import { swipers } from "./components/swipers";
// import { slider } from "./components/slider";
// import { gallery } from "./components/gallery";

document.addEventListener('DOMContentLoaded', () => {
	subnavInit();
	mobileNavInit();
	mainContent();
	upform();
	swipers();

	if (document.querySelector('.arrow-bar__arrow')) setTimeout(arrowBarInit, 2000);

	// if (document.querySelector('.js-portfolio-slider')) slider();
	// if (document.querySelector('.js-portfoio-gallerey')) gallery();
});
