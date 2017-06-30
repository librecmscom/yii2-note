<?php
use yii\bootstrap\Nav;
?>

<?= Nav::widget([
    'options' => ['class' => 'nav nav-tabs'],
    'items' => [

        //我的笔记
        ['label' => Yii::t('note', 'My Notes'), 'url' => ['/note/space/started', 'id' => $user->id]],
        //我收藏的笔记
        ['label' => Yii::t('note', 'Collection of notes'), 'url' => ['/note/space/collected', 'id' => $user->id]]
    ]
]); ?>
