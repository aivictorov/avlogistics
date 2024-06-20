/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/admin/admin.js":
/*!*************************************!*\
  !*** ./resources/js/admin/admin.js ***!
  \*************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _components_editor__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./components/editor */ "./resources/js/admin/components/editor.js");
/* harmony import */ var _components_gallery__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./components/gallery */ "./resources/js/admin/components/gallery.js");
/* harmony import */ var _components_avatarUpdate__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./components/avatarUpdate */ "./resources/js/admin/components/avatarUpdate.js");
/* harmony import */ var _components_destroyImageBtns__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./components/destroyImageBtns */ "./resources/js/admin/components/destroyImageBtns.js");
/* harmony import */ var _components_portfolioSort__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./components/portfolioSort */ "./resources/js/admin/components/portfolioSort.js");
/* harmony import */ var _components_portfolioImgs__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./components/portfolioImgs */ "./resources/js/admin/components/portfolioImgs.js");
/* harmony import */ var _components_questions__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./components/questions */ "./resources/js/admin/components/questions.js");
/* harmony import */ var _components_inputfile__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./components/inputfile */ "./resources/js/admin/components/inputfile.js");
/* harmony import */ var _components_galleryImgs__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ./components/galleryImgs */ "./resources/js/admin/components/galleryImgs.js");









document.addEventListener('DOMContentLoaded', function () {
  (0,_components_editor__WEBPACK_IMPORTED_MODULE_0__.editor)();
  (0,_components_gallery__WEBPACK_IMPORTED_MODULE_1__.initGalleryItems)();
  (0,_components_avatarUpdate__WEBPACK_IMPORTED_MODULE_2__.initUpdateAvatar)();
  (0,_components_destroyImageBtns__WEBPACK_IMPORTED_MODULE_3__.initDestroyImageButtons)();
  (0,_components_portfolioSort__WEBPACK_IMPORTED_MODULE_4__.initSortPortfolioGallery)();
  (0,_components_portfolioImgs__WEBPACK_IMPORTED_MODULE_5__.addImagesToPortfolio)();
  (0,_components_questions__WEBPACK_IMPORTED_MODULE_6__.initQuestions)();
  (0,_components_questions__WEBPACK_IMPORTED_MODULE_6__.addNewQuestion)();
  (0,_components_inputfile__WEBPACK_IMPORTED_MODULE_7__.fileinput)();
  (0,_components_galleryImgs__WEBPACK_IMPORTED_MODULE_8__.addImagesToGallery)();
});

/***/ }),

/***/ "./resources/js/admin/components/avatarUpdate.js":
/*!*******************************************************!*\
  !*** ./resources/js/admin/components/avatarUpdate.js ***!
  \*******************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   initUpdateAvatar: () => (/* binding */ initUpdateAvatar)
/* harmony export */ });
/* harmony import */ var _destroyImageBtns__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./destroyImageBtns */ "./resources/js/admin/components/destroyImageBtns.js");

function initUpdateAvatar() {
  var button = document.querySelector('[data-action="updateAvatar"]');
  if (button) {
    var input = button.closest('.input-group').querySelector('.custom-file-input');
    var label = button.closest('.input-group').querySelector('.custom-file-label');
    if (input) {
      button.addEventListener('click', function () {
        if (input.files.length == 0) alert('Выберите файл');
        if (input.files.length > 0) {
          var confirmation = confirm("Будет загружено новое изображение. Продолжить?");
          if (!confirmation) return;
          var form = new FormData();
          var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
          var page_id = button.dataset.id;
          var page_type = button.dataset.type;
          var avatar_file = input.files[0];
          if (page_id && page_type && avatar_file) {
            form.append('page_id', page_id);
            form.append('page_type', page_type);
            form.append('avatar_file', avatar_file);
            fetch('/admin/ajax/updateAvatar', {
              method: 'POST',
              headers: {
                'X-CSRF-TOKEN': csrfToken
              },
              body: form
            }).then(function (response) {
              response.text().then(function (responseText) {
                renderAvatar(responseText);
                input.value = "";
                if (label) label.innerText = "Файл не выбран";
              });
            });
          }
        }
      });
    }
  }
}
;
function renderAvatar(path) {
  var avatarPreview = document.querySelector('.avatar');
  if (avatarPreview) {
    avatarPreview.innerHTML = "";
    var image = document.createElement('img');
    image.src = path;
    avatarPreview.append(image);
    (0,_destroyImageBtns__WEBPACK_IMPORTED_MODULE_0__.addDestroyImageButton)(image);
  }
}

