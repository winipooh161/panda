<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class PortfolioController extends Controller
{
    /**
     * Получает все изображения из портфолио
     * 
     * @return array
     */
    public function getPortfolioImages()
    {
        $portfolioPath = public_path('images/portfolio');
        $images = [];
        
        try {
            // Проверяем существование директории
            if (File::isDirectory($portfolioPath)) {
                $files = File::files($portfolioPath);
                
                foreach ($files as $file) {
                    $extension = strtolower($file->getExtension());
                    if (in_array($extension, ['jpg', 'jpeg', 'png', 'webp'])) {
                        $fileName = $file->getFilename();
                        $images[] = [
                            'path' => 'images/portfolio/' . $fileName,
                            'title' => $this->generateImageTitle($fileName),
                            'alt' => 'Татуировка ' . $this->generateImageTitle($fileName) . ' в Ростове-на-Дону'
                        ];
                    }
                }
            } else {
                // Если директория не существует, создаем её
                File::makeDirectory($portfolioPath, 0755, true, true);
                Log::warning('Директория портфолио не существовала и была создана: ' . $portfolioPath);
            }
        } catch (\Exception $e) {
            Log::error('Ошибка при получении изображений: ' . $e->getMessage());
        }
        
        return $images;
    }
    
    /**
     * Получает все видео рилсы
     * 
     * @return array
     */
    public function getPortfolioReels()
    {
        $reelsPath = public_path('videos/reels');
        $reels = [];
        
        try {
            // Создаем директорию, если она не существует
            if (!File::isDirectory($reelsPath)) {
                File::makeDirectory($reelsPath, 0755, true, true);
                Log::info('Создана директория reels: ' . $reelsPath);
            }
            
            // Список доступных видео (фактические файлы в директории)
            $availableFiles = File::files($reelsPath);
            $availableFilenames = array_map(function($file) {
                return $file->getFilename();
            }, $availableFiles);
            
            // Список ожидаемых видеофайлов
            $expectedReels = [
            
                ['filename' => 'IMG_2760.mp4', 'title' => 'Процесс нанесения тату #2'],
                ['filename' => 'IMG_2906.mp4', 'title' => 'Процесс нанесения тату #3'],
                ['filename' => 'IMG_3279.mp4', 'title' => 'Татуировка рукав'],
                ['filename' => 'IMG_3287.mp4', 'title' => 'Нанесение контура'], 
                ['filename' => 'IMG_3848.mp4', 'title' => 'Детализация работы'],
                ['filename' => 'IMG_3919.mp4', 'title' => 'Работа тату машинкой'],
                ['filename' => 'IMG_4203.mp4', 'title' => 'Тонкие линии тату'],
                ['filename' => 'IMG_4210.mp4', 'title' => 'Минималистичный стиль'],
                ['filename' => 'IMG_4286.mp4', 'title' => 'Цветная татуировка'],

                ['filename' => 'video_2025-04-13_00-04-53.mp4', 'title' => 'Ботаническая тематика'],

            ];
            
            // Логируем информацию о найденных файлах
            Log::info('Фактически найдено файлов: ' . count($availableFilenames));
            Log::info('Доступные файлы: ' . implode(', ', $availableFilenames));
            
            // Обрабатываем каждый ожидаемый видеофайл
            foreach ($expectedReels as $reel) {
                $filename = $reel['filename'];
                $baseName = pathinfo($filename, PATHINFO_FILENAME);
                $extension = pathinfo($filename, PATHINFO_EXTENSION);
                
                // Проверяем наличие файла
                $fileExists = in_array($filename, $availableFilenames);
                
                // Формируем массив с информацией о видео
                $reels[] = [
                    'path' => '/videos/reels/' . $filename,
                    'title' => $reel['title'],
                    'poster' => $this->getReelPoster($filename),
                    'exists' => $fileExists,
                    'filename' => $filename,
                    'extension' => strtolower($extension)
                ];
            }
            
            // Добавляем существующие файлы, которых нет в ожидаемом списке
            foreach ($availableFiles as $file) {
                $filename = $file->getFilename();
                $extension = strtolower($file->getExtension());
                
                // Проверяем, не добавлен ли уже этот файл
                $alreadyAdded = false;
                foreach ($reels as $reel) {
                    if ($reel['filename'] === $filename) {
                        $alreadyAdded = true;
                        break;
                    }
                }
                
                // Если файл видео и еще не добавлен в список
                if (!$alreadyAdded && in_array($extension, ['mp4', 'mov', 'webm'])) {
                    $reels[] = [
                        'path' => 'videos/reels/' . $filename,
                        'title' => $this->generateReelTitle($filename),
                        'poster' => $this->getReelPoster($filename),
                        'exists' => true,
                        'filename' => $filename,
                        'extension' => $extension
                    ];
                }
            }
        } catch (\Exception $e) {
            Log::error('Ошибка при получении видео: ' . $e->getMessage());
        }
        
        return $reels;
    }
    
    /**
     * Создает заголовок для изображения
     * 
     * @param string $filename
     * @return string
     */
    private function generateImageTitle($filename)
    {
        // Удаляем расширение файла и заменяем подчеркивания на пробелы
        $name = pathinfo($filename, PATHINFO_FILENAME);
        $name = str_replace(['_', '-', '.'], ' ', $name);
        $name = ucfirst(trim($name));
        
        return empty($name) ? 'Татуировка' : $name;
    }
    
    /**
     * Создает заголовок для видео рилса
     * 
     * @param string $filename
     * @return string
     */
    private function generateReelTitle($filename)
    {
        // Специальная обработка для IMG 2682 и IMG 2760
        if (strpos($filename, 'IMG 2682') !== false) {
            return 'Процесс нанесения тату #1';
        }
        if (strpos($filename, 'IMG 2760') !== false) {
            return 'Процесс нанесения тату #2';
        }
        
        $name = pathinfo($filename, PATHINFO_FILENAME);
        $name = str_replace(['_', '-', '.'], ' ', $name);
        $name = ucfirst(trim($name));
        
        return empty($name) ? 'Процесс работы' : $name;
    }
    
    /**
     * Получает постер для видео
     * 
     * @param string $filename
     * @return string|null
     */
    private function getReelPoster($filename)
    {
        $baseName = pathinfo($filename, PATHINFO_FILENAME);
        $posterExtensions = ['jpg', 'jpeg', 'png', 'webp'];
        
        // Сначала ищем в той же директории
        foreach ($posterExtensions as $ext) {
            $posterPath = public_path("videos/reels/{$baseName}.{$ext}");
            if (File::exists($posterPath)) {
                return "videos/reels/{$baseName}.{$ext}";
            }
        }
        
        // Если не нашли, ищем в директории posters
        $postersDir = public_path("videos/reels/posters");
        if (File::isDirectory($postersDir)) {
            foreach ($posterExtensions as $ext) {
                $posterPath = "{$postersDir}/{$baseName}.{$ext}";
                if (File::exists($posterPath)) {
                    return "videos/reels/posters/{$baseName}.{$ext}";
                }
            }
        }
        
        // Если постер не найден, используем общий постер по умолчанию
        $defaultPoster = public_path("images/video-poster-default.jpg");
        if (File::exists($defaultPoster)) {
            return "images/video-poster-default.jpg";
        }
        
        return null;
    }
}
