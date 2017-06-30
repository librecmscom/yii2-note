<?php

use yii\bootstrap\Nav;
use yii\widgets\ListView;
use yuncms\live\assets\LiveAsset;

/* @var yii\web\View $this */
/* @var yuncms\user\models\User $model */

LiveAsset::register($this);
$this->context->layout = '@yuncms/user/views/layouts/space';
$this->params['user'] = $user;
if (!Yii::$app->user->isGuest && Yii::$app->user->id == $user->id) {//Me
    $who = Yii::t('user', 'My');
} else {
    $who = Yii::t('user', 'His');
}
$this->title = Yii::t('user', '{who} Stream', [
    'who' => $who,
]);
?>

<div class="stream-following">
    <?= $this->render('_nav', ['user' => $user]); ?>
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