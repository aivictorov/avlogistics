<form class="form" action="/contact" method="post">
    @csrf

    <div class="form-row">
        <div class="form-column form-column--33">
            {{-- <label class="form-control form-label">
                <span>Наименование организации (*)</span>
                <input class="form-input" type="text" id="contactform-firm" name="firm]">
            </label> --}}
            <label class="form-control form-label">
                Контактное лицо
                <input type="text" class="form-input form-name" name="name">
            </label>
            {{-- <label class="form-control form-label">
                Телефон
                <input type="text" id="contactform-phone" class="form-input form-phone" name="phone">
            </label> --}}
            <label class="form-control form-label">
                E-mail
                <div class="form-control field-contactform-email required">
                    <input type="text" class="form-input form-email" name="email">
                </div>
            </label>
        </div>

        <div class="form-column form-column--67">
            {{-- <label class="form-control form-label">
                Наименование груза
                <div class="form-control field-contactform-gruz required">
                    <input type="text" id="contactform-gruz" class="form-input form-gruz" name="gruz">
                </div>
            </label>
            <div class="form-row">
                <label class="form-control form-label">
                    Габаритные размеры груза
                    <div class="form-control field-contactform-size">
                        <input type="text" id="contactform-size" class="form-input form-size" name="size]">
                    </div>
                </label>
                <label class="form-control form-label">
                    Масса груза
                    <div class="form-control field-contactform-massa">
                        <input type="text" id="contactform-massa" class="form-input form-massa" name="massa]">
                    </div>
                </label>
            </div> --}}

            {{-- <div class="form-row">
                <label class="form-control form-label">
                    Вид упаковки
                    <div class="form-control field-contactform-pack">
                        <input type="text" id="contactform-pack" class="form-input form-pack" name="pack]">
                    </div>
                </label>
                <label class="form-control form-label">
                    Количество мест
                    <input type="text" id="contactform-place" class="form-input form-place" name="place]">
                </label>
            </div> --}}

            {{-- <div class="form-row">
                <label class="form-control form-label">
                    Пункт отправления
                    <div class="form-control field-contactform-from required">
                        <input type="text" id="contactform-from" class="form-input form-from" name="from]">
                    </div>
                </label>
                <label class="form-control form-label">
                    Пункт назначения
                    <div class="form-control field-contactform-to required">
                        <input type="text" id="contactform-to" class="form-input form-to" name="to]">
                    </div>
                </label>
            </div> --}}
        </div>
    </div>
    <div class="form-row">
        <label class="form-control form-label">
            Дополнительная информация
            <textarea class="form-textarea form-dopinfo" name="message"></textarea>
        </label>
    </div>
    {{-- <div class="form__row">
        <div class="form__item">
            <div class="input-file">
                <label class="input-file__label">
                    <input class="input-file__hidden visually-hidden" name="file[]" type="file"
                        accept="application/pdf, image/jpeg, image/png" multiple>
                    <div class="input-file__icon">
                        <svg class="icon icon--plus">
                            <use xlink:href="/images/icons/sprite.svg#plus"></use>
                        </svg>
                    </div>
                    <div class="input-file__text">
                        <div class="input-file__info">Прикрепить файл</div>
                        <div class="input-file__notice">Вы можете прикрепить не более 3 файлов формата PDF, JPG, PNG
                            размером до 5 мб каждый.</div>
                    </div>
                </label>
                <span class="input-notify"></span>
            </div>
        </div>
    </div> --}}
    {{-- <div class="form__row"> --}}
    {{-- <div class="captcha"> --}}
    {{-- <div id="captcha_id"></div> --}}
    {{-- <div class="g-recaptcha" data-sitekey="6LcXOZkpAAAAAKMYw8hzWcIoRbcvHp4BBlgZCUVs"></div> --}}
    {{-- <span class="input__notify"></span> --}}
    {{-- </div> --}}
    {{-- </div> --}}
    <div class="form-row">
        <button class="form-submit" type="submit">Отправить заявку</button>
    </div>
</form>

{{-- 
    <div class="form-header">
        Расчет стоимости перевозки
    </div>
    <div class="form-info2">
        Благодарим Вас за интерес, проявленный к нашей компании. Пожалуйста, заполните форму заявки на перевозку груза.
        Наши специалисты в кратчайшие сроки произведут расчет стоимости услуги и предоставят Вам всю необходимую
        информацию.
    </div> 
--}}
