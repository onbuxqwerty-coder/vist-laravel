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

        // Валідація (subject опціонально)
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
            $emailTo = $request->has('subject') ? 'info@vist.dp.ua' : 'sales@vist.net.ua';
            $subjectLabel = $request->has('subject') 
                ? 'Підтримка: ' . $this->getSubjectLabel($validated['subject'] ?? 'other')
                : 'Звернення з форми контактів';

            Mail::send('emails.contact', $validated, function ($message) use ($validated, $emailTo, $subjectLabel) {
                $message->to($emailTo)
                        ->subject($subjectLabel)
                        ->replyTo($validated['email'], $validated['name']);
            });

            // Повернення на головну з повідомленням про успіх
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