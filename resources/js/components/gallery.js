export function gallery() {
    const content = document.querySelector('.article__content');

    if (content) {
        content.innerHTML.match(/\[gallery\-\d+\]/gi).forEach((el) => {
            content.innerHTML = content.innerHTML.replace(el, `<p data-gallery-id="${parseInt(el.match(/\d+/))}"></p>`)
        })

        const elements = content.querySelectorAll('[data-gallery-id]');

        if (elements) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            elements.forEach((element) => {
                const id = parseInt(element.dataset.galleryId);

                if (id) {
                    fetch('/loadGallery', {
                        method: 'POST',
                        headers: { 'X-CSRF-TOKEN': csrfToken },
                        body: id,
                    }).then(response => {
                        response.text().then(responseText => {
                            const arr = JSON.parse(responseText);

                            let contentGallery = document.createElement('div');
                            contentGallery.classList.add('content-gallery');

                            element.replaceWith(contentGallery);

                            let imagesHtml = "";
                            let slidesHtml = "";

                            arr.forEach(item => {
                                imagesHtml = imagesHtml + `
                                    <a href="${item.image.path}" class="content-gallery__item" modal-button="gallery" title="${item.text}">
                                        <img src="${item.image.path}" alt="${item.text}">
                                    </a>
                                `
                                slidesHtml = slidesHtml + `
                                    <div class="swiper-slide">
                                        <img src="https://rail-projects.ru${item.image.path.replace('1_4', 'big')}" />
                                    </div>
                                `
                            });

                            contentGallery.innerHTML = imagesHtml;

                            let modal = document.createElement('div');
                            modal.classList.add = 'modals';

                            modal.innerHTML = `
                                <div class="modals">
                                    <div class="modal" modal-window="gallery">
                                        <div class="modal__content modal__content--center">

                                            <div class="content__slider">
                                                <div class="swiper">
                                                    <div class="swiper-wrapper">
                                                        ${slidesHtml}
                                                    </div>
                                                    <div class="swiper-button-next"></div>
                                                    <div class="swiper-button-prev"></div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            `;

                            contentGallery.after(modal);
                        })
                    });
                }
            })
        }
    }
}