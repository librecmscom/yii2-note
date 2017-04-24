<?php

namespace yuncms\note\models;

/**
 * This is the ActiveQuery class for [[NoteFolder]].
 *
 * @see NoteFolder
 */
class NoteFolderQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return NoteFolder[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return NoteFolder|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
