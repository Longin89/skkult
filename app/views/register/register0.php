<?php

use Core\FH;
?>
<?php $this->start('head'); ?>
<script src="/js/jquery-3.7.1.min.js"></script>
<?php $this->end(); ?>
<?= $this->setSiteTitle(SITE_TITLE . ' - Регистрация'); ?>
<?php $this->start('body'); ?>
<section class="register">
    <div class="register__container contain">
        <form class="register__form" action="" method="post">
            <?= FH::csrfInput(); ?>
            <?= FH::displayErrors($this->displayErrors) ?>
            <h2 class="register__form-title">Создание учетной записи</h2>
            <ul class="register__form-list">
                <li class="register__list-item">
                    <?= FH::inputBlock('text', 'Логин', 'username', $this->newUser->username, ['class' => 'register__item-input'], ['class' => 'register__item-wrapper']); ?>
                </li>
                <li class="register__list-item">
                    <?= FH::inputBlock('text', 'Email', 'email', $this->newUser->email, ['class' => 'register__item-input'], ['class' => 'register__item-wrapper']); ?>
                </li>
                <li class="register__list-item">
                    <?= FH::inputBlock('password', 'Пароль', 'password', $this->newUser->password, ['class' => 'register__item-input'], ['class' => 'register__item-wrapper']); ?>
                </li>
                <li class="register__list-item">
                    <?= FH::inputBlock('password', 'Подтвердите пароль', 'confirm', $this->newUser->getConfirm(), ['class' => 'register__item-input'], ['class' => 'register__item-wrapper']); ?>
                </li>
                <li class="register__list-item">
                    <?= FH::submitBlock('Регистрация', ['class' => 'register__item-button'], ['class' => 'register__item-wrapper']); ?>
                </li>
            </ul>
        </form>
    </div>
</section>
<?php $this->end(); ?>