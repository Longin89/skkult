<?= $this->setSiteTitle(SITE_TITLE . ' - Добавить расписание'); ?>
<?php $this->start('body'); ?>
<div class="wrapper">
    <section class="editpost">
        <div class="editpost__container container">
            <h1 class="posts__list-title">Добавить расписание</h1>
            <form action="<?= $this->formAction ?>" method="POST">
                <?= Core\FH::csrfInput(); ?>
                <?= Core\FH::displayErrors($this->displayErrors); ?>
                <div class="form-group my-2">
                    <label for="day_id">День недели</label>
                    <select name="day_id" id="day_id" class="form-control">
                        <option value="">Выберите день</option>
                        <?php foreach ($this->days as $day): ?>
                            <option value="<?= $day->id ?>" <?= ($this->schedule->day_id == $day->id) ? 'selected' : '' ?>><?= $day->name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <?= Core\FH::inputBlock('text', 'Спортзал', 'gym', $this->schedule->gym, ['class' => 'form-control'], ['class' => 'form-group my-2']); ?>
                <?= Core\FH::inputBlock('text', 'Армрестлинг', 'arm', $this->schedule->arm, ['class' => 'form-control'], ['class' => 'form-group my-2']); ?>
                <?= Core\FH::inputBlock('text', 'Степ-аэробика', 'step', $this->schedule->step, ['class' => 'form-control'], ['class' => 'form-group my-2']); ?>
                <?= Core\FH::inputBlock('text', 'Групповые занятия', 'group', $this->schedule->group, ['class' => 'form-control'], ['class' => 'form-group my-2']); ?>
                <?= Core\FH::inputBlock('text', 'Занятия для детей', 'kids', $this->schedule->kids, ['class' => 'form-control'], ['class' => 'form-group my-2']); ?>
                <button type="submit" class="btn btn-success mt-3">Сохранить</button>
                <a href="<?= PROOT ?>schedule/list" class="btn btn-secondary mt-3">Отмена</a>
            </form>
        </div>
    </section>
</div>
<?php $this->end(); ?> 