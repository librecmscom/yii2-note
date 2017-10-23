<?php

use yii\helpers\Url;
use yii\helpers\Html;
use xutl\highlightjs\HighlightJs;

/* @var $this yii\web\View */

$this->title = Html::encode($model->title) . ' - ' . Yii::t('note', 'Notes');
$this->context->layout = false;

?>
<?php $this->beginPage() ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title><?= Html::encode($model->title); ?> - Printed Paste
        ID: <?= Url::to(['/note/note/view', 'id' => $model->id], true) ?></title>
    <meta name="robots" content="noindex"/>
    <?= Html::csrfMetaTags() ?>
    <?php $this->head() ?>
    <style>
        body {
            line-height: 1.5em;
            font-family: Consolas, Menlo, Monaco, Lucida Console, Liberation Mono, DejaVu Sans Mono, Bitstream Vera Sans Mono, monospace, serif;
            font-size: 9pt;
            top: 0;
            margin: 0;
            padding: 0;
        }

        ol {
            margin: 0;
        }
    </style>
    <script>
        function printpage() {
            window.print();
        }
    </script>
</head>
<body onload="printpage()">
<?php $this->beginBody() ?>
<?php HighlightJs::begin([
    'format' => $model->format
]); ?>
<?= Html::encode($model->content); ?>
<?php HighlightJs::end() ?>
<?php $this->endBody() ?>
</body>
</html><?php $this->endPage() ?>
