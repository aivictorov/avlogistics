export default function old() {
    console.log('old imported');



    $('.js-subnav-blocks__close').click(function () {
        $('.js-subnav-blocks__block').removeClass('opened').fadeOut(300);
        $('.js-subnav-opener').removeClass('opened');
        return false;
    });

    $('body').click(function () {
        $('.js-subnav-blocks__block.opened').removeClass('opened').fadeOut(300);
        $('.js-subnav-opener').removeClass('opened');
        return true;
    });

    $('.js-subnav-blocks__block').click(function () {
        event.stopPropagation();
        return true;
    });

    $('.js-sixbox__text').mouseenter(function () {
        $(this).parent().addClass('hovered');
    }).mouseleave(function () {
        $(this).parent().removeClass('hovered');
    });

    $('.subnav-column__porfolio-arrows').attr('unselectable', 'on');

    var subnav_porfolio_slider = $('.js-subnav-portfolio-slider');

    $('.js-subnav_porfolio-arrows_right').click(function () {

        if (parseInt(subnav_porfolio_slider.css('left')) > -(279 * (subnav_porfolio_slider.data('count') - 1))) {
            subnav_porfolio_slider.animate({ left: "-=279" }, { duration: 400, queue: false, complete: function () { $(this).stop() } });
        }
    });

    $('.js-subnav_porfolio-arrows_left').click(function () {

        if (parseInt(subnav_porfolio_slider.css('left')) < 0) {
            subnav_porfolio_slider.animate({ left: "+=279" }, { duration: 400, queue: false, complete: function () { $(this).stop() } });
        }
    });








    var ginmove = false;

    $('.js-content-miniimage').click(function () {

        var miniimages = $(this).parents('.content-miniimages');
        var upflash = $('.js-upflash');
        upflash.addClass('upflash-bigimage')
        $('.js-blackback').fadeIn(300);
        var offset = $(document).scrollTop();

        var bigimages = $('<div class="gallery-slider"></div>');
        var slider = $('<div class="gallery-inslider"></div>');
        var img_counetr = 0;
        var img;
        miniimages.find('.content-gallerey-miniimage').each(function () {
            var text = Base64.decode($(this).data('text'));
            var portfolioUrl = $(this).data('portfolio-link');

            var portfolioLink = '';
            if (portfolioUrl != '') {
                portfolioLink =
                    '<p>' +
                    '<a class="content-bigimage-annotate-link" href="/portfolio/' + $(this).data('portfolio-link') + '/">' +
                    'Подробнее в портфолио' +
                    '</a>' +
                    '</p>';
            }

            var annotate = '';
            if (text != '' || portfolioLink != '') {
                annotate =
                    '<div class="content-bigimage-annotate">' +
                    text +
                    portfolioLink +
                    '</div>';
            }

            var alt = text.replace(/<\/?[^>]+>/gi, '');
            img =
                '<div class="content-bigimage-holder">' +
                '<img src="' + $(this).data('bigimage') + '" class="content-bigimage" alt="' + alt + '">' +
                annotate +
                '</div>';

            slider.append(img);

            img_counetr = img_counetr + 1;
        });
        slider.prepend(img);
        gcur_counter = $(this).data('counter');

        slider.css('width', ((img_counetr + 1) * 940) + 'px');
        slider.css('left', (-940) * gcur_counter + 'px');
        bigimages.append('<span class="gallery-slider-arrow gallery-slider-arrow__left js-gallery-slider-arrow__left"></span>');
        bigimages.append('<span class="gallery-slider-arrow gallery-slider-arrow__right js-gallery-slider-arrow__right"></span>');

        bigimages.append(slider);
        upflash.append(bigimages);
        upflash.css({ top: offset + 20 });
        upflash.fadeIn(300);
    });

    $(document).on("click", '.js-gallery-slider-arrow__right,  .content-bigimage', function () {

        if (!ginmove) {
            var slider = $(this).parents('.gallery-slider');
            var inslider = slider.find('.gallery-inslider');
            var slider_count = inslider.find('.content-bigimage').length;

            if (gcur_counter == slider_count - 1) {
                gcur_counter = 1;
                inslider.css('left', '0');
            }
            else {
                gcur_counter = gcur_counter + 1;
            }

            ginmove = true;

            inslider.animate({ left: "-=940" }, {
                duration: 500, queue: false, complete: function () {
                    //$(this).stop();
                    ginmove = false;
                }
            });
        }
    });

    $(document).on("click", '.js-gallery-slider-arrow__left', function () {
        if (!ginmove) {
            var slider = $(this).parents('.gallery-slider');
            var inslider = slider.find('.gallery-inslider');
            var slider_count = inslider.find('.content-bigimage').length;


            if (gcur_counter == 0) {
                gcur_counter = slider_count - 2;
                inslider.css('left', '-' + ((slider_count - 1) * 940) + 'px');

            }
            else {
                gcur_counter = gcur_counter - 1;
            }

            ginmove = true;

            inslider.animate({ left: "+=940" }, {
                duration: 500, queue: false, complete: function () {
                    //$(this).stop();
                    ginmove = false;
                }
            });
        }
    });

    $(document).on("click", '.content-gallerey-href', function () {
        return false;
    });

    $(document).scroll(function () {
        var curPos = $(document).scrollTop();
        if (!$('.js-index-content').data('wasopened')) {

            setTimeout(function () {
                if ($(document).scrollTop() == ($(document).outerHeight() - $(window).outerHeight())) {
                    opencontent();
                }
            }, 2000);
        }

        if (curPos >= 62) {
            $('.js-top-header').addClass('show');
            $('.js-subnav-blocks').addClass('sl');
            $('.js-main-header').addClass('vh');
        }
        else {
            $('.js-top-header').removeClass('show');
            $('.js-subnav-blocks').removeClass('sl');
            $('.js-main-header').removeClass('vh');
        }
    });

    setTimeout(arrowbaranimate, 2000);
}





