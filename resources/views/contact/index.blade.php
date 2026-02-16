@extends('layouts.app')

@section('title', 'Контакти | VIST')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
@endpush

@section('content')

<main class="vist-contact-page">

    <div class="contact">
        {{-- Ліва панель: форма --}}
        <div class="glass-form">
            <h1>Форма зв'язку</h1>

            @if(session('success'))
                <div class="success">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="alert-error">{{ session('error') }}</div>
            @endif

            <form method="POST" action="{{ route('contact.submit') }}">
                @csrf

                <label for="name">Ім'я</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                @error('name') <div class="error">{{ $message }}</div> @enderror

                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                @error('email') <div class="error">{{ $message }}</div> @enderror

                <label for="phone">Телефон</label>
                <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required>
                @error('phone') <div class="error">{{ $message }}</div> @enderror

                <label for="subject">Тема звернення</label>
                <select id="subject" name="subject" required>
                    <option value="" disabled {{ old('subject') ? '' : 'selected' }}>-- Оберіть тему --</option>
                    <option value="Загальне питання" {{ old('subject') == 'Загальне питання' ? 'selected' : '' }}>Загальне питання</option>
                    <option value="Технічна підтримка" {{ old('subject') == 'Технічна підтримка' ? 'selected' : '' }}>Технічна підтримка</option>
                    <option value="Пропозиція" {{ old('subject') == 'Пропозиція' ? 'selected' : '' }}>Пропозиція</option>
                    <option value="Скарга" {{ old('subject') == 'Скарга' ? 'selected' : '' }}>Скарга</option>
                    <option value="Інше" {{ old('subject') == 'Інше' ? 'selected' : '' }}>Інше</option>
                </select>
                @error('subject') <div class="error">{{ $message }}</div> @enderror

                <label for="message">Повідомлення</label>
                <textarea id="message" name="message" required>{{ old('message') }}</textarea>
                @error('message') <div class="error">{{ $message }}</div> @enderror

                {{-- Honeypot --}}
                <div style="position: absolute; left: -9999px;" aria-hidden="true">
                    <input type="text" name="website_url" tabindex="-1" autocomplete="new-password">
                </div>

                <button type="submit">Надіслати</button>
            </form>
        </div>

        {{-- Права панель: контакти --}}
        <div class="glass-form">
            <h1>Контакти:</h1>
            <h2>ТОВ фірма "ВІСТ"</h2>
            <p>
            Код ЄДРПОУ 21905171<br>
            Загальна система оподаткування.<br>
            Платник ПДВ Код 219051704631<br>
            Адреса: 49000, Україна, м.Дніпро,<br>
            вул. Князя Ярослава Мудрого, 27<br>
            E-mail: <a href="mailto:sales@vist.net.ua">sales@vist.net.ua</a><br>
            Тел.: +380563700707<br>
            &emsp;&emsp;&ensp;+380634370707<br>
            Telegram, Viber, WhatsApp:<br>
            &emsp;&emsp;&ensp;+380634370707
            </p>
        </div>
    </div>

</main>

@endsection
