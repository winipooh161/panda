<!-- Навигация Bootstrap -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#" style="font-family: var(--font-heading);">Эльвира</a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                data-bs-target="#navbarNav" aria-controls="navbarNav" 
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#about">О мастере</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#portfolio">Работы</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#pricing">Цены</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#faq">Вопросы</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#studio">Студия</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#booking">Запись</a>
                </li>
            </ul>
            
            <div class="d-none d-lg-flex ms-lg-3 social-icons">
                <a href="https://vk.com/sotnikovatattoo" class="nav-link" target="_blank"><i class="fab fa-vk"></i></a>
                <a href="https://t.me/ELVIRA182" class="nav-link" target="_blank"><i class="fab fa-telegram"></i></a>
            </div>
        </div>
    </div>
</nav>

<style>

</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Добавление социальных иконок в мобильное меню
    if (window.innerWidth < 992) {
        const navbarCollapse = document.querySelector('.navbar-collapse');
        const socialIconsContainer = document.createElement('div');
        socialIconsContainer.className = 'social-icons-mobile';
        
        // Добавляем ссылки на социальные сети
        socialIconsContainer.innerHTML = `
            <a href="https://vk.com/sotnikovatattoo" target="_blank"><i class="fab fa-vk"></i></a>
            <a href="https://t.me/ELVIRA182" target="_blank"><i class="fab fa-telegram"></i></a>
        `;
        
        navbarCollapse.appendChild(socialIconsContainer);
    }
});
</script>
