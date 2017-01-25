<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model yuncms\note\models\Note */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

<?= $form->field($model, 'title') ?>
<?= $form->field($model, 'format') ?>
<?= $form->field($model, 'content')->textarea() ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('note', 'Create') : Yii::t('note', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>