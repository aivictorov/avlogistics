/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/admin.js":
/*!*******************************!*\
  !*** ./resources/js/admin.js ***!
  \*******************************/
/***/ (() => {

document.addEventListener('DOMContentLoaded', function () {
  initUpdateAvatar();
  initDestroyImageButtons();
  initSortPortfolioGallery();
  addImagesToPortfolio();
  initQuestions();
  addNewQuestion();
  bsCustomFileInput.init();
  initTinymce();
});
function initTinymce() {
  tinymce.init({
    selector: ".editor",
    plugins: "file-manager table link lists code fullscreen",
    Flmngr: {
      apiKey: "FLMNFLMN",
      urlFileManager: '/flmngr',
      urlFiles: 'http://avlogistics.test/storage/upload/files'
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
    addDestroyImageButton(image);
  }
}
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
        addDestroyImageButton(img);
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
      addDestroyImageButton(image);
    });
  }
}
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
      question.innerHTML = "\n                <div class=\"card\">\n                    <div class=\"card-body\">\n                        <div class=\"form-group\">\n                            <label for=\"question_name[".concat(id, "]\">\u041D\u0430\u0437\u0432\u0430\u043D\u0438\u0435</label>\n                            <input type=\"text\" class=\"form-control\" id=\"question_name[").concat(id, "]\"\n                                name=\"questions[").concat(id, "][name]\" data-name=\"name\">\n                        </div>\n                        <div class=\"form-group\">\n                            <label for=\"question_answer[").concat(id, "]\">\u041E\u0442\u0432\u0435\u0442</label>\n                            <textarea id=\"question_answer[").concat(id, "]\" class=\"form-control\" rows=\"3\" name=\"questions[").concat(id, "][answer]\" data-name=\"answer\"></textarea>\n                        </div>\n                        <div class=\"row\">\n                            <div class=\"col-md-5\">\n                                <div class=\"form-group\">\n                                    <label for=\"questions[").concat(id, "][sort]\">\u041A\u043B\u044E\u0447 \u0441\u043E\u0440\u0442\u0438\u0440\u043E\u0432\u043A\u0438</label>\n                                    <input type=\"text\" class=\"form-control\"\n                                        id=\"questions[").concat(id, "][sort]\" name=\"questions[").concat(id, "][sort]\" data-name=\"sort\">\n                                </div>\n                            </div>\n                            <div class=\"col-md-5 d-flex align-items-end\">\n                                <div class=\"form-group w-100\">\n                                    <button type=\"button\" class=\"btn btn-block btn-primary\"\n                                        data-action=\"saveQuestion\"\n                                        data-id=\"0\"\n                                        data-faq=\"").concat(faq_id, "\">\n                                        \u0421\u043E\u0445\u0440\u0430\u043D\u0438\u0442\u044C\n                                    </button>\n                                </div>\n                            </div>\n                            <div class=\"col-md-2 d-flex align-items-end\">\n                                <div class=\"form-group w-100\">\n                                    <button type=\"button\" class=\"btn btn-block btn-danger\"\n                                        data-action=\"removeQuestion\"\n                                        data-id=\"{").concat(id, "}\">\n                                        \u0423\u0434\u0430\u043B\u0438\u0442\u044C\n                                    </button>\n                                </div>\n                            </div>\n                        </div>\n                    </div>\n                </div>\n            ");
      block.append(question);
      initQuestion(question);
    });
  }
}
;
(function () {
  var HOST = "http://avlogistics.test/";
  addEventListener("trix-attachment-add", function (event) {
    if (event.attachment.file) {
      uploadFileAttachment(event.attachment);
    }
  });
  function uploadFileAttachment(attachment) {
    uploadFile(attachment.file, setProgress, setAttributes);
    function setProgress(progress) {
      attachment.setUploadProgress(progress);
    }
    function setAttributes(attributes) {
      attachment.setAttributes(attributes);
    }
  }
  function uploadFile(file, progressCallback, successCallback) {
    var key = createStorageKey(file);
    var formData = createFormData(key, file);
    var xhr = new XMLHttpRequest();
    xhr.open("POST", HOST, true);
    xhr.upload.addEventListener("progress", function (event) {
      var progress = event.loaded / event.total * 100;
      progressCallback(progress);
    });
    xhr.addEventListener("load", function (event) {
      if (xhr.status == 204) {
        var attributes = {
          url: HOST + key,
          href: HOST + key + "?content-disposition=attachment"
        };
        successCallback(attributes);
      }
    });
    xhr.send(formData);
  }
  function createStorageKey(file) {
    var date = new Date();
    var day = date.toISOString().slice(0, 10);
    var name = date.getTime() + "-" + file.name;
    return ["tmp", day, name].join("/");
  }
  function createFormData(key, file) {
    var data = new FormData();
    data.append("key", key);
    data.append("Content-Type", file.type);
    data.append("file", file);
    return data;
  }
})();

/***/ }),

/***/ "./resources/scss/main.scss":
/*!**********************************!*\
  !*** ./resources/scss/main.scss ***!
  \**********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/scss/admin.scss":
/*!***********************************!*\
  !*** ./resources/scss/admin.scss ***!
  \***********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
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
/******/ 			"css/main": 0,
/******/ 			"css/admin": 0
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
/******/ 	__webpack_require__.O(undefined, ["css/main","css/admin"], () => (__webpack_require__("./resources/js/admin.js")))
/******/ 	__webpack_require__.O(undefined, ["css/main","css/admin"], () => (__webpack_require__("./resources/scss/main.scss")))
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["css/main","css/admin"], () => (__webpack_require__("./resources/scss/admin.scss")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;
//# sourceMappingURL=admin.js.map