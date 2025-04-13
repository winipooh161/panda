<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramController extends Controller
{
    /**
     * Отправляет сообщение через Telegram бота
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendMessage(Request $request)
    {
        try {
            // Подробное логирование входящего запроса
            Log::info('Получен запрос на отправку сообщения в Telegram', [
                'request_data' => $request->all(),
                'method' => $request->method(),
                'content_type' => $request->header('Content-Type'),
                'headers' => $request->headers->all(),
                'is_json' => $request->isJson(),
                'ip' => $request->ip()
            ]);
            
            // Валидация данных формы с более подробными сообщениями
            $validated = $request->validate([
                'name' => 'required|string|max:100',
                'phone' => 'required|string|max:20',
                'message' => 'nullable|string|max:500',
            ], [
                'name.required' => 'Имя обязательно для заполнения',
                'phone.required' => 'Телефон обязателен для заполнения'
            ]);
            
            // ID чата и токен бота из переменных окружения
            $chatId = env('TELEGRAM_CHAT_ID', '-'); 
            $botToken = env('TELEGRAM_BOT_TOKEN', '-');
            
            Log::info('Настройки Telegram', [
                'chat_id' => $chatId,
                'token_length' => strlen($botToken),
                'token_valid' => (strlen($botToken) > 10)
            ]);
            
            // Если не заданы переменные окружения - вернуть ошибку
            if ($chatId === '-' || $botToken === '-') {
                Log::error('Не настроены переменные окружения для Telegram бота');
                return response()->json(['success' => false, 'message' => 'Ошибка настройки бота. Проверьте переменные окружения.'], 500);
            }
            
            // Формируем текст сообщения
            $messageText = "✅ Новая заявка с сайта!\n\n";
            $messageText .= "👤 Имя: " . $validated['name'] . "\n";
            $messageText .= "📱 Телефон: " . $validated['phone'] . "\n";
            
            if (!empty($validated['message'])) {
                $messageText .= "💬 Сообщение: " . $validated['message'] . "\n";
            }
            
            $messageText .= "\n📅 Дата: " . now()->format('d.m.Y H:i:s');
            
            // Детали запроса к Telegram API для логирования
            Log::info('Отправляем запрос к API Telegram', [
                'url' => "https://api.telegram.org/bot{$botToken}/sendMessage",
                'message_text' => $messageText
            ]);
            
            // Отправляем запрос к API Telegram
            try {
                $response = Http::timeout(30)->post("https://api.telegram.org/bot{$botToken}/sendMessage", [
                    'chat_id' => $chatId,
                    'text' => $messageText,
                    'parse_mode' => 'HTML',
                ]);
                
                // Логгируем подробный ответ
                Log::info('Ответ от API Telegram', [
                    'status' => $response->status(),
                    'body' => $response->json(),
                    'headers' => $response->headers()
                ]);
                
                // Проверяем успешность отправки
                if ($response->successful() && $response->json('ok') === true) {
                    Log::info('Сообщение успешно отправлено в Telegram');
                    
                    return response()->json([
                        'success' => true,
                        'message' => 'Ваше сообщение успешно отправлено!',
                        'telegram_url' => 'https://t.me/ELVIRA182'
                    ]);
                } else {
                    Log::error('Ошибка отправки в Telegram', [
                        'response_status' => $response->status(),
                        'response_body' => $response->json(),
                        'error_description' => $response->json('description', 'Неизвестная ошибка')
                    ]);
                    
                    return response()->json([
                        'success' => false,
                        'message' => 'Ошибка API Telegram: ' . ($response->json('description', 'Неизвестная ошибка'))
                    ], 500);
                }
            } catch (\Exception $httpException) {
                Log::error('HTTP исключение при запросе к API Telegram', [
                    'exception' => $httpException->getMessage(),
                    'trace' => $httpException->getTraceAsString(),
                ]);
                
                return response()->json([
                    'success' => false,
                    'message' => 'Ошибка соединения с API Telegram: ' . $httpException->getMessage()
                ], 500);
            }
            
        } catch (\Illuminate\Validation\ValidationException $validationException) {
            Log::error('Ошибка валидации при отправке в Telegram', [
                'errors' => $validationException->errors(),
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Ошибка валидации данных',
                'errors' => $validationException->errors()
            ], 422);
            
        } catch (\Exception $e) {
            Log::error('Исключение при отправке в Telegram', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Произошла ошибка сервера: ' . $e->getMessage()
            ], 500);
        }
    }
}
