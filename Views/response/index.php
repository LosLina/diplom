<?php
$userModel = new \Models\Users();
$user = $userModel->getCurrentUser();

?>

<div class="text-end text-uppercase">
    <? if (empty($this->user)): ?>
    <a href="/response/add" class="btn btn-secondary">- Додати відгук -</a>
    <? endif; ?>
</div>

<div class="container-md">
    <div class=" mb-4 с11">
        <h6 class="card-title text-left texts">ВІДГУКИ</h6>
    </div>
    <hr class="featurette-divider">
    <?php foreach ($respon as $resp): ?>
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1"
                           aria-disabled="true">
                            <?= $resp['name'] ?>
                            <?= $resp['datetime'] ?></a>
                    </li>
                <div class="btn-group">
                    <? if ($resp['avtor_id'] == $user['id']): ?>
                        <a class="" href="/response/edit?id=<?= $resp['id'] ?>">
                            <img src="/images/checkmarkcircle_111048.png" alt="" class="z">
                        </a>
                        <a class="" href="/response/delete?id=<?= $resp['id'] ?>">
                            <img src="/images/1487086362-cancel_81578.png" alt="" class="z">
                        </a>
                    <? endif; ?>
                    <? if ($user['access'] == 1): ?>
                        <a class="" href="/response/delete?id=<?= $resp['id'] ?>">
                            <img src="/images/1487086362-cancel_81578.png" alt="" class="z">
                        </a>
                    <? endif; ?>
                    <p></p>
                </div>
            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0 text-justify">

                    <?= $resp['text'] ?>
                </blockquote>
            </div>
        </div>
        <div class=" mb-4"></div>
    <?php endforeach; ?>
    <div>
    </div>
</div>