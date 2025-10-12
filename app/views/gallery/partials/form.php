<?php

use Core\FH;
?>
<form action="<?= $this->formAction ?>" method="POST" enctype="multipart/form-data">
    <?= FH::csrfInput(); ?>
    <?= FH::hiddenInput('images_sorted', ''); ?>
    <?= FH::displayErrors($this->displayErrors); ?>
    <?= FH::inputBlock('text', 'Alt текст', 'alt_text', $this->gallery->alt_text, ['class' => 'form-control input-sm'], ['class' => 'form-group col-md-5 mx-auto my-4']); ?>
    <div class="mx-auto d-flex flex-column align-items-end col-md-4" aria-label="Загрузка картинки">
        <label for="galleryImages" class="upload__label py-2">Загрузить картинки</label>
        <input type="file" multiple name="images[]" id="galleryImages" class="upload__image">
    </div>
    <?php
    $this->partial('gallery', 'editImages');

    ?>
    <div class="button__block d-flex justify-content-end column-gap-4 m-4">
        <?= FH::submitBlock('Сохранить', ['class' => 'd-flex btn btn-primary justify-content-center'], ['class' => 'form-group text-center']); ?>
        <a href="<?= PROOT ?>admindashboard" class="d-flex btn btn-danger">Отмена</a>
    </div>
</form>