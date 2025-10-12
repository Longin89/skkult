<?php

use Core\FH;
?>
<form action="<?= $this->formAction ?>" method="POST" class="d-flex flex-column align-items-center">
    <?= Core\FH::csrfInput(); ?>
    <?= Core\FH::displayErrors($this->displayErrors); ?>
    <?= Core\FH::inputBlock('text', 'Название', 'title', $this->price->title, ['class' => 'form-control'], ['class' => 'form-group my-2 col-md-3']); ?>
    <?= Core\FH::inputBlock('text', 'Разовое посещение', 'daypay', $this->price->daypay, ['class' => 'form-control'], ['class' => 'form-group my-2 col-md-3']); ?>
    <?= Core\FH::inputBlock('text', '1 месяц', 'monthly', $this->price->monthly, ['class' => 'form-control'], ['class' => 'form-group my-2 col-md-3']); ?>
    <?= Core\FH::inputBlock('text', '3 месяца', 'quarter', $this->price->quarter, ['class' => 'form-control'], ['class' => 'form-group my-2 col-md-3']); ?>
    <?= Core\FH::inputBlock('text', '6 месяцев', 'halfyear', $this->price->halfyear, ['class' => 'form-control'], ['class' => 'form-group my-2 col-md-3']); ?>
    <?= Core\FH::inputBlock('text', '12 месяцев', 'yearly', $this->price->yearly, ['class' => 'form-control'], ['class' => 'form-group my-2 col-md-3']); ?>
    <div class="button__block d-flex justify-content-end column-gap-4 m-4">
        <?= FH::submitBlock('Добавить', ['class' => 'd-flex btn btn-primary justify-content-center'], ['class' => 'form-group text-center']); ?>
        <a href="<?= PROOT ?>prices/list" class="d-flex btn btn-danger">Отмена</a>
    </div>
</form>