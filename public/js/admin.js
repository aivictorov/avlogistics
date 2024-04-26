document.addEventListener('DOMContentLoaded', function () {
    initUpdateAvatar();
    initDestroyImageButtons();
    initSortPortfolioGallery();
    addImagesToPortfolio();
    search();
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
        height: "600px",
        toolbar: [
            "bold italic underline | alignleft aligncenter alignright alignjustify |  bullist numlist outdent indent | link blockquote table | code ",
        ],
        contextmenu: "undo redo | cut copy paste | inserttable",
        promotion: false,
        language: "ru",
    });
};

function initUpdateAvatar() {
    const button = document.querySelector('[data-action="updateAvatar"]');

    if (button) {
        const input = button.closest('.input-group').querySelector('.custom-file-input');
        const label = button.closest('.input-group').querySelector('.custom-file-label');

        if (input) {
            button.addEventListener('click', () => {
                if (input.files.length == 0) alert('Выберите файл')

                if (input.files.length > 0) {

                    const confirmation = confirm("Будет загружено новое изображение. Продолжить?");
                    if (!confirmation) return;

                    const form = new FormData();
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    const page_id = button.dataset.id;
                    const page_type = button.dataset.type;
                    const avatar_file = input.files[0];

                    if (page_id && page_type && avatar_file) {
                        form.append('page_id', page_id);
                        form.append('page_type', page_type);
                        form.append('avatar_file', avatar_file);

                        fetch('/admin/ajax/updateAvatar', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken
                            },
                            body: form,
                        }).then(response => {
                            response.text().then(responseText => {
                                renderAvatar(responseText);

                                input.value = "";
                                if (label) label.innerText = "Файл не выбран";
                            })
                        });
                    }
                }
            });
        }
    }
};

function renderAvatar(path) {
    const avatarPreview = document.querySelector('.avatar');

    if (avatarPreview) {
        avatarPreview.innerHTML = "";

        const image = document.createElement('img');
        image.src = path;
        avatarPreview.append(image);

        addDestroyImageButton(image);
    }
}

function initDestroyImageButtons() {
    const images = document.querySelectorAll('img[data-function="destroy"]');

    if (images) {
        images.forEach((image) => {
            addDestroyImageButton(image)
        });
    }
};

function addDestroyImageButton(image) {
    const id = image.src.split('/')[7];

    const button = document.createElement('button');
    button.type = 'button';
    button.classList.add('destroy-image-btn');
    button.dataset.id = id;
    button.innerHTML = `<i class="fas fa-trash"></i>`;

    if (image.nextElementSibling
        && image.nextElementSibling.tagName == 'BUTTON'
        && image.nextElementSibling.classList.contains('destroy-image-btn')
    ) {
        image.nextElementSibling.remove();
    }

    image.after(button);

    button.addEventListener('click', (event) => {
        event.preventDefault;
        destroyImageHandle(id, button);
    });

    function destroyImageHandle(id, button) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const result = confirm("Удалить изображение?");

        if (result) {
            fetch('/admin/ajax/destroyImage', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json;charset=utf-8',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ id: id }),
            }).then(response => {
                response.text().then(responseText => {
                    console.log('Ajax:', responseText);
                });

                if (button.parentElement.classList.contains('portfolio-gallery-image')) {
                    button.parentElement.remove();
                } else {
                    button.parentElement.querySelector('img').remove();
                }

                button.remove();
            });
        };
    };
};