/***/ }),

/***/ "./resources/js/admin/components/destroyImageBtns.js":
/*!***********************************************************!*\
  !*** ./resources/js/admin/components/destroyImageBtns.js ***!
  \***********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   addDestroyImageButton: () => (/* binding */ addDestroyImageButton),
/* harmony export */   initDestroyImageButtons: () => (/* binding */ initDestroyImageButtons)
/* harmony export */ });
function initDestroyImageButtons() {
  var images = document.querySelectorAll('img[data-function="destroy"]');
  if (images) {
    images.forEach(function (image) {
      addDestroyImageButton(image);
    });
  }
}
;
function addDestroyImageButton(image) {
  var id = image.src.split('/')[7];
  var button = document.createElement('button');
  button.type = 'button';
  button.classList.add('destroy-image-btn');
  button.dataset.id = id;
  button.innerHTML = "<i class=\"fas fa-trash\"></i>";
  if (image.nextElementSibling && image.nextElementSibling.tagName == 'BUTTON' && image.nextElementSibling.classList.contains('destroy-image-btn')) {
    image.nextElementSibling.remove();
  }
  image.after(button);
  button.addEventListener('click', function (event) {
    event.preventDefault;
    destroyImageHandle(id, button);
  });
  function destroyImageHandle(id, button) {
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var result = confirm("Удалить изображение?");
    if (result) {
      fetch('/admin/ajax/destroyImage', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json;charset=utf-8',
          'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({
          id: id
        })
      }).then(function (response) {
        response.text().then(function (responseText) {
          console.log('result:', responseText);
        });
        if (button.parentElement.classList.contains('portfolio-gallery-image')) {
          button.parentElement.remove();
        } else {
          button.parentElement.querySelector('img').remove();
        }
        button.remove();
      });
    }
    ;
  }
  ;
}
;

/***/ }),

/***/ "./resources/js/admin/components/editor.js":
/*!*************************************************!*\
  !*** ./resources/js/admin/components/editor.js ***!
  \*************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   editor: () => (/* binding */ editor)
/* harmony export */ });
function editor() {
  tinymce.init({
    selector: ".editor",
    plugins: "file-manager table link lists code fullscreen",
    Flmngr: {
      apiKey: "FLMNFLMN",
      urlFileManager: '/flmngr',
      urlFiles: '/storage/upload/files'
    },
    relative_urls: false,
    extended_valid_elements: "*[*]",
    height: "500px",
    toolbar: ["bold italic underline | alignleft aligncenter alignright alignjustify |  bullist numlist outdent indent | link blockquote table | code "],
    contextmenu: "undo redo | cut copy paste | inserttable",
    promotion: false,
    language: "ru"
  });
}
;

/***/ }),

/***/ "./resources/js/admin/components/gallery.js":
/*!**************************************************!*\
  !*** ./resources/js/admin/components/gallery.js ***!
  \**************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   initGalleryItems: () => (/* binding */ initGalleryItems)
