<?php
use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="row">
    <div class="col-md-1">
        <span class="label label-warning "><?= $model->views ?><?=Yii::t('note','views')?></span>
    </div>
    <div class="col-md-9 profile-mine__content--title-warp">
        <a class="profile-mine__content--title"
           href="<?= Url::to(['/note/note/view', 'id' => $model->id]); ?>"><?= Html::encode($model->title) ?></a>
    </div>
    <div class="col-md-2">
        <span class="profile-mine__content--date"><?= date('Y-m-d H:i', $model->created_at); ?></span>
    </div>
</div>
