<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */
namespace yuncms\note\models;

use yii\db\ActiveQuery;

/**
 * Class NoteQuery
 * @package yuncms\note\models
 */
class NoteQuery extends ActiveQuery
{
    /**
     * Apply possible notes order to query
     * @param string $order
     */
    public function applyOrder($order)
    {
        if ($order == 'new') {//按发布时间倒序
            $this->newest();
        } elseif ($order == 'hottest') {//热门笔记
            $this->hottest();
        }
    }

    /**
     * 可访问的笔记
     * @return $this
     */
    public function active()
    {
        return $this->orWhere(['type' => Note::TYPE_PUBLIC])->orWhere(['<=', 'expired_at', time()]);
    }

    /**
     * 热门笔记
     */
    public function hottest()
    {
        return $this->orderBy(['(views / pow((((UNIX_TIMESTAMP(NOW()) - created_at) / 3600) + 2),1.8) )' => SORT_DESC]);
    }

    /**
     * 最新笔记
     * @return $this
     */
    public function newest()
    {
        return $this->orderBy(['created_at' => SORT_DESC]);
    }

    /**
     * @param $limit
     * @return static
     */
    public function views($limit)
    {
        return $this->andWhere(['>', 'views', $limit]);
    }
}