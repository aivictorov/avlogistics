export function initGalleryItems() {
    const galleryItems = document.querySelectorAll('.gallery-item');

    if (galleryItems.length > 0) {
        galleryItems.forEach((item) => {
            initGalleryItem(item);
        })
    }
}

function initGalleryItem(item) {
    // const saveButton = gallery.querySelector('[data-action="saveGallery"]')
    // saveButton.addEventListener('click', saveGalleryHandle)

    const removeButton = item.querySelector('[data-action="removeGalleryItem"]')
    removeButton.addEventListener('click', removeGalleryHandle)

    function removeGalleryHandle() {
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

    // function saveGalleryHandle() {
    //     const confirmation = confirm("Сохранить вопрос?");
    //     if (!confirmation) return;

    //     const form = new FormData();
    //     const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    //     const id = saveButton.dataset.id;
    //     const name = gallery.querySelector('[data-name="name"]').value
    //     const answer = gallery.querySelector('[data-name="answer"]').value
    //     let sort = gallery.querySelector('[data-name="sort"]').value
    //     const faq = saveButton.dataset.faq;

    //     if (!sort) {
    //         sort = 1;
    //         gallery.querySelector('[data-name="sort"]').value = sort;
    //     }

    //     if (name && answer && sort) {
    //         form.append('id', id);
    //         form.append('name', name);
    //         form.append('answer', answer);
    //         form.append('sort', sort);
    //         form.append('faq_id', faq);

    //         fetch('/admin/ajax/saveGallery', {
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