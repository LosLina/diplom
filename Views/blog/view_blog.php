<div class="container2">
    <div class="post2">
        <div class="post2-image">
            <? if (is_file('Files/Blogs/' . $model['photo'] . '_n.jpg')) : ?>
                <? if (is_file('Files/Blogs/' . $model['photo'] . '_n.jpg')) : ?>
                    <a href="/Files/Blogs/<?= $model['photo'] ?>_n.jpg" data-fancybox="gallery">
                <? endif; ?>
                <img class="" src="/Files/Blogs/<?= $model['photo'] ?>_n.jpg"/>
                <? if (is_file('Files/Blogs/' . $model['photo'] . '_n.jpg')) : ?>
                    </a>
                <? endif; ?>
            <? endif; ?>
        </div>
        <div class="post2-content">
            <div class="post2-header">
                <h2 class="text-center"><?= $model['title'] ?></h2>
                <div class="text-center">
                    &bull; <?= $model['datetime'] ?> &bull;</div>
                <div class="post2-meta">
                    <span class="author2"></span>
                </div>
            </div >
            <p class="vv1"><?= $model['text'] ?></p>
        </div>
    </div>
</div>