/* harmony export */ });
function initGalleryItems() {
  var galleryItems = document.querySelectorAll('.gallery-item');
  if (galleryItems.length > 0) {
    galleryItems.forEach(function (item) {
      initGalleryItem(item);
    });
  }
}
function initGalleryItem(galleryItem) {
  var saveButton = galleryItem.querySelector('[data-action="saveGalleryItem"]');
  saveButton.addEventListener('click', saveHandle);
  var removeButton = galleryItem.querySelector('[data-action="removeGalleryItem"]');
  removeButton.addEventListener('click', removeHandle);
  function removeHandle() {
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var id = removeButton.dataset.id;
    if (id) {
      fetch('/admin/ajax/removeGalleryItem', {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': csrfToken
        },
        body: id
      }).then(function (response) {
        response.text().then(function (responseText) {
          console.log('result:', responseText);
          var item = removeButton.closest('.gallery-item');
          if (item) item.remove();
        });
      });
    }
  }
  function saveHandle() {
    var form = new FormData();
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var id = saveButton.dataset.id;
    var text = galleryItem.querySelector('[data-name="text"]').value;
    var sort = galleryItem.querySelector('[data-name="sort"]').value;
    var portfolio_id = galleryItem.querySelector('[data-name="portfolio_id"]').value;
    form.append('id', id);
    form.append('text', text);
    form.append('sort', sort);
    form.append('portfolio_id', portfolio_id);
    fetch('/admin/ajax/updateGalleryItem', {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': csrfToken
      },
      body: form
    }).then(function (response) {
      response.text().then(function (responseText) {
        console.log('result:', responseText);
        // console.log('result:', JSON.parse(responseText));
      });
    });
  }
}

/***/ }),

/***/ "./resources/js/admin/components/galleryImgs.js":
/*!******************************************************!*\
  !*** ./resources/js/admin/components/galleryImgs.js ***!
  \******************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   addImagesToGallery: () => (/* binding */ addImagesToGallery)
