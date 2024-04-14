<div class="container overflow-hidden px-5">
    <div class=" mb-4 с11">
        <h5 class="card-title text-center texts">ВИДАЛЕННЯ ЗАПИСУ</h5>
    </div>
    <div>
    </div>
</div>
<div class="card border-secondary">
    <div class="card-header text-danger">
        Підтвердження дії
    </div>
    <div class="card-body">
        <h5 class="card-title">Ви дійсно бажаєте видалити даний пункт -<b> <?=$model['text']?>?</b></h5>
        <p> - <?=$model['name']?></p>
        <a href="/course/delete?id=<?=$model['id']?>&confirm=yes" class="btn btn-warning">Підтвердити</a>
        <a href="<?=$_SERVER['HTTP_REFERER']?>" class="btn btn-secondary">Відмінити</a>
    </div>
</div>