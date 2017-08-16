<?php

use yii\helpers\Html;
use xutl\inspinia\ActiveForm;

/* @var $this yii\web\View */
/* @var $model yuncms\note\backend\models\NoteSearch */
/* @var $form ActiveForm */
?>

<div class="note-search pull-right">

    <?php $form = ActiveForm::begin([
        'layout' => 'inline',
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id', [
        'inputOptions' => [
            'placeholder' => $model->getAttributeLabel('id'),
        ],
    ]) ?>

    <?= $form->field($model, 'user_id', [
        'inputOptions' => [
            'placeholder' => $model->getAttributeLabel('user_id'),
        ],
    ]) ?>

    <?= $form->field($model, 'folder_id', [
        'inputOptions' => [
            'placeholder' => $model->getAttributeLabel('folder_id'),
        ],
    ]) ?>

    <?php // echo $form->field($model, 'uuid') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'format') ?>

    <?php // echo $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'ip') ?>

    <?php // echo $form->field($model, 'size') ?>

    <?php // echo $form->field($model, 'views') ?>

    <?php // echo $form->field($model, 'expired_at') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('note', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('note', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
