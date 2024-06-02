export function inputFile() {
    document.querySelectorAll('input[type="file"]').forEach((input) => {
        const label = input.closest('label')
        const info = label.querySelector('.input-file__info');

        input.addEventListener('change', function () {
            if (input.files.length > 0) {
                info.innerText = `Прикреплено файлов: ${input.files.length}`;
            } else {
                info.innerText = "Прикрепить файл";
            };
        });

        input.addEventListener('change', function () {
            if (input.files.length > 3) {
                input.value = "";
                alert('Ошибка! Нельзя прикреплять больше 3 файлов');
                info.innerText = "Прикрепить файл";
            };
        });
    });
};
