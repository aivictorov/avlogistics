export function initQuestions() {
    const questions = document.querySelectorAll('.question');

    if (questions.length > 0) {
        questions.forEach((question) => {
            initQuestion(question);
        })
    }
}

function initQuestion(question) {
    const saveButton = question.querySelector('[data-action="saveQuestion"]')
    saveButton.addEventListener('click', saveQuestionHandle)

    const removeButton = question.querySelector('[data-action="removeQuestion"]')
    removeButton.addEventListener('click', removeQuestionHandle)

    function saveQuestionHandle() {
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
                    console.log('result:', JSON.parse(responseText));
                    removeButton.dataset.id = JSON.parse(responseText).id;
                })
            });
        }
    }

    function removeQuestionHandle() {
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
                    console.log('result:', responseText);

                    const question = removeButton.closest('.question');
                    if (question) question.remove();
                })
            });
        }
    }
}

export function addNewQuestion() {
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
                            <div class="form-group">
                                <label
                                    for="questions[${id}][answer]">Ответ</label>
                                <input class="form-control" type="hidden"
                                    data-name="answer"
                                    id="questions[${id}][answer]"
                                    name="questions[${id}][answer]">
                                <trix-editor
                                    input="questions[${id}][answer]"></trix-editor>
                            </div>
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