/* harmony export */ });
function addImagesToGallery() {
  var button = document.querySelector('[data-action="addImagesToGallery"]');
  console.log(button);
  if (button) {
    var input = button.closest('.input-group').querySelector('.custom-file-input');
    var label = button.closest('.input-group').querySelector('.custom-file-label');
    if (input) {
      button.addEventListener('click', function () {
        if (input.files.length == 0) alert('Выберите файлы');
        if (input.files.length > 0) {
          var confirmation = confirm("Продолжить?");
          if (!confirmation) return;
          var form = new FormData();
          var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
          var page_id = button.dataset.id;
          var page_type = button.dataset.type;
          var image_files = input.files;
          if (page_id && page_type && image_files) {
            form.append('page_id', page_id);
            form.append('page_type', page_type);
            for (var i = 0; i < image_files.length; i++) {
              form.append("images[".concat(i, "]"), image_files[i]);
            }
            fetch('/admin/ajax/addImagesToGallery', {
              method: 'POST',
              headers: {
                'X-CSRF-TOKEN': csrfToken
              },
              body: form
            }).then(function (response) {
              response.text().then(function (responseText) {
                renderImages(JSON.parse(responseText));
                input.value = "";
                if (label) label.innerText = "Файлы не выбраны";
              });
            });
          }
        }
      });
    }
  }
}
function renderImages(paths) {
  var preview = document.querySelector('.gallery-items');
  if (preview) {
    paths.forEach(function (path) {
      var item = document.createElement('div');
      item.classList.add('gallery-item', 'col-md-6');
      item.innerHTML = "\n                    <div class=\"card\">\n                        <div class=\"card-body\">\n                            <div class=\"row\">\n                                <div class=\"col-md-4\">\n                                    <div class=\"form-group\">\n                                        <label>\u0418\u0437\u043E\u0431\u0440\u0430\u0436\u043D\u0438\u0435</label>\n                                        <div\n                                            class=\"portfolio-gallery-image mr-2 mt-1 mb-1 d-block position-relative\">\n                                            <img\n                                                src=\"".concat(path, "\" />\n                                        </div>\n                                    </div>\n                                </div>\n                                <div class=\"col-md-8\">\n                                    <div class=\"form-group\">\n                                        <label for=\"items[{{ $item['id'] }}][text]\">\n                                            \u0422\u0435\u043A\u0441\u0442\n                                        </label>\n                                        <textarea class=\"form-control\"\n                                            id=\"items[{{ $item['id'] }}][text]\"\n                                            name=\"items[{{ $item['id'] }}][text]\"\n                                            rows=\"3\" data-name=\"text\"\n                                            disabled>{{ $item['text'] }}\n                                        </textarea>\n                                    </div>\n                                </div>\n                            </div>\n                            <div class=\"row\">\n                                <div class=\"col-md-12\">\n                                    <div class=\"form-group\">\n                                        <label\n                                            for=\"items[{{ $item['id'] }}][portfolio_id]\">\u0421\u0441\u044B\u043B\u043A\u0430\n                                            \u043D\u0430 \u043F\u043E\u0440\u0442\u0444\u043E\u043B\u0438\u043E</label>\n                                        <select class=\"form-control\"\n                                            id=\"items[{{ $item['id'] }}][portfolio_id]\"\n                                            name=\"items[{{ $item['id'] }}][portfolio_id]\"\n                                            value=\"{{ $item['portfolio_id'] }}\"\n                                            data-name=\"portfolio_id\" \n                                            disabled>\n                                            <option value=\"0\">\u041D\u0435 \u0432\u044B\u0431\u0440\u0430\u043D\u043E</option>\n                                            @foreach ($portfolioGalleries as $portfolioGaller\u0443)\n                                                <option value=\"{{ $portfolioGaller\u0443['id'] }}\"\n                                                    {{ $portfolioGaller\u0443['id'] == $item['portfolio_id'] ? 'selected' : '' }}>\n                                                    {{ $portfolioGaller\u0443['name'] }}\n                                                </option>\n                                            @endforeach\n                                        </select>\n                                    </div>\n                                </div>\n                            </div>\n                            <div class=\"row\">\n                                <div class=\"col-md-5\">\n                                    <div class=\"form-group\">\n                                        <label for=\"items[{{ $item['id'] }}][sort]\">\u041A\u043B\u044E\u0447\n                                            \u0441\u043E\u0440\u0442\u0438\u0440\u043E\u0432\u043A\u0438</label>\n                                        <input type=\"text\" class=\"form-control\"\n                                            id=\"items[{{ $item['id'] }}][sort]\"\n                                            name=\"items[{{ $item['id'] }}][sort]\"\n                                            value=\"{{ $item['sort'] }}\" \n                                            data-name=\"sort\" \n                                            disabled/>\n                                    </div>\n                                </div>\n                                <div class=\"col-md-5 d-flex align-items-end\">\n                                    <div class=\"form-group w-100\">\n                                        <button type=\"button\"\n                                            class=\"btn btn-block btn-primary\"\n                                            data-action=\"saveGalleryItem\"\n                                            data-id=\"{{ $item['id'] }}\"\n                                            onclick=\"return check()\"\n                                            disabled>\n                                            \u0421\u043E\u0445\u0440\u0430\u043D\u0438\u0442\u044C\n                                        </button>\n                                    </div>\n                                </div>\n                                <div class=\"col-md-2 d-flex align-items-end\">\n                                    <div class=\"form-group w-100\">\n                                        <button type=\"button\"\n                                            class=\"btn btn-block btn-danger\"\n                                            data-action=\"removeGalleryItem\"\n                                            data-id=\"{{ $item['id'] }}\"\n                                            onclick=\"return check()\"\n                                            disabled>\n                                            <i class='fas fa-trash-alt'\n                                                style='color:#fff'></i>\n                                        </button>\n                                    </div>\n                                </div>\n                            </div>\n                        </div>\n                    </div>\n            ");
      preview.append(item);
    });
  }
}

// export function addNewQuestion() {
//     const block = document.querySelector('.questions');
//     const btn = document.querySelector('button[data-action="addNewQuestion"]');

//     if (block && btn) {
//         let faq_id = btn.dataset.faq;

//         btn.addEventListener('click', function () {
//             let id = Math.floor(Math.random() * 9999);

//             let question = document.createElement('div')
//             question.classList.add('question', 'col-md-6')

