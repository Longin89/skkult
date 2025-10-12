<?= $this->setSiteTitle(SITE_TITLE . ' - Список тренеров'); ?>
<?php $this->start('head'); ?>
<script src="/js/jquery-3.7.1.min.js"></script>
<script src="/js/alertMsg.js"></script>
<script src="/js/popper.min.js"></script>
<script>
    // Вынести в отдельный модуль, без повтора
    function deleteCoach(id) {
        if (window.confirm("Удалить тренера?")) {
            jQuery.ajax({
                url: '<?= PROOT ?>coaches/delete',
                method: "POST",
                data: {
                    id: id
                },
                success: function(resp) {
                    jQuery('tr[data-id="' + resp.model_id + '"]').remove();
                    alertMsg(resp.msg, resp.success ? 'success' : 'danger', 3000);
                }
            });
        }
    }
</script>
<link rel="stylesheet" href="/css/alertMsg.css" />
<?php $this->end(); ?>
<?php $this->start('body') ?>
<div class="wrapper">
    <section class="list">
        <div class="list__container contain">
            <h1 class="coaches__title text-center my-3">Список тренеров</h1>
            <a href="<?= PROOT ?>coaches/add" class="btn btn-success mb-3">Добавить тренера</a>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="text-center">№</th>
                        <th class="text-center">Имя</th>
                        <th class="text-center">Специализация</th>
                        <th class="text-center">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->coaches as $coach): ?>
                        <tr data-id="<?= $coach->id ?>">
                            <td class="text-center"><?= $coach->id ?></td>
                            <td><?= $coach->name ?></td>
                            <td><?= $coach->subdesc ?></td>
                            <td class="actions-row"><a href="<?= PROOT ?>coaches/edit/<?= $coach->id ?>" title="Редактировать" class="btn btn-sm btn-secondary edit-btn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                    </svg></a>
                                <a href="#" title="Удалить" class="btn btn-sm btn-danger edit-btn" onclick="deleteCoach('<?= $coach->id ?>');return false;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
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