export function initGalleryItems() {
    const galleryItems = document.querySelectorAll('.gallery-item');

    if (galleryItems.length > 0) {
        galleryItems.forEach((item) => {
            initGalleryItem(item);
        })
    }
}

function initGalleryItem(galleryItem) {
    const saveButton = galleryItem.querySelector('[data-action="saveGalleryItem"]')
    saveButton.addEventListener('click', saveHandle)

    const removeButton = galleryItem.querySelector('[data-action="removeGalleryItem"]')
    removeButton.addEventListener('click', removeHandle)

    function removeHandle() {
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

    function saveHandle() {
        const form = new FormData();
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        const id = saveButton.dataset.id;
        const text = galleryItem.querySelector('[data-name="text"]').value
        const sort = galleryItem.querySelector('[data-name="sort"]').value
        const portfolio_id = galleryItem.querySelector('[data-name="portfolio_id"]').value

        form.append('id', id);
        form.append('text', text);
        form.append('sort', sort);
        form.append('portfolio_id', portfolio_id);

        fetch('/admin/ajax/updateGalleryItem', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            body: form,
        }).then(response => {
            response.text().then(responseText => {
                console.log('result:', responseText);
                // console.log('result:', JSON.parse(responseText));
            })
        });
    }
}