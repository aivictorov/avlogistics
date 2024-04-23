document.addEventListener('DOMContentLoaded', function () {
    initUpdateAvatar();
    initDestroyImageButtons();
    initSortPortfolioGallery();

    search();
    questions();
    // sendRequest()
    ajaxImgLoad()
    dragQuestions()
})

$(document).ready(function () {
    bsCustomFileInput.init();
    trix();
})

function initUpdateAvatar() {
    const button = document.querySelector('[data-action="updateAvatar"]');

    if (button) {
        const input = button.closest('.input-group').querySelector('.custom-file-input');
        const label = button.closest('.input-group').querySelector('.custom-file-label');

        if (input) {
            button.addEventListener('click', () => {

                if (input.files.length == 0) alert('Выберите файл')

                if (input.files.length > 0) {
                    const result = confirm("Будет загружено новое изображение. Продолжить?");

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
                                const avatarPreview = document.querySelector('.avatar');

                                if (avatarPreview) {
                                    avatarPreview.innerHTML = "";

                                    const image = document.createElement('img');
                                    image.src = responseText;
                                    avatarPreview.append(image);

                                    addDestroyImageButton(image);
                                }

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

    image.after(button)

    button.addEventListener('click', (event) => {
        event.preventDefault;
        destroyImageHandle(id, button);
    });
};

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

            // button.parentElement.remove();
            button.parentElement.querySelector('img').remove();
            button.remove();
        });
    };
};




function initSortPortfolioGallery() {
    const gallery = document.getElementById('portfolio-gallery');
    const buttons = document.getElementById('portfolio-gallery-buttons');

    const sortButton = buttons.querySelector('[data-action="sort"]');
    const saveButton = buttons.querySelector('[data-action="save"]');
    const cancelButton = buttons.querySelector('[data-action="cancel"]');

    sortButton.addEventListener('click', () => { sortStartHandle(sortButton, saveButton, cancelButton) });
    saveButton.addEventListener('click', () => { saveHandle(sortButton, saveButton, cancelButton) });

    function sortStartHandle(sortButton, saveButton, cancelButton) {
        sortButton.setAttribute('disabled', '');
        saveButton.removeAttribute('disabled');
        cancelButton.removeAttribute('disabled',);

        const oldGallery = gallery.cloneNode(true);

        cancelButton.addEventListener('click', () => { cancelHandle(sortButton, saveButton, cancelButton, oldGallery) });

        gallery.querySelectorAll('.portfolio-gallery-image').forEach((image) => {
            image.draggable = true;

            image.addEventListener('dragstart', dragStartHandle)
            image.addEventListener('dragover', dragOverHandle);
            image.addEventListener('dragend', dragEndHandle);

            // image.querySelectorAll('img').forEach((img) => {
            //     img.style.pointerEvents = 'none';
            // })

            // image.querySelectorAll('button').forEach((btn) => {
            //     btn.style.pointerEvents = 'none';
            // })
        });
    }

    function sortEndHandle() {
        gallery.querySelectorAll('.portfolio-gallery-image').forEach((image) => {
            image.removeAttribute('draggable');
            image.removeEventListener('dragstart', dragStartHandle)
            image.removeEventListener('dragover', dragOverHandle);
            image.removeEventListener('dragend', dragEndHandle);
        })

        sortButton.removeAttribute('disabled');
        saveButton.setAttribute('disabled', '');
        cancelButton.setAttribute('disabled', '');
    }

    function cancelHandle() {
        sortEndHandle();
    }




    function dragStartHandle(event) {
        console.log('dragStart')
        event.target.classList.add('selected');
    };

    function dragEndHandle(event) {
        console.log('dragEnd')
        event.target.classList.remove('selected');
    };

    function dragOverHandle(event) {
        console.log('dragOver')
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
    }





    function saveHandle() {
        // let data = [];

        // gallery.querySelectorAll('.portfolio-gallery-image').forEach((item, id) => {
        //     const image_id = item.querySelector('img').src.split('/')[7];

        //     data.push({
        //         id: image_id,
        //         sort: id
        //     });
        // })

        // const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // fetch('/admin/ajax-1', {
        //     method: 'POST',
        //     headers: {
        //         'Content-Type': 'application/json;charset=utf-8',
        //         'X-CSRF-TOKEN': csrfToken
        //     },
        //     body: JSON.stringify(data),
        // }).then(response => {
        //     response.text().then(responseText => {
        //         console.log('Ajax:', responseText);
        //     });
        // });

        sortEndHandle();
    }
};


function trix() {
    var HOST = '/admin/ajax-3'




    addEventListener("trix-attachment-remove", function (event) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch('/admin/ajax-4', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json;charset=utf-8',
                'X-CSRF-TOKEN': csrfToken
            },
            body: event.attachment.file.name,
        }).then(response => {
            response.text().then(responseText => {
                console.log('Ajax:', responseText);
            });
        });


    })


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

        var sid = $("meta[name='csrf-token']").attr("content");
        xhr.setRequestHeader("X-CSRF-Token", sid);

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

        xhr.onreadystatechange = function () { // подписываемся на событие изменения состояния запроса
            if (xhr.readyState === 4) { // если запрос завершен
                console.log(xhr.responseText);
                // if (xhr.status === 200) { // если статус код ответа 200 OK
                //     console.log(xhr.responseText); // выводим ответ сервера
                // } else {
                //     console.error(xhr.statusText); // выводим текст ошибки
                // }
            }
        };

        // fetch('/admin/ajax-3', {
        //     method: 'POST',
        //     headers: {
        //         'X-CSRF-TOKEN': csrfToken
        //     },
        //     body: form,
        // }).then(response => {
        //     response.text().then(responseText => {
        //         images = JSON.parse(responseText);
        //     })
        // })

        return public_path();
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
        return data;
    }
}

