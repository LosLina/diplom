<form method="post" action="" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="name" class="form-label">Назва:</label>
        <input type="text" name="name" value="<?= $model['name'] ?>" class="form-control" id="name">
    </div>

    <div class="mb-3">
        <label for="value" class="form-label">Значення:</label>
        <input type="text" name="value" class="form-control editor" id="value" value="<?= $model['value'] ?>">
    </div>
    <button type="submit" class="btn btn-secondary">Зберегти</button>
</form>