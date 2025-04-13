<!-- Портфолио -->

<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
/>

<!-- Video.js CSS -->
<link href="https://vjs.zencdn.net/8.10.0/video-js.css" rel="stylesheet" />

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<!-- Video.js JS -->
<script src="https://vjs.zencdn.net/8.10.0/video.min.js"></script>

<section id="portfolio" class="portfolio bg-dark text-white">
    <div class="container">
        <h2 class="section-title text-white" data-aos="fade-up">Мои работы</h2>
        
        <!-- Галерея изображений -->
        <div class="portfolio-images mb-5" data-aos="fade-up">
            <h3 class="text-center mb-4">Фотографии</h3>
            
            @if(count($portfolioImages) > 0)
                <div class="swiper portfolioSwiper">
                    <div class="swiper-wrapper">
                        @foreach($portfolioImages as $index => $image)
                            <div class="swiper-slide">
                                <div class="portfolio-card">
                                    <div class="portfolio-img-container">
                                        <img class="lazy img-fluid" 
                                             src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="
                                             data-src="{{ asset($image['path']) }}" 
                                             alt="{{ $image['alt'] }}" 
                                             loading="lazy" 
                                             width="400" height="533">
                                        <div class="portfolio-overlay d-flex flex-column justify-content-end">
                                            <h5 class="text-white mb-1">{{ $image['title'] }}</h5>
                                            <p class="text-accent mb-0">Татуировка</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- Элементы навигации -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>
                </div>
            @else
                <div class="text-center">
                    <p>Фотографии работ скоро появятся</p>
                </div>
            @endif
        </div>
        
        <!-- Раздел с видео-рилсами -->
        <div class="portfolio-reels mt-5 pt-5">
            <h2 class="text-center mb-4" data-aos="fade-up" style="color: #fff">Видео процесса работы</h2>
            
            <!-- Информация о количестве видео -->
            <div class="text-center mb-4">
                <span class="badge bg-accent">Найдено видео: {{ count($portfolioReels) }}</span>
                <p class="text-light mt-2">Коллекция видеороликов процесса создания татуировок</p>
            </div>
            
            @if(count($portfolioReels) > 0)
                <div class="swiper reelsSwiper">
                    <div class="swiper-wrapper">
                        @foreach($portfolioReels as $index => $reel)
                            <div class="swiper-slide">
                                <div class="portfolio-reel-card">
                                    <div class="ratio ratio-9x16 rounded overflow-hidden">
                                        @if($reel['exists'])
                                            <video 
                                                id="reel-{{ $index }}" 
                                                class="video-js vjs-default-skin vjs-big-play-centered portfolio-reel"
                                                controls
                                                preload="metadata"
                                                width="100%"
                                                height="100%"
                                                {{ isset($reel['poster']) && $reel['poster'] ? 'poster='.asset($reel['poster']) : '' }}
                                                data-setup='{"fluid": true, "playbackRates": [0.5, 1, 1.5, 2]}'>
                                                <source src="{{ asset($reel['path']) }}" type="video/{{ $reel['extension'] }}">
                                                <p class="vjs-no-js">
                                                    Для просмотра видео необходимо включить JavaScript и использовать браузер с поддержкой HTML5 видео.
                                                </p>
                                            </video>
                                        @else
                                            <!-- Заглушка для отсутствующего видео -->
                                            <div class="video-placeholder d-flex flex-column align-items-center justify-content-center text-center">
                                                <i class="fas fa-film mb-3" style="font-size: 2rem;"></i>
                                                <h5 class="mb-2">{{ $reel['title'] }}</h5>
                                                <span class="badge bg-secondary">Скоро будет добавлено</span>
                                                <p class="small mt-2">{{ $reel['filename'] }}</p>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="reel-info p-2">
                                        <h5 class="text-center mt-2">{{ $reel['title'] }}</h5>
                                        <div class="text-center">
                                            <span class="badge {{ $reel['exists'] ? 'bg-success' : 'bg-secondary' }}">
                                                {{ $reel['exists'] ? 'Доступно' : 'Ожидается' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- Элементы навигации -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>
                </div>
            @else
                <div class="alert alert-warning text-center">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    Видео процесса работы скоро будут добавлены
                </div>
            @endif
        </div>
        
      
    </div>
</section>

<style>
    /* ...existing styles... */
    
    /* Стили для заглушек видео */
    /* Фиксы для адаптивного отображения слайдера */
    .portfolio .swiper-slide {
        width: 100%; /* Вместо фиксированной ширины */
    }
    
    .portfolio-img-container {
        width: 100%;
    }
    
    @media (max-width: 480px) {
        .portfolio-img-container {
            aspect-ratio: 1/1.1; /* Более квадратный аспект для маленьких экранов */
        }
        
        .portfolio-reel-card {
            max-width: 100%;
        }
        
        .swiper {
            padding-left: 0;
            padding-right: 0;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Инициализация Swiper для фото
    const portfolioSwiper = new Swiper('.portfolioSwiper', {
        slidesPerView: 1, // начинаем с 1 для самых маленьких экранов
        spaceBetween: 10, // меньше отступов на мобильных
        centeredSlides: false,
        loop: {{ count($portfolioImages) > 3 ? 'true' : 'false' }},
        grabCursor: true,
        pagination: {
            el: '.portfolioSwiper .swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.portfolioSwiper .swiper-button-next',
            prevEl: '.portfolioSwiper .swiper-button-prev',
        },
        breakpoints: {
            // Когда ширина окна >= 320px (маленькие телефоны)
            320: {
                slidesPerView: 1,
                spaceBetween: 10,
            },
            // Когда ширина окна >= 480px
            480: {
                slidesPerView: 1,
                spaceBetween: 15,
            },
            // Когда ширина окна >= 576px
            576: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            // Когда ширина окна >= 992px
            992: {
                slidesPerView: 3,
                spaceBetween: 20,
            }
        }
    });
    
    // Инициализация Swiper для видео
    const reelsSwiper = new Swiper('.reelsSwiper', {
        slidesPerView: 1, // 1 слайд на маленьких экранах
        spaceBetween: 10,
        centeredSlides: false,
        loop: {{ count($portfolioReels) > 3 ? 'true' : 'false' }},
        grabCursor: true,
        pagination: {
            el: '.reelsSwiper .swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.reelsSwiper .swiper-button-next',
            prevEl: '.reelsSwiper .swiper-button-prev',
        },
        breakpoints: {
            // Когда ширина окна >= 320px (маленькие телефоны)
            320: {
                slidesPerView: 1,
                spaceBetween: 10,
            },
            // Когда ширина окна >= 480px
            480: {
                slidesPerView: 1.5,
                spaceBetween: 15,
            },
            // Когда ширина окна >= 576px
            576: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            // Когда ширина окна >= 992px
            992: {
                slidesPerView: 3,
                spaceBetween: 30,
            }
        },
        on: {
            slideChange: function() {
                // Останавливаем все видео при смене слайда
                document.querySelectorAll('.portfolio-reel').forEach(videoEl => {
                    if (videojs.getPlayers()[videoEl.id]) {
                        videojs.getPlayers()[videoEl.id].pause();
                        
                        // Удаляем класс playing у всех карточек
                        document.querySelectorAll('.portfolio-reel-card').forEach(card => {
                            card.classList.remove('playing');
                        });
                    }
                });
                
                // Автоматически запускаем видео на активном слайде после небольшой задержки
                setTimeout(() => {
                    const activeSlide = document.querySelector('.reelsSwiper .swiper-slide-active');
                    if (activeSlide) {
                        const videoEl = activeSlide.querySelector('.video-js');
                        if (videoEl && videojs.getPlayers()[videoEl.id]) {
                            videojs.getPlayers()[videoEl.id].play();
                            activeSlide.querySelector('.portfolio-reel-card').classList.add('playing');
                        }
                    }
                }, 500);
            }
        }
    });
    
    // Lazy loading для изображений
    const lazyImages = document.querySelectorAll('img.lazy');
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                    imageObserver.unobserve(img);
                }
            });
        });
        
        lazyImages.forEach(img => {
            imageObserver.observe(img);
        });
    } else {
        // Fallback для браузеров без поддержки IntersectionObserver
        lazyImages.forEach(img => {
            img.src = img.dataset.src;
        });
    }

    // Оптимизация загрузки видео с использованием Video.js
    const videoElements = document.querySelectorAll('.video-js');
    
    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.1
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const videoEl = entry.target;
                
                // Инициализируем Video.js только когда видео видимо
                if (!videojs.getPlayers()[videoEl.id]) {
                    const player = videojs(videoEl.id, {
                        controls: true,
                        autoplay: false,
                        preload: 'metadata',
                        responsive: true,
                        fluid: true,
                        playbackRates: [0.5, 1, 1.5, 2]
                    });
                    
                    // Добавляем обработчики событий
                    player.on('play', function() {
                        // Останавливаем все другие видео
                        document.querySelectorAll('.portfolio-reel').forEach(otherVideoEl => {
                            if (otherVideoEl.id !== videoEl.id && videojs.getPlayers()[otherVideoEl.id]) {
                                videojs.getPlayers()[otherVideoEl.id].pause();
                            }
                        });
                        
                        // Удаляем класс playing у всех карточек
                        document.querySelectorAll('.portfolio-reel-card').forEach(card => {
                            card.classList.remove('playing');
                        });
                        
                        // Добавляем класс playing к карточке с текущим видео
                        videoEl.closest('.portfolio-reel-card').classList.add('playing');
                    });
                    
                    player.on('pause', function() {
                        videoEl.closest('.portfolio-reel-card').classList.remove('playing');
                    });
                    
                    player.on('ended', function() {
                        videoEl.closest('.portfolio-reel-card').classList.remove('playing');
                        
                        // Перемотка на начало
                        player.currentTime(0);
                    });
                }
                
                // Добавляем обработчик клика на карточку для запуска/остановки видео
                const reelCard = videoEl.closest('.portfolio-reel-card');
                if (reelCard && !reelCard.hasEventListener) {
                    reelCard.hasEventListener = true;
                    reelCard.addEventListener('click', function(e) {
                        // Не запускаем обработку клика, если клик был по элементам управления
                        if (e.target.closest('.vjs-control-bar') || e.target.closest('.vjs-big-play-button')) {
                            return;
                        }
                        
                        const player = videojs.getPlayers()[videoEl.id];
                        if (player) {
                            if (player.paused()) {
                                player.play();
                            } else {
                                player.pause();
                            }
                        }
                    });
                }
                
                observer.unobserve(videoEl);
            }
        });
    }, observerOptions);
    
    videoElements.forEach(video => {
        observer.observe(video);
    });
    
    // Инициализация первого видео после загрузки страницы
    setTimeout(() => {
        const firstVideo = document.querySelector('.reelsSwiper .swiper-slide-active .video-js');
        if (firstVideo && videojs.getPlayers()[firstVideo.id]) {
            videojs.getPlayers()[firstVideo.id].play();
            firstVideo.closest('.portfolio-reel-card').classList.add('playing');
        }
    }, 1500);
});
</script>
