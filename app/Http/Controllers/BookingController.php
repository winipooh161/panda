<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewBookingNotification;

class BookingController extends Controller
{
    /**
     * Store a newly created booking in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'idea' => 'nullable|string|max:1000',
        ]);

        $booking = Booking::create($validated);

        // Отправка уведомления на email (можно реализовать позже)
        // Mail::to('your-email@example.com')->send(new NewBookingNotification($booking));
        
        return response()->json([
            'success' => true,
            'message' => 'Спасибо за заявку! Я свяжусь с вами в ближайшее время.'
        ]);
    }
}
