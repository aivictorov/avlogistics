export function addImagesToPortfolio() {
    const button = document.querySelector('[data-action="addImagesToPortfolio"]');

    if (button) {
        const input = button.closest('.input-group').querySelector('.custom-file-input');
        const label = button.closest('.input-group').querySelector('.custom-file-label');

        if (input) {
            button.addEventListener('click', () => {
                if (input.files.length == 0) alert('Выберите файлы')

                if (input.files.length > 0) {

                    const confirmation = confirm("Продолжить?");
                    if (!confirmation) return;

                    const form = new FormData();
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    const page_id = button.dataset.id;
                    const page_type = button.dataset.type;
                    const image_files = input.files;

                    if (page_id && page_type && image_files) {
                        form.append('page_id', page_id);
                        form.append('page_type', page_type);
                        for (var i = 0; i < image_files.length; i++) {
                            form.append(`images[${i}]`, image_files[i]);
                        }

                        fetch('/admin/ajax/addImagesToPortfolio', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken
                            },
                            body: form,
                        }).then(response => {
                            response.text().then(responseText => {
                                renderGalleryImages(JSON.parse(responseText));

                                input.value = "";
                                if (label) label.innerText = "Файлы не выбраны";
                            })
                        });
                    }
                }
            });
        }
    }
}

function renderGalleryImages(paths) {
    const galleryPreview = document.getElementById('portfolio-gallery');

    if (galleryPreview) {

        paths.forEach((path) => {
            const image = document.createElement('img');
            image.src = path;
            image.setAttribute('width', '152px')
            image.setAttribute('height', 'auto')
            image.setAttribute('data-function', 'destroy')

            const item = document.createElement('div');
            item.classList.add("portfolio-gallery-image", "mr-2", "mt-1", "mb-1", "d-block", "position-relative");
            item.append(image);

            galleryPreview.append(item);
            addDestroyImageButton(image);
        });
    }
}