/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/site/components/arrowBar.js":
/*!**************************************************!*\
  !*** ./resources/js/site/components/arrowBar.js ***!
  \**************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   arrowBar: () => (/* binding */ arrowBar)
/* harmony export */ });
function arrowBar() {
  if (document.querySelector('.arrow-bar__arrow')) setTimeout(arrowBarInit, 1000);
}
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

/***/ "./resources/js/site/components/fancybox.js":
/*!**************************************************!*\
  !*** ./resources/js/site/components/fancybox.js ***!
  \**************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   fancybox: () => (/* binding */ fancybox)
/* harmony export */ });
function fancybox() {
  Fancybox.bind("[data-fancybox]", {
    // Your custom options
  });
}

/***/ }),

/***/ "./resources/js/site/components/gallery.js":
/*!*************************************************!*\
  !*** ./resources/js/site/components/gallery.js ***!
  \*************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   gallery: () => (/* binding */ gallery)
/* harmony export */ });
function gallery() {
  var content = document.querySelector('.article__content');
  var contentGalleries = document.querySelectorAll('.article__content .content-gallery');
  contentGalleries.forEach(function (gallery) {
    var id = gallery.dataset.id;
    var paragraphs = content.querySelectorAll('p');
    paragraphs.forEach(function (paragraph) {
      var regStr = '\\[gallery\\-' + id + '\\]';
      var regExp = new RegExp(regStr, 'i');
      if (paragraph.innerText.match(regExp)) {
        paragraph.replaceWith(gallery);
      }
    });
  });
}

/***/ }),

/***/ "./resources/js/site/components/grecaptcha.js":
/*!****************************************************!*\
  !*** ./resources/js/site/components/grecaptcha.js ***!
  \****************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   captcha: () => (/* binding */ captcha)
/* harmony export */ });
function captcha() {
  if (document.querySelector('#captcha_id')) {
    var verifyCallback = function verifyCallback() {
      var captcha = form.querySelector('#captcha_id');
      var notify = captcha.closest('.captcha').querySelector('.input__notify');
      notify.innerText = "";
    };
    var key = '6LfKbeYpAAAAAIPL2XNZxy3YS52yrXRboLB4Sp-r';
    var script = document.createElement('script');
    script.src = 'https://www.google.com/recaptcha/api.js';
    script.async = true;
    script.onload = function () {
      grecaptcha.ready(function () {
        grecaptcha.render('captcha_id', {
          'sitekey': key,
          'callback': verifyCallback
        });
      });
    };
    document.body.appendChild(script);
    ;
  }
}
;


/***/ }),

/***/ "./resources/js/site/components/inputFile.js":
/*!***************************************************!*\
  !*** ./resources/js/site/components/inputFile.js ***!
  \***************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   inputFile: () => (/* binding */ inputFile)
/* harmony export */ });
function inputFile() {
  document.querySelectorAll('input[type="file"]').forEach(function (input) {
    var label = input.closest('label');
    var info = label.querySelector('.input-file__info');
    input.addEventListener('change', function () {
      if (input.files.length > 0) {
        info.innerText = "\u041F\u0440\u0438\u043A\u0440\u0435\u043F\u043B\u0435\u043D\u043E \u0444\u0430\u0439\u043B\u043E\u0432: ".concat(input.files.length);
      } else {
        info.innerText = "Прикрепить файл";
      }
      ;
    });
    input.addEventListener('change', function () {
      if (input.files.length > 3) {
        input.value = "";
        alert('Ошибка! Нельзя прикреплять больше 3 файлов');
        info.innerText = "Прикрепить файл";
      }
      ;
    });
  });
}
;

/***/ }),

/***/ "./resources/js/site/components/mainContent.js":
/*!*****************************************************!*\
  !*** ./resources/js/site/components/mainContent.js ***!
  \*****************************************************/
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
  });
  function opencontent() {
    $('.js-index-content').data('opened', true).slideDown(2000, function () {
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
}

/***/ }),

/***/ "./resources/js/site/components/metrika.js":
/*!*************************************************!*\
  !*** ./resources/js/site/components/metrika.js ***!
  \*************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   metrika: () => (/* binding */ metrika)
/* harmony export */ });
function metrika() {
  (function (d, w, c) {
    (w[c] = w[c] || []).push(function () {
      try {
        w.yaCounter13339072 = new Ya.Metrika({
          id: 13339072,
          clickmap: false,
          trackLinks: false,
          accurateTrackBounce: true
        });
      } catch (e) {}
    });
    var n = d.getElementsByTagName("script")[0],
      x = "https://mc.yandex.ru/metrika/watch.js",
      s = d.createElement("script"),
      f = function f() {
        n.parentNode.insertBefore(s, n);
      };
    for (var i = 0; i < document.scripts.length; i++) {
      if (document.scripts[i].src === x) {
        return;
      }
    }
    s.type = "text/javascript";
    s.async = true;
    s.src = x;
    if (w.opera == "[object Opera]") {
      d.addEventListener("DOMContentLoaded", f, false);
    } else {
      f();
    }
  })(document, window, "yandex_metrika_callbacks");
}

/***/ }),

