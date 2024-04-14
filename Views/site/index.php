<!--Контент головної сторінки-->
<div class="container-fluid">
    <hr class="featurette-divider">
    <div class="slideshow">
        <div class="slideshow-item">
            <img src="/images/1.jpg" alt="">
        </div>
        <div class="slideshow-item">
            <img src="/images/6.jpg" alt="">
        </div>
        <div class="slideshow-item">
            <img src="/images/3.jpg" alt="">
        </div>
        <div class="slideshow-item">
            <img src="/images/4.jpg" alt="">
        </div>
        <div class="slideshow-item">
            <img src="/images/5.jpg" alt="">
        </div>
    </div>
</div>
<div class=" mb-3"></div>
<hr class="featurette-divider">
<div class="container marketing">
    <div class="row featurette">
        <div class="col text-center">
            <div class=" mb-5"></div>
            <h2 class="featurette-heading"> <span class="text-muted">Швидкий запис на консультацію</span></h2>
            <a href="/note/add" class="btn btn-secondary">Записатись</a>
        </div>
    </div>
</div>


<!--<div class="container">-->
<!--    <h2 class="mt-5 mb-3">Пример формы на Bootstrap</h2>-->
<!--    <form>-->
<!--        <div class="form-group">-->
<!--            <label for="exampleInputName">Имя</label>-->
<!--            <input type="text" class="form-control" id="exampleInputName" placeholder="Введите ваше имя">-->
<!--        </div>-->
<!--        <div class="form-group">-->
<!--            <label for="exampleInputEmail">Email адрес</label>-->
<!--            <input type="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Введите ваш email">-->
<!--            <small id="emailHelp" class="form-text text-muted">Мы никогда не будем делиться вашей электронной почтой с кем-либо еще.</small>-->
<!--        </div>-->
<!--        <div class="form-group">-->
<!--            <label for="exampleInputPassword">Пароль</label>-->
<!--            <input type="password" class="form-control" id="exampleInputPassword" placeholder="Введите пароль">-->
<!--        </div>-->
<!--        <button type="submit" class="btn btn-primary">Отправить</button>-->
<!--    </form>-->
<!--</div>-->

<div class=" mb-5"></div>
<?php foreach ($lastNews as $blog): ?>
    <div class="container">
        <div class="card text-right border-secondary mb-3">
            <div class="card-header ">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <div class="nav-link active text-secondary">НОВИНИ</div>
                    </li>
                    <li class="nav-item">
                        <div class="nav-link  featurette-heading"><?= $blog['datetime'] ?></div>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <h5 class="card-title"><?= $blog['title'] ?></h5>
                <p class="card-text"><?= $blog['text'] ?></p>
                <a href="/blog/viewblog?id=<?= $blog['id'] ?>" class="btn btn-outline-secondary">Детальніше</a>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<div class="album py-5 bg-light">
    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3">
            <?php foreach ($lastN as $catalog): ?>
                <div class="col">
                    <div class="card shadow-sm">
                        <? if (is_file('Files/Catalog/' . $catalog['photo'] . '_n.jpg')) : ?>
                            <? if (is_file('Files/Catalog/' . $catalog['photo'] . '_n.jpg')) : ?>
                                <a href="/Files/Catalog/<?= $catalog['photo'] ?>_n.jpg" >
                            <? endif; ?>
                            <img class="ibd-placeholder-img card-img-top"
                                 src="/Files/Catalog/<?= $catalog['photo'] ?>_n.jpg"/>
                            <? if (is_file('Files/Catalog/' . $catalog['photo'] . '_n.jpg')) : ?>
                                </a>
                            <? endif; ?>
                        <? endif; ?>
                        <div class="card-body">
                            <h4 class="card-text text-center"><?= $catalog['title'] ?></h4>
                            <hr class="featurette-divider">
                            <div class="card-text">Прізвище: <?= $catalog['surname'] ?></div>
                            <div class="card-text">Ім'я: <?= $catalog['name'] ?></div>
                            <div class="card-text">По-батькові: <?= $catalog['pobat'] ?></div>
                            <div class="card-text">Спеціалізація: <?= $catalog['way'] ?></div>
                            <div class="card-text">Стаж: <?= $catalog['experience'] ?></div>
                            <div class="d-flex justify-content-end align-items-center">
                                <div class="btn-group ">
                                    <? if ($user['access'] == 1): ?>
                                        <a class="" href="/catalog/edit?id=<?= $catalog['id'] ?>">
                                            <img src="/images/checkmarkcircle_111048.png" alt="" class="z">
                                        </a>
                                        <a class="" href="/catalog/delete?id=<?= $catalog['id'] ?>">
                                            <img src="/images/1487086362-cancel_81578.png" alt="" class="z">
                                        </a>
                                    <? endif; ?>
                                    <p></p>
                                </div>
                                <small class="text-muted centered text-center"><?= $catalog['datetime'] ?></small>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>


<div class=" mb-3"></div>
<hr class="featurette-divider">
<div class="container marketing">
    <div class="row featurette">
        <div class="col-md-7 c1">
            <div class=" mb-5"></div>
            <h2 class="featurette-heading"> <span class="text-muted"> Курс - "Ми любимо тварин так само, як і Ви"</span>
            </h2>
            <a href="/site/add" class="btn btn-secondary">Записатись</a>
        </div>
        <div class="col-md-5">
            <img class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="350"
                 height="350" src="/images/23814-146.jpg">
        </div>
    </div>
</div>
<hr class="featurette-divider">
<?php foreach ($respon as $resp): ?>
    <div class="container">
        <div class="card text-right border-secondary mb-3">
            <div class="card-header ">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <div class="nav-link active text-secondary"><?= $resp['name'] ?></div>
                    </li>
                    <li class="nav-item">
                        <div class="nav-link  featurette-heading"><?= $resp['datetime'] ?>
                            </div>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <p class="card-text"><?= $resp['text'] ?></p>

            </div>
        </div>
    </div>
<?php endforeach; ?>