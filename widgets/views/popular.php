<?php
/**
 * @var yuncms\note\models\Note[] $models
 */
use yii\helpers\Url;
use yii\helpers\Html;

?>


<div class="panel panel-default">
    <div class="panel-heading"><?= Yii::t('note', 'Popular Notes') ?></div>
    <ul class="note-notes-list list-group">
        <?php if (!empty($models)): ?>
            <?php foreach ($models as $model): ?>
                <li class="list-group-item">
                    <a href="<?= Url::to(['/note/note/view', 'uuid' => $model->uuid]) ?>"
                       title="<?= Html::encode($model->title) ?>">
                        <?= Html::encode($model->title) ?>
                    </a>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li class="list-group-item"><?= Yii::t('note', 'No popular notes') ?></li>
        <?php endif; ?>
    </ul>
</div>