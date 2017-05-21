<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\helpers\Html;
use xutl\highlightjs\HighlightJs;

$this->title = Html::encode($model->title) . ' - ' . Yii::t('note', 'Notes');
?>

<div class="row">
    <div class="col-xs-12 col-md-9 main">
        <h1>
            <i class="glyphicon glyphicon-tags"></i> <?= Yii::t('note', 'Notes') ?><br>
            <!--            <small>标签不仅能组织和归类你的内容，还能关联相似的内容。正确的使用标签可让你更容易的找到需要的源代码。</small>-->
        </h1>
        <?= Html::encode($model->title); ?>

        <div class="fmt">
            <?php HighlightJs::begin([
                'format' => $model->format
            ]); ?>
            <?= Html::encode($model->content); ?>
            <?php HighlightJs::end() ?>

        </div>
    </div>


    <div class="col-xs-12 col-md-3 side">
        <div class="side-alert alert alert-warning mt-30">
            <p><?= Yii::t('note', 'Learned something new？ Write it down'); ?></p>
            <a class="btn btn-primary btn-block mt-10" href="<?= Url::to(['/note/manage/create']) ?>"><i
                        class="fa fa-edit"></i> <?= Yii::t('note', 'Write a note'); ?></a>
        </div>


    </div>
</div>


