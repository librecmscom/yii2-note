<?php

use yii\helpers\Html;
use yii\helpers\Url;

/*
 * @var yii\web\View $this
 * @var yuncms\note\models\Note $model
 */
$this->title = Yii::t('note', 'Update Note: ') . ' ' . $model->title;
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('note', 'Notes'),
    'url' => ['index']
];
$this->params['breadcrumbs'][] = ['label' => Html::encode($model->title), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('note', 'Update');
?>
<div class="row">
    <div class="col-md-12">
        <h2 class="h3 profile-title"><?= Yii::t('note', 'Notes') ?>
            <div class="pull-right">
                <a class="btn btn-primary" href="<?= Url::to(['index']) ?>"><?= Yii::t('note', 'Notes') ?></a>
            </div>
        </h2>
        <div class="row">
            <div class="col-md-12">
                <?= $this->render('_form', ['model' => $model]) ?>
            </div>
        </div>
    </div>
</div>