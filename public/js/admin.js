document.addEventListener('DOMContentLoaded', function () {
    search();
    // questions();
    gallery();
    // callbackForm();
    sendRequest()
})

function gallery() {
    const gallery = document.querySelector('#portfolio-gallery');
    const elements = gallery.querySelectorAll('.portfolio-gallery__item');




    for (const element of elements) {
        element.draggable = true;

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
    }
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

