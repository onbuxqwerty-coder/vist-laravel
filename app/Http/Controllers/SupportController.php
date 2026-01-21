<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class SupportController extends Controller
{
    /**
     * Показати сторінку підтримки
     */
    public function index(): View
    {
        return view('support.index');
    }

    /**
     * Обробити форму зворотнього зв'язку
     */
    public function submit(Request $request): RedirectResponse
    {
        // Перевірка honeypot (захист від спаму)
        if ($request->filled('company')) {
            return redirect()->route('home');
        }

        // Валідація
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'subject' => 'required|in:consultation,order,warranty,repair,configuration,other',
            'message' => 'required|string|min:10|max:5000',
        ], [
            'name.required' => 'Будь ласка, вкажіть ваше ім\'я',
            'email.required' => 'Будь ласка, вкажіть email',
            'email.email' => 'Невірний формат email',
            'phone.required' => 'Будь ласка, вкажіть телефон',
            'subject.required' => 'Оберіть тему звернення',
            'message.required' => 'Будь ласка, напишіть повідомлення',
            'message.min' => 'Повідомлення має бути не менше 10 символів',
        ]);

        // Відправка email (налаштуйте MAIL_ в .env)
        try {
            Mail::send('emails.support', $validated, function ($message) use ($validated) {
                $message->to('info@vist.dp.ua')
                        ->subject('Нове звернення з сайту: ' . $this->getSubjectLabel($validated['subject']))
                        ->replyTo($validated['email'], $validated['name']);
            });

            return redirect()->route('support.index')
                           ->with('success', 'Дякуємо! Ваше звернення відправлено. Ми зв\'яжемося з вами найближчим часом.');
        } catch (\Exception $e) {
            return redirect()->route('support.index')
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