var Base64 = {
    _keyStr: "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",

    //метод для кодировки в base64 на javascript
    encode: function (input) {
        var output = "";
        var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
        var i = 0
        input = Base64._utf8_encode(input);
        while (i < input.length) {
            chr1 = input.charCodeAt(i++);
            chr2 = input.charCodeAt(i++);
            chr3 = input.charCodeAt(i++);
            enc1 = chr1 >> 2;
            enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
            enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
            enc4 = chr3 & 63;
            if (isNaN(chr2)) {
                enc3 = enc4 = 64;
            } else if (isNaN(chr3)) {
                enc4 = 64;
            }
            output = output +
                this._keyStr.charAt(enc1) + this._keyStr.charAt(enc2) +
                this._keyStr.charAt(enc3) + this._keyStr.charAt(enc4);
        }
        return output;
    },

    //метод для раскодировки из base64
    decode: function (input) {
        var output = "";
        var chr1, chr2, chr3;
        var enc1, enc2, enc3, enc4;
        var i = 0;
        input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");
        while (i < input.length) {
            enc1 = this._keyStr.indexOf(input.charAt(i++));
            enc2 = this._keyStr.indexOf(input.charAt(i++));
            enc3 = this._keyStr.indexOf(input.charAt(i++));
            enc4 = this._keyStr.indexOf(input.charAt(i++));
            chr1 = (enc1 << 2) | (enc2 >> 4);
            chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
            chr3 = ((enc3 & 3) << 6) | enc4;
            output = output + String.fromCharCode(chr1);
            if (enc3 != 64) {
                output = output + String.fromCharCode(chr2);
            }
            if (enc4 != 64) {
                output = output + String.fromCharCode(chr3);
            }
        }
        output = Base64._utf8_decode(output);
        return output;
    },

    // метод для кодировки в utf8
    _utf8_encode: function (string) {
        string = string.replace(/\r\n/g, "\n");
        var utftext = "";
        for (var n = 0; n < string.length; n++) {
            var c = string.charCodeAt(n);
            if (c < 128) {
                utftext += String.fromCharCode(c);
            } else if ((c > 127) && (c < 2048)) {
                utftext += String.fromCharCode((c >> 6) | 192);
                utftext += String.fromCharCode((c & 63) | 128);
            } else {
                utftext += String.fromCharCode((c >> 12) | 224);
                utftext += String.fromCharCode(((c >> 6) & 63) | 128);
                utftext += String.fromCharCode((c & 63) | 128);
            }
        }
        return utftext;

    },

    //метод для раскодировки из urf8
    _utf8_decode: function (utftext) {
        var string = "";
        var i = 0;
        var c = c1 = c2 = 0;
        while (i < utftext.length) {
            c = utftext.charCodeAt(i);
            if (c < 128) {
                string += String.fromCharCode(c);
                i++;
            } else if ((c > 191) && (c < 224)) {
                c2 = utftext.charCodeAt(i + 1);
                string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
                i += 2;
            } else {
                c2 = utftext.charCodeAt(i + 1);
                c3 = utftext.charCodeAt(i + 2);
                string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
                i += 3;
            }
        }
        return string;
    }
}