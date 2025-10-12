<?= $this->setSiteTitle(SITE_TITLE . ' - Список услуг и цен'); ?>
<?php $this->start('head'); ?>
<script src="/js/jquery-3.7.1.min.js"></script>
<?php $this->end(); ?>
<?php $this->start('body') ?>
<div class="wrapper">
    <section class="allposts">
        <div class="allposts_container container">
            <h2 class="allposts__title">
                Список услуг и цен
            </h2>
            <table class="table table-bordered table-hover table-responsive">
                <thead>
                    <th class="text-center">№</th>
                    <th class="text-center">Название</th>
                    <th class="text-center">Разовое посещение</th>
                    <th class="text-center">1 месяц</th>
                    <th class="text-center">3 месяца</th>
                    <th class="text-center">6 месяцев</th>
                    <th class="text-center">12 месяцев</th>
                    <th class="text-center actions-head">Действия</th>
                </thead>
                <tbody>
                    <?php foreach ($this->prices as $price): ?>
                        <tr data-id=<?= $price->id ?>>
                            <td class="text-center"><?= $price->id ?></td>
                            <td><?= $price->title ?></td>
                            <td class="text-center"><?= $price->daypay ?></td>
                            <td class="text-center"><?= $price->monthly ?></td>
                            <td class="text-center"><?= $price->quarter ?></td>
                            <td class="text-center"><?= $price->halfyear ?></td>
                            <td class="text-center"><?= $price->yearly ?></td>
                            <td class="actions-row">
                                <a href="<?= PROOT ?>prices/edit/<?= $price->id ?>" title="Редактировать" class="btn btn-sm btn-secondary edit-btn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                    </svg></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
</div>
<?php $this->end() ?>