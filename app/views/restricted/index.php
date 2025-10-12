<?= $this->setSiteTitle(SITE_TITLE . ' - Доступ запрещен'); ?>
<?= $this->start('body'); ?>
<section class="restricted">
    <div class="restricted__container contain">
        <h1 class="restricted__title">Страница не существует или у Вас нет доступа к ней</h1>
    </div>
</section>
<?= $this->end(); ?>