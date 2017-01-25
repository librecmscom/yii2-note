<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use xutl\highlightjs\HighlightJsAsset;

HighlightJsAsset::register($this);
$this->registerJs('
    $(\'pre code\').each(function(i, block) {
        hljs.highlightBlock(block);
    });
');


?>
<?=$model->title;?>
<pre class="<?=$model->format?>"><?=Html::encode($model->content);?></pre>
