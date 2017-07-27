<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */

namespace yuncms\note\frontend\widgets;

use yii\base\Widget;
use yuncms\note\models\Note;


/**
 * 获取热门问题
 * @author Nikolay Kostyurin <nikolay@artkost.ru>
 * @since 2.0
 */
class Popular extends Widget
{
    /**
     * @var int 获取数量
     */
    public $limit = 10;

    /**
     * @var int 最少显示次数
     */
    public $views = 10;

    /**
     * @inheritdoc
     */
    public function run()
    {
        $models = Note::find()->andWhere(['type' => Note::TYPE_PUBLIC])
            ->views($this->views)
            ->limit($this->limit)->orderBy(['(views / pow((((UNIX_TIMESTAMP(NOW()) - created_at) / 3600) + 2),1.8) )' => SORT_DESC])
            ->all();

        return $this->render('popular', [
            'models' => $models,
        ]);
    }
}