//             question.innerHTML = `
//                 <div class="gallery-item col-md-6">
//                     <div class="card">
//                         <div class="card-body">
//                             <div class="row">
//                                 <div class="col-md-4">
//                                     <div class="form-group">
//                                         <label>Изображние</label>
//                                         <div
//                                             class="portfolio-gallery-image mr-2 mt-1 mb-1 d-block position-relative">
//                                             <img
//                                                 src="{{ Image::path($item['image'], '1_4') }}" />
//                                         </div>
//                                     </div>
//                                 </div>
//                                 <div class="col-md-8">
//                                     <div class="form-group">
//                                         <label
//                                             for="items[{{ $item['id'] }}][text]">Текст</label>
//                                         <x-textarea class="form-control"
//                                             id="items[{{ $item['id'] }}][text]"
//                                             name="items[{{ $item['id'] }}][text]"
//                                             rows="3" data-name="text">
//                                             {{ $item['text'] }}
//                                         </x-textarea>
//                                     </div>
//                                 </div>
//                             </div>
//                             <div class="row">
//                                 <div class="col-md-12">
//                                     <div class="form-group">
//                                         <label
//                                             for="items[{{ $item['id'] }}][portfolio_id]">Ссылка
//                                             на портфолио</label>
//                                         <select class="form-control"
//                                             id="items[{{ $item['id'] }}][portfolio_id]"
//                                             name="items[{{ $item['id'] }}][portfolio_id]"
//                                             value="{{ $item['portfolio_id'] }}"
//                                             data-name="portfolio_id">
//                                             <option value="0">Не выбрано</option>
//                                             @foreach ($portfolioGalleries as $portfolioGallerу)
//                                                 <option value="{{ $portfolioGallerу['id'] }}"
//                                                     {{ $portfolioGallerу['id'] == $item['portfolio_id'] ? 'selected' : '' }}>
//                                                     {{ $portfolioGallerу['name'] }}
//                                                 </option>
//                                             @endforeach
//                                         </select>
//                                     </div>
//                                 </div>
//                             </div>
//                             <div class="row">
//                                 <div class="col-md-5">
//                                     <div class="form-group">
//                                         <label for="items[{{ $item['id'] }}][sort]">Ключ
//                                             сортировки</label>
//                                         <x-input type="text" class="form-control"
//                                             id="items[{{ $item['id'] }}][sort]"
//                                             name="items[{{ $item['id'] }}][sort]"
//                                             value="{{ $item['sort'] }}" data-name="sort" />
//                                     </div>
//                                 </div>
//                                 <div class="col-md-5 d-flex align-items-end">
//                                     <div class="form-group w-100">
//                                         <button type="button"
//                                             class="btn btn-block btn-primary"
//                                             data-action="saveGalleryItem"
//                                             data-id="{{ $item['id'] }}"
//                                             onclick="return check()">
//                                             Сохранить
//                                         </button>
//                                     </div>
//                                 </div>
//                                 <div class="col-md-2 d-flex align-items-end">
//                                     <div class="form-group w-100">
//                                         <button type="button"
//                                             class="btn btn-block btn-danger"
//                                             data-action="removeGalleryItem"
//                                             data-id="{{ $item['id'] }}"
//                                             onclick="return check()">
//                                             <i class='fas fa-trash-alt'
//                                                 style='color:#fff'></i>
//                                         </button>
//                                     </div>
//                                 </div>
//                             </div>
//                         </div>
//                     </div>
//                 </div>
//             `;

//             block.append(question)

//             initQuestion(question)
//         })
//     }
// };

/***/ }),

/***/ "./resources/js/admin/components/inputfile.js":
/*!****************************************************!*\
  !*** ./resources/js/admin/components/inputfile.js ***!
  \****************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   fileinput: () => (/* binding */ fileinput)
/* harmony export */ });
function fileinput() {
  bsCustomFileInput.init();
}

/***/ }),

/***/ "./resources/js/admin/components/portfolioImgs.js":
/*!********************************************************!*\
  !*** ./resources/js/admin/components/portfolioImgs.js ***!
  \********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   addImagesToPortfolio: () => (/* binding */ addImagesToPortfolio)
/* harmony export */ });
/* harmony import */ var _destroyImageBtns__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./destroyImageBtns */ "./resources/js/admin/components/destroyImageBtns.js");

