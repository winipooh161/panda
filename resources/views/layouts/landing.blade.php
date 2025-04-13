<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Профессиональные татуировки от Эльвиры Сотниковой в Ростове-на-Дону. Тонкие линии, ботаника, минимализм. Безопасные материалы, индивидуальный подход, доступные цены. Опыт работы 5+ лет. Запишитесь онлайн!">
        <meta name="keywords" content="тату, татуировки, Ростов-на-Дону, тату мастер, тонкие линии, ботаника, минимализм, тату на руке, тату-студия, сделать тату, татуировка Ростов, лучшие тату-мастера, Эльвира Сотникова, Western Tattoo Factory">
        <title>Эльвира Сотникова | Тату-мастер в Ростове-на-Дону | Тонкие линии, ботаника, минимализм</title>

        <!-- Canonical URL -->
        <link rel="canonical" href="{{ url()->current() }}">

        <!-- Open Graph метатеги для соцсетей -->
        <meta property="og:title" content="Эльвира Сотникова | Тату-мастер в Ростове-на-Дону">
        <meta property="og:description" content="Авторские татуировки в Ростове-на-Дону. Флора, символизм, минимализм. Тонкие линии и безопасные материалы. Запишитесь на сеанс!">
        <meta property="og:image" content="{{ asset('images/og-image.jpg') }}">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:type" content="website">
        <meta property="og:site_name" content="Эльвира Сотникова Тату">
        <meta property="og:locale" content="ru_RU">
        
        <!-- Twitter Card -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="Эльвира Сотникова | Тату-мастер в Ростове-на-Дону">
        <meta name="twitter:description" content="Авторские татуировки от Эльвиры в Ростове-на-Дону. Флора, символизм, минимализм. Профессиональный подход с 5-летним опытом.">
        <meta name="twitter:image" content="{{ asset('images/og-image.jpg') }}">

        <!-- Верификационные метатеги для вебмастеров -->
        <meta name="google-site-verification" content="ВАШ_КОД_ВЕРИФИКАЦИИ_GOOGLE" />
        <meta name="yandex-verification" content="ВАШ_КОД_ВЕРИФИКАЦИИ_ЯНДЕКС" />

        <!-- Мета-теги для поисковых систем -->
        <meta name="robots" content="index, follow">
        <meta name="author" content="Эльвира Сотникова">
        <meta name="geo.placename" content="Ростов-на-Дону, Россия">
        <meta name="geo.region" content="RU-ROS">

        <!-- Фавиконки -->
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('manifest.json') }}">
        <meta name="theme-color" content="#BF9D73">
        
        <!-- Шрифты с preload для оптимизации -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="preload" href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;500;600&family=Montserrat:wght@300;400;500;600&display=swap" as="style">
        <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;500;600&family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
        
        <!-- Bootstrap 5 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Swiper CSS для слайдеров -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
        
        <!-- Font Awesome для иконок -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
        
        <!-- AOS (Animate On Scroll) для анимации -->
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        
        <!-- CSRF токен для форм -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <!-- Стили -->
        @vite(['resources/css/app.css'])
        
        <!-- Schema.org микроразметка -->
        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "LocalBusiness",
            "name": "Тату-мастер Эльвира Сотникова",
            "description": "Авторские татуировки от Эльвиры Сотниковой в Ростове-на-Дону. Специализация: тонкие линии, флора, минимализм.",
            "image": "{{ asset('images/og-image.jpg') }}",
            "logo": "{{ asset('favicon/android-chrome-192x192.png') }}",
            "url": "{{ url('/') }}",
            "telephone": "+79381071186",
            "email": "elvira.tattoo@example.com",
            "priceRange": "от 3000 ₽",
            "address": {
                "@type": "PostalAddress",
                "streetAddress": "Проспект Стачки, 135, Western Tattoo Factory",
                "addressLocality": "Ростов-на-Дону",
                "addressRegion": "Ростовская область",
                "postalCode": "344058",
                "addressCountry": "RU"
            },
            "geo": {
                "@type": "GeoCoordinates",
                "latitude": "47.2348",
                "longitude": "39.7011"
            },
            "openingHoursSpecification": [
                {
                    "@type": "OpeningHoursSpecification",
                    "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
                    "opens": "10:00",
                    "closes": "20:00"
                },
                {
                    "@type": "OpeningHoursSpecification",
                    "dayOfWeek": ["Saturday"],
                    "opens": "10:00",
                    "closes": "18:00"
                }
            ],
            "sameAs": [
                "https://vk.com/sotnikovatattoo",
                "https://t.me/ELVIRA182"
            ],
            "review": {
                "@type": "Review",
                "reviewRating": {
                    "@type": "Rating",
                    "ratingValue": "4.9",
                    "bestRating": "5"
                },
                "author": {
                    "@type": "Person",
                    "name": "Клиент тату-студии"
                },
                "reviewBody": "Талантливый мастер с отличным чувством эстетики. Рекомендую всем, кто ищет качественную татуировку в Ростове."
            },
            "hasOfferCatalog": {
                "@type": "OfferCatalog",
                "name": "Услуги тату-мастера",
                "itemListElement": [
                    {
                        "@type": "Offer",
                        "name": "Минималистичные татуировки",
                        "price": "3000",
                        "priceCurrency": "RUB"
                    },
                    {
                        "@type": "Offer",
                        "name": "Ботанические татуировки",
                        "price": "5500",
                        "priceCurrency": "RUB"
                    },
                    {
                        "@type": "Offer",
                        "name": "Татуировки средних размеров",
                        "price": "6000",
                        "priceCurrency": "RUB"
                    }
                ]
            }
        }
        </script>
        
        <!-- Дополнительная разметка для организации -->
        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "ProfessionalService",
            "name": "Эльвира Сотникова - Тату-мастер",
            "image": "{{ asset('images/im.jpg') }}",
            "url": "{{ url('/') }}",
            "telephone": "+79381071186",
            "address": {
                "@type": "PostalAddress",
                "streetAddress": "Проспект Стачки, 135",
                "addressLocality": "Ростов-на-Дону",
                "addressRegion": "Ростовская область",
                "postalCode": "344058",
                "addressCountry": "RU"
            },
            "geo": {
                "@type": "GeoCoordinates",
                "latitude": "47.2348",
                "longitude": "39.7011"
            },
            "openingHoursSpecification": [
                {
                    "@type": "OpeningHoursSpecification",
                    "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
                    "opens": "10:00",
                    "closes": "20:00"
                },
                {
                    "@type": "OpeningHoursSpecification",
                    "dayOfWeek": ["Saturday"],
                    "opens": "10:00",
                    "closes": "18:00"
                }
            ],
            "areaServed": ["Ростов-на-Дону", "Ростовская область"],
            "description": "Профессиональный тату-мастер с 5-летним опытом работы. Специализация: тонкие линии, ботанические мотивы, минимализм. Безопасные материалы, индивидуальный подход.",
            "priceRange": "3000₽ - 10000₽"
        }
        </script>
        
        <!-- Дополнительные стили для секций -->
        @yield('styles')
    </head>
    <body>
        <!-- Эффект блестящего курсора -->
        <div class="glitter"></div>
        
        @include('sections.navbar')

        @yield('content')
        
        @include('sections.footer')
        
        <!-- Bootstrap 5 JS с Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        
        <!-- Swiper JS для слайдеров -->
        <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
        
        <!-- AOS JS с отложенной загрузкой -->
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js" defer></script>
        
        <!-- Основные скрипты -->
        @vite(['resources/js/app.js'])
        
        <script>
            // Инициализация AOS
            document.addEventListener('DOMContentLoaded', function() {
                AOS.init({
                    duration: 800,
                    easing: 'ease',
                    once: true,
                    offset: 50
                });
                
                // Lazy loading для изображений
                if ('loading' in HTMLImageElement.prototype) {
                    const images = document.querySelectorAll("img.lazy");
                    images.forEach(img => {
                        img.src = img.dataset.src;
                        if (img.dataset.srcset) {
                            img.srcset = img.dataset.srcset;
                        }
                    });
                } else {
                    // Полифилл для браузеров без нативной поддержки lazy loading
                    let script = document.createElement("script");
                    script.async = true;
                    script.src = "https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js";
                    document.body.appendChild(script);
                }
            });
        </script>
        
        <!-- Дополнительные скрипты -->
        @yield('scripts')
    </body>
</html>
