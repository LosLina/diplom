<?php ?>
<form method="post" action="" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="title" class="form-label">Заголовок:</label>
        <input type="text" name="title" value="<?= $model['title'] ?>" class="form-control" id="title_blog">
    </div>
    <div class="mb-3">
        <label for="text" class="form-label">Основний текст:</label>
        <textarea name="text" class="form-control editor" id="text" value="<?= $model['text'] ?>"></textarea>
    </div>
    <button type="submit" class="btn btn-secondary">Зберегти</button>
</form>
