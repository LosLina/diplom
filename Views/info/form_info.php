<form method="post" action="" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="title" class="form-label">Загаловок:</label>
        <input type="text" name="title" value="<?= $model['title'] ?>" class="form-control" id="title">
    </div>
    <div class="mb-3">
        <label for="phone" class="form-label">Номер телефону:</label>
        <input type="number" name="phone" class="form-control editor" id="phone" value="<?= $model['phone'] ?>">
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Електрона пошта:</label>
        <input type="email" name="email" class="form-control editor" id="email" value="<?= $model['email'] ?>">
    </div>
    <div class="mb-3">
        <label for="location" class="form-label">Місцезнаходження:</label>
        <input name="location" class="form-control editor" id="location" value="<?= $model['location'] ?>">
    </div>
    <button type="submit" class="btn btn-secondary">Зберегти</button>
</form>