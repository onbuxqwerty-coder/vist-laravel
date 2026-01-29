<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ContactController extends Controller
{
    /**
     * Показати сторінку контактів
     */
    public function index(): View
    {
        return view('contact.index');
    }

    /**
     * Показати сторінку підтримки
     */
    public function support(): View
    {
        return view('support.index');
    }

    /**
     * Обробити форму звернення (для обох сторінок)
     */
    public function submit(Request $request): RedirectResponse
    {
        // Перевірка honeypot (захист від спаму)
        if ($request->filled('company')) {
            return redirect()->route('home');
        }

        // Валідація (subject і product_name опціонально)
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'required|string|min:10|max:5000',
        ];

        // Додаємо subject тільки якщо він є
        if ($request->has('subject')) {
            $rules['subject'] = 'required|in:consultation,order,warranty,repair,configuration,other';
        }
        
        // Додаємо product_name якщо є (для замовлень з каталогу)
        if ($request->has('product_name')) {
            $rules['product_name'] = 'nullable|string|max:255';
        }

        $validated = $request->validate($rules, [
            'name.required' => 'Будь ласка, вкажіть ваше ім\'я',
            'email.required' => 'Будь ласка, вкажіть email',
            'email.email' => 'Невірний формат email',
            'phone.required' => 'Будь ласка, вкажіть телефон',
            'subject.required' => 'Оберіть тему звернення',
            'message.required' => 'Будь ласка, напишіть повідомлення',
            'message.min' => 'Повідомлення має бути не менше 10 символів',
        ]);

        // Відправка email
        try {
            $emailTo = $request->has('subject') ? 'info@vist.net.ua' : 'sales@vist.net.ua';
            
            // Формуємо subject для email
            if ($request->has('product_name')) {
                $subjectLabel = 'Замовлення: ' . $validated['product_name'];
            } elseif ($request->has('subject')) {
                $subjectLabel = 'Підтримка: ' . $this->getSubjectLabel($validated['subject'] ?? 'other');
            } else {
                $subjectLabel = 'Звернення з форми контактів';
            }

            Mail::send('emails.contact', $validated, function ($message) use ($validated, $emailTo, $subjectLabel) {
                $message->to($emailTo)
                        ->subject($subjectLabel)
                        ->replyTo($validated['email'], $validated['name']);
            });

   
// Якщо це замовлення з модалки - повертаємо назад
if ($request->has('product_name')) {
    return back()->with('success', 'Дякуємо за замовлення! Наш менеджер зв\'яжеться з вами найближчим часом.');
}

// Інакше на головну
return redirect()->route('home')
           ->with('success', 'Дякуємо! Ваше звернення відправлено. Ми зв\'яжемося з вами найближчим часом.');

        } catch (\Exception $e) {
            // При помилці повертаємось назад
            return back()
                   ->with('error', 'Виникла помилка при відправці. Будь ласка, спробуйте пізніше або зателефонуйте нам.')
                   ->withInput();
        }
    }

    /**
     * Отримати мітку теми
     */
    private function getSubjectLabel(string $subject): string
    {
        return match($subject) {
            'consultation' => 'Технічна консультація',
            'order' => 'Питання щодо замовлення',
            'warranty' => 'Гарантійне обслуговування',
            'repair' => 'Ремонт обладнання',
            'configuration' => 'Підбір конфігурації',
            'other' => 'Інше питання',
            default => 'Звернення',
        };
    }
}
