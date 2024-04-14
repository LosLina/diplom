<?php
$userModel = new \Models\Users();
$user = $userModel->getCurrentUser();
?>
<div class="container">
    <div class="row mb-2 justify-content-center">
        <div class="col-md-8">
            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                    <h3 class="mb-0 text-secondary"><?= $model['login'] ?></h3>
                    <hr/>
                    <p class="card-text mb-auto">
                        <label for="short_text_blog" class="form-label fst-italic">Ім'я:</label><br>
                        <label for="short_text_blog" class="form-label text-secondary"><?= $model['firstname'] ?></label><br>
                        <label for="short_text_blog" class="form-label fst-italic">Прізвище:</label><br>
                        <label for="short_text_blog" class="form-label text-secondary"><?= $model['lastname'] ?></label>
                    </p>
                    <p class="text-left">
                        <a href="/users/deleteuser?id=<?= $model['id'] ?>" class="btn-sm btn-secondary">Видалити
                            профіль</a>
                        <a href="/users/edit?id=<?= $model['id'] ?>" class="btn-sm btn-secondary">Редагувати профіль</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<? if ($user['access'] == 1): ?>
    <table class="table table-secondary">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Ім'я</th>
            <th scope="col">Дата</th>
            <th scope="col">Номер телефону</th>
            <th scope="col">Напрямок</th>
            <th scope="col">Статус</th>
            <th></th><th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($last as $note): ?>
        <tr>
            <th scope="row"><?= $note['id'] ?></th>
            <td><?= $note['name'] ?></td>
            <td><?= $note['datetime'] ?></td>
            <td><?= $note['phone'] ?></td>
            <td><?= $note['service'] ?></td>
            <td><?= $note['status'] ?></td>
            <td>
                <a href="/note/edit?id=<?= $note['id'] ?>" class="btn btn-sm btn-outline-secondary me-1">Редагувати</a>
            </td>
            <td>
                <a href="/note/delete?id=<?= $note['id'] ?>" class=" btn btn-sm btn-outline-secondary me-1">Видалити</a>
            </td>
        </tr>
        </tbody>

        <?php endforeach; ?>
    </table>
<? endif; ?>