/***/ "./resources/js/site/components/mobileNav.js":
/*!***************************************************!*\
  !*** ./resources/js/site/components/mobileNav.js ***!
  \***************************************************/
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
  var headers = document.querySelectorAll('.js-subnav-header-opener');
  headers.forEach(function (header) {
    header.addEventListener('click', function (event) {
      if (header.closest('.mobile-subnav-column__header').nextElementSibling.classList.contains('mobile-subnav-column__list-menu')) {
        event.preventDefault();
        if (header.closest('.mobile-subnav-column__header').nextElementSibling.style.display === "none") {
          header.closest('.mobile-subnav-column__header').nextElementSibling.removeAttribute('style');
        } else {
          header.closest('.mobile-subnav-column__header').nextElementSibling.style.display = "none";
        }
      }
    });
  });
}
;

/***/ }),

/***/ "./resources/js/site/components/subnav.js":
/*!************************************************!*\
  !*** ./resources/js/site/components/subnav.js ***!
  \************************************************/
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

/***/ "./resources/js/site/components/swipers.js":
/*!*************************************************!*\
  !*** ./resources/js/site/components/swipers.js ***!
  \*************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   swipers: () => (/* binding */ swipers)
/* harmony export */ });
function swipers() {
  var widgetSlider = new Swiper('.widget .swiper', {
    loop: true,
    effect: "fade",
    speed: 1000,
    autoplay: {
      delay: 7500,
      disableOnInteraction: false
    }
  });
  var portfolioSectionSlider = new Swiper('.portfolio-section__slider .swiper', {
    slidesPerView: 1,
    loop: true,
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev'
    }
  });
  var portfolioThumbs = new Swiper('.portfolio__thumbs .swiper', {
    loop: true,
    slidesPerView: "auto",
    freeMode: true,
    watchSlidesProgress: true,
    breakpoints: {
      0: {
        slidesPerView: 3,
        spaceBetween: 10
      },
      600: {
        slidesPerView: 4,
        spaceBetween: 20
      }
    }
  });
  var portfolioSlider = new Swiper('.portfolio__slider .swiper', {
    loop: true,
    slidesPerView: 1,
    spaceBetween: 10,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev"
    },
    thumbs: {
      swiper: portfolioThumbs
    }
  });
  var contentSlider = new Swiper('.content__slider .swiper', {
    loop: true,
    slidesPerView: 1,
    spaceBetween: 10,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev"
    }
  });
}


/***/ }),

/***/ "./resources/js/site/components/widget.js":
/*!************************************************!*\
  !*** ./resources/js/site/components/widget.js ***!
  \************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   widgetInit: () => (/* binding */ widgetInit)
/* harmony export */ });
function widgetInit() {
  var widget = document.querySelector('.widget');
  var closeButtons = document.querySelectorAll('.js-widget-close');
  if (widget && closeButtons) {
    closeButtons.forEach(function (closeBtn) {
      closeBtn.addEventListener('click', function (event) {
        event.preventDefault();
        widget.remove();
      });
    });
  }
  ;
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
/*!***********************************!*\
  !*** ./resources/js/site/main.js ***!
  \***********************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _components_gallery__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./components/gallery */ "./resources/js/site/components/gallery.js");
/* harmony import */ var _components_subnav__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./components/subnav */ "./resources/js/site/components/subnav.js");
/* harmony import */ var _components_arrowBar__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./components/arrowBar */ "./resources/js/site/components/arrowBar.js");
/* harmony import */ var _components_mobileNav__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./components/mobileNav */ "./resources/js/site/components/mobileNav.js");
/* harmony import */ var _components_mainContent__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./components/mainContent */ "./resources/js/site/components/mainContent.js");
/* harmony import */ var _components_swipers__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./components/swipers */ "./resources/js/site/components/swipers.js");
/* harmony import */ var _components_grecaptcha__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./components/grecaptcha */ "./resources/js/site/components/grecaptcha.js");
/* harmony import */ var _components_fancybox__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./components/fancybox */ "./resources/js/site/components/fancybox.js");
/* harmony import */ var _components_metrika__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ./components/metrika */ "./resources/js/site/components/metrika.js");
/* harmony import */ var _components_inputFile__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! ./components/inputFile */ "./resources/js/site/components/inputFile.js");
/* harmony import */ var _components_widget__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! ./components/widget */ "./resources/js/site/components/widget.js");











// import { upform } from "./components/upform";
// import { modalWindows } from "./components/modals";

window.addEventListener('load', function () {
  (0,_components_metrika__WEBPACK_IMPORTED_MODULE_8__.metrika)();
  (0,_components_subnav__WEBPACK_IMPORTED_MODULE_1__.subnavInit)();
  (0,_components_mobileNav__WEBPACK_IMPORTED_MODULE_3__.mobileNavInit)();
  (0,_components_arrowBar__WEBPACK_IMPORTED_MODULE_2__.arrowBar)();
  (0,_components_mainContent__WEBPACK_IMPORTED_MODULE_4__.mainContent)();
  (0,_components_swipers__WEBPACK_IMPORTED_MODULE_5__.swipers)();
  (0,_components_widget__WEBPACK_IMPORTED_MODULE_10__.widgetInit)();
  // upform();
  // modalWindows();
});
document.addEventListener('click', function () {
  (0,_components_inputFile__WEBPACK_IMPORTED_MODULE_9__.inputFile)();
  (0,_components_grecaptcha__WEBPACK_IMPORTED_MODULE_6__.captcha)();
}, {
  once: true
});
document.addEventListener('scroll', function () {
  (0,_components_gallery__WEBPACK_IMPORTED_MODULE_0__.gallery)();
  (0,_components_fancybox__WEBPACK_IMPORTED_MODULE_7__.fancybox)();
}, {
  once: true
});
})();

/******/ })()
;
//# sourceMappingURL=main.js.map