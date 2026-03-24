@extends('layouts.app')

@section('title', 'Сервісний центр | VIST')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
    <link rel="stylesheet" href="{{ asset('css/service.css') }}">
@endpush

@section('content')

<main class="vist-service-page">

    <div class="page-hero">
        <h1>Сервісний центр</h1>
        <p>Професійний ремонт та обслуговування комп'ютерної техніки</p>
    </div>

    <div class="service-content">

        <div class="service-text-block">
            <h2>Професійний сервіс та ремонт комп'ютерної техніки</h2>
            <p>Сервісний центр ТОВ фірма «ВІСТ» — це поєднання багаторічного досвіду, сучасної діагностичної бази та високої кваліфікації інженерів. Ми забезпечуємо повний цикл технічної підтримки: від простого налаштування ПЗ до складного компонентного ремонту електроніки.</p>
            <p>Нам довіряють як приватні користувачі, так і великі корпоративні клієнти, яким важливо мінімізувати час простою техніки.</p>

            <h3>Наші ключові напрямки ремонту</h3>
            <p>Ми спеціалізуємося на відновленні працездатності широкого спектра обладнання:</p>

            <h4>Ремонт ноутбуків та ПК:</h4>
            <ul>
                <li>Чистка від пилу та заміна термопасти.</li>
                <li>Заміна матриць, клавіатур, роз'ємів живлення.</li>
                <li>Модернізація (Upgrade): встановлення SSD, збільшення об'єму RAM.</li>
                <li>Відновлення материнських плат після залиття або стрибків напруги.</li>
            </ul>

            <h4>Обслуговування джерел безперебійного живлення (ДБЖ/UPS):</h4>
            <ul>
                <li>Калібрування та діагностика електроніки.</li>
                <li>Заміна акумуляторних батарей (АКБ) на оригінальні або сумісні аналоги (APC, Eaton та інші).</li>
                <li>Ремонт інверторів та ланцюгів заряду.</li>
            </ul>

            <h4>Ремонт лазерних принтерів та БФП:</h4>
            <ul>
                <li>Професійна чистка та технічне обслуговування механічних вузлів.</li>
                <li>Заміна вузлів закріплення (печей), роликів захоплення паперу.</li>
                <li>Усунення дефектів друку та програмних помилок.</li>
            </ul>

            <h3>Чому обирають сервіс ТОВ фірма «ВІСТ»?</h3>
            <ul>
                <li><strong>Професійна діагностика:</strong> Точне виявлення причини несправності перед початком будь-яких робіт.</li>
                <li><strong>Власний склад запчастин:</strong> Наявність основних комплектуючих дозволяє виконувати ремонт у найкоротші терміни.</li>
                <li><strong>Гарантія на виконані роботи:</strong> Ми несемо відповідальність за якість встановлених деталей та наданих послуг.</li>
                <li><strong>Робота з юридичними особами:</strong> Повний пакет документів, безготівковий розрахунок та можливість укладання договору на постійне сервісне обслуговування.</li>
            </ul>

            <p class="service-cta-text">Не чекайте, поки техніка вийде з ладу остаточно. Своєчасне обслуговування економить ваші кошти та час.</p>
        </div>

        <div class="contact">
            <div class="glass-form">
                <h1>Залишити заявку</h1>

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
                        <option value="Ремонт ноутбука/ПК" {{ old('subject') == 'Ремонт ноутбука/ПК' ? 'selected' : '' }}>Ремонт ноутбука/ПК</option>
                        <option value="Обслуговування ДБЖ" {{ old('subject') == 'Обслуговування ДБЖ' ? 'selected' : '' }}>Обслуговування ДБЖ</option>
                        <option value="Ремонт принтера/БФП" {{ old('subject') == 'Ремонт принтера/БФП' ? 'selected' : '' }}>Ремонт принтера/БФП</option>
                        <option value="Технічна підтримка" {{ old('subject') == 'Технічна підтримка' ? 'selected' : '' }}>Технічна підтримка</option>
                        <option value="Інше" {{ old('subject') == 'Інше' ? 'selected' : '' }}>Інше</option>
                    </select>
                    @error('subject') <div class="error">{{ $message }}</div> @enderror

                    <label for="message">Опис проблеми</label>
                    <textarea id="message" name="message" required>{{ old('message') }}</textarea>
                    @error('message') <div class="error">{{ $message }}</div> @enderror

                    <div style="position: absolute; left: -9999px;" aria-hidden="true">
                        <input type="text" name="website_url" tabindex="-1" autocomplete="new-password">
                    </div>

                    <button type="submit">Надіслати заявку</button>
                </form>
            </div>
        </div>

    </div>

</main>

@endsection
