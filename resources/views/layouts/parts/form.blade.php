<div class="upform">
    {{-- <div class="upform-header">
        Расчет стоимости перевозки
    </div>

    <div class="upform-info2">
        Благодарим Вас за интерес, проявленный к нашей компании. Пожалуйста, заполните форму заявки на перевозку груза.
        Наши специалисты в кратчайшие сроки произведут расчет стоимости услуги и предоставят Вам всю необходимую
        информацию.
    </div> --}}

    <form id="w0" action="/contact/" method="post">
        <input type="hidden" name="_csrf" value="Uy5MLWhjZTZlYQdJAQkGeidvCkIKOzNjN006AAYnE2UDAxRKGFAhZg==">
        <div class="upform-fieldarea">
            <labal class="upform-label upform-firm_label">Наименование организации<span class="upform-masthave">*</span>
            </labal>
            <div class="form-group field-contactform-firm required">

                <input type="text" id="contactform-firm" class="upform-input upform-firm" name="ContactForm[firm]">

                <div class="help-block"></div>
            </div>
            <labal class="upform-label upform-gruz_label">Наименование груза<span class="upform-masthave">*</span>
            </labal>
            <div class="form-group field-contactform-gruz required">

                <input type="text" id="contactform-gruz" class="upform-input upform-gruz" name="ContactForm[gruz]">

                <div class="help-block"></div>
            </div>
            <labal class="upform-label upform-name_label">Контактное лицо<span class="upform-masthave">*</span></labal>
            <div class="form-group field-contactform-name required">

                <input type="text" id="contactform-name" class="upform-input upform-name" name="ContactForm[name]">

                <div class="help-block"></div>
            </div>
            <labal class="upform-label upform-size_label">Габаритные размеры груза</labal>
            <div class="form-group field-contactform-size">

                <input type="text" id="contactform-size" class="upform-input upform-size" name="ContactForm[size]">

                <div class="help-block"></div>
            </div>
            <labal class="upform-label upform-massa_label">Масса груза</labal>
            <div class="form-group field-contactform-massa">

                <input type="text" id="contactform-massa" class="upform-input upform-massa"
                    name="ContactForm[massa]">

                <div class="help-block"></div>
            </div>
            <labal class="upform-label upform-phone_label">Телефон<span class="upform-masthave">*</span></labal>
            <div class="form-group field-contactform-phone required">

                <input type="text" id="contactform-phone" class="upform-input upform-phone"
                    name="ContactForm[phone]">

                <div class="help-block"></div>
            </div>
            <labal class="upform-label upform-pack_label">Вид упаковки</labal>
            <div class="form-group field-contactform-pack">

                <input type="text" id="contactform-pack" class="upform-input upform-pack" name="ContactForm[pack]">

                <div class="help-block"></div>
            </div>
            <labal class="upform-label upform-place_label">Количество мест</labal>
            <div class="form-group field-contactform-place">

                <input type="text" id="contactform-place" class="upform-input upform-place"
                    name="ContactForm[place]">

                <div class="help-block"></div>
            </div>
            <labal class="upform-label upform-email_label">E-mail<span class="upform-masthave">*</span></labal>
            <div class="form-group field-contactform-email required">

                <input type="text" id="contactform-email" class="upform-input upform-email"
                    name="ContactForm[email]">

                <div class="help-block"></div>
            </div>
            <labal class="upform-label upform-from_label">Пункт отправления<span class="upform-masthave">*</span>
            </labal>
            <div class="form-group field-contactform-from required">

                <input type="text" id="contactform-from" class="upform-input upform-from" name="ContactForm[from]">

                <div class="help-block"></div>
            </div>
            <labal class="upform-label upform-to_label">Пункт назначения<span class="upform-masthave">*</span></labal>
            <div class="form-group field-contactform-to required">

                <input type="text" id="contactform-to" class="upform-input upform-to" name="ContactForm[to]">

                <div class="help-block"></div>
            </div>
            <labal class="upform-label upform-dopinfo_label">Дополнительная информация</labal>
            <div class="form-group field-contactform-dopinfo">

                <textarea id="contactform-dopinfo" class="upform-input upform-dopinfo" name="ContactForm[dopinfo]"></textarea>

                <div class="help-block"></div>
            </div>


            <button type="submit" class="upform-submit">Отправить заявку</button>
        </div>

        <span class="upform-masthave">*</span> — Поля обязательные для заполнения.
    </form>
</div>