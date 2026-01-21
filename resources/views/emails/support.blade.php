<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #0066cc; color: white; padding: 20px; text-align: center; }
        .content { background: #f9f9f9; padding: 20px; margin: 20px 0; }
        .field { margin-bottom: 15px; }
        .label { font-weight: bold; color: #555; }
        .value { margin-top: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Нове звернення з сайту VIST</h2>
        </div>
        
        <div class="content">
            <div class="field">
                <div class="label">Ім'я:</div>
                <div class="value">{{ $name }}</div>
            </div>
            
            <div class="field">
                <div class="label">Email:</div>
                <div class="value">{{ $email }}</div>
            </div>
            
            <div class="field">
                <div class="label">Телефон:</div>
                <div class="value">{{ $phone }}</div>
            </div>
            
            <div class="field">
                <div class="label">Тема:</div>
                <div class="value">{{ $subject }}</div>
            </div>
            
            <div class="field">
                <div class="label">Повідомлення:</div>
                <div class="value">{{ $message }}</div>
            </div>
        </div>
        
        <p style="text-align: center; color: #999; font-size: 12px;">
            Це автоматичне повідомлення з форми зворотнього зв'язку сайту vist.dp.ua
        </p>
    </div>
</body>
</html>