<?php

use Core\FH;
?>
<form action="<?= $this->formAction ?>" method="POST" enctype="multipart/form-data">
    <?= FH::csrfInput(); ?>
    <?= FH::hiddenInput('images_sorted', ''); ?>
    <?= FH::displayErrors($this->displayErrors); ?>
    <?= FH::inputBlock('text', 'Имя', 'name', $this->coach->name, ['class' => 'form-control input-sm'], ['class' => 'form-group col-md-5 mx-auto my-4']); ?>
    <?= FH::inputBlock('text', 'Специализация', 'subdesc', $this->coach->subdesc, ['class' => 'form-control input-sm'], ['class' => 'form-group col-md-5 mx-auto my-4']); ?>
    <?php echo '<div class="mx-auto d-flex flex-column align-items-end col-md-4 aria-label="Загрузка картинки">'; ?>
    <label for="coachImages" class="upload__label py-2">Загрузить картинку</label>
    <input type="file" multiple name="images[]" id="coachImages" class="upload__image">
    <?php echo '</div>'; ?>
    <?php
    if (isset($this->coach->id)) {
        $this->partial('coaches', 'partials/editImages');
    }
    ?>
    <div class="button__block d-flex justify-content-end column-gap-4 m-4">
        <?= FH::submitBlock('Сохранить', ['class' => 'd-flex btn btn-primary justify-content-center'], ['class' => 'form-group text-center']); ?>
        <a href="<?= PROOT ?>coaches/list" class="d-flex btn btn-danger">Отмена</a>
    </div>
</form> 