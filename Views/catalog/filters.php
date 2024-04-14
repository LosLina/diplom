<div class="text-end text-uppercase">
    <a href="<?=$_SERVER['HTTP_REFERER']?>" class="btn btn-secondary">Назад</a>
</div>
<hr class="featurette-divider">
<div class="album py-5 bg-light">
    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3">
            <?php foreach ($last as $catalog): ?>
                <div class="col">
                    <div class="card shadow-sm">
                        <?  if (is_file('Files/Catalog/' . $catalog['photo'] . '_n.jpg')) : ?>
                            <?  if (is_file('Files/Catalog/' . $catalog['photo'] . '_n.jpg')) : ?>
                                <a href="/Files/Catalog/<?= $catalog['photo'] ?>_n.jpg" >
                            <?  endif; ?>
                            <img class="ibd-placeholder-img card-img-top"  src="/Files/Catalog/<?= $catalog['photo'] ?>_n.jpg"/>
                            <?  if (is_file('Files/Catalog/' . $catalog['photo'] . '_n.jpg')) : ?>
                                </a>
                            <?  endif; ?>
                        <?  endif; ?>

                        <div class="card-body">
                            <h4 class="card-text text-center"><?= $catalog['title'] ?></h4>
                            <hr class="featurette-divider">
                            <div class="card-text">Прізвище: <?= $catalog['surname'] ?></div>
                            <div class="card-text">Ім'я: <?= $catalog['name'] ?></div>
                            <div class="card-text">По-батькові: <?= $catalog['pobat'] ?></div>
                            <div class="card-text">Спеціалізація: <?= $catalog['way'] ?></div>
                            <div class="card-text">Стаж: <?= $catalog['experience'] ?></div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <? if ($user['access'] == 1): ?>
                                        <a class="" href="/catalog/edit?id=<?= $catalog['id'] ?>">
                                            <img src="/images/checkmarkcircle_111048.png" alt="" class="z">
                                        </a>
                                        <a class="" href="/catalog/delete?id=<?= $catalog['id'] ?>">
                                            <img src="/images/1487086362-cancel_81578.png" alt="" class="z">
                                        </a>
                                    <? endif; ?>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>