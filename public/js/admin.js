document.addEventListener('DOMContentLoaded', function () {
    search();
    questions();
    gallery();
    // callbackForm();
    sendRequest()
    ajaxImgLoad()
    dragQuestions()
})

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

function gallery() {
    console.log('gallery start')

    document.querySelectorAll('.portfolio-gallery').forEach((gallery) => {
        const elements = gallery.querySelectorAll('.portfolio-gallery__item');

        for (const element of elements) {
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

                const activeElement = gallery.querySelector('.selected');
                const currentElement = event.target;

                const isMoveable = activeElement !== currentElement &&
                    currentElement.classList.contains('portfolio-gallery__item');

                if (!isMoveable) return;

                const nextElement = (currentElement === activeElement.nextElementSibling) ?
                    currentElement.nextElementSibling :
                    currentElement;

                gallery.insertBefore(activeElement, nextElement);
            });
        };

        const btn = gallery.querySelector('.sort-save-button');

        if (btn) {
            btn.addEventListener('click', () => {

                let data = [];

                gallery.querySelectorAll('.portfolio-gallery__item').forEach((item, id) => {
                    data.push({
                        id: item.dataset.id,
                        sort: id
                    });
                })

                console.log(data)

                // elements.forEach((element, id) => {
                //     console.log(element, id, element.offsetLeft, element.offsetTop)
                // })

                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                fetch('/admin/ajax-1', {
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

            })
        }
    });

    // })
}


function sendRequest() {

    const buttons = document.querySelectorAll('[data-action="image"]')

    buttons.forEach((button) => {
        button.addEventListener('click', (event) => {
            event.preventDefault;
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            const result = confirm("Удалить изображение?");

            if (result) {
                fetch('/admin/ajax', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json;charset=utf-8',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ id: button.dataset.id }),
                }).then(response => {
                    response.text().then(responseText => {
                        console.log('Ajax:', responseText);
                    });
                    button.closest('.portfolio-gallery__item').remove();
                });
            };
        });
    });

    // function postData(event){event.preventDefault();
    //     var formData = new FormData();
    //     formData.append('title', i('tittle').value);
    //     formData.append('body', i('body').value);
    //     fetch(url, {
    //         method: 'POST',
    //         body: formData,
    //     }).then(response => response.json())
    //     .then((data) =>  console.log(data))
    // }
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

    deleteQuestion();

    block.querySelectorAll('.col-md-6')

    let id = Math.random() * 999999;

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

    const elements = questions.querySelectorAll('.col-md-6');

    for (const element of elements) {
        element.draggable = true;

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
};

