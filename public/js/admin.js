document.addEventListener('DOMContentLoaded', function () {
    search();
    questions();
})

function search() {
    searchField = document.getElementById('search');

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
                                    <label for="sort">Ключ сортировки</label>
                                    <input type="text" class="form-control"
                                        id="questions[0][sort]" name="questions[0][sort]">
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

