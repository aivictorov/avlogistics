{{-- <a href="{{ route('contactForm') }}" class="main-aside__send-form">
    Рассчитать стоимость
</a> --}}

<a href="#!" class="js-form-open main-aside__send-form">
    Рассчитать стоимость
</a>

<div class="modal">
    <div class="js-blackback blackback"></div>

    <div class="js-upflash upflash">
        <a href="#" class="js-upform-close upform-close"></a>
    </div>

    <div class="apply-form js-apply-form">
        <div class="upform">
            <div class="upform-header">
                Расчет стоимости перевозки
            </div>
            <div class="upform-info2">
                Благодарим Вас за интерес, проявленный к нашей компании. Пожалуйста, заполните форму заявки на перевозку
                груза. Наши специалисты в кратчайшие сроки произведут расчет стоимости услуги и предоставят Вам всю
                необходимую информацию.
            </div>

            @include('layouts.parts.form')

        </div>
    </div>
</div>
