<?php

use yii\helpers\Html;
use xutl\inspinia\Box;
use xutl\inspinia\Toolbar;
use xutl\inspinia\Alert;

/* @var $this yii\web\View */
/* @var $model yuncms\note\models\Note */

$this->title = Yii::t('note', 'Update Note') . ': ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('note', 'Manage Note'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12 note-update">
            <?= Alert::widget() ?>
            <?php Box::begin([
            'header' => Html::encode($this->title),
            ]); ?>
            <div class="row">
                <div class="col-sm-4 m-b-xs">
                    <?= Toolbar::widget(['items' => [
                        [
                            'label' => Yii::t('note', 'Manage Note'),
                            'url' => ['index'],
                        ],
                        [
                            'label' => Yii::t('note', 'Create Note'),
                            'url' => ['create'],
                        ],
                    ]]); ?>
                </div>
                <div class="col-sm-8 m-b-xs">

                </div>
            </div>

            <?= $this->render('_form', [
            'model' => $model,
            ]) ?>
            <?php Box::end(); ?>
        </div>
    </div>
</div>