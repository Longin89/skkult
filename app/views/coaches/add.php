<?= $this->setSiteTitle(SITE_TITLE . ' - Добавить тренера'); ?>
<?php $this->start('body') ?>
<section class="add">
    <div class="add__container contain">
        <h1 class="add__title text-center my-3">Добавить тренера</h1>
        <?php $this->partial('coaches', 'form') ?>
    </div>
</section>
<?php $this->end() ?> 