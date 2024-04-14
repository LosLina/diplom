<?php
$userModel = new \Models\Users();
$user = $userModel->getCurrentUser();
?>
<div class="card text-center">
    <div class="card-header">
        <small class="fst-italic text-muted font-weight-normal card-title ">&bull;<?= $model['datetime'] ?>&bull;</small>
    </div>
    <div class="card-body">
        <blockquote class="blockquote mb-0">
            <p class="card-text text-center"> <?= $model['text'] ?> </p>
        </blockquote>
    </div>
</div>






