(()=>{"use strict";var e,t={134:()=>{function e(){var e=document.querySelectorAll(".gallery-item");e.length>0&&e.forEach((function(e){!function(e){var t=e.querySelector('[data-action="saveGalleryItem"]');t.addEventListener("click",o);var n=e.querySelector('[data-action="removeGalleryItem"]');function a(){var e=document.querySelector('meta[name="csrf-token"]').getAttribute("content"),t=n.dataset.id;t&&fetch("/admin/ajax/removeGalleryItem",{method:"POST",headers:{"X-CSRF-TOKEN":e},body:t}).then((function(e){e.text().then((function(e){console.log("result:",e);var t=n.closest(".gallery-item");t&&t.remove()}))}))}function o(){var n=new FormData,a=document.querySelector('meta[name="csrf-token"]').getAttribute("content"),o=t.dataset.id,r=e.querySelector('[data-name="text"]').value,i=e.querySelector('[data-name="sort"]').value,l=e.querySelector('[data-name="portfolio_id"]').value;n.append("id",o),n.append("text",r),n.append("sort",i),n.append("portfolio_id",l),fetch("/admin/ajax/updateGalleryItem",{method:"POST",headers:{"X-CSRF-TOKEN":a},body:n}).then((function(e){e.text().then((function(e){console.log("result:",e)}))}))}n.addEventListener("click",a)}(e)}))}function t(e){var t=e.src.split("/")[7],n=document.createElement("button");n.type="button",n.classList.add("destroy-image-btn"),n.dataset.id=t,n.innerHTML='<i class="fas fa-trash"></i>',e.nextElementSibling&&"BUTTON"==e.nextElementSibling.tagName&&e.nextElementSibling.classList.contains("destroy-image-btn")&&e.nextElementSibling.remove(),e.after(n),n.addEventListener("click",(function(e){e.preventDefault,function(e,t){var n=document.querySelector('meta[name="csrf-token"]').getAttribute("content");confirm("Удалить изображение?")&&fetch("/admin/ajax/destroyImage",{method:"POST",headers:{"Content-Type":"application/json;charset=utf-8","X-CSRF-TOKEN":n},body:JSON.stringify({id:e})}).then((function(e){e.text().then((function(e){console.log("result:",e)})),t.parentElement.classList.contains("portfolio-gallery-image")?t.parentElement.remove():t.parentElement.querySelector("img").remove(),t.remove()}))}(t,n)}))}function n(){var e=document.querySelector('[data-action="updateAvatar"]');if(e){var n=e.closest(".input-group").querySelector(".custom-file-input"),a=e.closest(".input-group").querySelector(".custom-file-label");n&&e.addEventListener("click",(function(){if(0==n.files.length&&alert("Выберите файл"),n.files.length>0){if(!confirm("Будет загружено новое изображение. Продолжить?"))return;var o=new FormData,r=document.querySelector('meta[name="csrf-token"]').getAttribute("content"),i=e.dataset.id,l=e.dataset.type,c=n.files[0];i&&l&&c&&(o.append("page_id",i),o.append("page_type",l),o.append("avatar_file",c),fetch("/admin/ajax/updateAvatar",{method:"POST",headers:{"X-CSRF-TOKEN":r},body:o}).then((function(e){e.text().then((function(e){!function(e){var n=document.querySelector(".avatar");if(n){n.innerHTML="";var a=document.createElement("img");a.src=e,n.append(a),t(a)}}(e),n.value="",a&&(a.innerText="Файл не выбран")}))})))}}))}}function a(){if(document.getElementById("portfolio-gallery")){var e=document.getElementById("portfolio-gallery"),n=e.cloneNode(!0),a=document.getElementById("portfolio-gallery-buttons"),o=a.querySelector('[data-action="sort"]'),r=a.querySelector('[data-action="save"]'),i=a.querySelector('[data-action="cancel"]');o.addEventListener("click",(function(){e.querySelectorAll(".portfolio-gallery-image").forEach((function(e){e.draggable=!0,e.querySelectorAll("img").forEach((function(e){e.style.pointerEvents="none"})),e.querySelectorAll("button").forEach((function(e){e.style.display="none"})),e.addEventListener("dragstart",d),e.addEventListener("dragover",u),e.addEventListener("dragend",s)})),o.setAttribute("disabled",""),r.removeAttribute("disabled"),i.removeAttribute("disabled")})),r.addEventListener("click",(function(){var t=[];e.querySelectorAll(".portfolio-gallery-image").forEach((function(e,n){var a=e.querySelector("img").src.split("/")[7];t.push({id:a,sort:n})}));var n=document.querySelector('meta[name="csrf-token"]').getAttribute("content");fetch("/admin/ajax/saveGallerySort",{method:"POST",headers:{"Content-Type":"application/json;charset=utf-8","X-CSRF-TOKEN":n},body:JSON.stringify(t)}).then((function(e){e.text().then((function(e){console.log("result:",e)}))})),c(),l()})),i.addEventListener("click",(function(){var a;a=n,e.replaceWith(a),c(),l(),e.querySelectorAll(".portfolio-gallery-image").forEach((function(e){e.querySelectorAll("img").forEach((function(e){t(e)}))}))}))}function l(){e=document.getElementById("portfolio-gallery"),n=e.cloneNode(!0)}function c(){e.querySelectorAll(".portfolio-gallery-image").forEach((function(e){e.removeAttribute("draggable"),e.querySelectorAll("img").forEach((function(e){e.removeAttribute("style")})),e.querySelectorAll("button").forEach((function(e){e.removeAttribute("style")})),e.removeEventListener("dragstart",d),e.removeEventListener("dragover",u),e.removeEventListener("dragend",s)})),o.removeAttribute("disabled"),r.setAttribute("disabled",""),i.setAttribute("disabled","")}function d(e){e.target.classList.add("selected")}function s(e){e.target.classList.remove("selected")}function u(t){t.preventDefault();var n=e.querySelector(".selected"),a=t.target;if(n!==a&&a.classList.contains("portfolio-gallery-image")){var o=a===n.nextElementSibling?a.nextElementSibling:a;e.insertBefore(n,o)}}}function o(){var e=document.querySelector('[data-action="addImagesToPortfolio"]');if(e){var n=e.closest(".input-group").querySelector(".custom-file-input"),a=e.closest(".input-group").querySelector(".custom-file-label");n&&e.addEventListener("click",(function(){if(0==n.files.length&&alert("Выберите файлы"),n.files.length>0){if(!confirm("Продолжить?"))return;var o=new FormData,r=document.querySelector('meta[name="csrf-token"]').getAttribute("content"),i=e.dataset.id,l=e.dataset.type,c=n.files;if(i&&l&&c){o.append("page_id",i),o.append("page_type",l);for(var d=0;d<c.length;d++)o.append("images[".concat(d,"]"),c[d]);fetch("/admin/ajax/addImagesToPortfolio",{method:"POST",headers:{"X-CSRF-TOKEN":r},body:o}).then((function(e){e.text().then((function(e){var o,r;o=JSON.parse(e),(r=document.getElementById("portfolio-gallery"))&&o.forEach((function(e){var n=document.createElement("img");n.src=e,n.setAttribute("width","152px"),n.setAttribute("height","auto"),n.setAttribute("data-function","destroy");var a=document.createElement("div");a.classList.add("portfolio-gallery-image","mr-2","mt-1","mb-1","d-block","position-relative"),a.append(n),r.append(a),t(n)})),n.value="",a&&(a.innerText="Файлы не выбраны")}))}))}}}))}}function r(e){var t=e.querySelector('[data-action="saveQuestion"]');t.addEventListener("click",(function(){if(!confirm("Сохранить вопрос?"))return;var a=new FormData,o=document.querySelector('meta[name="csrf-token"]').getAttribute("content"),r=t.dataset.id,i=e.querySelector('[data-name="name"]').value,l=e.querySelector('[data-name="answer"]').value,c=e.querySelector('[data-name="sort"]').value,d=t.dataset.faq;c||(c=1,e.querySelector('[data-name="sort"]').value=c);i&&l&&c&&(a.append("id",r),a.append("name",i),a.append("answer",l),a.append("sort",c),a.append("faq_id",d),fetch("/admin/ajax/saveQuestion",{method:"POST",headers:{"X-CSRF-TOKEN":o},body:a}).then((function(e){e.text().then((function(e){console.log("result:",JSON.parse(e)),n.dataset.id=JSON.parse(e).id}))})))}));var n=e.querySelector('[data-action="removeQuestion"]');n.addEventListener("click",(function(){if(!confirm("Удалить вопрос?"))return;var e=document.querySelector('meta[name="csrf-token"]').getAttribute("content"),t=n.dataset.id;t&&fetch("/admin/ajax/removeQuestion",{method:"POST",headers:{"X-CSRF-TOKEN":e},body:t}).then((function(e){e.text().then((function(e){console.log("result:",e);var t=n.closest(".question");t&&t.remove()}))}))}))}function i(){var e=document.querySelector('[data-action="addImagesToGallery"]');if(console.log(e),e){var t=e.closest(".input-group").querySelector(".custom-file-input"),n=e.closest(".input-group").querySelector(".custom-file-label");t&&e.addEventListener("click",(function(){if(0==t.files.length&&alert("Выберите файлы"),t.files.length>0){if(!confirm("Продолжить?"))return;var a=new FormData,o=document.querySelector('meta[name="csrf-token"]').getAttribute("content"),r=e.dataset.id,i=e.dataset.type,l=t.files;if(r&&i&&l){a.append("page_id",r),a.append("page_type",i);for(var c=0;c<l.length;c++)a.append("images[".concat(c,"]"),l[c]);fetch("/admin/ajax/addImagesToGallery",{method:"POST",headers:{"X-CSRF-TOKEN":o},body:a}).then((function(e){e.text().then((function(e){var a,o;a=JSON.parse(e),(o=document.querySelector(".gallery-items"))&&a.forEach((function(e){var t=document.createElement("div");t.classList.add("gallery-item","col-md-6"),t.innerHTML='\n                    <div class="card">\n                        <div class="card-body">\n                            <div class="row">\n                                <div class="col-md-4">\n                                    <div class="form-group">\n                                        <label>Изображние</label>\n                                        <div\n                                            class="portfolio-gallery-image mr-2 mt-1 mb-1 d-block position-relative">\n                                            <img\n                                                src="'.concat(e,'" />\n                                        </div>\n                                    </div>\n                                </div>\n                                <div class="col-md-8">\n                                    <div class="form-group">\n                                        <label for="items[{{ $item[\'id\'] }}][text]">\n                                            Текст\n                                        </label>\n                                        <textarea class="form-control"\n                                            id="items[{{ $item[\'id\'] }}][text]"\n                                            name="items[{{ $item[\'id\'] }}][text]"\n                                            rows="3" data-name="text"\n                                            disabled>{{ $item[\'text\'] }}\n                                        </textarea>\n                                    </div>\n                                </div>\n                            </div>\n                            <div class="row">\n                                <div class="col-md-12">\n                                    <div class="form-group">\n                                        <label\n                                            for="items[{{ $item[\'id\'] }}][portfolio_id]">Ссылка\n                                            на портфолио</label>\n                                        <select class="form-control"\n                                            id="items[{{ $item[\'id\'] }}][portfolio_id]"\n                                            name="items[{{ $item[\'id\'] }}][portfolio_id]"\n                                            value="{{ $item[\'portfolio_id\'] }}"\n                                            data-name="portfolio_id" \n                                            disabled>\n                                            <option value="0">Не выбрано</option>\n                                            @foreach ($portfolioGalleries as $portfolioGallerу)\n                                                <option value="{{ $portfolioGallerу[\'id\'] }}"\n                                                    {{ $portfolioGallerу[\'id\'] == $item[\'portfolio_id\'] ? \'selected\' : \'\' }}>\n                                                    {{ $portfolioGallerу[\'name\'] }}\n                                                </option>\n                                            @endforeach\n                                        </select>\n                                    </div>\n                                </div>\n                            </div>\n                            <div class="row">\n                                <div class="col-md-5">\n                                    <div class="form-group">\n                                        <label for="items[{{ $item[\'id\'] }}][sort]">Ключ\n                                            сортировки</label>\n                                        <input type="text" class="form-control"\n                                            id="items[{{ $item[\'id\'] }}][sort]"\n                                            name="items[{{ $item[\'id\'] }}][sort]"\n                                            value="{{ $item[\'sort\'] }}" \n                                            data-name="sort" \n                                            disabled/>\n                                    </div>\n                                </div>\n                                <div class="col-md-5 d-flex align-items-end">\n                                    <div class="form-group w-100">\n                                        <button type="button"\n                                            class="btn btn-block btn-primary"\n                                            data-action="saveGalleryItem"\n                                            data-id="{{ $item[\'id\'] }}"\n                                            onclick="return check()"\n                                            disabled>\n                                            Сохранить\n                                        </button>\n                                    </div>\n                                </div>\n                                <div class="col-md-2 d-flex align-items-end">\n                                    <div class="form-group w-100">\n                                        <button type="button"\n                                            class="btn btn-block btn-danger"\n                                            data-action="removeGalleryItem"\n                                            data-id="{{ $item[\'id\'] }}"\n                                            onclick="return check()"\n                                            disabled>\n                                            <i class=\'fas fa-trash-alt\'\n                                                style=\'color:#fff\'></i>\n                                        </button>\n                                    </div>\n                                </div>\n                            </div>\n                        </div>\n                    </div>\n            '),o.append(t)})),t.value="",n&&(n.innerText="Файлы не выбраны")}))}))}}}))}}document.addEventListener("DOMContentLoaded",(function(){var l,c;tinymce.init({selector:".editor",plugins:"file-manager table link lists code fullscreen",Flmngr:{apiKey:"FLMNFLMN",urlFileManager:"/flmngr",urlFiles:"/storage/upload/files"},relative_urls:!1,extended_valid_elements:"*[*]",height:"500px",toolbar:["bold italic underline | alignleft aligncenter alignright alignjustify |  bullist numlist outdent indent | link blockquote table | code "],contextmenu:"undo redo | cut copy paste | inserttable",promotion:!1,language:"ru"}),e(),n(),(l=document.querySelectorAll('img[data-function="destroy"]'))&&l.forEach((function(e){t(e)})),a(),o(),(c=document.querySelectorAll(".question")).length>0&&c.forEach((function(e){r(e)})),function(){var e=document.querySelector(".questions"),t=document.querySelector('button[data-action="addNewQuestion"]');if(e&&t){var n=t.dataset.faq;t.addEventListener("click",(function(){var t=Math.floor(9999*Math.random()),a=document.createElement("div");a.classList.add("question","col-md-6"),a.innerHTML='\n                <div class="card">\n                    <div class="card-body">\n                        <div class="form-group">\n                            <label for="question_name['.concat(t,']">Название</label>\n                            <input type="text" class="form-control" id="question_name[').concat(t,']"\n                                name="questions[').concat(t,'][name]" data-name="name">\n                        </div>\n                        <div class="form-group">\n                            <div class="form-group">\n                                <label\n                                    for="questions[').concat(t,'][answer]">Ответ</label>\n                                <input class="form-control" type="hidden"\n                                    data-name="answer"\n                                    id="questions[').concat(t,'][answer]"\n                                    name="questions[').concat(t,'][answer]">\n                                <trix-editor\n                                    input="questions[').concat(t,'][answer]"></trix-editor>\n                            </div>\n                        </div>\n                        <div class="row">\n                            <div class="col-md-5">\n                                <div class="form-group">\n                                    <label for="questions[').concat(t,'][sort]">Ключ сортировки</label>\n                                    <input type="text" class="form-control"\n                                        id="questions[').concat(t,'][sort]" name="questions[').concat(t,'][sort]" data-name="sort">\n                                </div>\n                            </div>\n                            <div class="col-md-5 d-flex align-items-end">\n                                <div class="form-group w-100">\n                                    <button type="button" class="btn btn-block btn-primary"\n                                        data-action="saveQuestion"\n                                        data-id="0"\n                                        data-faq="').concat(n,'">\n                                        Сохранить\n                                    </button>\n                                </div>\n                            </div>\n                            <div class="col-md-2 d-flex align-items-end">\n                                <div class="form-group w-100">\n                                    <button type="button" class="btn btn-block btn-danger"\n                                        data-action="removeQuestion"\n                                        data-id="{').concat(t,'}">\n                                        Удалить\n                                    </button>\n                                </div>\n                            </div>\n                        </div>\n                    </div>\n                </div>\n            '),e.append(a),r(a)}))}}(),bsCustomFileInput.init(),i()}))},357:()=>{}},n={};function a(e){var o=n[e];if(void 0!==o)return o.exports;var r=n[e]={exports:{}};return t[e](r,r.exports,a),r.exports}a.m=t,e=[],a.O=(t,n,o,r)=>{if(!n){var i=1/0;for(s=0;s<e.length;s++){for(var[n,o,r]=e[s],l=!0,c=0;c<n.length;c++)(!1&r||i>=r)&&Object.keys(a.O).every((e=>a.O[e](n[c])))?n.splice(c--,1):(l=!1,r<i&&(i=r));if(l){e.splice(s--,1);var d=o();void 0!==d&&(t=d)}}return t}r=r||0;for(var s=e.length;s>0&&e[s-1][2]>r;s--)e[s]=e[s-1];e[s]=[n,o,r]},a.o=(e,t)=>Object.prototype.hasOwnProperty.call(e,t),(()=>{var e={567:0,552:0};a.O.j=t=>0===e[t];var t=(t,n)=>{var o,r,[i,l,c]=n,d=0;if(i.some((t=>0!==e[t]))){for(o in l)a.o(l,o)&&(a.m[o]=l[o]);if(c)var s=c(a)}for(t&&t(n);d<i.length;d++)r=i[d],a.o(e,r)&&e[r]&&e[r][0](),e[r]=0;return a.O(s)},n=self.webpackChunk=self.webpackChunk||[];n.forEach(t.bind(null,0)),n.push=t.bind(null,n.push.bind(n))})(),a.O(void 0,[552],(()=>a(134)));var o=a.O(void 0,[552],(()=>a(357)));o=a.O(o)})();
//# sourceMappingURL=admin.js.map