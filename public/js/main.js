(()=>{"use strict";function e(){var n=document.querySelector(".arrow-bar__arrow");n.style.backgroundPosition="0 -48px",setTimeout((function(){n.style.backgroundPosition="0 -96px",setTimeout((function(){n.style.backgroundPosition="0 -48px",setTimeout((function(){n.style.backgroundPosition="0 0",setTimeout((function(){n.style.backgroundPosition="0 -48px",setTimeout((function(){n.style.backgroundPosition="0 -96px",setTimeout((function(){n.style.backgroundPosition="0 -48px",setTimeout((function(){n.style.backgroundPosition="0 0"}),100)}),150)}),100)}),150)}),100)}),150)}),100),setTimeout(e,3e3)}function n(){$(".js-index-content-opener").click((function(){var e=$(".js-index-content");1==e.data("opened")?($(".js-index-content-opener").removeClass("index-submap__arrow--up"),$(".js-index-content").data("opened",!1).slideUp(2e3,(function(){$(".js-index-submap").removeClass("index-submap--nobg")}))):0==e.data("opened")&&$(".js-index-content").data("opened",!0).slideDown(2e3,(function(){$(".js-index-submap").addClass("index-submap--nobg"),$(".js-index-content-opener").addClass("index-submap__arrow--up"),$(".js-index-content").data("opened",!0)}))}))}window.addEventListener("load",(function(){var t,o,s,c;!function(e,n,t){(n[t]=n[t]||[]).push((function(){try{n.yaCounter13339072=new Ya.Metrika({id:13339072,clickmap:!1,trackLinks:!1,accurateTrackBounce:!0})}catch(e){}}));for(var o=e.getElementsByTagName("script")[0],s="https://mc.yandex.ru/metrika/watch.js",c=e.createElement("script"),i=function(){o.parentNode.insertBefore(c,o)},a=0;a<document.scripts.length;a++)if(document.scripts[a].src===s)return;c.type="text/javascript",c.async=!0,c.src=s,"[object Opera]"==n.opera?e.addEventListener("DOMContentLoaded",i,!1):i()}(document,window,"yandex_metrika_callbacks"),function(){var e=document.querySelector(".js-subnav"),n=document.querySelectorAll(".js-subnav-opener"),t=document.querySelectorAll(".js-subnav-block"),o=document.querySelectorAll(".js-subnav-close");function s(){e.classList.remove("opened"),n.forEach((function(e){e.classList.remove("opened")})),t.forEach((function(e){e.classList.remove("opened")}))}n.forEach((function(n){n.addEventListener("click",(function(o){n.dataset.subnav&&(o.preventDefault(),s(),e.classList.add("opened"),o.target.classList.add("opened"),t.forEach((function(e){e.dataset.subnav==o.target.dataset.subnav&&e.classList.add("opened")})))}))})),document.addEventListener("keydown",(function(e){"Escape"==e.code&&s()})),document.addEventListener("click",(function(n){n.target.closest(".js-subnav-opener")||n.target.closest(".js-subnav")||!e.classList.contains("opened")||s()})),o.forEach((function(e){e.addEventListener("click",(function(){s()}))}))}(),t=document.querySelector(".js-mobile-nav-opener"),o=document.querySelector(".js-mobile-subnav"),t&&o&&t.addEventListener("click",(function(e){e.preventDefault(),o.classList.contains("opened")?(this.classList.remove("opened"),document.body.classList.remove("no-scroll"),o.classList.remove("opened")):(this.classList.add("opened"),document.body.classList.add("no-scroll"),o.classList.add("opened"))})),document.querySelectorAll(".mobile-subnav-column__list-menu").forEach((function(e){e.style.display="none"})),document.querySelectorAll(".js-subnav-header-opener").forEach((function(e){e.addEventListener("click",(function(n){e.closest(".mobile-subnav-column__header").nextElementSibling.classList.contains("mobile-subnav-column__list-menu")&&(n.preventDefault(),"none"===e.closest(".mobile-subnav-column__header").nextElementSibling.style.display?e.closest(".mobile-subnav-column__header").nextElementSibling.removeAttribute("style"):e.closest(".mobile-subnav-column__header").nextElementSibling.style.display="none")}))})),document.querySelector(".arrow-bar__arrow")&&setTimeout(e,1e3),n(),function(){new Swiper(".widget .swiper",{loop:!0,effect:"fade",speed:1e3,autoplay:{delay:7500,disableOnInteraction:!1}}),new Swiper(".portfolio-section__slider .swiper",{slidesPerView:1,loop:!0,navigation:{nextEl:".swiper-button-next",prevEl:".swiper-button-prev"}});var e=new Swiper(".portfolio__thumbs .swiper",{loop:!0,slidesPerView:"auto",freeMode:!0,watchSlidesProgress:!0,breakpoints:{0:{slidesPerView:3,spaceBetween:10},600:{slidesPerView:4,spaceBetween:20}}});new Swiper(".portfolio__slider .swiper",{loop:!0,slidesPerView:1,spaceBetween:10,navigation:{nextEl:".swiper-button-next",prevEl:".swiper-button-prev"},thumbs:{swiper:e}}),new Swiper(".content__slider .swiper",{loop:!0,slidesPerView:1,spaceBetween:10,navigation:{nextEl:".swiper-button-next",prevEl:".swiper-button-prev"}})}(),s=document.querySelector(".widget"),c=document.querySelector(".js-widget-close"),s&&c&&c.addEventListener("click",(function(e){e.preventDefault(),s.remove()}))})),document.addEventListener("click",(function(){document.querySelectorAll('input[type="file"]').forEach((function(e){var n=e.closest("label").querySelector(".input-file__info");e.addEventListener("change",(function(){e.files.length>0?n.innerText="Прикреплено файлов: ".concat(e.files.length):n.innerText="Прикрепить файл"})),e.addEventListener("change",(function(){e.files.length>3&&(e.value="",alert("Ошибка! Нельзя прикреплять больше 3 файлов"),n.innerText="Прикрепить файл")}))})),function(){if(document.querySelector("#captcha_id")){var e=function(){form.querySelector("#captcha_id").closest(".captcha").querySelector(".input__notify").innerText=""},n=document.createElement("script");n.src="https://www.google.com/recaptcha/api.js",n.async=!0,n.onload=function(){grecaptcha.ready((function(){grecaptcha.render("captcha_id",{sitekey:"6LfKbeYpAAAAAIPL2XNZxy3YS52yrXRboLB4Sp-r",callback:e})}))},document.body.appendChild(n)}}()}),{once:!0}),document.addEventListener("scroll",(function(){var e;e=document.querySelector(".article__content"),document.querySelectorAll(".article__content .content-gallery").forEach((function(n){var t=n.dataset.id;e.querySelectorAll("p").forEach((function(e){var o=new RegExp("\\[gallery\\-"+t+"\\]","i");e.innerText.match(o)&&e.replaceWith(n)}))})),Fancybox.bind("[data-fancybox]",{})}),{once:!0})})();
//# sourceMappingURL=main.js.map