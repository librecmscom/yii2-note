<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ListView;
use yuncms\note\models\Note;
use yuncms\note\frontend\widgets\Popular;
use yuncms\note\frontend\assets\NoteAsset;
/*
 * @var yii\web\View $this
 */

$this->title = Yii::t('note', 'Notes');
//$this->params['breadcrumbs'][] = $this->title;
NoteAsset::register($this);
?>
<div class="row">
    <div class="col-xs-12 col-md-9 main">
        <h4 class="page-title">
            <i class="glyphicon glyphicon-tags"></i> <?= Html::encode($this->title) ?><br>
        </h4>
        <?= ListView::widget([
            'options' => [
                'class' => 'note-stream'
            ],
            'layout' => '{items} <div class="text-center">{pager}</div>',
            'pager' => [
                'maxButtonCount' => 10,
                'nextPageLabel' => Yii::t('note', 'Next page'),
                'prevPageLabel' => Yii::t('note', 'Previous page'),
            ],
            'dataProvider' => $dataProvider,
            'itemOptions' => ['tag' => 'section', 'class' => 'note-list-item clearfix'],
            'itemView' => '_item'
        ]);
        ?>
    </div>


    <div class="col-xs-12 col-md-3 side">
        <div class="side-alert alert alert-warning mt-30">
            <p><?= Yii::t('note', 'Learned something new？ Write it down'); ?></p>
            <a class="btn btn-primary btn-block mt-10" href="<?= Url::to(['/note/note/create']) ?>"><i
                        class="fa fa-edit"></i> <?= Yii::t('note', 'Write a note'); ?></a>
        </div>
        <?= Popular::widget() ?>
    </div>
</div>