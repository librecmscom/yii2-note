<?php

use yii\bootstrap\Nav;
use yii\widgets\ListView;

/* @var yii\web\View $this */
/* @var yuncms\user\models\User $model */

$this->context->layout = '@yuncms/space/frontend/views/layouts/space';
$this->params['user'] = $user;

if (!Yii::$app->user->isGuest && Yii::$app->user->id == $user->id) {//Me
    $this->title = Yii::t('note', 'My Notes');
} else {
    $this->title = Yii::t('note', 'His Notes');
}
?>

<div class="stream-following">
    <?=$this->render('_nav', ['user' => $user]);?>
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'options' => [
            'tag' => 'ul',
            'class' => 'profile-mine__content mb-20',
        ],
        'layout' => "{items}\n{pager}",
        'itemOptions' => ['tag' => 'li'],
        'itemView' => '_item',//子视图
    ]); ?>
</div>