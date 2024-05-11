document.addEventListener('DOMContentLoaded', () => {
	subnav();
	mobileNav();
	if (document.querySelector('.js-portfolio-slider')) slider();
	gallery();
	// old();

	// Main content
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
});

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
	$('.js-portfoio-gallerey').each(function () {
		var miniimages = $(this).find('.js-miniimage')
		var minicounter = 0;

		miniimages.each(function () {
			$(this).data('counter', minicounter);
			minicounter = minicounter + 1;
		});

		var portfolio_inslider = $(this).find('.portfolio-gallerey-in');
		var bigimages = portfolio_inslider.find('.portfolio-gallerey-bigimage');

		portfolio_inslider.append(bigimages.first().clone());

		var bigcounter = 1;
		bigimages.each(function () {
			$(this).data('counter', bigcounter);
		});

		portfolio_inslider.css('width', (bigimages.length + 1) * 670);

		var cur_counter = 0;
		var inmove = false;

		miniimages.removeClass('cur').eq(cur_counter).addClass('cur');

		$('.js-portfolio-gallerey-arrow__right').click(function () {

			if (!inmove) {
				var portfolio_slider = $(this).parents('.portfolio-gallerey');
				var portfolio_inslider = portfolio_slider.find('.portfolio-gallerey-in');
				var portfolio_count = portfolio_inslider.find('.portfolio-gallerey-bigimage').length;

				if (cur_counter == portfolio_count - 1) {
					cur_counter = 1;
					portfolio_inslider.css('left', '0');
				} else {
					cur_counter = cur_counter + 1;
				}

				inmove = true;

				portfolio_inslider.animate({ left: "-=670" }, {
					duration: 500, queue: false, complete: function () {
						//$(this).stop();
						inmove = false;
					}
				});

				miniimages.removeClass('cur').eq(cur_counter % (portfolio_count - 1)).addClass('cur');
			}
		});

		$('.js-portfolio-gallerey-arrow__left').click(function () {

			if (!inmove) {
				var portfolio_slider = $(this).parents('.portfolio-gallerey');
				var portfolio_inslider = portfolio_slider.find('.portfolio-gallerey-in');
				var portfolio_count = portfolio_inslider.find('.portfolio-gallerey-bigimage').length;


				cur_counter = cur_counter - 1;

				if (cur_counter < 0) {
					cur_counter = portfolio_count - 2;
					portfolio_inslider.css('left', '-' + ((portfolio_count - 1) * 670) + 'px');
				}

				inmove = true;
				portfolio_inslider.animate({ left: "+=670" }, {
					duration: 500, queue: false, complete: function () {
						//$(this).stop();
						inmove = false;
					}
				});
				miniimages.removeClass('cur').eq(cur_counter).addClass('cur');
			}

		});

		$('.js-miniimage').click(function () {

			var portfolio_inslider = $(this).parents('.js-portfoio-gallerey').find('.portfolio-gallerey-in');
			var left = -$(this).data('counter') * 670;
			var steps = Math.abs(cur_counter - $(this).data('counter'));

			inmove = true;
			portfolio_inslider.animate(
				{ left: left },
				{
					duration: steps / (3 - 2 / steps) * 500, queue: false, complete: function () {
						inmove = false;
					}
				}
			);
			cur_counter = $(this).data('counter');

			miniimages.removeClass('cur').eq(cur_counter).addClass('cur');
		});

	});
}


