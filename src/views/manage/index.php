<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

/*
 * @var yii\web\View $this
 * @var yuncms\note\models\Note $model
 */

$this->title = Yii::t('note', 'Notes');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-2">
        <?= $this->render('@yuncms/user/views/_profile_menu') ?>
    </div>
    <div class="col-md-10">
        <h2 class="h3 profile-title"><?= Yii::t('note', 'Notes') ?>
            <div class="pull-right">
                <a class="btn btn-primary" href="<?= Url::to(['create']) ?>"><?= Yii::t('note', 'Create Note') ?></a>
            </div>
        </h2>
        <div class="row">
            <div class="col-md-12">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'layout' => "{items}\n{pager}",
                    'columns' => [
                        [
                            'header' => Yii::t('note', 'Title'),
                            'value' => function ($model) {
                                return Html::a($model->title, ['/note/note/view', 'uuid' => $model->uuid], ['target' => '_blank']);
                            },
                            'format' => 'raw',
                        ],
                        'format',
                        'views',
                        [
                            'header' => Yii::t('note', 'Type'),
                            'value' => function ($model) {
                                if ($model->isPublic()) {
                                    return Html::a(Yii::t('note', 'Public'), ['set-type', 'id' => $model->id, 'type' => 1], [
                                        'class' => 'btn btn-xs btn-success btn-block',
                                        'data-method' => 'post',
                                        'data-confirm' => Yii::t('note', 'Are you sure you want to private this note?'),
                                    ]);
                                } else {
                                    return Html::a(Yii::t('note', 'Private'), ['set-type', 'id' => $model->id, 'type' => 0], [
                                        'class' => 'btn btn-xs btn-danger btn-block',
                                        'data-method' => 'post',
                                        'data-confirm' => Yii::t('note', 'Are you sure you want to public this note?'),
                                    ]);
                                }
                            },
                            'format' => 'raw',
                        ],
                        'created_at:date',
                        'updated_at:date',
                        [
                            'header' => Yii::t('note', 'Operation'),
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{update} {delete}',
                        ],
                    ],
                ]);
                ?>
            </div>
        </div>
    </div>
</div>
