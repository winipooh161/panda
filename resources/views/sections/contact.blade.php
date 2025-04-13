<!-- Контакты -->
<section id="contact" class="contact">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">Связаться со мной</h2>
        
        <div class="row g-5">
            <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
                <div class="contact-info">
                    <h3 class="mb-4">Есть вопросы? Я с радостью на них отвечу!</h3>
                    <p class="mb-4">Свяжитесь со мной любым удобным способом, чтобы узнать больше о моих услугах, обсудить детали вашей будущей татуировки или задать любые вопросы.</p>
                    
                    <div class="contact-method d-flex align-items-start mb-4">
                        <div class="contact-icon me-3">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <h5 class="mb-2">Адрес</h5>
                            <p>Western Tattoo Factory, Проспект Стачки 135,   Ростов-на-Дону </p>
                        </div>
                    </div>
                    
                    <div class="contact-method d-flex align-items-start mb-4">
                        <div class="contact-icon me-3">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div>
                            <h5 class="mb-2">Телефон</h5>
                            <p><a href="tel:+79381071186" class="text-dark">+7 (938) 107-11-86</a></p>
                        </div>
                    </div>
                    
                    <div class="contact-method d-flex align-items-start mb-4">
                        <div class="contact-icon me-3">
                            <i class="fab fa-telegram"></i>
                        </div>
                        <div>
                            <h5 class="mb-2">Telegram</h5>
                            <p><a href="https://t.me/ELVIRA182" class="text-dark" target="_blank">@ELVIRA182</a></p>
                        </div>
                    </div>
                    
                    <div class="contact-method d-flex align-items-start">
                        <div class="contact-icon me-3">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div>
                            <h5 class="mb-2">Время работы</h5>
                            <p>Пн-Пт: 10:00 - 20:00<br>Сб: 10:00 - 18:00<br>Вс: выходной</p>
                        </div>
                    </div>
                    
                    <div class="social-links mt-4">
                        <a href="https://vk.com/sotnikovatattoo" class="social-link me-2" target="_blank"><i class="fab fa-vk"></i></a>
                        <a href="https://t.me/ELVIRA182" class="social-link me-2" target="_blank"><i class="fab fa-telegram"></i></a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
                <div class="contact-form bg-white p-4 p-lg-5 shadow-sm rounded">
                    <h3 class="mb-4 text-center">Напишите мне</h3>
                    
                    <form id="contact-form" action="{{ route('contact.send') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Ваше имя</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="message" class="form-label">Сообщение</label>
                            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-custom w-100 py-3">Отправить сообщение</button>
                        <div class="form-message mt-3 text-center"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
