<?= $this->setSiteTitle(SITE_TITLE . ' - Контакты'); ?>
<?php $this->setMetaDescription("Контакты СК 'Культурист' — адрес: г. Стерлитамак, ул. Дружбы 3 (цоколь)"); ?>

<?php $this->start('body'); ?>
<section class="contacts">
    <div class="contacts__container contain">
        <h1 class="contacts__title">
            Контакты
        </h1>
        <ul class="contacts__list">
            <li class="contacts__list-item">
                <p class="contacts__item-desc">
                    Наш адрес: г. Стерлитамак, ул. Дружбы 3, цокольный этаж
                </p>
            </li>
            <li class="contacts__list-item">
                <p class="contacts__item-desc">
                    Мы в 2-Gis: <a href="<?= $this->contacts->gis?>" class="contacts__item-link" target="_blank">Ссылка</a>
                </p>
            </li>
            <li class="contacts__list-item">
                <p class="contacts__item-desc">
                    Наш телефон: <a href="tel:<?= $this->contacts->phone?>" class="contacts__item-link"><?= $this->contacts->phone?></a>
                </p>
            </li>
            <li class="contacts__list-item">
                <p class="contacts__item-desc">
                    Наш Email: <a href="mailto:<?= $this->contacts->email?>" class="contacts__item-link"><?= $this->contacts->email?></a>
                </p>
            </li>
            <li class="contacts__list-item">
                <p class="contacts__item-desc">
                    Мы ВКонтакте: <a href="<?= $this->contacts->vk?>" class="contacts__item-link" target="_blank">Ссылка</a>
                </p>
            </li>
            <li class="contacts__list-item">
                <p class="contacts__item-desc">
                    Мы в WhatsApp: <a href="https://wa.me/<?= $this->contacts->whatsup?>" class="contacts__item-link">+<?= $this->contacts->whatsup?></a>
                </p>
            </li>
        </ul>
        <div id="map" class="contacts__map"></div>
    </div>
</section>
<?php $this->end(); ?>