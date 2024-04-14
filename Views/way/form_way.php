<form method="post" action="" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="name" class="form-label">Назва:</label>
        <input type="text" name="name" value="<?= $model['name'] ?>" class="form-control" id="title">
    </div>
    <button type="submit" class="btn btn-secondary">Зберегти</button>
</form>