<?php
$userModel = new \Models\Users();
$user = $userModel->getCurrentUser();



?>
<div class="text-end text-uppercase">
    <? if ($user['access'] == 1): ?>
        <a href="/price/addprice" class="btn btn-secondary">- Додати -</a>
    <? endif; ?>
</div>
<div class="container">
    <h1 class="mt-5 mb-2">Вивід матеріалу</h1>

    <!-- Таблиця для виводу матеріалу -->
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Дата і час</th>
            <th scope="col">Назва</th>
            <th scope="col">Значення</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($lastPrice as $price): ?>
            <tr>
                <td><?= $price['datetime'] ?></td>
                <td><?= $price['name'] ?></td>
                <td><?= $price['value'] ?></td>
                <?php if ($user['access'] == 1): ?>
                    <td class="text-end">
                        <a href="/price/editprice?id=<?= $price['id'] ?>" class="btn btn-primary">Редагувати</a>
                        <a href="/price/deleteprice?id=<?= $price['id'] ?>" class="btn btn-danger">Видалити</a>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
