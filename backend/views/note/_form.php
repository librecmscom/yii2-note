<?php
use yii\helpers\Html;
use xutl\inspinia\ActiveForm;

/* @var \yii\web\View $this */
/* @var yuncms\note\models\Note $model */
/* @var ActiveForm $form */
?>
<?php $form = ActiveForm::begin(['layout'=>'horizontal', 'enableAjaxValidation' => true, 'enableClientValidation' => false,]); ?>

    <?= $form->field($model, 'type')->textInput() ?>    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'format')->textInput(['maxlength' => true]) ?>    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>    <div class="hr-line-dashed"></div>

    <?= $form->field($model, 'size')->textInput() ?>    <div class="hr-line-dashed"></div>


<div class="form-group">
    <div class="col-sm-4 col-sm-offset-2">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('note', 'Create') : Yii::t('note', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>

