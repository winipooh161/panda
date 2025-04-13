import './bootstrap';

// Скрипты для лендинга
document.addEventListener('DOMContentLoaded', function() {
    // Обработка скролла для навигации
    const navbar = document.querySelector('.navbar');
    const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
    const mobileMenu = document.querySelector('.mobile-menu');
    const mobileMenuClose = document.querySelector('.mobile-menu-close');
    const overlay = document.querySelector('.overlay');

    // Добавляем класс к навигации при скролле
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });

    // Улучшение для мобильного меню - закрытие при клике по ссылке
    document.querySelectorAll('.navbar-nav .nav-link').forEach(link => {
        link.addEventListener('click', function() {
            const navbarToggler = document.querySelector('.navbar-toggler');
            const navbarCollapse = document.querySelector('.navbar-collapse');
            if (window.innerWidth < 992 && navbarCollapse.classList.contains('show')) {
                navbarToggler.click();
            }
        });
    });

    // Мобильное меню
    if (mobileMenuBtn && mobileMenu && mobileMenuClose && overlay) {
        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.add('active');
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        });

        mobileMenuClose.addEventListener('click', closeMenu);
        overlay.addEventListener('click', closeMenu);

        function closeMenu() {
            mobileMenu.classList.remove('active');
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        }

        // Закрытие меню при клике на ссылку
        const mobileNavLinks = document.querySelectorAll('.mobile-nav-links a');
        mobileNavLinks.forEach(link => {
            link.addEventListener('click', closeMenu);
        });
    }

    // Слайдер отзывов
    const testimonials = document.querySelectorAll('.testimonial');
    const dots = document.querySelectorAll('.testimonial-dot');
    let currentSlide = 0;

    function showSlide(index) {
        testimonials.forEach(testimonial => {
            testimonial.classList.remove('active');
        });
        
        dots.forEach(dot => {
            dot.classList.remove('active');
        });
        
        testimonials[index].classList.add('active');
        dots[index].classList.add('active');
        currentSlide = index;
    }

    if (dots.length > 0) {
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                showSlide(index);
            });
        });

        // Показываем первый слайд
        showSlide(0);

        // Автоматическое переключение слайдов
        setInterval(() => {
            showSlide((currentSlide + 1) % testimonials.length);
        }, 5000);
    }

    // Форма бронирования
    const bookingForm = document.getElementById('booking-form');
    if (bookingForm) {
        bookingForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(bookingForm);
            const formMessage = document.querySelector('.form-message');
            
            fetch('/booking', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    formMessage.textContent = data.message;
                    formMessage.className = 'form-message success';
                    formMessage.style.display = 'block';
                    bookingForm.reset();
                } else {
                    formMessage.textContent = data.message;
                    formMessage.className = 'form-message error';
                    formMessage.style.display = 'block';
                }
            })
            .catch(error => {
                formMessage.textContent = 'Произошла ошибка. Пожалуйста, попробуйте позже.';
                formMessage.className = 'form-message error';
                formMessage.style.display = 'block';
            });
        });
    }
    
    // Контактная форма
    const contactForm = document.getElementById('contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(contactForm);
            const formMessage = contactForm.querySelector('.form-message');
            
            fetch('/contact', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    formMessage.textContent = data.message;
                    formMessage.className = 'form-message success';
                    formMessage.style.display = 'block';
                    contactForm.reset();
                } else {
                    formMessage.textContent = data.message;
                    formMessage.className = 'form-message error';
                    formMessage.style.display = 'block';
                }
            })
            .catch(error => {
                formMessage.textContent = 'Произошла ошибка. Пожалуйста, попробуйте позже.';
                formMessage.className = 'form-message error';
                formMessage.style.display = 'block';
            });
        });
    }

    // Эффект блестящего курсора - отключаем на мобильных
    const glitter = document.querySelector('.glitter');
    if (glitter) {
        if ('ontouchstart' in window || navigator.maxTouchPoints > 0) {
            // Отключаем эффект блестящего курсора на мобильных устройствах
            glitter.style.display = 'none';
        } else {
            document.addEventListener('mousemove', (e) => {
                glitter.style.left = e.clientX + 'px';
                glitter.style.top = e.clientY + 'px';
                glitter.style.opacity = '1';
            });

            document.addEventListener('mouseout', () => {
                glitter.style.opacity = '0';
            });
        }
    }
    
    // Lazy loading для видео
    const lazyVideos = document.querySelectorAll('video.lazy');
    
    if ('IntersectionObserver' in window) {
        const videoObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const video = entry.target;
                    video.load();
                    videoObserver.unobserve(video);
                }
            });
        });
        
        lazyVideos.forEach(video => {
            videoObserver.observe(video);
        });
    }

    // Обработчик отправки формы в Telegram
    const telegramForm = document.getElementById('telegram-form');
    const sendTelegramBtn = document.getElementById('send-telegram-btn');
    
    if (sendTelegramBtn && telegramForm) {
        // Улучшение доступности модального окна
        const contactModal = document.getElementById('contactModal');
        if (contactModal) {
            contactModal.addEventListener('shown.bs.modal', function() {
                // Управление фокусом - устанавливаем фокус на первое поле ввода
                const firstInput = contactModal.querySelector('input[type="text"]');
                if (firstInput) {
                    firstInput.focus();
                }
            });
            
            // Обработка клавиши Escape
            contactModal.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    const bsModal = bootstrap.Modal.getInstance(contactModal);
                    if (bsModal) {
                        bsModal.hide();
                    }
                }
            });
        }

        sendTelegramBtn.addEventListener('click', function() {
            // Получаем данные формы
            const name = document.getElementById('tg-name').value;
            const phone = document.getElementById('tg-phone').value;
            const message = document.getElementById('tg-message').value;
            const successMessage = document.getElementById('tg-success');
            const errorMessage = document.getElementById('tg-error');
            
            // Скрываем предыдущие сообщения
            successMessage.classList.add('d-none');
            errorMessage.classList.add('d-none');
            
            // Проверка на заполнение обязательных полей
            if (!name || !phone) {
                errorMessage.textContent = 'Пожалуйста, заполните обязательные поля';
                errorMessage.classList.remove('d-none');
                return;
            }
            
            // Получаем CSRF токен из мета-тега или из скрытого поля
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || 
                              document.getElementById('csrf-token')?.value;
            
            if (!csrfToken) {
                console.error('CSRF токен не найден!');
                errorMessage.textContent = 'Ошибка безопасности: CSRF токен не найден';
                errorMessage.classList.remove('d-none');
                return;
            }
            
            console.log('Отправка данных формы...', {name, phone, message});
            
            // Отправляем данные на сервер как JSON
            fetch('/send-telegram', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    name: name,
                    phone: phone,
                    message: message
                })
            })
            .then(response => {
                console.log('Статус ответа:', response.status);
                // Показываем полный ответ для диагностики
                response.text().then(text => {
                    try {
                        // Пробуем распарсить как JSON
                        const data = JSON.parse(text);
                        console.log('Ответ сервера:', data);
                        
                        if (data.success) {
                            // Очищаем форму
                            telegramForm.reset();
                            // Показываем сообщение об успехе
                            successMessage.classList.remove('d-none');
                            // Перемещаем фокус на сообщение об успехе для скринридеров
                            successMessage.setAttribute('tabindex', '-1');
                            successMessage.focus();
                            
                            // Открываем Telegram в новой вкладке
                            setTimeout(() => {
                                window.open('https://t.me/ELVIRA182', '_blank');
                            }, 1000);
                            
                            // Закрываем модальное окно через 2 секунды
                            setTimeout(() => {
                                const modal = bootstrap.Modal.getInstance(document.getElementById('contactModal'));
                                if (modal) {
                                    modal.hide();
                                }
                            }, 2000);
                        } else {
                            // Показываем сообщение об ошибке
                            errorMessage.textContent = data.message || 'Произошла ошибка при отправке сообщения';
                            errorMessage.classList.remove('d-none');
                            // Перемещаем фокус на сообщение об ошибке для скринридеров
                            errorMessage.setAttribute('tabindex', '-1');
                            errorMessage.focus();
                        }
                    } catch (e) {
                        console.error('Ошибка при парсинге ответа:', e);
                        console.log('Исходный текст ответа:', text);
                        errorMessage.textContent = 'Некорректный ответ от сервера';
                        errorMessage.classList.remove('d-none');
                        errorMessage.setAttribute('tabindex', '-1');
                        errorMessage.focus();
                    }
                });
            })
            .catch(error => {
                console.error('Ошибка при отправке:', error);
                errorMessage.textContent = 'Произошла ошибка при отправке сообщения: ' + error.message;
                errorMessage.classList.remove('d-none');
                errorMessage.setAttribute('tabindex', '-1');
                errorMessage.focus();
            });
        });
    }
    
    // Улучшение доступности для мобильных устройств - добавляем плавную прокрутку
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            if(targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if(targetElement) {
                // Дополнительное смещение для фиксированного навбара
                const navbarHeight = document.querySelector('.navbar').offsetHeight;
                const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - navbarHeight - 20;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
    
    // Улучшение UI для мобильных - возврат в верх страницы
    const backToTopButton = document.createElement('button');
    backToTopButton.innerHTML = '<i class="fas fa-chevron-up"></i>';
    backToTopButton.classList.add('back-to-top');
    document.body.appendChild(backToTopButton);
    
    // Показываем/скрываем кнопку возврата при прокрутке
    window.addEventListener('scroll', () => {
        if (window.pageYOffset > 300) {
            backToTopButton.classList.add('active');
        } else {
            backToTopButton.classList.remove('active');
        }
    });
    
    // Действие при клике на кнопку возврата
    backToTopButton.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
});
