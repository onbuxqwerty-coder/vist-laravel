@extends('layouts.app')

@section('title', 'Контакти | VIST')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
@endpush

@section('content')

<main class="vist-contact-page theme-light">
 
    <section class="contacts-layout">
        <section class="vist-contact-wrap">
            <div class="vist-contact-panel">

                <h1 class="vist-contact-title">Звернення до VIST</h1>
                <p class="vist-contact-subtitle">
                    Залиште контакти та коротко опишіть запит — ми відповімо якнайшвидше.
                </p>

                @include('components.contact-form', [
                    'showSubject' => false,
                    'showNote' => true,
                    'note' => 'Після відправлення буде автоматичне повернення на головну.'
                ])

            </div>
        </section>
        
        <!----------------------------------------------- Контакти та реквізити: ----------------------------------------------->
        <section class="contacts-content">
            <h1>Контакти<br> та<br> реквізити:</h1>
            <h2>ТОВ фірма "ВІСТ"</h2>
            <ul class="contacts-list">
                <li>Код ЄДРПОУ 21905171</li>
                <li>Загальна система оподаткування.</li>
                <li>Платник ПДВ Код <span>219051</span><span>704631</span></li>
                <li>Адреса: 49000, Україна, м.Дніпро,<br> вул. Князя Ярослава Мудрого, 27</li>
                <li><a href="mailto:sales@vist.net.ua">sales@vist.net.ua</a></li>
                <li>Тел.: +380563700707<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+380634370707
                </li>
                <li>Telegram, Viber, WhatsApp:<br>
                    +380634370707
                </li>
            </ul>
        </section>
    </section>
</main>

@endsection