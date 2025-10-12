<?php $this->setSiteTitle(SITE_TITLE . ' - ' . 'Редактирование' . ' ' . $this->post->title); ?>
<?php
$this->start('head'); ?>
<script src="/js/jquery-3.7.1.min.js"></script>
<script src="/js/jquery-ui/jquery-ui.min.js"></script>
<?php $this->end(); ?>
<?php $this->start('body') ?>
<div class="wrapper">
    <section class="editpost">
        <div class="editpost__container container">
            <h1 class="posts__list-title">Редактирование новости</h1>
            <?php $this->partial('posts', 'form') ?>
        </div>
    </section>
</div>
<?php $this->end(); ?>