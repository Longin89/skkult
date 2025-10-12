<?= $this->setSiteTitle(SITE_TITLE . ' - Цена'); ?>
<?php $this->setMetaDescription("Актуальные цены в СК 'Культурист'"); ?>

<?php $this->start('body'); ?>
<section class="prices">
    <div class="prices__container container">
        <h1 class="prices__title">
            Наши цены
        </h1>
        <table class="prices__table">
            <tbody>
                <tr>
                    <th class="prices__table-title">Цена</th>
                    <th class="prices__table-title">Разовое посещение</th>
                    <th class="prices__table-title">1 месяц</th>
                    <th class="prices__table-title">3 месяца</th>
                    <th class="prices__table-title">6 месяцев</th>
                    <th class="prices__table-title">12 месяцев</th>
                </tr>
                <?php foreach ($this->prices as $price): ?>
                    <tr>
                        <td data-th="Вид услуги" class="prices__table-service">
                            <?= $price->title ?>
                        </td>
                        <td data-th="Разовое посещение" class="prices__table-price">
                            <?= $price->daypay ?>
                        </td>
                        <td data-th="Цена за месяц" class="prices__table-price">
                            <?= $price->monthly ?>
                        </td>
                        <td data-th="Цена за 3 месяца" class="prices__table-price">
                            <?= $price->quarter ?>
                        </td>
                        <td data-th="Цена за 6 месяцев" class="prices__table-price">
                            <?= $price->halfyear ?>
                        </td>
                        <td data-th="Цена за год" class="prices__table-price">
                            <?= $price->yearly ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="prices__image">
            <img src="/images/price_builder.webp" alt="price_builder">
        </div>
    </div>
</section>
<?php $this->end(); ?>