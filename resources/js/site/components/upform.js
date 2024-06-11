export function upform() {
    $('.js-form-open').click(function () {

        $("html, body").animate({ scrollTop: 200 }, "slow");
        $('.js-blackback').fadeIn(300);

        var upflash = $('.js-apply-form');
        upflash.appendTo('.js-upflash');
        upflash.show();

        $('.js-upflash').fadeIn(300);
        return false;
    });

    $('.js-upform-close, .js-blackback').click(function () {
        $('.js-blackback').fadeOut(300);

        var upform = $('.js-upflash');
        var upflash = upform.find('.js-apply-form');

        upform.fadeOut(300, function () {

            upform.removeClass('upflash-bigimage')
            upflash.hide();
            upflash.prependTo('body');
        });
        return false;
    });
}