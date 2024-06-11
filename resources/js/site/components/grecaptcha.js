function captcha() {
    if (document.querySelector('#captcha_id')) {
        var key = '6LfKbeYpAAAAAIPL2XNZxy3YS52yrXRboLB4Sp-r';

        var script = document.createElement('script');
        script.src = 'https://www.google.com/recaptcha/api.js';
        script.async = true;
        script.onload = function () {
            grecaptcha.ready(function () {
                grecaptcha.render('captcha_id', { 'sitekey': key, 'callback': verifyCallback, });
            })
        };

        document.body.appendChild(script);

        function verifyCallback() {
            const captcha = form.querySelector('#captcha_id');
            const notify = captcha.closest('.captcha').querySelector('.input__notify');
            notify.innerText = "";
        };
    }
};

export { captcha };