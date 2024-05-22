import { subnavInit } from "./components/subnav";
import { upform } from "./components/upform";
import { arrowBarInit } from "./components/arrowBar";
import { mobileNavInit } from "./components/mobileNav";
import { slider } from "./components/slider";
import { gallery } from "./components/gallery";
import { mainContent } from "./components/mainContent";

document.addEventListener('DOMContentLoaded', () => {
	subnavInit();
	mobileNavInit();
	mainContent();
	upform();

	if (document.querySelector('.js-portfolio-slider')) slider();
	if (document.querySelector('.js-portfoio-gallerey')) gallery();
	if (document.querySelector('.arrow-bar__arrow')) setTimeout(arrowBarInit, 2000);
});