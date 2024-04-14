<table class="table table-secondary">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Ім'я</th>
        <th scope="col">Електронна пошта</th>
        <th scope="col">Дата</th>
        <th scope="col">Статус</th>
        <th></th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($last as $opr): ?>
    <tr>
        <th scope="row"><?= $opr['id'] ?></th>
        <td><?= $opr['name'] ?></td>
        <td><?= $opr['text'] ?></td>
        <td><?= $opr['datetime'] ?></td>
        <td><?= $opr['status'] ?></td>
        <td>
            <a href="/route/edit?id=<?= $opr['id'] ?>" class="btn btn-sm btn-outline-secondary me-1">Редагувати</a>
        </td>
        <td>
            <a href="/route/delete?id=<?= $opr['id'] ?>" class=" btn btn-sm btn-outline-secondary me-1">Видалити</a>
        </td>
    </tr>
    </tbody>

    <?php endforeach; ?>
</table>

