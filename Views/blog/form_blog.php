<form method="post" action="" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="title" class="form-label">Заголовок новини:</label>
        <input type="text" name="title" value="<?= $model['title'] ?>" class="form-control" id="title_blog">
    </div>

    <div class="mb-3">
        <label for="text" class="form-label">Текст новини:</label>
        <textarea name="text" class="form-control editor" id="text" value="<?= $model['text'] ?>"></textarea>
    </div>
    <div class="mb-3">
        <label for="file" class="form-label">Фото до новини:</label>
        <input type="file" accept="image/jpeg, image/png" name="file" class="form-control" id="file">
        <div class="mb-3">
            <? if (is_file('Files/Blogs/' . $model['photo'].'_n.jpg')) : ?>
                <img src="/Files/Blogs/<?= $model['photo_blog'] ?>_n.jpg"/>
            <? endif; ?>
        </div>
    </div>
    <button type="submit" class="btn btn-secondary">Зберегти</button>
</form>