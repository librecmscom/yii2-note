<?php
use yii\web\View;
use yii\helpers\Url;
use yii\helpers\Html;
use xutl\inspinia\Box;
use xutl\inspinia\Toolbar;
use xutl\inspinia\Alert;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel yuncms\note\backend\models\NoteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('note', 'Manage Note');
$this->params['breadcrumbs'][] = $this->title;
$this->registerJs("jQuery(\"#batch_deletion\").on(\"click\", function () {
    yii.confirm('" . Yii::t('app', 'Are you sure you want to delete this item?')."',function(){
        var ids = jQuery('#gridview').yiiGridView(\"getSelectedRows\");
        jQuery.post(\"/note/batch-delete\",{ids:ids});
    });
});", View::POS_LOAD);
?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12 note-index">
            <?= Alert::widget() ?>
            <?php Pjax::begin(); ?>                
            <?php Box::begin([
                //'noPadding' => true,
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
                        [
                            'options' => ['id' => 'batch_deletion', 'class'=>'btn btn-sm btn-danger'],
                            'label' => Yii::t('note', 'Batch Deletion'),
                            'url' => 'javascript:void(0);',
                        ]
                    ]]); ?>
                </div>
                <div class="col-sm-8 m-b-xs">
                    <?= $this->render('_search', ['model' => $searchModel]); ?>
                </div>
            </div>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'options' => ['id' => 'gridview'],
                'layout' => "{items}\n{summary}\n{pager}",
                'filterModel' => $searchModel,
                'columns' => [
                    [
                        'class' => 'yii\grid\CheckboxColumn',
                        "name" => "id",
                    ],
                    //['class' => 'yii\grid\SerialColumn'],
                    'id',
                    'user_id',
                    'folder_id',
                    'uuid',
                    'type',
                    // 'title',
                    // 'format',
                    // 'content:ntext',
                    // 'ip',
                    // 'size',
                    // 'views',
                    // 'expired_at',
                    // 'created_at',
                    // 'updated_at',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => Yii::t('note', 'Operation'),
                        'template' => '{view} {update} {delete}',
                        //'buttons' => [
                        //    'update' => function ($url, $model, $key) {
                        //        return $model->status === 'editable' ? Html::a('Update', $url) : '';
                        //    },
                        //],
                    ],
                ],
            ]); ?>
            <?php Box::end(); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>