function addImagesToPortfolio() {
  var button = document.querySelector('[data-action="addImagesToPortfolio"]');
  if (button) {
    var input = button.closest('.input-group').querySelector('.custom-file-input');
    var label = button.closest('.input-group').querySelector('.custom-file-label');
    if (input) {
      button.addEventListener('click', function () {
        if (input.files.length == 0) alert('Выберите файлы');
        if (input.files.length > 0) {
          var confirmation = confirm("Продолжить?");
          if (!confirmation) return;
          var form = new FormData();
          var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
          var page_id = button.dataset.id;
          var page_type = button.dataset.type;
          var image_files = input.files;
          if (page_id && page_type && image_files) {
            form.append('page_id', page_id);
            form.append('page_type', page_type);
            for (var i = 0; i < image_files.length; i++) {
              form.append("images[".concat(i, "]"), image_files[i]);
            }
            fetch('/admin/ajax/addImagesToPortfolio', {
              method: 'POST',
              headers: {
                'X-CSRF-TOKEN': csrfToken
              },
              body: form
            }).then(function (response) {
              response.text().then(function (responseText) {
                renderGalleryImages(JSON.parse(responseText));
                input.value = "";
                if (label) label.innerText = "Файлы не выбраны";
              });
            });
          }
        }
      });
    }
  }
}
function renderGalleryImages(paths) {
  var galleryPreview = document.getElementById('portfolio-gallery');
  if (galleryPreview) {
    paths.forEach(function (path) {
      var image = document.createElement('img');
      image.src = path;
      image.setAttribute('width', '152px');
      image.setAttribute('height', 'auto');
      image.setAttribute('data-function', 'destroy');
      var item = document.createElement('div');
      item.classList.add("portfolio-gallery-image", "mr-2", "mt-1", "mb-1", "d-block", "position-relative");
      item.append(image);
      galleryPreview.append(item);
      (0,_destroyImageBtns__WEBPACK_IMPORTED_MODULE_0__.addDestroyImageButton)(image);
    });
  }
}

/***/ }),

/***/ "./resources/js/admin/components/portfolioSort.js":
/*!********************************************************!*\
  !*** ./resources/js/admin/components/portfolioSort.js ***!
  \********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   initSortPortfolioGallery: () => (/* binding */ initSortPortfolioGallery)
/* harmony export */ });
/* harmony import */ var _destroyImageBtns__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./destroyImageBtns */ "./resources/js/admin/components/destroyImageBtns.js");

