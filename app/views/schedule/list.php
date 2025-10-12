<?= $this->setSiteTitle(SITE_TITLE . ' - Расписание'); ?>
<?php $this->start('body') ?>
<div class="wrapper">
    <section class="allposts">
        <div class="allposts_container container schedule__list">
            <h2 class="allposts__title">
                Расписание
            </h2>
            <table class="table table-bordered table-hover table-responsive">
                <thead>
                    <th class="text-center">№</th>
                    <th class="text-center">День недели</th>
                    <th class="text-center">Спортзал</th>
                    <th class="text-center">Армрестлинг</th>
                    <th class="text-center">Степ-аэробика</th>
                    <th class="text-center">Групповые занятия</th>
                    <th class="text-center">Занятия для детей</th>
                    <th class="text-center actions-head">Действия</th>
                </thead>
                <tbody>
                    <?php foreach ($this->schedules as $schedule): ?>
                        <tr data-id=<?= $schedule->id ?>>
                            <td class="text-center"><?= $schedule->id ?></td>
                            <td><?= $this->days[$schedule->day_id - 1]->name ?></td>
                            <td class="text-center"><?= $schedule->gym ?></td>
                            <td class="text-center"><?= $schedule->arm ?></td>
                            <td class="text-center"><?= $schedule->step ?></td>
                            <td class="text-center"><?= $schedule->group ?></td>
                            <td class="text-center"><?= $schedule->kids ?></td>
                            <td class="actions-row">
                                <a href="<?= PROOT ?>schedule/edit/<?= $schedule->id ?>" title="Редактировать" class="btn btn-sm btn-secondary edit-btn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
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