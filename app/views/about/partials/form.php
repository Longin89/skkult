<?php

use Core\FH;
?>
<form action="<?= $this->formAction ?>" method="POST">
    <?= FH::csrfInput(); ?>
    <?= FH::displayErrors($this->displayErrors); ?>
    <?= FH::inputBlock('text', 'Заголовок', 'title', $this->about->title, ['class' => 'form-control input-sm'], ['class' => 'form-group col-md-5 mx-auto my-4']); ?>
    <?= FH::inputTextarea('Содержание', 'content', $this->about->content, ['class' => 'form-control input-sm tiny', 'rows' => '8'], ['class' => 'form-group col-md-5 mx-auto my-4']); ?>
    <div class="button__block d-flex justify-content-end column-gap-4 m-4">
        <?= FH::submitBlock('Сохранить', ['class' => 'd-flex btn btn-primary justify-content-center'], ['class' => 'form-group text-center']); ?>
        <a href="<?= PROOT ?>about/index" class="d-flex btn btn-danger">Отмена</a>
    </div>
</form>