<form class="form" action="{{ route('contactForm.send') }}" method="post" enctype="multipart/form-data">
    @csrf
    <x-errors />
    <x-user-notice />

    <div class="form-row">
        <div class="form-column form-column--33">
            <label class="form-control form-label">
                <span>Наименование организации</span>
                <x-input class="form-input" type="text" name="company" />
            </label>
            <label class="form-control form-label">
                <span>Контактное лицо (*)</span>
                <x-input class="form-input" type="text" name="name" />
            </label>
            <label class="form-control form-label">
                <span>Телефон</span>
                <x-input class="form-input" type="text" name="phone" />
            </label>
            <label class="form-control form-label">
                <span>E-mail (*)</span>
                <x-input class="form-input" type="text" name="email" />
            </label>
        </div>

        <div class="form-column form-column--67">
            <div class="form-row">
                <label class="form-control form-label">
                    <span>Пункт отправления</span>
                    <x-input class="form-input" type="text" name="from" />
                </label>
            </div>
            <div class="form-row">
                <label class="form-control form-label">
                    <span>Пункт назначения</span>
                    <x-input class="form-input" type="text" name="to" />
                </label>
            </div>
            <div class="form-row">
                <label class="form-control form-label">
                    <span>Информация о грузе (*)</span>
                    <x-textarea class="form-textarea" name="message"
                        placeholder="Укажите наименование, массу груза, количество мест, тип упаковки и другую необходимую информацию."></x-textarea>
                </label>
            </div>
        </div>
    </div>
    <div class="form__row">
        (*) - поле обязательно для заполнения
    </div>
    <div class="form__row">
        <div class="form__item">
            <div class="input-file">
                <label class="input-file__label">
                    <input class="input-file__hidden visually-hidden" name="files[]" type="file"
                        accept="application/pdf, image/jpeg, image/png" multiple>
                    <div class="input-file__icon">
                        <svg class="icon icon--plus">
                            <use xlink:href="/images/icons/sprite.svg#plus"></use>
                        </svg>
                    </div>
                    <div class="input-file__text">
                        <div class="input-file__info">Прикрепить файл</div>
                        <div class="input-file__notice">Вы можете прикрепить не более 3 файлов формата PDF, JPG, PNG,
                            DOC, DOCX, XLS, XLSX размером до 5 мб каждый.</div>
                    </div>
                </label>
                <span class="input-notify"></span>
            </div>
        </div>
    </div>
    <div class="form-row">
        <label class="form-control form-label">
            @section('text')
                Подтверждаю свое
                <a href="/personal_data.pdf" class="link" target="_blank" rel="nofollow">
                    согласие на обработку персональных данных
                </a>
            @endsection
            <x-checkbox type="checkbox" name="agreement" />
        </label>
    </div>
    <div class="form__row">
        <div class="captcha">
            <div id="captcha_id"></div>
            <span class="input__notify"></span>
        </div>
    </div>
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