function ajaxImgLoad() {

    const input = document.querySelector('[data-js="img-input"]');
    const btn = document.querySelector('[data-js="img-input-btn"]');
    const gallery_html = document.querySelector('.portfolio-gallery');

    if (btn) {
        btn.addEventListener('click', () => {
            var files = input.files;

            var form = new FormData();
            console.log(form);

            var page_id = btn.dataset.page;
            form.append('page_id', page_id);

            for (var i = 0; i < files.length; i++) {
                form.append(`images[${i}]`, files[i]);
            }

            // console.log(form.get('page_id'));
            // console.log(form.get('images[0]'));

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch('/admin/ajax-2', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                body: form,
            }).then(response => {
                response.text().then(responseText => {
                    images = JSON.parse(responseText);

                    console.log('Ajax:', images);


                    var rand = Math.floor(Math.random() * 9999);
                    console.log(rand);

                    images.forEach((image) => {
                        gallery_html.insertAdjacentHTML('afterbegin', `
                            <div class="portfolio-gallery__item new_${rand} mb-2 mr-2 position-relative" data-id="${image.id}">
                                <button class="delBtn" type="button" data-action="image" data-id="${image.id}">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <img src="http://avlogistics.test/storage/upload/portfolio_image/${image.parent_id}/${image.id}/sizes/small_${image.image}" width="152px" style="pointer-events: none"/>
                            </div>
                        `);
                    })

                    var testGallery = document.querySelector('.portfolio-gallery');

                    const newElements = document.querySelectorAll(`.portfolio-gallery__item.new_${rand}`);

                    for (const element of newElements) {
                        element.draggable = true;

                        // test
                        element.querySelectorAll('img').forEach((img) => {
                            img.draggable = false;

                            img.style.pointerEvents = 'none';

                            // img.ondragstart = function () {
                            //     return false;
                            // };
                        })


                        element.querySelectorAll('button').forEach((button) => {
                            button.draggable = false;
                            // button.style.pointerEvents = 'none';
                        })


                        element.addEventListener('dragstart', (event) => {
                            event.target.classList.add('selected');
                            console.log('drag start');
                        })

                        element.addEventListener('dragend', (event) => {
                            event.target.classList.remove('selected');
                            console.log('drag end');
                        });

                        element.addEventListener('dragover', (event) => {
                            event.preventDefault();

                            console.log('drag over');

                            const activeElement = document.querySelector('.selected');
                            const currentElement = event.target;

                            const isMoveable = activeElement !== currentElement &&
                                currentElement.classList.contains('portfolio-gallery__item');

                            if (!isMoveable) return;

                            const nextElement = (currentElement === activeElement.nextElementSibling) ?
                                currentElement.nextElementSibling :
                                currentElement;

                            console.log(testGallery);
                            testGallery.insertBefore(activeElement, nextElement);
                        });
                    };


                });
            });
        });
    }
}

