<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
</head>
<body style="font-family: Arial, sans-serif; background: #f4f6f9; padding: 32px;">
    <div style="max-width: 560px; margin: 0 auto; background: #fff; border-radius: 8px; padding: 32px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        <h2 style="color: #333; margin-bottom: 16px;">Відповідь на ваше звернення</h2>

        <p style="color: #666; font-size: 14px; margin-bottom: 8px;">
            <strong>Тема:</strong> {{ $appeal->subject }}
        </p>

        <hr style="border: none; border-top: 1px solid #eee; margin: 16px 0;">

        <div style="font-size: 15px; color: #333; line-height: 1.6;">
            {!! nl2br(e($replyMessage)) !!}
        </div>

        <hr style="border: none; border-top: 1px solid #eee; margin: 16px 0;">

        <p style="color: #999; font-size: 12px;">
            Це автоматичний лист-відповідь на ваше звернення від {{ $appeal->date }}.
        </p>
    </div>
</body>
</html>