function initSortPortfolioGallery() {
    if (!document.getElementById('portfolio-gallery')) return

    let gallery = document.getElementById('portfolio-gallery');
    let initialGallery = gallery.cloneNode(true);

    const buttons = document.getElementById('portfolio-gallery-buttons');
    const sortButton = buttons.querySelector('[data-action="sort"]');
    const saveButton = buttons.querySelector('[data-action="save"]');
    const cancelButton = buttons.querySelector('[data-action="cancel"]');

    sortButton.addEventListener('click', sortStartHandle);
    saveButton.addEventListener('click', saveHandle);
    cancelButton.addEventListener('click', () => { cancelHandle(initialGallery) });

    function reInitGallery() {
        console.log('reInitGallery');
        gallery = document.getElementById('portfolio-gallery');
        initialGallery = gallery.cloneNode(true);
    }

    function sortStartHandle() {
        console.log('--- sortStartHandle ---');

        gallery.querySelectorAll('.portfolio-gallery-image').forEach((image) => {
            image.draggable = true;

            image.querySelectorAll('img').forEach((img) => {
                img.style.pointerEvents = 'none';
            });

            image.querySelectorAll('button').forEach((button) => {
                button.style.display = 'none';
            });

            image.addEventListener('dragstart', dragStartHandle)
            image.addEventListener('dragover', dragOverHandle);
            image.addEventListener('dragend', dragEndHandle);
        });

        sortButton.setAttribute('disabled', '');
        saveButton.removeAttribute('disabled');
        cancelButton.removeAttribute('disabled',);
    }

    function cancelHandle(old) {
        gallery.replaceWith(old);

        sortEndHandle();
        reInitGallery();

        gallery.querySelectorAll('.portfolio-gallery-image').forEach((item) => {
            item.querySelectorAll('img').forEach((img) => {
                // console.log(img)
                addDestroyImageButton(img);
            });
        });
    };

    function sortEndHandle() {
        console.log('*** sortEndHandle ***');

        gallery.querySelectorAll('.portfolio-gallery-image').forEach((image) => {
            image.removeAttribute('draggable');

            image.querySelectorAll('img').forEach((img) => {
                // img.style.pointerEvents = 'auto';
                img.removeAttribute('style')
            });

            image.querySelectorAll('button').forEach((button) => {
                button.removeAttribute('style')
            });

            image.removeEventListener('dragstart', dragStartHandle)
            image.removeEventListener('dragover', dragOverHandle);
            image.removeEventListener('dragend', dragEndHandle);
        })

        sortButton.removeAttribute('disabled');
        saveButton.setAttribute('disabled', '');
        cancelButton.setAttribute('disabled', '');
    }

    function dragStartHandle(event) {
        // console.log('dragStart')
        event.target.classList.add('selected');
    };

    function dragEndHandle(event) {
        // console.log('dragEnd')
        event.target.classList.remove('selected');
    };

    function dragOverHandle(event) {
        // console.log('dragOver')
        event.preventDefault();

        const activeElement = gallery.querySelector('.selected');
        const currentElement = event.target;

        const isMoveable = activeElement !== currentElement &&
            currentElement.classList.contains('portfolio-gallery-image');

        if (!isMoveable) return;

        const nextElement = (currentElement === activeElement.nextElementSibling) ?
            currentElement.nextElementSibling :
            currentElement;

        gallery.insertBefore(activeElement, nextElement);
    };

    function saveHandle() {
        console.log('saveHandle');

        let data = [];

        gallery.querySelectorAll('.portfolio-gallery-image').forEach((item, id) => {
            const image_id = item.querySelector('img').src.split('/')[7];

            data.push({
                id: image_id,
                sort: id
            });
        })

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch('/admin/ajax/saveGallerySort', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json;charset=utf-8',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify(data),
        }).then(response => {
            response.text().then(responseText => {
                console.log('Ajax:', responseText);
            });
        });

        sortEndHandle();

        reInitGallery();
    };
};

function addImagesToPortfolio() {
    const button = document.querySelector('[data-action="addImagesToPortfolio"]');

    if (button) {
        const input = button.closest('.input-group').querySelector('.custom-file-input');
        const label = button.closest('.input-group').querySelector('.custom-file-label');

        if (input) {
            button.addEventListener('click', () => {
                console.log('addImagesToPortfolio -- click')

                if (input.files.length == 0) alert('Выберите файлы')

                if (input.files.length > 0) {

                    const confirmation = confirm("Продолжить?");
                    if (!confirmation) return;

                    const form = new FormData();
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    const page_id = button.dataset.id;
                    const page_type = button.dataset.type;
                    const image_files = input.files;

                    if (page_id && page_type && image_files) {
                        form.append('page_id', page_id);
                        form.append('page_type', page_type);
                        for (var i = 0; i < image_files.length; i++) {
                            form.append(`images[${i}]`, image_files[i]);
                        }

                        fetch('/admin/ajax/addImagesToPortfolio', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken
                            },
                            body: form,
                        }).then(response => {
                            response.text().then(responseText => {
                                renderGalleryImages(JSON.parse(responseText));

                                input.value = "";
                                if (label) label.innerText = "Файлы не выбраны";
                            })
                        });
                    }
                }
            });
        }
    }
}

function renderGalleryImages(paths) {
    const galleryPreview = document.getElementById('portfolio-gallery');
    console.log(galleryPreview);

    if (galleryPreview) {

        paths.forEach((path) => {
            const image = document.createElement('img');
            image.src = path;
            image.setAttribute('width', '152px')
            image.setAttribute('height', 'auto')
            image.setAttribute('data-function', 'destroy')

            const item = document.createElement('div');
            item.classList.add("portfolio-gallery-image", "mr-2", "mt-1", "mb-1", "d-block", "position-relative");
            item.append(image);

            galleryPreview.append(item);
            addDestroyImageButton(image);
        });
    }
}

function search() {
    const searchField = document.getElementById('search');

    if (searchField) table = searchField.closest('table');
    if (searchField && table) links = table.querySelectorAll('a');
    if (searchField && table && links) {
        searchField.addEventListener('input', function () {
            links.forEach(function (link) {
                if (link.innerText != '' && !link.innerText.toLowerCase().includes(searchField.value.toLowerCase())) {
                    link.closest('tr').classList.add('d-none');
                } else {
                    link.closest('tr').classList.remove('d-none');
                }
            });
        });
    }
};

