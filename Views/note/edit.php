<!--<form method="post" action="" enctype="multipart/form-data">-->
<!--    <div class="container marketing">-->
<!--        <div class="row featurette">-->
<!--            <div class="col-md-7 c1">-->
<!--                <p class="lead">-->
<!--                <div class="mb-3">-->
<!--                    <label for="name" class="form-label text-muted">Ім'я:</label>-->
<!--                    <input type="text" name="name" readonly class="form-control" id="name" value="--><?//= $model['name'] ?><!--"-->
<!--                </div>-->
<!--                <div class="mb-3">-->
<!--                    <label for="text" class="form-label text-muted">Номер телефону:</label>-->
<!--                    <input name="text" readonly class="form-control" id="text" value="--><?//= $model['phone'] ?><!--"-->
<!--                </div>-->
<!--                <div class="mb-3">-->
<!--                    <label for="text" class="form-label text-muted">Послуга:</label>-->
<!--                    <textarea rows="3" name="text" readonly class="form-control" id="text" value="--><?//= $model['service'] ?><!--"></textarea>-->
<!--                </div>-->
<!--                <div class="mb-3">-->
<!--                    <label for="status" class="form-label">Статус:</label>-->
<!--                    <input type="text" name="status" value="--><?//= $model['status'] ?><!--" class="form-control" id="status">-->
<!--                </div>-->
<!--                <button type="submit" class="btn btn-secondary">Відправити</button>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</form>-->

<div class="container">
    <div class="row justify-content-center center-form">
        <div class="col-md-7">
            <form method="post" action="" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label text-muted">Ім'я:</label>
                    <input type="text" name="name" readonly class="form-control" id="name" value="<?= $model['name'] ?>">
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label text-muted">Номер телефону:</label>
                    <input name="phone" readonly class="form-control" id="phone" value="<?= $model['phone'] ?>">
                </div>
                <div class="mb-3">
                    <label for="service" class="form-label text-muted">Послуга:</label>
                    <textarea rows="3" name="service" readonly class="form-control" id="service"><?= $model['service'] ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Статус:</label>
                    <input type="text" name="status" value="<?= $model['status'] ?>" class="form-control" id="status">
                </div>
                <button type="submit" class="btn btn-secondary">Відправити</button>
            </form>
        </div>
    </div>
</div>

