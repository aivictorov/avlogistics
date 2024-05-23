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
  var button = document.querySelector('.js-mobile-nav-opener');
  var subnav = document.querySelector('.js-mobile-subnav');
  if (button && subnav) {
    button.addEventListener('click', function (event) {
      event.preventDefault();
      if (!subnav.classList.contains('opened')) {
        this.classList.add('opened');
        document.body.classList.add('no-scroll');
        subnav.classList.add('opened');
      } else {
        this.classList.remove('opened');
        document.body.classList.remove('no-scroll');
        subnav.classList.remove('opened');
      }
    });
  }
  ;
  var lists = document.querySelectorAll('.mobile-subnav-column__list-menu');
  lists.forEach(function (list) {
    list.style.display = "none";
  });
  var headers = document.querySelectorAll('.mobile-subnav-column__header');
  headers.forEach(function (header) {
    header.addEventListener('click', function (event) {
      if (header.nextElementSibling.classList.contains('mobile-subnav-column__list-menu')) {
        event.preventDefault();
        if (header.nextElementSibling.style.display === "none") {
          header.nextElementSibling.removeAttribute('style');
        } else {
          header.nextElementSibling.style.display = "none";
        }
      }
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

/***/ "./resources/js/components/swipers.js":
/*!********************************************!*\
  !*** ./resources/js/components/swipers.js ***!
  \********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   swipers: () => (/* binding */ swipers)
/* harmony export */ });
function swipers() {
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
}


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
/* harmony import */ var _components_mainContent__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./components/mainContent */ "./resources/js/components/mainContent.js");
/* harmony import */ var _components_swipers__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./components/swipers */ "./resources/js/components/swipers.js");






// import { slider } from "./components/slider";
// import { gallery } from "./components/gallery";

document.addEventListener('DOMContentLoaded', function () {
  (0,_components_subnav__WEBPACK_IMPORTED_MODULE_0__.subnavInit)();
  (0,_components_mobileNav__WEBPACK_IMPORTED_MODULE_3__.mobileNavInit)();
  (0,_components_mainContent__WEBPACK_IMPORTED_MODULE_4__.mainContent)();
  (0,_components_upform__WEBPACK_IMPORTED_MODULE_1__.upform)();
  (0,_components_swipers__WEBPACK_IMPORTED_MODULE_5__.swipers)();
  if (document.querySelector('.arrow-bar__arrow')) setTimeout(_components_arrowBar__WEBPACK_IMPORTED_MODULE_2__.arrowBarInit, 2000);

  // if (document.querySelector('.js-portfolio-slider')) slider();
  // if (document.querySelector('.js-portfoio-gallerey')) gallery();
});
})();

/******/ })()
;
//# sourceMappingURL=main.js.map