<div class="support-form-container">
    <form action="{{ '#' }}" method="POST" class="vist-contact-form" novalidate>
        @csrf
        
        <div class="form-group">
            <label for="name">Ім'я <span class="required">*</span></label>
            <input type="text" id="name" name="name" required placeholder="Ваше ім'я" value="{{ old('name') }}">
            @error('name')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="email">Email <span class="required">*</span></label>
            <input type="email" id="email" name="email" autocomplete="email" required placeholder="name@company.com" value="{{ old('email') }}">
            @error('email')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="phone">Телефон <span class="required">*</span></label>
            <input type="tel" id="phone" name="phone" required placeholder="+38 (0XX) XXX-XX-XX" value="{{ old('phone') }}">
            @error('phone')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>
        
        @if($showSubject ?? true)
        <div class="form-group">
            <label for="subject">Тема звернення <span class="required">*</span></label>
            <select id="subject" name="subject" required>
                <option value="">Оберіть тему...</option>
                <option value="consultation" {{ old('subject') == 'consultation' ? 'selected' : '' }}>Технічна консультація</option>
                <option value="order" {{ old('subject') == 'order' ? 'selected' : '' }}>Питання щодо замовлення</option>
                <option value="warranty" {{ old('subject') == 'warranty' ? 'selected' : '' }}>Гарантійне обслуговування</option>
                <option value="repair" {{ old('subject') == 'repair' ? 'selected' : '' }}>Ремонт обладнання</option>
                <option value="configuration" {{ old('subject') == 'configuration' ? 'selected' : '' }}>Підбір конфігурації</option>
                <option value="other" {{ old('subject') == 'other' ? 'selected' : '' }}>Інше питання</option>
            </select>
            @error('subject')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>
        @endif
        
        <div class="form-group">
            <label for="message">Повідомлення <span class="required">*</span></label>
            <textarea id="message" name="message" rows="6" minlength="10" required placeholder="Детально опишіть ваше питання...">{{ old('message') }}</textarea>
            @error('message')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>
        
        <!-- Honeypot для захисту від спаму -->
        <div style="position: absolute; left: -9999px;">
            <input type="text" name="company" tabindex="-1" autocomplete="off">
        </div>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif
        
        <button type="submit" class="btn-submit-support">
            📨 Відправити звернення
        </button>
        
        @if($showNote ?? true)
        <p style="text-align: center; color: #7f8c8d; font-size: 14px; margin-top: 15px;">
            {{ $note ?? 'Ми зв\'яжемося з вами найближчим часом.' }}
        </p>
        @endif
    </form>
</div>