function old() {
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

	$('.js-subnav-blocks__close').click(function () {
		$('.js-subnav-blocks__block').removeClass('opened').fadeOut(300);
		$('.js-subnav-opener').removeClass('opened');
		return false;
	});

	$('body').click(function () {
		$('.js-subnav-blocks__block.opened').removeClass('opened').fadeOut(300);
		$('.js-subnav-opener').removeClass('opened');
		return true;
	});

	$('.js-subnav-blocks__block').click(function () {
		event.stopPropagation();
		return true;
	});

	$('.js-sixbox__text').mouseenter(function () {
		$(this).parent().addClass('hovered');
	}).mouseleave(function () {
		$(this).parent().removeClass('hovered');
	});

	$('.subnav-column__porfolio-arrows').attr('unselectable', 'on');

	var subnav_porfolio_slider = $('.js-subnav-portfolio-slider');

	$('.js-subnav_porfolio-arrows_right').click(function () {

		if (parseInt(subnav_porfolio_slider.css('left')) > -(279 * (subnav_porfolio_slider.data('count') - 1))) {
			subnav_porfolio_slider.animate({ left: "-=279" }, { duration: 400, queue: false, complete: function () { $(this).stop() } });
		}
	});

	$('.js-subnav_porfolio-arrows_left').click(function () {

		if (parseInt(subnav_porfolio_slider.css('left')) < 0) {
			subnav_porfolio_slider.animate({ left: "+=279" }, { duration: 400, queue: false, complete: function () { $(this).stop() } });
		}
	});








	var ginmove = false;

	$('.js-content-miniimage').click(function () {

		var miniimages = $(this).parents('.content-miniimages');
		var upflash = $('.js-upflash');
		upflash.addClass('upflash-bigimage')
		$('.js-blackback').fadeIn(300);
		var offset = $(document).scrollTop();

		var bigimages = $('<div class="gallery-slider"></div>');
		var slider = $('<div class="gallery-inslider"></div>');
		var img_counetr = 0;
		var img;
		miniimages.find('.content-gallerey-miniimage').each(function () {
			var text = Base64.decode($(this).data('text'));
			var portfolioUrl = $(this).data('portfolio-link');

			var portfolioLink = '';
			if (portfolioUrl != '') {
				portfolioLink =
					'<p>' +
					'<a class="content-bigimage-annotate-link" href="/portfolio/' + $(this).data('portfolio-link') + '/">' +
					'Подробнее в портфолио' +
					'</a>' +
					'</p>';
			}

			var annotate = '';
			if (text != '' || portfolioLink != '') {
				annotate =
					'<div class="content-bigimage-annotate">' +
					text +
					portfolioLink +
					'</div>';
			}

			var alt = text.replace(/<\/?[^>]+>/gi, '');
			img =
				'<div class="content-bigimage-holder">' +
				'<img src="' + $(this).data('bigimage') + '" class="content-bigimage" alt="' + alt + '">' +
				annotate +
				'</div>';

			slider.append(img);

			img_counetr = img_counetr + 1;
		});
		slider.prepend(img);
		gcur_counter = $(this).data('counter');

		slider.css('width', ((img_counetr + 1) * 940) + 'px');
		slider.css('left', (-940) * gcur_counter + 'px');
		bigimages.append('<span class="gallery-slider-arrow gallery-slider-arrow__left js-gallery-slider-arrow__left"></span>');
		bigimages.append('<span class="gallery-slider-arrow gallery-slider-arrow__right js-gallery-slider-arrow__right"></span>');

		bigimages.append(slider);
		upflash.append(bigimages);
		upflash.css({ top: offset + 20 });
		upflash.fadeIn(300);
	});

	$(document).on("click", '.js-gallery-slider-arrow__right,  .content-bigimage', function () {

		if (!ginmove) {
			var slider = $(this).parents('.gallery-slider');
			var inslider = slider.find('.gallery-inslider');
			var slider_count = inslider.find('.content-bigimage').length;

			if (gcur_counter == slider_count - 1) {
				gcur_counter = 1;
				inslider.css('left', '0');
			}
			else {
				gcur_counter = gcur_counter + 1;
			}

			ginmove = true;

			inslider.animate({ left: "-=940" }, {
				duration: 500, queue: false, complete: function () {
					//$(this).stop();
					ginmove = false;
				}
			});
		}
	});

	$(document).on("click", '.js-gallery-slider-arrow__left', function () {
		if (!ginmove) {
			var slider = $(this).parents('.gallery-slider');
			var inslider = slider.find('.gallery-inslider');
			var slider_count = inslider.find('.content-bigimage').length;


			if (gcur_counter == 0) {
				gcur_counter = slider_count - 2;
				inslider.css('left', '-' + ((slider_count - 1) * 940) + 'px');

			}
			else {
				gcur_counter = gcur_counter - 1;
			}

			ginmove = true;

			inslider.animate({ left: "+=940" }, {
				duration: 500, queue: false, complete: function () {
					//$(this).stop();
					ginmove = false;
				}
			});
		}
	});

	$(document).on("click", '.content-gallerey-href', function () {
		return false;
	});

	$(document).scroll(function () {
		var curPos = $(document).scrollTop();
		if (!$('.js-index-content').data('wasopened')) {

			setTimeout(function () {
				if ($(document).scrollTop() == ($(document).outerHeight() - $(window).outerHeight())) {
					opencontent();
				}
			}, 2000);
		}

		if (curPos >= 62) {
			$('.js-top-header').addClass('show');
			$('.js-subnav-blocks').addClass('sl');
			$('.js-main-header').addClass('vh');
		}
		else {
			$('.js-top-header').removeClass('show');
			$('.js-subnav-blocks').removeClass('sl');
			$('.js-main-header').removeClass('vh');
		}
	});

	setTimeout(arrowbaranimate, 2000);
}

