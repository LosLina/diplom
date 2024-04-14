<form method="post" action="">
    <div class="mb-3">
        <label for="login" class="form-label">Логін(email):</label>
        <div class="input-group">
        <span class="input-group-text" id="basic-addon1">@</span>
        <input type="email" name="login" class="form-control" id="login" aria-describedby="basic-addon1">
        </div>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Пароль:</label>
        <input type="password" name="password" class="form-control" id="password">
    </div>
    <button type="submit" class="btn btn-secondary me-2">Увійти</button>
    <a href="/users/register" class="btn btn-secondary me-2">Реєстрація</a>
</form>
