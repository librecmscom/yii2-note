<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */
namespace yuncms\note\widgets;

use yii\base\Widget;
use yuncms\note\models\Note;


/**
 * 获取热门问题
 * @author Nikolay Kostyurin <nikolay@artkost.ru>
 * @since 2.0
 */
class Popular extends Widget
{
    public $limit = 10;
    public $views = 10;

    /**
     * @inheritdoc
     */
    public function run()
    {
        $models = Note::find()->andWhere(['type' => Note::TYPE_PUBLIC])
            ->views($this->views)
            ->limit($this->limit)
            ->all();

        return $this->render('popular', [
            'models' => $models,
        ]);
    }
}