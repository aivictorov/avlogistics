<form class="form" action="/contact/" method="post">
    <input type="hidden" name="_csrf" value="Uy5MLWhjZTZlYQdJAQkGeidvCkIKOzNjN006AAYnE2UDAxRKGFAhZg==">

    <div class="form-row">
        <div class="form-column form-column--33">
            <label class="form-control form-label">
                <span>Наименование организации (*)</span>
                <input class="form-input" type="text" id="contactform-firm" name="ContactForm[firm]">
            </label>
            <label class="form-control form-label">
                Контактное лицо
                <input type="text" id="contactform-name" class="form-input form-name" name="ContactForm[name]">
            </label>
            <label class="form-control form-label">
                Телефон
                <input type="text" id="contactform-phone" class="form-input form-phone" name="ContactForm[phone]">
            </label>
            <label class="form-control form-label">
                E-mail
                <div class="form-control field-contactform-email required">
                    <input type="text" id="contactform-email" class="form-input form-email"
                        name="ContactForm[email]">
                </div>
            </label>
        </div>

        <div class="form-column form-column--67">
            <label class="form-control form-label">
                Наименование груза
                <div class="form-control field-contactform-gruz required">
                    <input type="text" id="contactform-gruz" class="form-input form-gruz" name="ContactForm[gruz]">
                </div>
            </label>

            <div class="form-row">
                <label class="form-control form-label">
                    Габаритные размеры груза
                    <div class="form-control field-contactform-size">
                        <input type="text" id="contactform-size" class="form-input form-size"
                            name="ContactForm[size]">
                    </div>
                </label>
                <label class="form-control form-label">
                    Масса груза
                    <div class="form-control field-contactform-massa">
                        <input type="text" id="contactform-massa" class="form-input form-massa"
                            name="ContactForm[massa]">
                    </div>
                </label>
            </div>

            <div class="form-row">
                <label class="form-control form-label">
                    Вид упаковки
                    <div class="form-control field-contactform-pack">
                        <input type="text" id="contactform-pack" class="form-input form-pack"
                            name="ContactForm[pack]">
                    </div>
                </label>
                <label class="form-control form-label">
                    Количество мест
                    <input type="text" id="contactform-place" class="form-input form-place"
                        name="ContactForm[place]">
                </label>
            </div>

            <div class="form-row">
                <label class="form-control form-label">
                    Пункт отправления
                    <div class="form-control field-contactform-from required">
                        <input type="text" id="contactform-from" class="form-input form-from"
                            name="ContactForm[from]">
                    </div>
                </label>
                <label class="form-control form-label">
                    Пункт назначения
                    <div class="form-control field-contactform-to required">
                        <input type="text" id="contactform-to" class="form-input form-to" name="ContactForm[to]">
                    </div>
                </label>
            </div>
        </div>
    </div>

    <div class="form-row">
        <label class="form-control form-label">
            Дополнительная информация
            <textarea class="form-textarea form-dopinfo" id="contactform-dopinfo" name="ContactForm[dopinfo]"></textarea>
        </label>
    </div>

    <div class="form-row">
        <button class="form-submit" type="button">Отправить заявку</button>
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
