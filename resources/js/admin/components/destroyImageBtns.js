export function initDestroyImageButtons() {
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

    if (image.nextElementSibling
        && image.nextElementSibling.tagName == 'BUTTON'
        && image.nextElementSibling.classList.contains('destroy-image-btn')
    ) {
        image.nextElementSibling.remove();
    }

    image.after(button);

    button.addEventListener('click', (event) => {
        event.preventDefault;
        destroyImageHandle(id, button);
    });

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
                    console.log('result:', responseText);
                });

                if (button.parentElement.classList.contains('portfolio-gallery-image')) {
                    button.parentElement.remove();
                } else {
                    button.parentElement.querySelector('img').remove();
                }

                button.remove();
            });
        };
    };
};