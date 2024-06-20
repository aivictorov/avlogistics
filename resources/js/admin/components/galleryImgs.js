export function addImagesToGallery() {
    const button = document.querySelector('[data-action="addImagesToGallery"]');
    console.log(button)

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

                        fetch('/admin/ajax/addImagesToGallery', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken
                            },
                            body: form,
                        }).then(response => {
                            response.text().then(responseText => {
                                renderImages(JSON.parse(responseText));

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

function renderImages(paths) {
    const preview = document.querySelector('.gallery-items');

    if (preview) {
        paths.forEach((path) => {
            const item = document.createElement('div');
            item.classList.add('gallery-item', 'col-md-6');

            item.innerHTML = `
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Изображние</label>
                                        <div
                                            class="portfolio-gallery-image mr-2 mt-1 mb-1 d-block position-relative">
                                            <img
                                                src="${path}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="items[{{ $item['id'] }}][text]">
                                            Текст
                                        </label>
                                        <textarea class="form-control"
                                            id="items[{{ $item['id'] }}][text]"
                                            name="items[{{ $item['id'] }}][text]"
                                            rows="3" data-name="text"
                                            disabled>{{ $item['text'] }}
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label
                                            for="items[{{ $item['id'] }}][portfolio_id]">Ссылка
                                            на портфолио</label>
                                        <select class="form-control"
                                            id="items[{{ $item['id'] }}][portfolio_id]"
                                            name="items[{{ $item['id'] }}][portfolio_id]"
                                            value="{{ $item['portfolio_id'] }}"
                                            data-name="portfolio_id" 
                                            disabled>
                                            <option value="0">Не выбрано</option>
                                            @foreach ($portfolioGalleries as $portfolioGallerу)
                                                <option value="{{ $portfolioGallerу['id'] }}"
                                                    {{ $portfolioGallerу['id'] == $item['portfolio_id'] ? 'selected' : '' }}>
                                                    {{ $portfolioGallerу['name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="items[{{ $item['id'] }}][sort]">Ключ
                                            сортировки</label>
                                        <input type="text" class="form-control"
                                            id="items[{{ $item['id'] }}][sort]"
                                            name="items[{{ $item['id'] }}][sort]"
                                            value="{{ $item['sort'] }}" 
                                            data-name="sort" 
                                            disabled/>
                                    </div>
                                </div>
                                <div class="col-md-5 d-flex align-items-end">
                                    <div class="form-group w-100">
                                        <button type="button"
                                            class="btn btn-block btn-primary"
                                            data-action="saveGalleryItem"
                                            data-id="{{ $item['id'] }}"
                                            onclick="return check()"
                                            disabled>
                                            Сохранить
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-end">
                                    <div class="form-group w-100">
                                        <button type="button"
                                            class="btn btn-block btn-danger"
                                            data-action="removeGalleryItem"
                                            data-id="{{ $item['id'] }}"
                                            onclick="return check()"
                                            disabled>
                                            <i class='fas fa-trash-alt'
                                                style='color:#fff'></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            `;

            preview.append(item);
        });
    }
}

// export function addNewQuestion() {
//     const block = document.querySelector('.questions');
//     const btn = document.querySelector('button[data-action="addNewQuestion"]');

//     if (block && btn) {
//         let faq_id = btn.dataset.faq;

//         btn.addEventListener('click', function () {
//             let id = Math.floor(Math.random() * 9999);

//             let question = document.createElement('div')
//             question.classList.add('question', 'col-md-6')

//             question.innerHTML = `
//                 <div class="gallery-item col-md-6">
//                     <div class="card">
//                         <div class="card-body">
//                             <div class="row">
//                                 <div class="col-md-4">
//                                     <div class="form-group">
//                                         <label>Изображние</label>
//                                         <div
//                                             class="portfolio-gallery-image mr-2 mt-1 mb-1 d-block position-relative">
//                                             <img
//                                                 src="{{ Image::path($item['image'], '1_4') }}" />
//                                         </div>
//                                     </div>
//                                 </div>
//                                 <div class="col-md-8">
//                                     <div class="form-group">
//                                         <label
//                                             for="items[{{ $item['id'] }}][text]">Текст</label>
//                                         <x-textarea class="form-control"
//                                             id="items[{{ $item['id'] }}][text]"
//                                             name="items[{{ $item['id'] }}][text]"
//                                             rows="3" data-name="text">
//                                             {{ $item['text'] }}
//                                         </x-textarea>
//                                     </div>
//                                 </div>
//                             </div>
//                             <div class="row">
//                                 <div class="col-md-12">
//                                     <div class="form-group">
//                                         <label
//                                             for="items[{{ $item['id'] }}][portfolio_id]">Ссылка
//                                             на портфолио</label>
//                                         <select class="form-control"
//                                             id="items[{{ $item['id'] }}][portfolio_id]"
//                                             name="items[{{ $item['id'] }}][portfolio_id]"
//                                             value="{{ $item['portfolio_id'] }}"
//                                             data-name="portfolio_id">
//                                             <option value="0">Не выбрано</option>
//                                             @foreach ($portfolioGalleries as $portfolioGallerу)
//                                                 <option value="{{ $portfolioGallerу['id'] }}"
//                                                     {{ $portfolioGallerу['id'] == $item['portfolio_id'] ? 'selected' : '' }}>
//                                                     {{ $portfolioGallerу['name'] }}
//                                                 </option>
//                                             @endforeach
//                                         </select>
//                                     </div>
//                                 </div>
//                             </div>
//                             <div class="row">
//                                 <div class="col-md-5">
//                                     <div class="form-group">
//                                         <label for="items[{{ $item['id'] }}][sort]">Ключ
//                                             сортировки</label>
//                                         <x-input type="text" class="form-control"
//                                             id="items[{{ $item['id'] }}][sort]"
//                                             name="items[{{ $item['id'] }}][sort]"
//                                             value="{{ $item['sort'] }}" data-name="sort" />
//                                     </div>
//                                 </div>
//                                 <div class="col-md-5 d-flex align-items-end">
//                                     <div class="form-group w-100">
//                                         <button type="button"
//                                             class="btn btn-block btn-primary"
//                                             data-action="saveGalleryItem"
//                                             data-id="{{ $item['id'] }}"
//                                             onclick="return check()">
//                                             Сохранить
//                                         </button>
//                                     </div>
//                                 </div>
//                                 <div class="col-md-2 d-flex align-items-end">
//                                     <div class="form-group w-100">
//                                         <button type="button"
//                                             class="btn btn-block btn-danger"
//                                             data-action="removeGalleryItem"
//                                             data-id="{{ $item['id'] }}"
//                                             onclick="return check()">
//                                             <i class='fas fa-trash-alt'
//                                                 style='color:#fff'></i>
//                                         </button>
//                                     </div>
//                                 </div>
//                             </div>
//                         </div>
//                     </div>
//                 </div>
//             `;

//             block.append(question)

//             initQuestion(question)
//         })
//     }
// };