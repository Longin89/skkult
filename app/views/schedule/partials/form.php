<?php
use Core\H;

use Core\FH;
?>
<form action="<?= $this->formAction ?>" method="POST" class="d-flex flex-column align-items-center">
    <?= FH::csrfInput(); ?>
    <?= FH::displayErrors($this->displayErrors); ?>
    <?= FH::inputBlock('text', 'День недели', 'day', $this->day->name, ['class' => 'form-control', 'readonly' => true], ['class' => 'form-group my-2 col-md-3']); ?>
    <?= FH::inputBlock('text', 'Спортзал', 'gym', $this->schedule->gym, ['class' => 'form-control'], ['class' => 'form-group my-2 col-md-3']); ?>
    <?= FH::inputBlock('text', 'Армрестлинг', 'arm', $this->schedule->arm, ['class' => 'form-control'], ['class' => 'form-group my-2 col-md-3']); ?>
    <?= FH::inputBlock('text', 'Степ-аэробика', 'step', $this->schedule->step, ['class' => 'form-control'], ['class' => 'form-group my-2 col-md-3']); ?>
    <?= FH::inputBlock('text', 'Групповые занятия', 'group', $this->schedule->group, ['class' => 'form-control'], ['class' => 'form-group my-2 col-md-3']); ?>
    <?= FH::inputBlock('text', 'Занятия для детей', 'kids', $this->schedule->kids, ['class' => 'form-control'], ['class' => 'form-group my-2 col-md-3']); ?>
    <div class="button__block d-flex justify-content-end column-gap-4 m-4">
        <?= FH::submitBlock('Добавить', ['class' => 'd-flex btn btn-primary justify-content-center'], ['class' => 'form-group text-center']); ?>
        <a href="<?= PROOT ?>prices/list" class="d-flex btn btn-danger">Отмена</a>
    </div>
</form>