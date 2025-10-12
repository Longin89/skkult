<?php $this->setSiteTitle(SITE_TITLE . ' - ' . 'Редактирование расписания'); ?>
<?php $this->start('body') ?>
<div class="wrapper">
    <section class="editpost">
        <div class="editpost__container container">
            <h1 class="posts__list-title">Редактирование расписания</h1>
            <?php $this->partial('schedule', 'form') ?>
        </div>
    </section>
</div>
<?php $this->end(); ?>