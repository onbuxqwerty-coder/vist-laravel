<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; background: #f4f4f4; }
        .container { max-width: 600px; margin: 20px auto; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .header { background: linear-gradient(135deg, #0066cc, #004999); color: white; padding: 30px 20px; text-align: center; }
        .header h2 { margin: 0; font-size: 24px; }
        .content { padding: 30px; }
        .field { margin-bottom: 20px; padding-bottom: 20px; border-bottom: 1px solid #eee; }
        .field:last-child { border-bottom: none; }
        .label { font-weight: bold; color: #0066cc; font-size: 12px; text-transform: uppercase; margin-bottom: 5px; }
        .value { margin-top: 5px; font-size: 16px; }
        .footer { background: #f9f9f9; padding: 20px; text-align: center; color: #999; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>📧 Нове звернення з сайту VIST</h2>
        </div>
        
        <div class="content">
            <div class="field">
                <div class="label">Ім'я клієнта</div>
                <div class="value">{{ $name }}</div>
            </div>
            
            <div class="field">
                <div class="label">Email</div>
                <div class="value"><a href="mailto:{{ $email }}">{{ $email }}</a></div>
            </div>
            
            <div class="field">
                <div class="label">Телефон</div>
                <div class="value"><a href="tel:{{ $phone }}">{{ $phone }}</a></div>
            </div>
            
            @if(isset($subject))
            <div class="field">
                <div class="label">Тема звернення</div>
                <div class="value">{{ $subject }}</div>
            </div>
            @endif
            
            <div class="field">
                <div class="label">Повідомлення</div>
                <div class="value">{!! nl2br(e($message)) !!}</div>
            </div>
        </div>
        
        <div class="footer">
            <p>Це автоматичне повідомлення з сайту vist.dp.ua</p>
            <p>Дата отримання: {{ now()->format('d.m.Y H:i') }}</p>
        </div>
    </div>
</body>
</html>