function callbackForm() {
    const form = document.querySelector('#form')
    const answer = document.querySelector('#answer')

    form.addEventListener('submit', (event) => {
        event.preventDefault();

        const formData = new FormData(form);

        fetch('./../php/mail.php', {
            method: 'POST',
            body: formData
        }).then(response => {
            response.text().then(responseText => {
                form.classList.add('none')
                answer.innerText = responseText;
                const closeBtn = event.target.closest('[modal-window]').querySelector('[close-modal-button]');

                if (closeBtn) {
                    closeBtn.classList.remove('none');

                    closeBtn.addEventListener('click', function (event) {
                        form.classList.remove('none');
                        answer.innerText = "";
                        grecaptcha.reset();
                        closeBtn.classList.add('none');
                    });
                };
            });
        });
    });
};

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

function questions() {
    const block = document.getElementById('questions');
    const btn = document.getElementById('questions_btn');

    if (block && btn) {
        deleteQuestion();

        block.querySelectorAll('.col-md-6')

        let id = Math.floor(Math.random() * 9999);

        btn.addEventListener('click', function () {
            block.insertAdjacentHTML('beforeend', `
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="question_name[${id}]">Название</label>
                                <input type="text" class="form-control" id="question_name[${id}]"
                                    name="questions[${id}][name]">
                            </div>
                            <div class="form-group">
                                <label for="question_answer[${id}]">Ответ</label>
                                <textarea id="question_answer[${id}]" class="form-control" rows="3" name="questions[${id}][answer]"></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="questions[${id}][sort]">Ключ сортировки</label>
                                        <input type="text" class="form-control"
                                            id="questions[${id}][sort]" name="questions[${id}][sort]">
                                    </div>
                                </div>
                                <div class="col-md-4 d-flex align-items-end">
                                    <div class="form-group w-100">
                                        <button type="button" class="btn btn-block btn-outline-danger" data-action="remove_question_btn">
                                            Удалить
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `);

            id++;

            deleteQuestion();
        })
    }

    function deleteQuestion() {
        const delete_buttons = document.querySelectorAll('[data-action="remove_question_btn"]');

        delete_buttons.forEach(function (btn) {
            btn.addEventListener('click', () => {
                btn.closest('.col-md-6').remove();
            })
        })
    }
};

function dragQuestions() {
    const questions = document.querySelector('#questions');

    if (questions) {
        const elements = questions.querySelectorAll('.col-md-6');

        if (elements) {
            for (const element of elements) {
                element.draggable = true;

                // test
                element.querySelectorAll('input').forEach((input) => {
                    input.draggable = false;
                    input.style.pointerEvents = 'none';
                })

                element.querySelectorAll('label').forEach((label) => {
                    label.draggable = false;
                    label.style.pointerEvents = 'none';
                })

                element.querySelectorAll('textarea').forEach((textarea) => {
                    textarea.draggable = false;
                    textarea.style.pointerEvents = 'none';
                })

                element.querySelectorAll('button').forEach((button) => {
                    button.draggable = false;
                })

                element.addEventListener('dragstart', (event) => {
                    event.target.classList.add('selected');
                    console.log('drag start');
                })

                element.addEventListener('dragend', (event) => {
                    event.target.classList.remove('selected');
                    console.log('drag end');
                });

                element.addEventListener('dragover', (event) => {
                    event.preventDefault();

                    console.log('drag over');

                    const activeElement = questions.querySelector('.selected');
                    const currentElement = event.target;

                    const isMoveable = activeElement !== currentElement &&
                        currentElement.classList.contains('col-md-6');

                    if (!isMoveable) return;

                    const nextElement = (currentElement === activeElement.nextElementSibling) ?
                        currentElement.nextElementSibling :
                        currentElement;

                    questions.insertBefore(activeElement, nextElement);
                });
            };
        }
    }
};

