// import old from "./old";

document.addEventListener('DOMContentLoaded', () => {
	subnav();
	mobileNav();
	mainContent();
	upform();

	if (document.querySelector('.js-portfolio-slider')) slider();
	if (document.querySelector('.js-portfoio-gallerey')) gallery();
	if (document.querySelector('.arrow-bar__arrow')) setTimeout(arrowbaranimate, 2000);
	// old();
});



function mainContent() {
	$('.js-index-content-opener').click(function () {
		var indexContent = $('.js-index-content');
		if (indexContent.data("opened") == true) {
			closecontent();
		}
		else if (indexContent.data("opened") == false) {
			opencontent();
		}

		function opencontent() {
			$('.js-index-content').data('wasopened', true)
				.slideDown(2000, function () {
					$('.js-index-submap').addClass('index-submap--nobg');
					$('.js-index-content-opener').addClass('index-submap__arrow--up');
					$('.js-index-content').data('opened', true);
				});
		}

		function closecontent() {
			$('.js-index-content-opener').removeClass('index-submap__arrow--up');
			$('.js-index-content').data('opened', false)
				.slideUp(2000, function () {
					$('.js-index-submap').removeClass('index-submap--nobg');
				});
		}
	});
}

function slider() {
	document.querySelectorAll('.js-portfolio-slider').forEach((slider) => {
		const slideWidth = slider.offsetWidth - 2 * 85;

		const portfolio_inslider = slider.querySelector('.inslider');
		const slides = portfolio_inslider.querySelectorAll('.portfolio-slide');

		portfolio_inslider.prepend(slides[slides.length - 1].cloneNode(true));
		portfolio_inslider.prepend(slides[slides.length - 1].cloneNode(true));
		portfolio_inslider.append(slides[0].cloneNode(true));
		portfolio_inslider.append(slides[0].cloneNode(true));

		portfolio_inslider.style.width = ((slides.length + 4) * slideWidth) + "px";
	});

	const rightBtns = document.querySelectorAll('.js-portfolio-slider-arrow__right');

	rightBtns.forEach((right) => {
		right.addEventListener('click', () => {
			const portfolio_slider = right.closest('.js-portfolio-slider');
			const portfolio_inslider = portfolio_slider.querySelector('.inslider');
			const portfolio_count = portfolio_inslider.querySelectorAll('.portfolio-slide').length;

			slideWidth = portfolio_slider.offsetWidth - 2 * 85;
			slideHeight = 260 * slideWidth / 500 + 3;
			console.log(right, portfolio_slider, portfolio_count)

			if (!portfolio_inslider.style.left) {
				portfolio_inslider.style.left = (85 - slideWidth) + "px"
			}

			if (parseInt(portfolio_inslider.style.left) < - (portfolio_count - 4) * slideWidth) {
				portfolio_inslider.style.left = (85 - slideWidth) + "px";
			}

			portfolio_inslider.style.left = (parseInt(portfolio_inslider.style.left) - slideWidth) + "px";
		});
	});

	const leftBtns = document.querySelectorAll('.js-portfolio-slider-arrow__left');

	leftBtns.forEach((left) => {
		left.addEventListener('click', () => {
			const portfolio_slider = left.closest('.js-portfolio-slider');
			const portfolio_inslider = portfolio_slider.querySelector('.inslider');
			const portfolio_count = portfolio_inslider.querySelectorAll('.portfolio-slide').length;

			slideWidth = portfolio_slider.offsetWidth - 2 * 85;

			console.log(left, portfolio_slider, portfolio_count)

			if (!portfolio_inslider.style.left) {
				portfolio_inslider.style.left = (85 - slideWidth) + "px"
			}

			if (parseInt(portfolio_inslider.style.left) > -slideWidth) {
				portfolio_inslider.style.left = '-' + ((portfolio_count - 2) * slideWidth - 85) + 'px';
			}

			portfolio_inslider.style.left = (parseInt(portfolio_inslider.style.left) + slideWidth) + "px";
		});
	});

	function slidersInit() {
		const pageContent = document.querySelector('.page-content');
		slideWidth = pageContent.offsetWidth - 2 * 85;
		slideHeight = 260 * slideWidth / 500 + 3;
		fullHeight = slideHeight + 80;

		console.log(slideWidth, slideHeight);

		const insliders = document.querySelectorAll('.inslider');

		insliders.forEach((inslider) => {
			const slides = inslider.querySelectorAll('.portfolio-slide');

			slides.forEach((slide) => {
				slide.style.width = slideWidth + "px";
			})

			inslider.style.width = ((slides.length + 4) * slideWidth) + "px";
			inslider.style.left = (85 - slideWidth) + "px";
		});

		rightBtns.forEach((right) => {
			right.style.height = slideHeight + "px";
		});

		leftBtns.forEach((left) => {
			left.style.height = slideHeight + "px";
		});

		const slideNames = document.querySelectorAll('.portfolio-slide-name');
		slideNames.forEach((name) => {
			name.style.width = slideWidth + "px";
		});

		const slideMore = document.querySelectorAll('.portfolio-slide-more');
		slideMore.forEach((more) => {
			more.style.width = slideWidth + "px";
		});

		const sliders = document.querySelectorAll('.portfolio-slider');

		sliders.forEach((slider) => {
			slider.style.height = fullHeight + "px";
		});
	}

	window.addEventListener('resize', () => {
		slidersInit();
	})

	slidersInit();
}

