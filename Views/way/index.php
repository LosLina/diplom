<?php
$userModel = new \Models\Users();
$user = $userModel->getCurrentUser();
?>
<div class="text-end text-uppercase">
    <? if ($user['access'] == 1): ?>
        <a href="/way/addway" class="btn btn-secondary">- Додати -</a>
    <? endif; ?>
</div>
<div class="container">
    <h1 class="mt-5 mb-4">Основні напрямки клініки</h1>

    <!-- Таблиця для виводу матеріалу -->
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Дата і час</th>
            <th scope="col">Назва</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($lastWay as $way): ?>
            <tr>
                <td><?= $way['datetime'] ?></td>
                <td><?= $way['name'] ?></td>
                <?php if ($user['access'] == 1): ?>
                    <td class="text-end">
                        <a href="/way/edit?id=<?= $way['id'] ?>" class="btn btn-primary">Редагувати</a>
                        <a href="/way/delete?id=<?= $way['id'] ?>" class="btn btn-danger">Видалити</a>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>