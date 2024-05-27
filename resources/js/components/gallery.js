export function gallery() {
    const content = document.querySelector('.article__content');
    console.log(content);

    const contentGallery = document.querySelector('.article__content .content__slider');
    console.log(contentGallery);

    if (content && contentGallery) {
        content.querySelector('p[data-gallery-id="2"]').replaceWith(contentGallery)
    }


    // const placeholder2 = content.innerHTML.match(/\<.+\>\[gallery\-\d+\]\<.+\>/i)
    // const num = parseInt(placeholder2[0].match(/\d+/));
    // console.log(placeholder2[0], num);

    // content.innerHTML = content.innerHTML.replace(placeholder2[0], `<p data-gallery-id="${num}"></p>`)

    // content.append(contentGallery)


    // const placeholder = content.querySelector('p[data-gallery-id]');
    // console.log(placeholder);


    // placeholder.replaceWith(contentGallery)

    // contentGallery.replaceWith("")

}