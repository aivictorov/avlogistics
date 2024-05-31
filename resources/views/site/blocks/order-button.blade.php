<a href="{{ route('contactForm.show') }}" class="order-button">
    {{-- <a href="/contact" class="order-button js-form-open"> --}}
    Рассчитать стоимость
</a>

<div class="js-blackback blackback">
    <div class="js-upflash upflash">
        <a href="#" class="js-upform-close upform-close"></a>
        <div class="apply-form js-apply-form">
            <div class="form">
                <div class="form-header">
                    Расчет стоимости перевозки
                </div>
                <div class="form-info">
                    Благодарим Вас за интерес, проявленный к нашей компании. Пожалуйста, заполните форму заявки на
                    перевозку груза. Наши специалисты в кратчайшие сроки произведут расчет стоимости услуги и
                    предоставят Вам всю необходимую информацию.
                </div>
                @include('site.forms.form')
            </div>
        </div>
    </div>
</div>