function initQuestions() {
    const questions = document.querySelectorAll('.question');

    if (questions.length > 0) {
        questions.forEach((question) => {
            initQuestion(question);
        })
    }
}

function initQuestion(question) {
    console.log(question)

    const saveButton = question.querySelector('[data-action="saveQuestion"]')
    saveButton.addEventListener('click', saveQuestionHandle)

    const removeButton = question.querySelector('[data-action="removeQuestion"]')
    removeButton.addEventListener('click', removeQuestionHandle)

    function saveQuestionHandle() {
        console.log('saveQuestionHandle')

        const confirmation = confirm("Сохранить вопрос?");
        if (!confirmation) return;

        const form = new FormData();
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        const id = saveButton.dataset.id;
        const name = question.querySelector('[data-name="name"]').value
        const answer = question.querySelector('[data-name="answer"]').value
        let sort = question.querySelector('[data-name="sort"]').value
        const faq = saveButton.dataset.faq;

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
                body: form,
            }).then(response => {
                response.text().then(responseText => {
                    console.log('Ajax:', JSON.parse(responseText));

                    removeButton.dataset.id = JSON.parse(responseText).id;
                    console.log(removeButton);
                })
            });
        }
    }

    function removeQuestionHandle() {
        console.log('removeQuestionHandle')

        const confirmation = confirm("Удалить вопрос?");
        if (!confirmation) return;

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        const id = removeButton.dataset.id;

        if (id) {
            fetch('/admin/ajax/removeQuestion', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                body: id,
            }).then(response => {
                response.text().then(responseText => {
                    console.log('Ajax:', responseText);

                    const question = removeButton.closest('.question');
                    if (question) question.remove();
                })
            });
        }
    }
}

function addNewQuestion() {
    console.log('addNewQuestion init')
    const block = document.querySelector('.questions');
    const btn = document.querySelector('button[data-action="addNewQuestion"]');

    if (block && btn) {
        let faq_id = btn.dataset.faq;

        btn.addEventListener('click', function () {
            let id = Math.floor(Math.random() * 9999);

            let question = document.createElement('div')
            question.classList.add('question', 'col-md-6')

            question.innerHTML = `
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="question_name[${id}]">Название</label>
                            <input type="text" class="form-control" id="question_name[${id}]"
                                name="questions[${id}][name]" data-name="name">
                        </div>
                        <div class="form-group">
                            <label for="question_answer[${id}]">Ответ</label>
                            <textarea id="question_answer[${id}]" class="form-control" rows="3" name="questions[${id}][answer]" data-name="answer"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="questions[${id}][sort]">Ключ сортировки</label>
                                    <input type="text" class="form-control"
                                        id="questions[${id}][sort]" name="questions[${id}][sort]" data-name="sort">
                                </div>
                            </div>
                            <div class="col-md-5 d-flex align-items-end">
                                <div class="form-group w-100">
                                    <button type="button" class="btn btn-block btn-primary"
                                        data-action="saveQuestion"
                                        data-id="0"
                                        data-faq="${faq_id}">
                                        Сохранить
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <div class="form-group w-100">
                                    <button type="button" class="btn btn-block btn-danger"
                                        data-action="removeQuestion"
                                        data-id="{${id}}">
                                        Удалить
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            block.append(question)

            initQuestion(question)
        })
    }
};



(function () {
    var HOST = "http://avlogistics.test/"

    addEventListener("trix-attachment-add", function (event) {
        if (event.attachment.file) {
            uploadFileAttachment(event.attachment)
        }
    })

    function uploadFileAttachment(attachment) {
        uploadFile(attachment.file, setProgress, setAttributes)

        function setProgress(progress) {
            attachment.setUploadProgress(progress)
        }

        function setAttributes(attributes) {
            attachment.setAttributes(attributes)
        }
    }

    function uploadFile(file, progressCallback, successCallback) {
        var key = createStorageKey(file)
        var formData = createFormData(key, file)
        var xhr = new XMLHttpRequest()

        xhr.open("POST", HOST, true)

        xhr.upload.addEventListener("progress", function (event) {
            var progress = event.loaded / event.total * 100
            progressCallback(progress)
        })

        xhr.addEventListener("load", function (event) {
            if (xhr.status == 204) {
                var attributes = {
                    url: HOST + key,
                    href: HOST + key + "?content-disposition=attachment"
                }
                successCallback(attributes)
            }
        })

        xhr.send(formData)
    }

    function createStorageKey(file) {
        var date = new Date()
        var day = date.toISOString().slice(0, 10)
        var name = date.getTime() + "-" + file.name
        return ["tmp", day, name].join("/")
    }

    function createFormData(key, file) {
        var data = new FormData()
        data.append("key", key)
        data.append("Content-Type", file.type)
        data.append("file", file)
        return data
    }
})();