<!-- Футер -->
<footer class="py-5 bg-dark text-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4 mb-lg-0">
                <h3 class="mb-4 text-white fs-2" style="font-family: var(--font-heading);">Эльвира Сотникова</h3>
                <p class="mb-4">Авторские татуировки в Ростове-на-Дону. Ботаника, минимализм, символизм и другие стили.</p>
                <div class="d-flex gap-3 mb-3">
                    <a href="https://vk.com/sotnikovatattoo" class="text-white fs-5" target="_blank"><i class="fab fa-vk"></i></a>
                    <a href="https://t.me/ELVIRA182" class="text-white fs-5" target="_blank"><i class="fab fa-telegram"></i></a>
                    <a href="tel:+79381071186" class="text-white fs-5"><i class="fas fa-phone"></i></a>
                </div>
            </div>
            
            <div class="col-md-4 col-12 mb-4 mb-md-0">
                <h5 class="mb-3 text-white">Навигация</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#about" class="text-white-50 text-decoration-none"><i class="fas fa-angle-right me-2"></i>О мастере</a></li>
                    <li class="mb-2"><a href="#portfolio" class="text-white-50 text-decoration-none"><i class="fas fa-angle-right me-2"></i>Работы</a></li>
                    <li class="mb-2"><a href="#testimonials" class="text-white-50 text-decoration-none"><i class="fas fa-angle-right me-2"></i>Отзывы</a></li>
                    <li class="mb-2"><a href="#pricing" class="text-white-50 text-decoration-none"><i class="fas fa-angle-right me-2"></i>Цены</a></li>
                    <li class="mb-2"><a href="#faq" class="text-white-50 text-decoration-none"><i class="fas fa-angle-right me-2"></i>Вопросы</a></li>
                    <li><a href="#studio" class="text-white-50 text-decoration-none"><i class="fas fa-angle-right me-2"></i>Студия</a></li>
                </ul>
            </div>
            
            <div class="col-md-4 col-12">
                <h5 class="mb-3 text-white">Контакты</h5>
                <ul class="list-unstyled">
                    <li class="mb-3 d-flex">
                        <i class="fas fa-map-marker-alt me-3 text-accent mt-1"></i>
                        <span>Western Tattoo Factory, Проспект Стачки, 135, Ростов-на-Дону </span>
                    </li>
                    <li class="mb-3 d-flex">
                        <i class="fas fa-phone-alt me-3 text-accent mt-1"></i>
                        <span><a href="tel:+79381071186" class="text-white">+7 (938) 107-11-86</a></span>
                    </li>
                    <li class="mb-3 d-flex">
                        <i class="fab fa-telegram me-3 text-accent mt-1"></i>
                        <span><a href="https://t.me/ELVIRA182" class="text-white" target="_blank">@ELVIRA182</a></span>
                    </li>
                    <li class="d-flex">
                        <i class="far fa-clock me-3 text-accent mt-1"></i>
                    </li>
                </ul>
            </div>
        </div>
        
        <hr class="my-4">
        
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
            <p class="mb-2 mb-md-0">© {{ date('Y') }} Эльвира Сотникова | Тату-мастер. Все права защищены.</p>
            <a href="/policy" class="text-white-50 text-decoration-none">Политика конфиденциальности</a>
        </div>
    </div>
</footer>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Обработка формы бронирования
    const bookingForm = document.getElementById('booking-form');
    if (bookingForm) {
        bookingForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(bookingForm);
            const successMessage = document.getElementById('booking-success');
            const errorMessage = document.getElementById('booking-error');
            
            // Скрываем предыдущие сообщения
            if (successMessage) successMessage.classList.add('d-none');
            if (errorMessage) errorMessage.classList.add('d-none');
            
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
                    // Показываем сообщение об успехе
                    if (successMessage) successMessage.classList.remove('d-none');
                    bookingForm.reset();
                    
                    // Скролл к сообщению об успехе
                    successMessage.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    
                    // Перенаправление в Telegram через 2 секунды
                    setTimeout(() => {
                        window.open('https://t.me/ELVIRA182', '_blank');
                    }, 2000);
                } else {
                    // Показываем сообщение об ошибке
                    if (errorMessage) {
                        errorMessage.textContent = data.message || 'Произошла ошибка при отправке сообщения';
                        errorMessage.classList.remove('d-none');
                    }
                }
            })
            .catch(error => {
                if (errorMessage) {
                    errorMessage.textContent = 'Произошла ошибка при отправке сообщения';
                    errorMessage.classList.remove('d-none');
                }
                console.error('Error:', error);
            });
        });
    }
});
</script>
