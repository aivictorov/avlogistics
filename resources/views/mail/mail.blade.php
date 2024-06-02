<!DOCTYPE html>
<html>

<head>
    <title>{{ $title }}</title>
</head>

<body>
    <b>Информация об отправителе</b>
    <div>
        <span>Наименование организации: </span>
        {{ $data['company'] }}
    </div>
    <div>
        <span>Контактное лицо: </span>
        {{ $data['name'] }}
    </div>
    <div>
        <span>Электронная почта: </span>
        {{ $data['email'] }}
    </div>
    <div>
        <span>Телефон: </span>
        {{ $data['phone'] }}
    </div>
    <br>
    <b>Текст запроса</b>
    <div>
        <span>Пункт отправления: </span>
        {{ $data['from'] }}
    </div>
    <div>
        <span>Пункт назначения: </span>
        {{ $data['to'] }}
    </div>
    <div>
        <span>Характеристика груза: </span>
        {{ $data['message'] }}
    </div>
    <br>
    @if (!empty($data['files']))
        <div>
            <span><b>Прикрепленные файлы (см. вложения):</b></span>
            {{ $data['files'] }}
        </div>
    @endif
    <br>
    <br>
    <a href="mailto:{{ $data['email'] }}?subject=Расчет стоимости&body=Добрый день!<br><br><br>">
        <b>Ответить на запрос</b>
    </a>
</body>

</html>
