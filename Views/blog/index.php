<?php
$userModel = new \Models\Users();
$user = $userModel->getCurrentUser();

$page = isset($_GET['page']) ? $_GET['page'] : 1;


?>
<div class="text-end text-uppercase">
    <? if ($user['access'] == 1): ?>
        <a href="/blog/addblog" class="btn btn-secondary">- Додати новину -</a>
    <? endif; ?>
</div>

<div class="container-md">
    <div class=" mb-4 с11">
        <h6 class="card-title text-left texts">НОВИНИ</h6>
    </div>
    <hr class="featurette-divider">
    <?php foreach ($lastNews as $blog): ?>
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1"
                           aria-disabled="true"><?= $blog['datetime'] ?></a>
                    </li>
                    <? if ($user['access'] == 1): ?>
                        <a class="nav-link" href="/blog/editblog?id=<?= $blog['id'] ?>">
                            <img src="/images/checkmarkcircle_111048.png" alt="" class="z">
                        </a>
                        <a class="nav-link" href="/blog/deleteblog?id=<?= $blog['id'] ?>">
                            <img src="/images/1487086362-cancel_81578.png" alt="" class="z">
                        </a>
                    <? endif; ?>
                    <a class="nav-link" href="/blog/viewblog?id=<?= $blog['id'] ?>">
                        <img src="/images/one-finger-click-black-hand-symbol_icon-icons.com_64350%20(1).png" alt=""
                             class="z">
                    </a>
                </ul>
            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0 text-justify">
                    <p><?= $blog['title'] ?></p>
                    <?= $blog['text'] ?>
                </blockquote>
            </div>
        </div>
        <div class=" mb-4"></div>
    <?php endforeach; ?>
    <div>
<!--        <div>-->
<!--        <hr class="pol" />-->
<!--        <a href="/blog/?page=1"><button>1</button></a>-->
<!--        <a href="/blog/?page=2"><button>2</button></a>-->
<!--        </div>-->
    </div>
</div>
