<?= $this->setSiteTitle(SITE_TITLE . ' - Расписание'); ?>
<?php $this->setMetaDescription("Расписание тренировок СК 'Культурист' — тренажерный зал, армрестлинг, степ-аэробика, групповые и детские занятия."); ?>

<?php $this->start('body'); ?>
<section class="schedule">
                <div class="schedule__container container">
                    <h1 class="schedule__title">
                        Расписание занятий
                    </h1>
                    <table class="schedule__table">
                        <tbody>
                            <tr>
                                <th class="schedule__table-title">День</th>
                                <th class="schedule__table-title">Спортзал</th>
                                <th class="schedule__table-title">Армрестлинг</th>
                                <th class="schedule__table-title">Степ-аэробика</th>
                                <th class="schedule__table-title">Групповые занятия</th>
                                <th class="schedule__table-title">Занятия для детей</th>
                            </tr>
                            <?php foreach ($this->schedules as $schedule): ?>
                        <tr data-id=<?= $schedule->id ?>>
                                <td data-th="День недели" class="schedule__table-service">
                                    <?= $this->days[$schedule->day_id - 1]->name ?>
                                </td>
                                <td data-th="Спортзал" class="schedule__table-price">
                                    <?= $schedule->gym ?>
                                </td>
                                <td data-th="Армрестлинг" class="schedule__table-price">
                                    <?= $schedule->arm ?>
                                </td>
                                <td data-th="Степ-аэробика" class="schedule__table-price">
                                    <?= $schedule->step ?>
                                </td>
                                <td data-th="Групповые занятия" class="schedule__table-price">
                                    <?= $schedule->group ?>
                                </td>
                                <td data-th="Занятия для детей" class="schedule__table-price">
                                    <?= $schedule->kids ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="schedule__image">
                        <img src="/images/builder.webp" alt="builder">
                    </div>
                </div>
            </section>
<?php $this->end(); ?>