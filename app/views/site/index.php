<?php
use yii\widgets\ListView;

/* @var $this yii\web\View */

$this->title = 'Wisebites Test';
?>
<div class="site-index">
    <?= ListView::widget([
        'dataProvider' => $data,
        'layout' => "{sorter}\n<div class='row'>{items}</div>\n{pager}",
        'itemView' => '_video',
        'itemOptions' => ['class' => 'col-md-4'],
        'sorter' => [
            'options' => [
                'class' => 'pagination',
                'itemOptions' => ['class' => 'page-item'],
            ],
            'linkOptions' => ['class' => 'page-link'],
        ],
        'pager' => [
            'maxButtonCount' => 5,
            'firstPageLabel' => 'first',
            'lastPageLabel' => 'last',
            'linkContainerOptions' => ['class' => 'page-item'],
            'disabledListItemSubTagOptions' => ['class' => 'page-link'],
            'linkOptions' => ['class' => 'page-link'],
        ],
    ])?>
</div>