function mobileNav() {
	const btn = document.querySelector('.mobile-nav-icon');
	const blockSubnav = document.querySelector('.js-mobile-subnav');
	const blocks = blockSubnav.querySelectorAll('.js-mobile-subnav-block');

	const forwardBtns = blockSubnav.querySelectorAll('.js-forward-button');

	forwardBtns.forEach((button) => {
		button.addEventListener('click', () => {
			button.parentElement.nextElementSibling.classList.toggle('opened');
			// button.closest('.mobile-subnav-column').querySelector('.mobile-subnav-column__list-menu').classList.toggle('opened');
		})
	});

	btn.addEventListener('click', (event) => {
		event.preventDefault();
		console.log('mobile-nav-icon click')

		blockSubnav.classList.toggle('opened');
		blocks.forEach((block) => {
			block.classList.toggle('opened');
		})
	});
};

function subnav() {
	const btnZhd = document.querySelector('.js-subnav-opener-zhd');

	btnZhd.addEventListener('click', (event) => {
		event.preventDefault();
		const blockSubnav = document.querySelector('.js-subnav-blocks');
		const blockZhd = document.querySelector('.js-subnav-blocks__block--zhd');

		console.log(blockSubnav, blockZhd)

		if (blockZhd.classList.contains('opened')) {
			blockSubnav.classList.remove('opened');
			blockZhd.classList.remove('opened');
			btnZhd.classList.remove('opened');
		} else {
			blockSubnav.classList.add('opened');
			blockZhd.classList.add('opened')
			btnZhd.classList.add('opened');
		}

		// if (blockAbout.hasClass('opened')) {
		// 	openBlocks.removeClass('opened').fadeOut(300);
		// 	$('.js-subnav-opener-about').removeClass('opened');
		// }

		// else {
		// 	openBlocks.removeClass('opened').delay(300).fadeOut(10);
		// 	blockAbout.addClass('opened').fadeIn(300);
		// 	$('.js-subnav-opener').removeClass('opened')
		// 	$('.js-subnav-opener-about').addClass('opened');
		// }

	});



	// $('.js-subnav-opener-zhd').click(function () {
	// 	var blockZhd = $('.js-subnav-blocks__block--zhd');
	// 	var openBlocks = $('.js-subnav-blocks__block.opened');

	// 	if (blockZhd.hasClass('opened')) {
	// 		openBlocks.removeClass('opened').fadeOut(300);
	// 		$('.js-subnav-opener-zhd').removeClass('opened');
	// 	}
	// 	else {
	// 		openBlocks.removeClass('opened').delay(300).fadeOut(10);
	// 		blockZhd.addClass('opened').fadeIn(300);
	// 		$('.js-subnav-opener').removeClass('opened')
	// 		$('.js-subnav-opener-zhd').addClass('opened');

	// 	}

	// 	return false;
	// });

	// $('.js-subnav-opener-scheme').click(function () {

	// 	var blockScheme = $('.js-subnav-blocks__block--scheme');
	// 	var openBlocks = $('.js-subnav-blocks__block.opened');
	// 	if (blockScheme.hasClass('opened')) {
	// 		openBlocks.removeClass('opened').fadeOut(300);
	// 		$('.js-subnav-opener-scheme').removeClass('opened');
	// 	}
	// 	else {

	// 		openBlocks.removeClass('opened').delay(300).fadeOut(10);
	// 		blockScheme.addClass('opened').fadeIn(300);
	// 		$('.js-subnav-opener').removeClass('opened')
	// 		$('.js-subnav-opener-scheme').addClass('opened');

	// 	}
	// 	return false;
	// });

	// $('.js-subnav-opener-contacts').click(function () {

	// 	var blockContacts = $('.js-subnav-blocks__block--contacts');
	// 	var openBlocks = $('.js-subnav-blocks__block.opened');

	// 	if (blockContacts.hasClass('opened')) {
	// 		openBlocks.removeClass('opened').fadeOut(300);
	// 		$('.js-subnav-opener-contacts').removeClass('opened');
	// 	}
	// 	else {

	// 		openBlocks.removeClass('opened').delay(300).fadeOut(10);
	// 		blockContacts.addClass('opened').fadeIn(300);
	// 		$('.js-subnav-opener').removeClass('opened')
	// 		$('.js-subnav-opener-contacts').addClass('opened');
	// 	}

	// 	return false;
	// });
};

