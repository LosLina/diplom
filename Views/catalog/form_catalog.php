
<form method="post" action="" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="name" class="form-label">Ім'я:</label>
        <input type="text" name="name" value="<?= $model['name'] ?>" class="form-control" id="name">
    </div>
    <div class="mb-3">
        <label for="surname" class="form-label">Прізвище:</label>
        <input type="text" name="surname" value="<?= $model['surname'] ?>" class="form-control" id="surname">
    </div>
    <div class="mb-3">
        <label for="pobat" class="form-label">По-батькові:</label>
        <input type="text" name="pobat" value="<?= $model['pobat'] ?>" class="form-control" id="pobat">
    </div>
    <div class="mb-3">
        <label for="experience" class="form-label">Cтаж:</label>
        <input name="experience" class="form-control editor" id="experience" value="<?= $model['experience'] ?>">
    </div>
    <div class="mb-3">
        <label for="way" class="form-label">Спеціалізація:</label>
        <input name="way" class="form-control editor" id="way" value="<?= $model['way'] ?>">
    </div>
    <button type="submit" class="btn btn-secondary">Зберегти</button>
</form>