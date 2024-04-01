﻿@extends('layouts.main')

@section('content')
    <section class="main-section main-section--index-map">
        <div class="main-section__container">
            <div class="zhd">
                <h1 class="zhd__big">ЖД перевозки</h1>
                <a class="zhd__neg" href="">негабаритных грузов </a> <span class="zhd__rf">из Санкт-Петербурга по
                    РФ</span>
            </div>
        </div>

        <div class="main-section__container main-section__container--inhider js-index-content" data-opened="false">
            <div class="index-content__main-text">
                ООО <strong>«Авангард Лоджистикс»</strong> осуществляет железнодорожные перевозки любых негабаритных,
                тяжеловесных и длинномерных грузов с собственных терминалов в Санкт-Петербурге. Наша компания обладает
                уникальным опытом перевозки техники ведущих мировых производителей (Caterpillar, Doosan, Grove, John Deere,
                Hitachi, Komatsu, Liebherr, Ponsse, Sandvik, Shantui, Terex, Volvo), оборудования для энергетической,
                нефтеперерабатывающей, горнодобывающей и других отраслей промышленности, металлических конструкций и
                железобетонных изделий.
            </div>

            <hr class="super-hr" />

            <h2 class="index-content__h2">
                Мы осуществляем железнодорожные перевозки негабаритных и тяжеловесных грузов,
                <br>перевозки техники и оборудования
            </h2>
            <div class="index-content-columns">
                <ul class="index-content-columns__left">

                    <li class="index-content-columns__item">Негабаритные и проектные перевозки грузов железнодорожным
                        транспортом из Санкт-Петербурга и Ленинградской области</li>
                    <li class="index-content-columns__item">Перевозки грузов по железной дороге на платформах, в полувагонах
                        и в крытых вагонах со станции Красное Село и станции Купчинская Октябрьской железной дороги</li>
                    <li class="index-content-columns__item">Железнодорожные перевозки негабаритных, тяжеловесных и
                        длинномерных грузов на платформенных, площадочных, колодцевых и сцепных транспортерах</li>
                    <li class="index-content-columns__item">Железнодорожные перевозки грузов из Санкт-Петербурга в любую
                        точку России, в Якутию, на Сахалин, Камчатку, Чукотку, в порты Дальнего Востока (Корсаков, Магадан,
                        Петропавловск-Камчатский, Анадырь, Эгвекинот, Певек), а также международные перевозки грузов</li>
                    <li class="index-content-columns__item">Перевозка грузов по линиям Обская - Бованенково (Газпромтранс),
                        Нерюнгри - Томмот - Нижний Бестях (ЖДЯ), Сывдарма - Коротчаево - Новый Уренгой (ЯЖДК), подача
                        вагонов на строящиеся станции</li>
                </ul>
                <ul class="index-content-columns__right">
                    <li class="index-content-columns__item">Доставка грузов от двери до двери с использованием
                        железнодорожного, автомобильного, морского и речного транспорта</li>
                    <li class="index-content-columns__item">Разработка и согласование технической документации на перевозку
                        негабаритных и тяжеловесных грузов на платформах и транспортерах, разработка эскизов и схем погрузки
                    </li>
                    <li class="index-content-columns__item">Погрузо-разгрузочные работы и крепление грузов на
                        железнодорожном подвижном составе, подготовка грузов к перевозке, хранение грузов на охраняемых
                        площадках</li>
                    <li class="index-content-columns__item">Подача подвижного состава, оплата с собственного ЕЛС
                        железнодорожных тарифов по территории России, а также транзитных тарифов по территории Казахстана,
                        Узбекистана и других государств, страхование грузов, отслеживание грузов</li>
                    <li class="index-content-columns__item">Услуги ж/д тупика по приему и выгрузке платформ, полувагонов и
                        крытых вагонов в Санкт-Петербурге, прием вагонов в Санкт-Петербурге, хранение на открытых площадках,
                        погрузка на автомобильный транспорт</li>
                </ul>
            </div>
            <div class="index-content-simple">
                Более десяти лет мы перевозим по железной дороге самые сложные грузы.<br>В нашем <a
                    href="http://www.zhd.su/portfolio/">портфолио</a> сотни успешно выполненных проектов, поэтому с нами Вы
                можете быть уверены, что Ваш груз будет доставлен в сохранности и точно в срок. Доверьте доставку
                негабаритных грузов профессионалам.
            </div>
        </div>

        <div class="arrow-bar">
            <div class="arrow-bar__arrow js-index-content-opener index-submap__arrow--up"
                style="background-position: 0px -48px;"></div>
        </div>
        <div class="index-submap js-index-submap"></div>

        <div class="main-section__container">
            <div class="sixbox">
                <div class="sixbox__block js-sixbox__block sixbox__block--question">
                    <a href="/faq/" class="sixbox__text js-sixbox__text">Вопросы <span>и ответы</span></a>
                </div>
                <div class="sixbox__block js-sixbox__block sixbox__block--form">
                    <a href="/contact/" class="sixbox__text js-sixbox__text">Рассчитать <span>стоимость</span></a>
                </div>
                <div class="sixbox__block js-sixbox__block sixbox__block--blog">
                    <a href="/blog/" class="sixbox__text js-sixbox__text">Блог <span>компании</span></a>
                </div>
            </div>
        </div>

        @include('site.parts.section-portfolio')

    </section>
@endsection