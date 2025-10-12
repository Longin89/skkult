<?= $this->setSiteTitle(SITE_TITLE . ' - Новости'); ?>
<?php $this->setMetaDescription("Новости и статьи СК 'Культурист'"); ?>

<?php $this->start('body'); ?>
<section class="posts">
    <div class="posts__container contain">
        <ul class="posts__list">
            <?php foreach ($this->posts as $post): ?>
                <li class="posts__list-item">
                    <h2 class="posts__list-title"> <?= $post['title']; ?></h2>
                    <div class="posts__list-img">
                        <?php foreach ($post['images'] as $image): ?>
                            <img src="<?= PROOT . $image ?>" alt="Картинка поста" class="posts__img">
                        <?php endforeach; ?>
                    </div>
                    <p class="posts__date">Опубликовано: <?= substr($post['updated_at'], 0, 10); ?></p>
                    <p class="posts__subtitle">
                        <?= $post['content']; ?>

                    </p>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php
        if ($this->pagecount > 1): ?>
            <nav aria-label="Page navigation" class="posts__nav">
                <ul class="posts__nav-list pagination">
                    <?php for ($i = 1; $i <= $this->pagecount; $i++): ?>
                        <li class="posts__list-item <?= ($this->page == $i) ? 'posts__item-active' : '' ?>">
                            <a href="<?= PROOT ?>posts/index?page=<?= $i ?>" class="posts__item-link"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        <? else: ?>
            <style>
                .posts__list-item:last-child {
                    padding: 0 0 8.75em;
                }

                @media(max-width:768px) {
                    .posts__list-item:last-child {
                        padding: 0 0 70px;
                    }
                }
            </style>
        <? endif; ?>
    </div>
</section>
<?php $this->end(); ?>