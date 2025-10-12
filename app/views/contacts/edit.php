<?php
use Core\FH;
$this->setSiteTitle(SITE_TITLE . ' - Редактировать контакты');
$this->start('body'); ?>
<div class="wrapper">
    <section class="editcontacts">
        <div class="editcontacts__container container">
            <h1 class="contacts__title">Редактировать контакты</h1>
            <form action="<?= $this->formAction ?>" method="POST">
                <?= FH::csrfInput(); ?>
                <?= FH::displayErrors($this->displayErrors); ?>
                <?= FH::inputBlock('text', '2GIS', 'gis', $this->contacts->gis, ['class' => 'form-control input-sm', 'placeholder' => 'https://2gis.ru/sterlitamak/inside/7600460026350576/firm/7600352652166873?m=55.939877%2C53.64896%2F17.03'], ['class' => 'form-group col-md-5 mx-auto my-2']); ?>
                <?= FH::inputBlock('text', 'Телефон', 'phone', $this->contacts->phone, ['class' => 'form-control input-sm', 'placeholder' => '+73473439773'], ['class' => 'form-group col-md-5 mx-auto my-2']); ?>
                <?= FH::inputBlock('text', 'Email', 'email', $this->contacts->email, ['class' => 'form-control input-sm', 'placeholder' => '444celena@mail.ru'], ['class' => 'form-group col-md-5 mx-auto my-2']); ?>
                <?= FH::inputBlock('text', 'VK', 'vk', $this->contacts->vk, ['class' => 'form-control input-sm', 'placeholder' => 'https://vk.com/kulturiststr'], ['class' => 'form-group col-md-5 mx-auto my-2']); ?>
                <?= FH::inputBlock('text', 'WhatsApp', 'whatsup', $this->contacts->whatsup, ['class' => 'form-control input-sm', 'placeholder' => '79173495679'], ['class' => 'form-group col-md-5 mx-auto my-2']); ?>
                <?= FH::inputBlock('text', 'Telegram', 'telegram', $this->contacts->telegram, ['class' => 'form-control input-sm'], ['class' => 'form-group col-md-5 mx-auto my-2']); ?>
                <div class="button__block d-flex justify-content-end column-gap-4 m-4">
                    <?= FH::submitBlock('Сохранить', ['class' => 'd-flex btn btn-primary justify-content-center'], ['class' => 'form-group text-center']); ?>
                    <a href="<?= PROOT ?>contacts/index" class="d-flex btn btn-danger">Отмена</a>
                </div>
            </form>
        </div>
    </section>
</div>
<?php $this->end(); ?>
