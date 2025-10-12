<?= $this->setSiteTitle(SITE_TITLE . ' - О клубе'); ?>
<?php $this->setMetaDescription("О клубе 'Культурист' — история, ценности и миссия спортивного клуба. Узнайте, чем мы отличаемся и почему нам доверяют."); ?>

<?php $this->start('body'); ?>
<section class="posts">
    <div class="posts__container contain">
        <h1 class="posts__list-title"><?= $this->about->title; ?></h1>
        <img src="/images/about.webp" alt="about">
        <p class="posts__subtitle"><?= $this->about->content; ?></p>
    </div>
</section>
<?php $this->end(); ?>