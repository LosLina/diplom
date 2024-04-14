<?php
$userModel = new \Models\Users();
$user = $userModel->getCurrentUser();
?>
<div class="text-end text-uppercase">
    <? if ($user['access'] == 1): ?>
        <a href="/info/addinfo" class="btn btn-secondary">- Додати -</a>
        <a href="/info/editinfo?id=<?= $blog['id'] ?>" class="btn btn-secondary">- Редагувати -</a>
        <a href="/info/deleteinfo?id=<?= $blog['id'] ?>" class="btn btn-secondary">- Видалити -</a>
    <? endif; ?>
</div>

<div class="container overflow-hidden px-5">
    <div class=" mb-4 ">
        <h5 class="card-title text-center texts">ЗВ'ЯЖІТЬСЯ З НАМИ</h5>
    </div>
    <div>
    </div>
</div>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <p class="card-text">

                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2536.1394150435467!2d30.597219499999998!3d50.5315775!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40d4d114d489bbad%3A0xf1c27d463017cf5d!2z0YPQuy4g0JzQuNC70L7RgdC70LDQstGB0LrQsNGPLCA0Mywg0JrQuNC10LIsIDAyMDAw!5e0!3m2!1sru!2sua!4v1709280060291!5m2!1sru!2sua" width="600" height="220" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Контакти клініки "Щасливі Лапки"</h3>
                    <?php foreach ($lastNews as $info): ?>
                        <h6 class="card-title">Електронна адреса</h6>
                    <p class="card-text"><?=  $info['email'] ?></p>
                        <h6 class="card-title">Номер телефону</h6>
                        <p class="card-text"><?=  $info['phone'] ?></p>
                        <h6 class="card-title">Локація</h6>
                    <p class="card-text"><?=  $info['location'] ?></p>

                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
