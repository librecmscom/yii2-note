<?php

use yii\helpers\Url;
/*
 * @var yii\web\View $this
 */
$this->title = Yii::t('note', 'Create Note');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('note', 'Notes'),
    'url' => ['index']
];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="row">
    <div class="col-md-12">

        <h2 class="h3 profile-title"><?= Yii::t('note', 'Notes') ?>
            <div class="pull-right">
                <a class="btn btn-primary" href="<?=Url::to(['index'])?>"><?=Yii::t('note', 'Notes')?></a>
            </div>
        </h2>
        <div class="row">
            <div class="col-md-12">
                <?= $this->render('_form', ['model' => $model]) ?>
            </div>
        </div>
    </div>
</div>