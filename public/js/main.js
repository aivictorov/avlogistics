/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!******************************!*\
  !*** ./resources/js/main.js ***!
  \******************************/
// import old from "./old";

document.addEventListener('DOMContentLoaded', function () {
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
    } else if (indexContent.data("opened") == false) {
      opencontent();
    }
    function opencontent() {
      $('.js-index-content').data('wasopened', true).slideDown(2000, function () {
        $('.js-index-submap').addClass('index-submap--nobg');
        $('.js-index-content-opener').addClass('index-submap__arrow--up');
        $('.js-index-content').data('opened', true);
      });
    }
    function closecontent() {
      $('.js-index-content-opener').removeClass('index-submap__arrow--up');
      $('.js-index-content').data('opened', false).slideUp(2000, function () {
        $('.js-index-submap').removeClass('index-submap--nobg');
      });
    }
  });
}
function slider() {
  document.querySelectorAll('.js-portfolio-slider').forEach(function (slider) {
    var slideWidth = slider.offsetWidth - 2 * 85;
    var portfolio_inslider = slider.querySelector('.inslider');
    var slides = portfolio_inslider.querySelectorAll('.portfolio-slide');
    portfolio_inslider.prepend(slides[slides.length - 1].cloneNode(true));
    portfolio_inslider.prepend(slides[slides.length - 1].cloneNode(true));
    portfolio_inslider.append(slides[0].cloneNode(true));
    portfolio_inslider.append(slides[0].cloneNode(true));
    portfolio_inslider.style.width = (slides.length + 4) * slideWidth + "px";
  });
  var rightBtns = document.querySelectorAll('.js-portfolio-slider-arrow__right');
  rightBtns.forEach(function (right) {
    right.addEventListener('click', function () {
      var portfolio_slider = right.closest('.js-portfolio-slider');
      var portfolio_inslider = portfolio_slider.querySelector('.inslider');
      var portfolio_count = portfolio_inslider.querySelectorAll('.portfolio-slide').length;
      slideWidth = portfolio_slider.offsetWidth - 2 * 85;
      slideHeight = 260 * slideWidth / 500 + 3;
      console.log(right, portfolio_slider, portfolio_count);
      if (!portfolio_inslider.style.left) {
        portfolio_inslider.style.left = 85 - slideWidth + "px";
      }
      if (parseInt(portfolio_inslider.style.left) < -(portfolio_count - 4) * slideWidth) {
        portfolio_inslider.style.left = 85 - slideWidth + "px";
      }
      portfolio_inslider.style.left = parseInt(portfolio_inslider.style.left) - slideWidth + "px";
    });
  });
  var leftBtns = document.querySelectorAll('.js-portfolio-slider-arrow__left');
  leftBtns.forEach(function (left) {
    left.addEventListener('click', function () {
      var portfolio_slider = left.closest('.js-portfolio-slider');
      var portfolio_inslider = portfolio_slider.querySelector('.inslider');
      var portfolio_count = portfolio_inslider.querySelectorAll('.portfolio-slide').length;
      slideWidth = portfolio_slider.offsetWidth - 2 * 85;
      console.log(left, portfolio_slider, portfolio_count);
      if (!portfolio_inslider.style.left) {
        portfolio_inslider.style.left = 85 - slideWidth + "px";
      }
      if (parseInt(portfolio_inslider.style.left) > -slideWidth) {
        portfolio_inslider.style.left = '-' + ((portfolio_count - 2) * slideWidth - 85) + 'px';
      }
      portfolio_inslider.style.left = parseInt(portfolio_inslider.style.left) + slideWidth + "px";
    });
  });
  function slidersInit() {
    var pageContent = document.querySelector('.page-content');
    slideWidth = pageContent.offsetWidth - 2 * 85;
    slideHeight = 260 * slideWidth / 500 + 3;
    fullHeight = slideHeight + 80;
    console.log(slideWidth, slideHeight);
    var insliders = document.querySelectorAll('.inslider');
    insliders.forEach(function (inslider) {
      var slides = inslider.querySelectorAll('.portfolio-slide');
      slides.forEach(function (slide) {
        slide.style.width = slideWidth + "px";
      });
      inslider.style.width = (slides.length + 4) * slideWidth + "px";
      inslider.style.left = 85 - slideWidth + "px";
    });
    rightBtns.forEach(function (right) {
      right.style.height = slideHeight + "px";
    });
    leftBtns.forEach(function (left) {
      left.style.height = slideHeight + "px";
    });
    var slideNames = document.querySelectorAll('.portfolio-slide-name');
    slideNames.forEach(function (name) {
      name.style.width = slideWidth + "px";
    });
    var slideMore = document.querySelectorAll('.portfolio-slide-more');
    slideMore.forEach(function (more) {
      more.style.width = slideWidth + "px";
    });
    var sliders = document.querySelectorAll('.portfolio-slider');
    sliders.forEach(function (slider) {
      slider.style.height = fullHeight + "px";
    });
  }
  window.addEventListener('resize', function () {
    slidersInit();
  });
  slidersInit();
}
function mobileNav() {
  var btn = document.querySelector('.mobile-nav-icon');
  var blockSubnav = document.querySelector('.js-mobile-subnav');
  var blocks = blockSubnav.querySelectorAll('.js-mobile-subnav-block');

  // const forwardBtns = blockSubnav.querySelectorAll('.js-forward-button');

  // forwardBtns.forEach((button) => {
  // 	button.addEventListener('click', () => {
  // 		button.parentElement.nextElementSibling.classList.toggle('opened');
  // 		// button.closest('.mobile-subnav-column').querySelector('.mobile-subnav-column__list-menu').classList.toggle('opened');
  // 	})
  // });

  btn.addEventListener('click', function (event) {
    event.preventDefault();
    console.log('mobile-nav-icon click');
    blockSubnav.classList.toggle('opened');
    blocks.forEach(function (block) {
      block.classList.toggle('opened');
    });
  });
}
;
function subnav() {
  var btnZhd = document.querySelector('.js-subnav-opener-zhd');
  btnZhd.addEventListener('click', function (event) {
    event.preventDefault();
    var blockSubnav = document.querySelector('.js-subnav-blocks');
    var blockZhd = document.querySelector('.js-subnav-blocks__block--zhd');
    console.log(blockSubnav, blockZhd);
    if (blockZhd.classList.contains('opened')) {
      blockSubnav.classList.remove('opened');
      blockZhd.classList.remove('opened');
      btnZhd.classList.remove('opened');
    } else {
      blockSubnav.classList.add('opened');
      blockZhd.classList.add('opened');
      btnZhd.classList.add('opened');
    }
  });
  var btnAbout = document.querySelector('.js-subnav-opener-about');
  btnAbout.addEventListener('click', function (event) {
    event.preventDefault();
    var blockSubnav = document.querySelector('.js-subnav-blocks');
    var blockAbout = document.querySelector('.js-subnav-blocks__block--about');
    console.log(blockSubnav, blockAbout);
    if (blockAbout.classList.contains('opened')) {
      blockSubnav.classList.remove('opened');
      blockAbout.classList.remove('opened');
      btnAbout.classList.remove('opened');
    } else {
      blockSubnav.classList.add('opened');
      blockAbout.classList.add('opened');
      btnAbout.classList.add('opened');
    }
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
}
;
function gallery() {
  var gallery = document.querySelector('.js-portfoio-gallerey');
  // const slideWidth = document.querySelector('.aside-page').offsetWidth;
  var portfolio_inslider = gallery.querySelector('.portfolio-gallerey-in');
  var bigimages = portfolio_inslider.querySelectorAll('.portfolio-gallerey-bigimage');
  var miniimages = gallery.querySelectorAll('.js-miniimage');
  var right = gallery.querySelector('.js-portfolio-gallerey-arrow__right');
  var left = gallery.querySelector('.js-portfolio-gallerey-arrow__left');
  var slideWidth, slideHeight;
  var minicounter = 0;
  var cur_counter = 0;
  var inmove = false;
  galleryInit();
  window.addEventListener('resize', function () {
    galleryInit();
  });
  function galleryInit() {
    slideWidth = document.querySelector('.aside-page').offsetWidth;
    slideHeight = Math.floor(350 * slideWidth / 670);
    if (cur_counter) {
      portfolio_inslider.style.left = "-" + cur_counter * slideWidth + "px";
    } else {
      portfolio_inslider.style.left = 0 + "px";
    }
    gallery.querySelector('.portfolio-gallerey').style.height = slideHeight + "px";
    portfolio_inslider.querySelectorAll('img').forEach(function (img) {
      img.style.width = slideWidth + "px";
    });
    document.querySelectorAll('.portfolio-gallerey-arrow').forEach(function (arrow) {
      arrow.style.height = slideHeight + "px";
    });
    miniimages.forEach(function (image) {
      var imgWidth = (slideWidth - 3 * 20) / 4;
      image.style.width = imgWidth + "px";
    });
  }
  ;
  miniimages.forEach(function (image) {
    image.dataset.counter = minicounter;
    minicounter = minicounter + 1;
  });
  portfolio_inslider.append(bigimages[0].cloneNode(true));
  var bigcounter = 1;
  bigimages.forEach(function (image) {
    image.dataset.counter = bigcounter;
  });
  portfolio_inslider.style.width = (bigimages.length + 1) * slideWidth + "px";
  miniimages.forEach(function (image) {
    image.classList.remove('cur');
  });
  miniimages[cur_counter].classList.add('cur');
  right.addEventListener('click', function () {
    if (!inmove) {
      var portfolio_count = bigimages.length;
      if (cur_counter == portfolio_count - 1) {
        cur_counter = 1;
        portfolio_inslider.style.left = 0 + "px";
      } else {
        cur_counter = cur_counter + 1;
      }
      inmove = true;
      if (!portfolio_inslider.style.left) {
        portfolio_inslider.style.left = 0 + "px";
      }
      portfolio_inslider.style.left = parseInt(portfolio_inslider.style.left) - slideWidth + "px";
      inmove = false;
      miniimages.forEach(function (image) {
        image.classList.remove('cur');
      });
      miniimages[cur_counter % (portfolio_count - 1)].classList.add('cur');
    }
  });
  left.addEventListener('click', function () {
    if (!inmove) {
      var portfolio_count = bigimages.length;
      cur_counter = cur_counter - 1;
      if (cur_counter < 0) {
        cur_counter = portfolio_count - 2;
        portfolio_inslider.style.left = "-" + (portfolio_count - 1) * slideWidth + "px";
      }
      inmove = true;
      if (!portfolio_inslider.style.left) {
        portfolio_inslider.style.left = 0 + "px";
      }
      portfolio_inslider.style.left = parseInt(portfolio_inslider.style.left) + slideWidth + "px";
      inmove = false;
      miniimages.forEach(function (image) {
        image.classList.remove('cur');
      });
      miniimages[cur_counter].classList.add('cur');
    }
  });
  miniimages.forEach(function (image) {
    image.addEventListener('click', function () {
      inmove = true;
      portfolio_inslider.style.left = "-" + parseInt(image.dataset.counter) * slideWidth + "px";
      cur_counter = image.dataset.counter;
      inmove = false;
      miniimages.forEach(function (image) {
        image.classList.remove('cur');
      });
      miniimages[cur_counter].classList.add('cur');
    });
  });
}
function arrowbaranimate() {
  var arrowBar = document.querySelector('.arrow-bar__arrow');
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
    $("html, body").animate({
      scrollTop: 200
    }, "slow");
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
      upform.removeClass('upflash-bigimage');
      slider.remove();
      upflash.hide();
      upflash.prependTo('body');
    });
    return false;
  });
}
/******/ })()
;
//# sourceMappingURL=main.js.map