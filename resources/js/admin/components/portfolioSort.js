import { addDestroyImageButton } from './destroyImageBtns'

export function initSortPortfolioGallery() {
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
        gallery = document.getElementById('portfolio-gallery');
        initialGallery = gallery.cloneNode(true);
    }

    function sortStartHandle() {
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
                addDestroyImageButton(img);
            });
        });
    };

    function sortEndHandle() {
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
        event.target.classList.add('selected');
    };

    function dragEndHandle(event) {
        event.target.classList.remove('selected');
    };

    function dragOverHandle(event) {
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
                console.log('result:', responseText);
            });
        });

        sortEndHandle();

        reInitGallery();
    };
};