function gallery() {
	const gallery = document.querySelector('.js-portfoio-gallerey');
	// const slideWidth = document.querySelector('.aside-page').offsetWidth;
	const portfolio_inslider = gallery.querySelector('.portfolio-gallerey-in');
	const bigimages = portfolio_inslider.querySelectorAll('.portfolio-gallerey-bigimage');
	const miniimages = gallery.querySelectorAll('.js-miniimage');
	const right = gallery.querySelector('.js-portfolio-gallerey-arrow__right');
	const left = gallery.querySelector('.js-portfolio-gallerey-arrow__left');
	let slideWidth, slideHeight;

	let minicounter = 0;
	let cur_counter = 0;
	let inmove = false;

	galleryInit();

	window.addEventListener('resize', () => {
		galleryInit()
	});

	function galleryInit() {
		slideWidth = document.querySelector('.aside-page').offsetWidth;
		slideHeight = Math.floor(350 * slideWidth / 670);

		if (cur_counter) {
			portfolio_inslider.style.left = "-" + (cur_counter * slideWidth) + "px";
		} else {
			portfolio_inslider.style.left = 0 + "px";
		}

		gallery.querySelector('.portfolio-gallerey').style.height = slideHeight + "px";

		portfolio_inslider.querySelectorAll('img').forEach((img) => {
			img.style.width = slideWidth + "px";
		})

		document.querySelectorAll('.portfolio-gallerey-arrow').forEach((arrow) => {
			arrow.style.height = slideHeight + "px";
		})

		miniimages.forEach((image) => {
			const imgWidth = (slideWidth - 3 * 20) / 4
			image.style.width = imgWidth + "px";
		});
	};

	miniimages.forEach((image) => {
		image.dataset.counter = minicounter;
		minicounter = minicounter + 1;
	});

	portfolio_inslider.append(bigimages[0].cloneNode(true));
	let bigcounter = 1;

	bigimages.forEach((image) => {
		image.dataset.counter = bigcounter;
	});

	portfolio_inslider.style.width = (bigimages.length + 1) * slideWidth + "px";

	miniimages.forEach((image) => {
		image.classList.remove('cur');
	});

	miniimages[cur_counter].classList.add('cur');

	right.addEventListener('click', () => {
		if (!inmove) {
			const portfolio_count = bigimages.length;

			if (cur_counter == portfolio_count - 1) {
				cur_counter = 1;
				portfolio_inslider.style.left = 0 + "px";
			} else {
				cur_counter = cur_counter + 1;
			}

			inmove = true;

			if (!portfolio_inslider.style.left) {
				portfolio_inslider.style.left = 0 + "px"
			}

			portfolio_inslider.style.left = (parseInt(portfolio_inslider.style.left) - slideWidth) + "px";

			inmove = false;

			miniimages.forEach((image) => {
				image.classList.remove('cur');
			});

			miniimages[cur_counter % (portfolio_count - 1)].classList.add('cur');
		}
	})

	left.addEventListener('click', () => {
		if (!inmove) {
			const portfolio_count = bigimages.length;

			cur_counter = cur_counter - 1;

			if (cur_counter < 0) {
				cur_counter = portfolio_count - 2;
				portfolio_inslider.style.left = ("-" + (portfolio_count - 1) * slideWidth) + "px";
			}

			inmove = true;

			if (!portfolio_inslider.style.left) {
				portfolio_inslider.style.left = 0 + "px"
			}

			portfolio_inslider.style.left = (parseInt(portfolio_inslider.style.left) + slideWidth) + "px";

			inmove = false;

			miniimages.forEach((image) => {
				image.classList.remove('cur');
			});

			miniimages[cur_counter].classList.add('cur');
		}
	})

	miniimages.forEach((image) => {
		image.addEventListener('click', () => {

			inmove = true;

			portfolio_inslider.style.left = "-" + (parseInt(image.dataset.counter) * slideWidth) + "px";

			cur_counter = image.dataset.counter;

			inmove = false;

			miniimages.forEach((image) => {
				image.classList.remove('cur');
			});

			miniimages[cur_counter].classList.add('cur');
		})
	});
}

