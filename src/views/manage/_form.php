<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yuncms\note\models\Note;

/* @var $this yii\web\View */
/* @var $model yuncms\note\models\Note */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

<?= $form->field($model, 'title') ?>
<?= $form->field($model, 'format') ?>
<?= $form->field($model, 'content')->textarea() ?>


    <div class="form-group">
        <?php if ($model->isNewRecord): ?>
            <?= Html::submitButton(Yii::t('note', 'Save as public'), [
                'class' => 'btn btn-success',
                'name' => 'Note[type]',
                'value' => Note::TYPE_PUBLIC
            ]) ?>

            <?= Html::submitButton(Yii::t('note', 'Save as private'), [
                'class' => 'btn pub-btn',
                'name' => 'Note[type]',
                'value' => Note::TYPE_PRIVATE
            ]) ?>
        <?php else: ?>
            <?=
            Html::submitButton(Yii::t('note', 'Update'), ['class' => 'btn btn-primary'])
            ?>
        <?php endif; ?>
    </div>

<?php ActiveForm::end(); ?>