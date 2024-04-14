<form method="post" action="" enctype="multipart/form-data" style="mb-4">
    <div class="mb-3">
        <label for="login" class="form-label">Логін(email):</label>
        <input type="email" name="login" value="<?= $_POST['login'] ?>" class="form-control" id="login">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Пароль:</label>
        <input type="password" name="password" class="form-control" id="password">
    </div>
    <div class="mb-3">
        <label for="password2" class="form-label">Пароль(повторно):</label>
        <input type="password" name="password2" class="form-control" id="password2">
    </div>
    <div class="mb-3">
        <label for="lastname" class="form-label">Прізвище:</label>
        <input type="text" name="lastname" value="<?= $_POST['lastname'] ?>" class="form-control" id=lastname">
    </div>
    <div class="mb-3">
        <label for="firstname" class="form-label">Ім'я:</label>
        <input type="text" name="firstname" value="<?= $_POST['firstname'] ?>" class="form-control" id=firstname">
    </div>
    <div class="mb-3">
        <label for="file" class="form-label">Фото профіля:</label>
        <input type="file" accept="image/jpeg, image/png" name="file" class="form-control" id="file">
        <div class="mb-3">
            <? if (is_file('Files/Users/' . $model['photo_user'].'_s.jpg')) : ?>
                <img src="/Files/Users/<?= $model['photo_user'] ?>_s.jpg"/>
            <? endif; ?>
        </div>
    </div>
    <div class="mb-3">
    </div>
    <button type="submit" class="btn btn-secondary">Зареєструватися</button>
</form>