<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\helpers\Html;
use xutl\highlightjs\HighlightJs;
use yuncms\note\frontend\assets\NoteAsset;

NoteAsset::register($this);

$this->title = Html::encode($model->title) . ' - ' . Yii::t('note', 'Notes');
?>

<div class="row">
    <div class="col-xs-12 col-md-9 main">
        <h4 class="page-title">
            <i class="glyphicon glyphicon-tags"></i> <?= Html::encode($model->title); ?>

            <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->isCollected(get_class($model), $model->id)): ?>
                <button data-target="collect-button" class="btn btn-default btn-sm"
                        data-loading-text="<?= Yii::t('note', 'Loading...'); ?>"
                        data-source_type="note"
                        data-source_id="<?= $model->id ?>"> <?= Yii::t('note', 'Collected'); ?>
                </button>
            <?php else: ?>
                <button data-target="collect-button" class="btn btn-default btn-sm"
                        data-loading-text="<?= Yii::t('note', 'Loading...'); ?>"
                        data-source_type="note"
                        data-source_id="<?= $model->id ?>"> <?= Yii::t('note', 'Collect'); ?>
                </button>
            <?php endif; ?>
        </h4>

        <div class="fmt">
            <?=HighlightJs::widget([
                'format' => $model->format,
                'content' => $model->content,
            ]); ?>
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