function initSortPortfolioGallery() {
  if (!document.getElementById('portfolio-gallery')) return;
  var gallery = document.getElementById('portfolio-gallery');
  var initialGallery = gallery.cloneNode(true);
  var buttons = document.getElementById('portfolio-gallery-buttons');
  var sortButton = buttons.querySelector('[data-action="sort"]');
  var saveButton = buttons.querySelector('[data-action="save"]');
  var cancelButton = buttons.querySelector('[data-action="cancel"]');
  sortButton.addEventListener('click', sortStartHandle);
  saveButton.addEventListener('click', saveHandle);
  cancelButton.addEventListener('click', function () {
    cancelHandle(initialGallery);
  });
  function reInitGallery() {
    gallery = document.getElementById('portfolio-gallery');
    initialGallery = gallery.cloneNode(true);
  }
  function sortStartHandle() {
    gallery.querySelectorAll('.portfolio-gallery-image').forEach(function (image) {
      image.draggable = true;
      image.querySelectorAll('img').forEach(function (img) {
        img.style.pointerEvents = 'none';
      });
      image.querySelectorAll('button').forEach(function (button) {
        button.style.display = 'none';
      });
      image.addEventListener('dragstart', dragStartHandle);
      image.addEventListener('dragover', dragOverHandle);
      image.addEventListener('dragend', dragEndHandle);
    });
    sortButton.setAttribute('disabled', '');
    saveButton.removeAttribute('disabled');
    cancelButton.removeAttribute('disabled');
  }
  function cancelHandle(old) {
    gallery.replaceWith(old);
    sortEndHandle();
    reInitGallery();
    gallery.querySelectorAll('.portfolio-gallery-image').forEach(function (item) {
      item.querySelectorAll('img').forEach(function (img) {
        (0,_destroyImageBtns__WEBPACK_IMPORTED_MODULE_0__.addDestroyImageButton)(img);
      });
    });
  }
  ;
  function sortEndHandle() {
    gallery.querySelectorAll('.portfolio-gallery-image').forEach(function (image) {
      image.removeAttribute('draggable');
      image.querySelectorAll('img').forEach(function (img) {
        // img.style.pointerEvents = 'auto';
        img.removeAttribute('style');
      });
      image.querySelectorAll('button').forEach(function (button) {
        button.removeAttribute('style');
      });
      image.removeEventListener('dragstart', dragStartHandle);
      image.removeEventListener('dragover', dragOverHandle);
      image.removeEventListener('dragend', dragEndHandle);
    });
    sortButton.removeAttribute('disabled');
    saveButton.setAttribute('disabled', '');
    cancelButton.setAttribute('disabled', '');
  }
  function dragStartHandle(event) {
    event.target.classList.add('selected');
  }
  ;
  function dragEndHandle(event) {
    event.target.classList.remove('selected');
  }
  ;
  function dragOverHandle(event) {
    event.preventDefault();
    var activeElement = gallery.querySelector('.selected');
    var currentElement = event.target;
    var isMoveable = activeElement !== currentElement && currentElement.classList.contains('portfolio-gallery-image');
    if (!isMoveable) return;
    var nextElement = currentElement === activeElement.nextElementSibling ? currentElement.nextElementSibling : currentElement;
    gallery.insertBefore(activeElement, nextElement);
  }
  ;
  function saveHandle() {
    var data = [];
    gallery.querySelectorAll('.portfolio-gallery-image').forEach(function (item, id) {
      var image_id = item.querySelector('img').src.split('/')[7];
      data.push({
        id: image_id,
        sort: id
      });
    });
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    fetch('/admin/ajax/saveGallerySort', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json;charset=utf-8',
        'X-CSRF-TOKEN': csrfToken
      },
      body: JSON.stringify(data)
    }).then(function (response) {
      response.text().then(function (responseText) {
        console.log('result:', responseText);
      });
    });
    sortEndHandle();
    reInitGallery();
  }
  ;
}
;

/***/ }),

/***/ "./resources/js/admin/components/questions.js":
/*!****************************************************!*\
  !*** ./resources/js/admin/components/questions.js ***!
  \****************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   addNewQuestion: () => (/* binding */ addNewQuestion),
