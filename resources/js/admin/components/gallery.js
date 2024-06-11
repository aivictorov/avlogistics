export function initGalleryItems() {
    const galleryItems = document.querySelectorAll('.gallery-item');

    if (galleryItems.length > 0) {
        galleryItems.forEach((item) => {
            initGalleryItem(item);
        })
    }
}

function initGalleryItem(item) {
    // const saveButton = question.querySelector('[data-action="saveQuestion"]')
    // saveButton.addEventListener('click', saveQuestionHandle)

    const removeButton = item.querySelector('[data-action="removeGalleryItem"]')
    removeButton.addEventListener('click', removeQuestionHandle)

    function removeQuestionHandle() {
        const confirmation = confirm("Удалить изображение?");
        if (!confirmation) return;

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        const id = removeButton.dataset.id;

        if (id) {
            fetch('/admin/ajax/removeGalleryItem', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                body: id,
            }).then(response => {
                response.text().then(responseText => {
                    console.log('result:', responseText);

                    const item = removeButton.closest('.gallery-item');
                    if (item) item.remove();
                })
            });
        }
    }

    // function saveQuestionHandle() {
    //     const confirmation = confirm("Сохранить вопрос?");
    //     if (!confirmation) return;

    //     const form = new FormData();
    //     const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    //     const id = saveButton.dataset.id;
    //     const name = question.querySelector('[data-name="name"]').value
    //     const answer = question.querySelector('[data-name="answer"]').value
    //     let sort = question.querySelector('[data-name="sort"]').value
    //     const faq = saveButton.dataset.faq;

    //     if (!sort) {
    //         sort = 1;
    //         question.querySelector('[data-name="sort"]').value = sort;
    //     }

    //     if (name && answer && sort) {
    //         form.append('id', id);
    //         form.append('name', name);
    //         form.append('answer', answer);
    //         form.append('sort', sort);
    //         form.append('faq_id', faq);

    //         fetch('/admin/ajax/saveQuestion', {
    //             method: 'POST',
    //             headers: {
    //                 'X-CSRF-TOKEN': csrfToken
    //             },
    //             body: form,
    //         }).then(response => {
    //             response.text().then(responseText => {
    //                 console.log('result:', JSON.parse(responseText));
    //                 removeButton.dataset.id = JSON.parse(responseText).id;
    //             })
    //         });
    //     }
    // }
}