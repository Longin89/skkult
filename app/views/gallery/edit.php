<?php $this->setSiteTitle(SITE_TITLE . ' - ' .  'Редактирование галереи'); ?>
<?php $this->start('head'); ?>
<script src="/js/jquery-3.7.1.min.js"></script>
<script src="/js/jquery-ui/jquery-ui.min.js"></script>
<script src="/js/alertMsg.js"></script>
<script src="/js/popper.min.js"></script>
<link rel="stylesheet" href="/css/alertMsg.css" />
<?php $this->end(); ?>
<?php $this->start('body') ?>
<div class="wrapper">
    <section class="editgallery">
        <div class="editgallery__container container">
            <h1 class="posts__list-title">Редактирование галереи</h1>
            <?php $this->partial('gallery', 'form') ?>
        </div>
    </section>
</div>
<?php $this->end(); ?>