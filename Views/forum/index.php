<?php
$userModel = new \Models\Users();
$user = $userModel->getCurrentUser();
?>
<div class="container overflow-hidden px-5">
    <div class=" mb-4 с11">
        <h5 class="card-title text-center texts">ПРОСТІР ДЛЯ ВАШИХ ДУМОК</h5>
    </div>
    <div>
    </div>
</div>
<div class="text-uppercase text-center">
    <? if (empty($this->user) || $user['access'] == 1): ?>
        <a href="/forum/add" class="btn btn-secondary">- Написати повідомлення -</a>
    <? endif; ?>
</div>
<p></p>

<div class="row">
    <?php foreach ($lastNews as $forum) : ?>
    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">
                    <small class="fst-italic text-muted font-weight-normal card-title">&bull;<?= $forum['datetime'] ?>&bull;</small>
                    <small class=" font-weight-normal">ID:<?= $forum['user_id'] ?></small>
            </h5>
                <p class="card-text"> <?= $forum['title'] ?></p>
                <a href="/forum/view?id=<?= $forum['id'] ?>" class="btn btn-secondary">Детальніше</a>
                <? if ($forum['user_id'] == $user['id']): ?>
                    <a href="/forum/edit?id=<?= $forum['id'] ?>" class="btn btn-outline-warning">Редагувати</a>
                    <a href="/forum/delete?id=<?= $forum['id'] ?>" class="btn btn-outline-danger">Видалити</a>
                <? endif; ?>
                <? if ($user['access'] == 1): ?>
                    <a href="/forum/delete?id=<?= $forum['id'] ?>" class="btn btn-outline-danger">Видалити</a>
                <? endif; ?>
            </div>
        </div>
        <p></p>
    </div>
    <?php endforeach; ?>
    <p></p>
</div>


