<?php

use Core\FH;
?>
<form action="<?= $this->formAction ?>" method="POST" enctype="multipart/form-data">
    <?= FH::csrfInput(); ?>
    <?= FH::hiddenInput('images_sorted', ''); ?>
    <?= FH::displayErrors($this->displayErrors); ?>
    <?= FH::inputBlock('text', 'Заголовок', 'title', $this->post->title, ['class' => 'form-control input-sm'], ['class' => 'form-group col-md-5 mx-auto my-4']); ?>
    <?= FH::inputTextarea('Содержание', 'content', $this->post->content, ['class' => 'form-control input-sm tiny', 'rows' => '8'], ['class' => 'form-group col-md-5 mx-auto my-4']); ?>
    <?php echo '<div class="mx-auto d-flex flex-column align-items-end col-md-4 aria-label="Загрузка картинки">'; ?>
    <label for="postImages" class="upload__label py-2">Загрузить картинку</label>
    <input type="file" multiple name="images[]" id="postImages" class="upload__image">
    <?php echo '</div>'; ?>
    <?php
    if ($_SERVER['REQUEST_URI'] != PROOT . 'posts/add') {
        $this->partial('posts', 'editImages');
    }
    ?>
    <div class="button__block d-flex justify-content-end column-gap-4 m-4">
        <?= FH::submitBlock('Добавить', ['class' => 'd-flex btn btn-primary justify-content-center'], ['class' => 'form-group text-center']); ?>
        <a href="<?= PROOT ?>posts/list" class="d-flex btn btn-danger">Отмена</a>
    </div>
</form>