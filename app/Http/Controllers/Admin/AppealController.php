<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\AppealReply;
use App\Models\Appeal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AppealController extends Controller
{
    public function index()
    {
        $appeals = Appeal::latest()->paginate(10);

        return view('admin.appeals.index', compact('appeals'));
    }

    public function show(Appeal $appeal)
    {
        $appeal->load('comments');

        return view('admin.appeals.show', compact('appeal'));
    }

    public function edit(Appeal $appeal)
    {
        return view('admin.appeals.edit', compact('appeal'));
    }

    public function update(Request $request, Appeal $appeal)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        $appeal->update($validated);

        return redirect()->route('admin.appeals.show', $appeal)
            ->with('success', 'Звернення успішно оновлено.');
    }

    public function destroy(Appeal $appeal)
    {
        $appeal->delete();

        return redirect()->route('admin.appeals.index')
            ->with('success', 'Звернення успішно видалено.');
    }

    public function addComment(Request $request, Appeal $appeal)
    {
        $validated = $request->validate([
            'body' => 'required|string',
        ]);

        $appeal->comments()->create($validated);

        return redirect()->route('admin.appeals.show', $appeal)
            ->with('success', 'Коментар додано.');
    }

    public function reply(Request $request, Appeal $appeal)
    {
        $validated = $request->validate([
            'reply_message' => 'required|string',
        ]);

        Mail::to($appeal->email)->send(new AppealReply($appeal, $validated['reply_message']));

        return redirect()->route('admin.appeals.show', $appeal)
            ->with('success', 'Відповідь надіслано на ' . $appeal->email);
    }
}
