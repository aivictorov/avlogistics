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
    let id = 0;

    btn.addEventListener('click', function () {

        block.insertAdjacentHTML('beforeend', `
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="question_name">Название</label>
                        <input type="text" class="form-control" id="question_name"
                            name="questions[${id}][name]">
                    </div>
                    <div class="form-group">
                        <label for="question_answer">Ответ</label>
                        <x-textarea id="question_answer" class="form-control" rows="3"
                            name="questions[${id}][answer]" />
                    </div>
                </div>
            </div>
        `);

        id++;
    })

};

