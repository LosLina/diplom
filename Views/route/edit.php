<div class="container">
    <form method="post" action="" enctype="multipart/form-data">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="featurette">
                    <h2 class="featurette-heading text-center">Курс - "Ми любимо тварин так само, як і Ви"</h2>
                    <p class="lead">
                    <div class="mb-3">
                        <label for="name" class="form-label text-muted">Ім'я:</label>
                        <input type="text" name="name" readonly class="form-control" id="name" value="<?= $model['name'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="text" class="form-label text-muted">Електронна адреса:</label>
                        <input name="text" readonly class="form-control" id="text" value="<?= $model['text'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Статус:</label>
                        <input type="text" name="status" value="<?= $model['status'] ?>" class="form-control" id="status">
                    </div>
                    <button type="submit" class="btn btn-secondary">Відправити</button>
                </div>
            </div>
        </div>
    </form>
</div>
