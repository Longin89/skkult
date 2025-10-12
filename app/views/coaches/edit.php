<?php $this->setSiteTitle(SITE_TITLE . ' - Редактирование ' . $this->coach->name); ?>
<?php
$this->start('head'); ?>
<script src="/js/jquery-3.7.1.min.js"></script>
<?php $this->end(); ?>
<?php $this->start('body') ?>
<div class="wrapper">
    <section class="editcoach">
        <div class="editcoach__container container">
            <h1 class="coaches__title text-center my-3">Редактирование тренера</h1>
            <?php $this->partial('coaches', 'form') ?>
        </div>
    </section>
</div>
<?php $this->end(); ?>