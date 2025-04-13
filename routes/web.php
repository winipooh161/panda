<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\TelegramController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $portfolioController = new PortfolioController();
    $portfolioImages = $portfolioController->getPortfolioImages();
    $portfolioReels = $portfolioController->getPortfolioReels();
    
    return view('welcome', compact('portfolioImages', 'portfolioReels'));
})->name('home');

// Маршрут для обработки формы бронирования
Route::post('/booking', [BookingController::class, 'store'])->name('booking.send');
// Маршрут для обработки контактной формы
Route::post('/contact', [ContactController::class, 'store'])->name('contact.send');

// Маршрут для политики конфиденциальности
Route::get('/policy', function () {
    return view('policy');
})->name('policy');

// Маршрут для обработки отправки сообщений в Telegram
Route::post('/send-telegram', [TelegramController::class, 'sendMessage'])
    ->name('telegram.send')
    ->middleware('web'); // Явно указываем middleware web для включения CSRF-защиты

Auth::routes(['register' => false]); // Отключаем публичную регистрацию

Route::get('/home', [HomeController::class, 'index'])->name('dashboard');
