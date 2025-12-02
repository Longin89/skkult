<?php

use Core\FH;
?>
<?php $this->start('head'); ?>
<script src="/js/jquery-3.7.1.min.js"></script>
<?php $this->end(); ?>
<?= $this->setSiteTitle(SITE_TITLE . ' - Вход'); ?>
<?php $this->start('body'); ?>
<section class="login">
    <div class="login__container contain">
        <form class="login__form" action="<?= PROOT ?>register/login" method="post">
            <?= FH::csrfInput(); ?>
            <?= FH::displayErrors($this->displayErrors); ?>
            <h2 class="login__form-title">Авторизация</h2>
            <ul class="login__form-list">
                <li class="login__list-item">
                    <?= FH::inputBlock('text', 'Логин', 'username', $this->login->username, ['class' => 'login__item-input'], ['class' => 'login__item-wrapper']); ?>
                </li>
                <li class="login__list-item">
                    <?= FH::inputBlock('password', 'Пароль', 'password', $this->login->password, ['class' => 'login__item-input'], ['class' => 'login__item-wrapper']); ?>
                </li>
                <li class="login__list-item">
                    <?= FH::checkboxBlock('Запомнить меня', 'remember_me', $this->login->getRememberMeChecked(), [], ['class' => 'login__item-wrapper']); ?>
                </li>
                <li class="login__list-item">
                    <?= FH::submitBlock('Войти', ['class' => 'login__item-button'], ['class' => 'login__item-wrapper']); ?>
                </li>
                <li class="login__list-item">
                    <!-- <a href="<?= PROOT ?>register/register" class="register__item-link">Регистрация</a> -->
                </li>
            </ul>
        </form>
    </div>
</section>
<?php $this->end(); ?>