function arrowbaranimate() {
	const arrowBar = document.querySelector('.arrow-bar__arrow');

	arrowBar.style.backgroundPosition = "0 -48px";
	setTimeout(function () {
		arrowBar.style.backgroundPosition = "0 -96px";
		setTimeout(function () {
			arrowBar.style.backgroundPosition = "0 -48px";
			setTimeout(function () {
				arrowBar.style.backgroundPosition = "0 0";
				setTimeout(function () {
					arrowBar.style.backgroundPosition = "0 -48px";
					setTimeout(function () {
						arrowBar.style.backgroundPosition = "0 -96px";
						setTimeout(function () {
							arrowBar.style.backgroundPosition = "0 -48px";
							setTimeout(function () {
								arrowBar.style.backgroundPosition = "0 0";
							}, 100);
						}, 150);
					}, 100);
				}, 150);
			}, 100);
		}, 150);
	}, 100);
	setTimeout(arrowbaranimate, 3000);
}

function upform() {
	$('.js-form-open').click(function () {

		$("html, body").animate({ scrollTop: 200 }, "slow");
		$('.js-blackback').fadeIn(300);

		var upflash = $('.js-apply-form');
		upflash.appendTo('.js-upflash');
		upflash.show();

		$('.js-upflash').fadeIn(300);
		return false;
	});

	$('.js-upform-close, .js-blackback').click(function () {
		$('.js-blackback').fadeOut(300);

		var upform = $('.js-upflash');
		var upflash = upform.find('.js-apply-form');
		var slider = upform.find('.gallery-slider');

		upform.fadeOut(300, function () {

			upform.removeClass('upflash-bigimage')
			slider.remove();
			upflash.hide();
			upflash.prependTo('body');
		});
		return false;
	});
}
