<?php
/** @var $model \app\models\Video */
?>
<div class="card mb-4 shadow-sm">
    <img src="<?=$model->thumbnail?>" class="card-img-top" alt="<?=$model->title?>">
    <div class="card-body">
        <small><?=Yii::$app->formatter->asDate($model->added)?></small>
        <h5><?=$model->title?></h5>
        <div class="d-flex justify-content-between align-items-center">
            <small>Views: <?=$model->views?></small>
            <small class="text-muted"><?=Yii::$app->formatter->format($model->duration, \app\helpers\Formatter::asDuration())?></small>
        </div>
    </div>
</div>