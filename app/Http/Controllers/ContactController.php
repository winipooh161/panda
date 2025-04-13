<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewContactNotification;

class ContactController extends Controller
{
    /**
     * Store a newly created contact message in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:1000',
        ]);

        $contact = Contact::create($validated);

        // Отправка уведомления на email (можно реализовать позже)
        // Mail::to('your-email@example.com')->send(new NewContactNotification($contact));

        return response()->json([
            'success' => true,
            'message' => 'Спасибо за ваше сообщение! Я отвечу вам в ближайшее время.'
        ]);
    }
}
