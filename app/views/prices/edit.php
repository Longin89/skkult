<?php $this->setSiteTitle(SITE_TITLE . ' - ' . 'Редактирование' . ' ' . $this->price->title); ?>
<?php $this->start('body') ?>
<div class="wrapper">
    <section class="editpost">
        <div class="editpost__container container">
            <h1 class="posts__list-title">Редактирование услуги</h1>
            <?php $this->partial('prices', 'form') ?>
        </div>
    </section>
</div>
<?php $this->end(); ?>