import { addDestroyImageButton } from './destroyImageBtns'

export function initUpdateAvatar() {
    const button = document.querySelector('[data-action="updateAvatar"]');

    if (button) {
        const input = button.closest('.input-group').querySelector('.custom-file-input');
        const label = button.closest('.input-group').querySelector('.custom-file-label');

        if (input) {
            button.addEventListener('click', () => {
                if (input.files.length == 0) alert('Выберите файл')

                if (input.files.length > 0) {

                    const confirmation = confirm("Будет загружено новое изображение. Продолжить?");
                    if (!confirmation) return;

                    const form = new FormData();
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    const page_id = button.dataset.id;
                    const page_type = button.dataset.type;
                    const avatar_file = input.files[0];

                    if (page_id && page_type && avatar_file) {
                        form.append('page_id', page_id);
                        form.append('page_type', page_type);
                        form.append('avatar_file', avatar_file);

                        fetch('/admin/ajax/updateAvatar', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken
                            },
                            body: form,
                        }).then(response => {
                            response.text().then(responseText => {
                                renderAvatar(responseText);

                                input.value = "";
                                if (label) label.innerText = "Файл не выбран";
                            })
                        });
                    }
                }
            });
        }
    }
};

function renderAvatar(path) {
    const avatarPreview = document.querySelector('.avatar');

    if (avatarPreview) {
        avatarPreview.innerHTML = "";

        const image = document.createElement('img');
        image.src = path;
        avatarPreview.append(image);

        addDestroyImageButton(image);
    }
}
