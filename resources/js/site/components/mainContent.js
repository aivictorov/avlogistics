export function mainContent() {
    $('.js-index-content-opener').click(function () {
        var indexContent = $('.js-index-content');
        if (indexContent.data("opened") == true) {
            closecontent();
        }
        else if (indexContent.data("opened") == false) {
            opencontent();
        }
    });

    function opencontent() {
        $('.js-index-content').data('wasopened', true)
            .slideDown(2000, function () {
                $('.js-index-submap').addClass('index-submap--nobg');
                $('.js-index-content-opener').addClass('index-submap__arrow--up');
                $('.js-index-content').data('opened', true);
            });
    }

    function closecontent() {
        $('.js-index-content-opener').removeClass('index-submap__arrow--up');
        $('.js-index-content').data('opened', false)
            .slideUp(2000, function () {
                $('.js-index-submap').removeClass('index-submap--nobg');
            });
    }

    setTimeout(opencontent, 1000);
}