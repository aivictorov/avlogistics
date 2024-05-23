/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/components/arrowBar.js":
/*!*********************************************!*\
  !*** ./resources/js/components/arrowBar.js ***!
  \*********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   arrowBarInit: () => (/* binding */ arrowBarInit)
/* harmony export */ });
function arrowBarInit() {
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
  setTimeout(arrowBarInit, 3000);
}

/***/ }),

/***/ "./resources/js/components/gallery.js":
/*!********************************************!*\
  !*** ./resources/js/components/gallery.js ***!
  \********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   gallery: () => (/* binding */ gallery)
/* harmony export */ });
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

/***/ }),

/***/ "./resources/js/components/mainContent.js":
/*!************************************************!*\
  !*** ./resources/js/components/mainContent.js ***!
  \************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   mainContent: () => (/* binding */ mainContent)
/* harmony export */ });
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

/***/ }),

/***/ "./resources/js/components/mobileNav.js":
/*!**********************************************!*\
  !*** ./resources/js/components/mobileNav.js ***!
  \**********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   mobileNavInit: () => (/* binding */ mobileNavInit)
/* harmony export */ });
function mobileNavInit() {
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

/***/ }),

/***/ "./resources/js/components/subnav.js":
/*!*******************************************!*\
  !*** ./resources/js/components/subnav.js ***!
  \*******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   subnavInit: () => (/* binding */ subnavInit)
/* harmony export */ });
function subnavInit() {
  var subnav = document.querySelector('.js-subnav');
  var buttons = document.querySelectorAll('.js-subnav-opener');
  var blocks = document.querySelectorAll('.js-subnav-block');
  var closeButtons = document.querySelectorAll('.js-subnav-close');
  buttons.forEach(function (button) {
    button.addEventListener('click', function (event) {
      if (button.dataset.subnav) {
        event.preventDefault();
        close();
        subnav.classList.add('opened');
        event.target.classList.add('opened');
        blocks.forEach(function (block) {
          if (block.dataset.subnav == event.target.dataset.subnav) {
            block.classList.add('opened');
          }
        });
      }
    });
  });
  document.addEventListener('keydown', function (event) {
    if (event.code == "Escape") {
      close();
    }
  });
  document.addEventListener('click', function (event) {
    if (!event.target.closest('.js-subnav-opener') && !event.target.closest('.js-subnav') && subnav.classList.contains('opened')) {
      close();
    }
  });
  closeButtons.forEach(function (closeButton) {
    closeButton.addEventListener('click', function () {
      close();
    });
  });
  function close() {
    subnav.classList.remove('opened');
    buttons.forEach(function (button) {
      button.classList.remove('opened');
    });
    blocks.forEach(function (block) {
      block.classList.remove('opened');
    });
  }
  ;
}
;

/***/ }),

/***/ "./resources/js/components/upform.js":
/*!*******************************************!*\
  !*** ./resources/js/components/upform.js ***!
  \*******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   upform: () => (/* binding */ upform)
/* harmony export */ });
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

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!******************************!*\
  !*** ./resources/js/main.js ***!
  \******************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _components_subnav__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./components/subnav */ "./resources/js/components/subnav.js");
/* harmony import */ var _components_upform__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./components/upform */ "./resources/js/components/upform.js");
/* harmony import */ var _components_arrowBar__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./components/arrowBar */ "./resources/js/components/arrowBar.js");
/* harmony import */ var _components_mobileNav__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./components/mobileNav */ "./resources/js/components/mobileNav.js");
/* harmony import */ var _components_gallery__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./components/gallery */ "./resources/js/components/gallery.js");
/* harmony import */ var _components_mainContent__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./components/mainContent */ "./resources/js/components/mainContent.js");




// import { slider } from "./components/slider";


document.addEventListener('DOMContentLoaded', function () {
  (0,_components_subnav__WEBPACK_IMPORTED_MODULE_0__.subnavInit)();
  (0,_components_mobileNav__WEBPACK_IMPORTED_MODULE_3__.mobileNavInit)();
  (0,_components_mainContent__WEBPACK_IMPORTED_MODULE_5__.mainContent)();
  (0,_components_upform__WEBPACK_IMPORTED_MODULE_1__.upform)();

  // if (document.querySelector('.js-portfolio-slider')) slider();
  if (document.querySelector('.js-portfoio-gallerey')) (0,_components_gallery__WEBPACK_IMPORTED_MODULE_4__.gallery)();
  if (document.querySelector('.arrow-bar__arrow')) setTimeout(_components_arrowBar__WEBPACK_IMPORTED_MODULE_2__.arrowBarInit, 2000);
});
var swiper3 = new Swiper('.swiper', {
  slidesPerView: "auto",
  centeredSlides: true,
  spaceBetween: 0,
  loop: true,
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev'
  }
});
var swiper2 = new Swiper(".mySwiper2", {
  // spaceBetween: 10,
  loop: true,
  watchSlidesProgress: true,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev"
  },
  thumbs: {
    swiper: swiper
  }
});
var swiper = new Swiper(".mySwiper", {
  // spaceBetween: 10,
  slidesPerView: 5,
  loop: true,
  freeMode: true,
  watchSlidesProgress: true
});
})();

/******/ })()
;
//# sourceMappingURL=main.js.map