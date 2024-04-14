<form method="post" action="" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="name" class="form-label">Ім'я:</label>
        <input type="text" name="name" value="<?= $model['name'] ?>" class="form-control" id="name">
    </div>
    <div class="mb-3">
        <label for="text" class="form-label">Текст:</label>
        <textarea type="text" name="text" value="<?= $model['text'] ?>" class="form-control" id="text"></textarea>
    </div>
    <button type="submit" class="btn btn-secondary">Зберегти</button>
</form>