/* harmony export */   initQuestions: () => (/* binding */ initQuestions)
/* harmony export */ });
function initQuestions() {
  var questions = document.querySelectorAll('.question');
  if (questions.length > 0) {
    questions.forEach(function (question) {
      initQuestion(question);
    });
  }
}
function initQuestion(question) {
  var saveButton = question.querySelector('[data-action="saveQuestion"]');
  saveButton.addEventListener('click', saveQuestionHandle);
  var removeButton = question.querySelector('[data-action="removeQuestion"]');
  removeButton.addEventListener('click', removeQuestionHandle);
  function saveQuestionHandle() {
    var confirmation = confirm("Сохранить вопрос?");
    if (!confirmation) return;
    var form = new FormData();
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var id = saveButton.dataset.id;
    var name = question.querySelector('[data-name="name"]').value;
    var answer = question.querySelector('[data-name="answer"]').value;
    var sort = question.querySelector('[data-name="sort"]').value;
    var faq = saveButton.dataset.faq;
    if (!sort) {
      sort = 1;
      question.querySelector('[data-name="sort"]').value = sort;
    }
    if (name && answer && sort) {
      form.append('id', id);
      form.append('name', name);
      form.append('answer', answer);
      form.append('sort', sort);
      form.append('faq_id', faq);
      fetch('/admin/ajax/saveQuestion', {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': csrfToken
        },
        body: form
      }).then(function (response) {
        response.text().then(function (responseText) {
          console.log('result:', JSON.parse(responseText));
          removeButton.dataset.id = JSON.parse(responseText).id;
        });
      });
    }
  }
  function removeQuestionHandle() {
    var confirmation = confirm("Удалить вопрос?");
    if (!confirmation) return;
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var id = removeButton.dataset.id;
    if (id) {
      fetch('/admin/ajax/removeQuestion', {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': csrfToken
        },
        body: id
      }).then(function (response) {
        response.text().then(function (responseText) {
          console.log('result:', responseText);
          var question = removeButton.closest('.question');
          if (question) question.remove();
        });
      });
    }
  }
}
function addNewQuestion() {
  var block = document.querySelector('.questions');
  var btn = document.querySelector('button[data-action="addNewQuestion"]');
  if (block && btn) {
    var faq_id = btn.dataset.faq;
    btn.addEventListener('click', function () {
      var id = Math.floor(Math.random() * 9999);
      var question = document.createElement('div');
      question.classList.add('question', 'col-md-6');
      question.innerHTML = "\n                <div class=\"card\">\n                    <div class=\"card-body\">\n                        <div class=\"form-group\">\n                            <label for=\"question_name[".concat(id, "]\">\u041D\u0430\u0437\u0432\u0430\u043D\u0438\u0435</label>\n                            <input type=\"text\" class=\"form-control\" id=\"question_name[").concat(id, "]\"\n                                name=\"questions[").concat(id, "][name]\" data-name=\"name\">\n                        </div>\n                        <div class=\"form-group\">\n                            <div class=\"form-group\">\n                                <label\n                                    for=\"questions[").concat(id, "][answer]\">\u041E\u0442\u0432\u0435\u0442</label>\n                                <input class=\"form-control\" type=\"hidden\"\n                                    data-name=\"answer\"\n                                    id=\"questions[").concat(id, "][answer]\"\n                                    name=\"questions[").concat(id, "][answer]\">\n                                <trix-editor\n                                    input=\"questions[").concat(id, "][answer]\"></trix-editor>\n                            </div>\n                        </div>\n                        <div class=\"row\">\n                            <div class=\"col-md-5\">\n                                <div class=\"form-group\">\n                                    <label for=\"questions[").concat(id, "][sort]\">\u041A\u043B\u044E\u0447 \u0441\u043E\u0440\u0442\u0438\u0440\u043E\u0432\u043A\u0438</label>\n                                    <input type=\"text\" class=\"form-control\"\n                                        id=\"questions[").concat(id, "][sort]\" name=\"questions[").concat(id, "][sort]\" data-name=\"sort\">\n                                </div>\n                            </div>\n                            <div class=\"col-md-5 d-flex align-items-end\">\n                                <div class=\"form-group w-100\">\n                                    <button type=\"button\" class=\"btn btn-block btn-primary\"\n                                        data-action=\"saveQuestion\"\n                                        data-id=\"0\"\n                                        data-faq=\"").concat(faq_id, "\">\n                                        \u0421\u043E\u0445\u0440\u0430\u043D\u0438\u0442\u044C\n                                    </button>\n                                </div>\n                            </div>\n                            <div class=\"col-md-2 d-flex align-items-end\">\n                                <div class=\"form-group w-100\">\n                                    <button type=\"button\" class=\"btn btn-block btn-danger\"\n                                        data-action=\"removeQuestion\"\n                                        data-id=\"{").concat(id, "}\">\n                                        \u0423\u0434\u0430\u043B\u0438\u0442\u044C\n                                    </button>\n                                </div>\n                            </div>\n                        </div>\n                    </div>\n                </div>\n            ");
      block.append(question);
      initQuestion(question);
    });
  }
}
;

/***/ }),

/***/ "./resources/scss/main.scss":
/*!**********************************!*\
  !*** ./resources/scss/main.scss ***!
  \**********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


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
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
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
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/js/admin": 0,
/******/ 			"css/main": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some((id) => (installedChunks[id] !== 0))) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunk"] = self["webpackChunk"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["css/main"], () => (__webpack_require__("./resources/js/admin/admin.js")))
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["css/main"], () => (__webpack_require__("./resources/scss/main.scss")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;
//# sourceMappingURL=admin.js.map