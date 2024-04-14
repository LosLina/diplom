<div class="container overflow-hidden px-5">
    <div class=" mb-4 с11">
        <h5 class="card-title text-center texts">РЕДАГУВАННЯ ПРОФІЛЮ</h5>
    </div>
</div>
<form method="post" action="" enctype="multipart/form-data">
    <div class="card card-body">
        <div class="mb-3">
            <label for="login" class="form-label">Логін(email):</label>
            <input type="email" readonly name="login" value="<?= $model['login'] ?>" class="form-control" id="login">
        </div>
        <div class="mb-3">
            <label for="lastname" class="form-label">Прізвище:</label>
            <input type="text" name="lastname" value="<?= $model['lastname'] ?>" class="form-control"
                   id=lastname">
        </div>
        <div class="mb-3">
            <label for="firstname" class="form-label">Ім'я:</label>
            <input type="text"  name="firstname" value="<?= $model['firstname'] ?>" class="form-control"
                   id=firstname">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Новий пароль:</label>
            <input type="password" name="password" class="form-control" id="password">
        </div>
        <div class="mb-3">
            <label for="passwordnew2" class="form-label">Новий пароль(повторно):</label>
            <input type="password" name="passwordnew2" class="form-control" id="passwordnew2">
        </div>
    </div>
    <br>
    <button type="submit" class="btn-sm btn-secondary">Зберегти</button>
</form>