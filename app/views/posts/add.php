<?= $this->setSiteTitle(SITE_TITLE . ' - Добавить новость'); ?>
<?php $this->start('body') ?>
<div class="wrapper">
    <section class="add">
        <div class="add__container contain">
            <!-- <table class="table table-bordered table-hover">
                <thead>
                    <th>
                        ID
                    </th>
                    <th>
                        Заголовок
                    </th>
                    <th>
                        Время создания
                    </th>
                </thead>
                <tbody>
                    <?php foreach ($this->post as $item): ?>
                        <tr data-id=<?= $item->id ?>></tr>
                        <td><?= $item->title ?></td>
                        <td><?= $item->content ?></td>
                    <?php endforeach; ?>
                </tbody>
            </table> -->
            <h1 class="add__title text-center my-3">Добавить новость</h1>
            <?php $this->partial('posts', 'form') ?>
        </div>
    </section>
</div>
<?php $this->end() ?>