function arrowbaranimate() {
	$(".arrow-bar__arrow").css({ backgroundPosition: "0 -48px" });
	setTimeout(function () {
		$(".arrow-bar__arrow").css({ backgroundPosition: "0 -96px" });
		setTimeout(function () {
			$(".arrow-bar__arrow").css({ backgroundPosition: "0 -48px" });
			setTimeout(function () {
				$(".arrow-bar__arrow").css({ backgroundPosition: "0 0" });
				setTimeout(function () {
					$(".arrow-bar__arrow").css({ backgroundPosition: "0 -48px" });
					setTimeout(function () {
						$(".arrow-bar__arrow").css({ backgroundPosition: "0 -96px" });
						setTimeout(function () {
							$(".arrow-bar__arrow").css({ backgroundPosition: "0 -48px" });
							setTimeout(function () {
								$(".arrow-bar__arrow").css({ backgroundPosition: "0 0" });
							}, 100);
						}, 150);
					}, 100);
				}, 150);
			}, 100);
		}, 150);
	}, 100);
	setTimeout(arrowbaranimate, 3000);
}



var Base64 = {
	_keyStr: "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",

	//метод для кодировки в base64 на javascript
	encode: function (input) {
		var output = "";
		var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
		var i = 0
		input = Base64._utf8_encode(input);
		while (i < input.length) {
			chr1 = input.charCodeAt(i++);
			chr2 = input.charCodeAt(i++);
			chr3 = input.charCodeAt(i++);
			enc1 = chr1 >> 2;
			enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
			enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
			enc4 = chr3 & 63;
			if (isNaN(chr2)) {
				enc3 = enc4 = 64;
			} else if (isNaN(chr3)) {
				enc4 = 64;
			}
			output = output +
				this._keyStr.charAt(enc1) + this._keyStr.charAt(enc2) +
				this._keyStr.charAt(enc3) + this._keyStr.charAt(enc4);
		}
		return output;
	},

	//метод для раскодировки из base64
	decode: function (input) {
		var output = "";
		var chr1, chr2, chr3;
		var enc1, enc2, enc3, enc4;
		var i = 0;
		input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");
		while (i < input.length) {
			enc1 = this._keyStr.indexOf(input.charAt(i++));
			enc2 = this._keyStr.indexOf(input.charAt(i++));
			enc3 = this._keyStr.indexOf(input.charAt(i++));
			enc4 = this._keyStr.indexOf(input.charAt(i++));
			chr1 = (enc1 << 2) | (enc2 >> 4);
			chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
			chr3 = ((enc3 & 3) << 6) | enc4;
			output = output + String.fromCharCode(chr1);
			if (enc3 != 64) {
				output = output + String.fromCharCode(chr2);
			}
			if (enc4 != 64) {
				output = output + String.fromCharCode(chr3);
			}
		}
		output = Base64._utf8_decode(output);
		return output;
	},

	// метод для кодировки в utf8
	_utf8_encode: function (string) {
		string = string.replace(/\r\n/g, "\n");
		var utftext = "";
		for (var n = 0; n < string.length; n++) {
			var c = string.charCodeAt(n);
			if (c < 128) {
				utftext += String.fromCharCode(c);
			} else if ((c > 127) && (c < 2048)) {
				utftext += String.fromCharCode((c >> 6) | 192);
				utftext += String.fromCharCode((c & 63) | 128);
			} else {
				utftext += String.fromCharCode((c >> 12) | 224);
				utftext += String.fromCharCode(((c >> 6) & 63) | 128);
				utftext += String.fromCharCode((c & 63) | 128);
			}
		}
		return utftext;

	},

	//метод для раскодировки из urf8
	_utf8_decode: function (utftext) {
		var string = "";
		var i = 0;
		var c = c1 = c2 = 0;
		while (i < utftext.length) {
			c = utftext.charCodeAt(i);
			if (c < 128) {
				string += String.fromCharCode(c);
				i++;
			} else if ((c > 191) && (c < 224)) {
				c2 = utftext.charCodeAt(i + 1);
				string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
				i += 2;
			} else {
				c2 = utftext.charCodeAt(i + 1);
				c3 = utftext.charCodeAt(i + 2);
				string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
				i += 3;
			}
		}
		return string;
	}
}