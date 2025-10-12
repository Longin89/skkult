<?= $this->setSiteTitle(SITE_TITLE . ' - Главная'); ?>
<?php $this->setMetaDescription("СК 'Культурист' — спортивный клуб в Стерлитамаке: тренажерный зал, групповые тренировки и детские занятия. Записывайтесь на пробную тренировку!"); ?>
<?php $this->start('head'); ?>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <link rel="canonical" href="<?= htmlspecialchars(BASE_URL, ENT_QUOTES, 'UTF-8'); ?>">
<?php $this->end();?>
<?php $this->start('body'); ?>
<section class="motivation">
    <div class="motivation__container contain">
        <div class="motivation__desc animate__animated animate__fadeInLeft">
            <h1 class="motivation__desc-title">
                СК Культурист
            </h1>
            <p class="motivation__desc-text">
                Спорт для всех возрастов и уровней подготовки - гарантированные результаты под пристальным вниманием
                профессиональных тренеров.
            </p>
            <p class="motivation__desc-text">
                Инвестируйте в своё здоровье и получайте удовольствие от каждой тренировки.
            </p>
            <a href="https://wa.me/<?= $this->contacts->whatsup?>" class="motivation-desc-consultation" target="_blank">
                Сделать шаг навстречу здоровью
            </a>
        </div>
        <div class="motivation__picture animate__animated animate__fadeInRight">
            <img src="/images/coach.png" alt="coach">
        </div>
    </div>
</section>
<section class="mission">
    <div class="mission__container contain">
        <h2 class="mission__title">
            Наша миссия
        </h2>
        <p class="mission__subtitle">
            Настоящая победа рождается внутри. В СК Культурист каждый шаг к совершенству - это победа
            над собственными пределами.
            <br>
            <img src="/images/facility.webp" class="mission__img" alt="facility">
            <br>
            <b>СК Культурист</b> не просто спортивный клуб, мы - сообщество единомышленников, которые верят: самая
            главная победа - это <b>победа над собой</b>.
        </p>
    </div>
</section>
<section id="path" class="path">
    <div class="path__container contain">
        <h2 class="path__title">
            Наши программы тренировок для Вас
        </h2>
        <ul class="path__list">
            <li class="path__list-item">
                <img src="/images/gym.webp" alt="gym">
                <h3 class="path__item-title">
                    <?= $this->programs[0] ?>
                </h3>
                </a>
            </li>
            <li class="path__list-item">
                <img src="/images/giri.webp" alt="armwrestling">
                <h3 class="path__item-title">
                    <?= $this->programs[1] ?>

                </h3>
                </a>
            </li>
            <li class="path__list-item">
                <img src="/images/step.webp" alt="step">
                <h3 class="path__item-title">
                    <?= $this->programs[2] ?>
                </h3>
                </a>
            </li>
            <li class="path__list-item">
                <img src="/images/group.webp" alt="group training">
                <h3 class="path__item-title">
                    <?= $this->programs[3] ?>
                </h3>
                </a>
            </li>
            <li class="path__list-item">
                <img src="/images/children.webp" alt="children">
                <h3 class="path__item-title">
                    <?= $this->programs[4] ?>
                </h3>
                </a>
            </li>
        </ul>
    </div>
</section>
<section class="coaches">
    <div class="coaches__container contain">
        <h2 class="coaches__title" id="coaches">
            Наши Тренеры
        </h2>
        <ul class="coaches__list">
            <?php foreach ($this->coaches as $coach): ?>
                <li class="coaches__list-item">
                    <a href="#open-<?= $coach['id'] ?>" class="coaches__item-link button">
                        <img src="<?= $coach['image'] ?>" alt="coach">
                        <h3 class="coaches__link-title">
                            <?= $coach['name'] ?>
                        </h3>
                        <p class="coaches__link-subtitle">
                            <?= $coach['subdesc'] ?>
                        </p>
                    </a>
                    <div id="open-<?= $coach['id'] ?>" class="coaches__modal">
                        <div class="coaches__modal-wrapper">
                            <h3 class="coaches__modal-title"><?= $coach['name'] ?></h3>
                            <img src="<?= $coach['image'] ?>" alt="Тренер">
                            <p class="coaches__modal-subtitle">
                                <?= $coach['description'] ?>
                            </p>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>
<section class="gallery">
    <div class="gallery__container contain">
        <h2 class="gallery__title">
            Галерея
        </h2>
        <ul class="gallery__list">
            <?php foreach ($this->galleryImages as $image): ?>
                <li class="gallery__list-item">
                    <img src="<?= $image['url'] ?>" alt="Фото из галереи">
                </li>
            <?php endforeach; ?>
        </ul>
        <div class="gallery__arrow-wrapper">
            <a class="gallery__arrow next" onclick="plusSlides(1)">&#10095;</a>
            <a class="gallery__arrow prev" onclick="plusSlides(-1)">&#10094;</a>
        </div>
        <div class="gallery__caption-wrapper caption-container">
            <p class="gallery__wrapper-desc" id="caption"></p>
        </div>

        <ul class="gallery__row">
            <?php $i = 1;
            foreach ($this->galleryImages as $image): ?>
                <li class="gallery__column">
                    <img class="gallery__column-demo cursor" src="<?= $image['url'] ?>" onclick="currentSlide(<?= $i ?>)" alt="Наш спортзал">
                </li>
            <?php $i++;
            endforeach; ?>
        </ul>
    </div>
</section>
<script>
    /* СЛАЙДЕР ДЛЯ ГАЛЕРЕИ */

    let slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    function currentSlide(n) {
        showSlides(slideIndex = n);
    }
    // Галерея со слайдами
    function showSlides(n) {
        let i;
        let slides = document.getElementsByClassName("gallery__list-item");
        let dots = document.getElementsByClassName("gallery__column-demo");
        let captionText = document.getElementById("caption");
        if (n > slides.length) {
            slideIndex = 1
        }
        if (n < 1) {
            slideIndex = slides.length
        }
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";
        captionText.innerHTML = dots[slideIndex - 1].alt;
    }
</script>
<?php $this->end(); ?>