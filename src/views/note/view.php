<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use xutl\highlightjs\HighlightJs;
?>
<?=$model->title;?>


<?php HighlightJs::begin([
    'format'=>$model->format
]);?>
<?= Html::encode($model->content); ?>
<?php HighlightJs::end()?>
