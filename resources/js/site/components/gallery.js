export function gallery() {
    const content = document.querySelector('.article__content');

    const contentGalleries = document.querySelectorAll('.article__content .content-gallery');

    contentGalleries.forEach((gallery) => {
        const id = gallery.dataset.id;

        const paragraphs = content.querySelectorAll('p');

        paragraphs.forEach((paragraph) => {
            const regStr = '\\[gallery\\-' + id + '\\]';
            var regExp = new RegExp(regStr, 'i');

            if (paragraph.innerText.match(regExp)) {
                paragraph.replaceWith(gallery);
            }
        })
    });
}