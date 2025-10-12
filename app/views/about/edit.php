<?php $this->setSiteTitle(SITE_TITLE . ' - ' . 'Редактирование' . ' ' . $this->about->title); ?>
<?php $this->start('body') ?>
<div class="wrapper">
    <section class="editpost">
        <div class="editpost__container container">
            <h1 class="posts__list-title">Редактирование</h1>
            <?php $this->partial('about', 'form') ?>
        </div>
    </section>
</div>
<?php $this->end(); ?>